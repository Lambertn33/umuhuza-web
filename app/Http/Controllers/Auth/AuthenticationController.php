<?php

namespace App\Http\Controllers\Auth;

use App\Events\NotaryRegistered;
use App\Http\Controllers\Controller;
use App\Http\Services\Auth\CheckUserRoleService;
use App\Http\Services\Common\FileStoring;
use App\Http\Services\Common\ValidateInputs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;
use App\Models\Client;
use App\Models\Notary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthenticationController extends Controller
{
    public function getLoginPage(Request $request)
    {
        if ($request->session()->has('registrationData')) {
            $request->session()->forget('registrationData');
        }
        if ($request->session()->has('currentUser')) {
            $request->session()->forget('currentUser');
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
        if (!(new ValidateInputs)->validatePhoneNumber($data['telephone'], $phoneFormat, $phoneTotalDigits)) {
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
            DB::beginTransaction();
            $data = $request->session()->get('registrationData');
            $names = $data['names'];
            $role = $data['role'];
            $email = $data['email'];
            $telephone = $data['telephone'];   
            $national_id = $request->national_id;
            if (!(new ValidateInputs)->validateNationalIDLength($national_id)) {
                return back()->withInput()->with('error','The national ID Must consists of 16 digits');
            }

            if( (new ValidateInputs)->validateNationalIDExistence($national_id)) {
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
                    $image = (new FileStoring)->storeFile($request, 'image', $telephone, 'notary_passport_images');
                }
    
                if ($request->hasFile('national_id_photocopy')) {
                   $nationalIdPhotocopy = (new FileStoring)->storeFile($request, 'national_id_photocopy', $telephone, 'notary_photocopy_ids');
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
                DB::commit();
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
                DB::commit();
                //TODO...Job To Send Welcome Message and Password
                return redirect()->route('getConfirmationPage');
            }
            
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()->with('error','an error occured..please try again');
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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();
        return redirect()->route('getLoginPage');
    }

    public function storeFile($request, $file, $tel, $disk) {
        $uploadedFile = $request->file($file);
        $filename = time() . '_'.$tel.'.' .$uploadedFile->getClientOriginalExtension();
        $finalFile = $uploadedFile->storeAs(date('YF'),$filename, $disk);
        return $finalFile;        
    }
}
