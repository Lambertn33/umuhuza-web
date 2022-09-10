<?php

namespace App\Http\Controllers\Auth;

use App\Events\NotaryRegistered;
use App\Http\Controllers\Controller;
use App\Http\Services\CheckUserRoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;
use App\Models\Client;
use App\Models\Notary;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function getLoginPage(Request $request)
    {
        if ($request->session()->has('registrationData')) {
            $request->session()->forget('registrationData');
        }
        return view('auth.login');
    }

    public function getRegistrationPage(Request $request)
    {
        $data = [];
        $roles = Role::get();
        if ($request->session()->has('registrationData')) {
            $data = $request->session()->get('registrationData');
        }
        return view('auth.register',compact('data'));
    }

    public function registerOnFirstPage(Request $request)
    {
        $phoneFormat = 2507;
        $phoneTotalDigits = 12;
        $data = $request->all();
        $emailValidation = User::where('email', $data['email']);
        $phoneValidation = User::where('telephone', $data['telephone']);
        if ((substr($data['telephone'], 0, 4) != $phoneFormat) || strlen($data['telephone']) != $phoneTotalDigits) {
            return back()->withInput()->with('error','The Telephone number must start with '. $phoneFormat .'... and consists of '.$phoneTotalDigits.' digits');
        }
        if ($emailValidation->exists()) {
            return back()->withInput()->with('error','The email provided has been already taken');
        }
        if ($phoneValidation->exists()) {
            return back()->withInput()->with('error','The telephone provided has been already taken');
        }
        $request->session()->put('registrationData', $data);
        return redirect()->route('getRegistrationNextPage');
    }

    public function getRegistrationNextPage(Request $request)
    {
        if (!$request->session()->has('registrationData')) {
            return back();
        }
        $data = $request->session()->get('registrationData');
        $names = $data['names'];
        $role = $data['role'];
        return view('auth.next', compact('names', 'role')); 
    }

    public function submitRegistration(Request $request)
    {
        try {
            $data = $request->session()->get('registrationData');
            $names = $data['names'];
            $role = $data['role'];
            $email = $data['email'];
            $telephone = $data['telephone'];   
            $national_id = $request->national_id;
            if (strlen($national_id) != 16) {
                return back()->withInput()->with('error','The national ID Must consists of 16 digits');
            }

            if ($this->validateNationalID($national_id)) {
                return back()->withInput()->with('error','The national ID provided already exists');
            }

            
            if ($role === \App\Models\Role::NOTARY) {
                $district = $request->district;
                $sector = $request->sector;
                $cell = $request->cell;
                $image = '';
                $nationalIdPhotocopy = '';
                $newUser = [
                    'id' => Str::uuid()->toString(),
                    'role_id' => Role::where('type',$data['role'])->value('id'),
                    'names' => $names,
                    'email' => $email,
                    'telephone' => $telephone,
                    'is_active' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]; 
                
                if ($request->hasFile('image')) {
                    $image = $this->storeFile($request, 'image', $telephone, 'notary_passport_images');
                }
    
                if ($request->hasFile('national_id_photocopy')) {
                   $nationalIdPhotocopy =  $this->storeFile($request, 'national_id_photocopy', $telephone, 'notary_photocopy_ids');
                }
                $newNotary = [
                    'id' => Str::uuid()->toString(),
                    'user_id' => $newUser['id'],
                    'national_id_photocopy' => $nationalIdPhotocopy,
                    'notary_code' => 12345,
                    'district' => $district,
                    'sector' => $sector,
                    'cell' => $cell,
                    'national_id' => $national_id,
                    'image' => $image,
                    'status' => \App\Models\Notary::PENDING,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                NotaryRegistered::dispatch($newUser, $newNotary);
                return redirect()->route('getConfirmationPage');
            } else {
                $newUser = [
                    'id' => Str::uuid()->toString(),
                    'role_id' => Role::where('type',$data['role'])->value('id'),
                    'names' => $names,
                    'email' => $email,
                    'telephone' => $telephone,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $newClient = [
                    'id' => Str::uuid()->toString(),
                    'user_id' => $newUser['id'],
                    'national_id' => $national_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                User::insert($newUser);
                Client::insert($newClient);

                //TODO...Job To Send Welcome Message and Password
                return redirect()->route('getConfirmationPage');
            }
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getConfirmationPage(Request $request)
    {
        if (!$request->session()->has('registrationData')) {
            return back();
        }
        $data =  $request->session()->get('registrationData');
        return view('auth.confirm',compact('data'));

    }

    public function authenticate(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if ( (Auth::attempt(['email' => $username, 'password' => $password])) || (Auth::attempt(['telephone' => $username, 'password' => $password])) ) {
           if (Auth::user()->is_active) {
            $authenticatedUser = Auth::user();
            if ((new CheckUserRoleService)->isAdministrator($authenticatedUser)) {
                return redirect()->route('getAdminDashboardOverview');
            }else if ((new CheckUserRoleService)->isNotary($authenticatedUser)) {
                return redirect()->route('getNotaryDashboardOverview');
            } else{
                return redirect()->route('getClientDashboardOverview');
            }
           } else {
             return back()->withInput()->with('error','Your account is locked.. please contact the system administrator');
           }
        } else {
            return back()->withInput()->with('error','Invalid credentials..');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('getLoginPage');
    }

    public function storeFile($request, $file, $tel, $disk) {
        $uploadedFile = $request->file($file);
        $filename = time() . '_'.$tel.'.' .$uploadedFile->getClientOriginalExtension();
        $finalFile = $uploadedFile->storeAs(date('YF'),$filename, $disk);
        return $finalFile;        
    }

    public function validateNationalID($input){
        if (Notary::where('national_id', $input)->exists() || Client::where('national_id', $input)->exists()) {
            return true;
        } else {
            return false;
        }
    }
}
