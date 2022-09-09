<?php

namespace App\Http\Controllers\Auth;

use App\Events\ClientRegistered;
use App\Events\NotaryRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Role;

class AuthenticationController extends Controller
{
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
        $data = $request->all();
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
            
            if ($role === \App\Models\Role::NOTARY) {
                $national_id = $request->national_id;
                $district = $request->district;
                $sector = $request->sector;
                $cell = $request->cell;
                $image = '';
                $nationalIdPhotocopy = '';
                if ($request->hasFile('image')) {
                    $image = $this->storeFile($request, 'image', $telephone, 'notary_passport_images');
                }
    
                if ($request->hasFile('national_id_photocopy')) {
                   $nationalIdPhotocopy =  $this->storeFile($request, 'national_id_photocopy', $telephone, 'notary_photocopy_ids');
                }

                $newUser = [
                    'id' => Str::uuid()->toString(),
                    'role_id' => Role::where('type',$data['role'])->value('id'),
                    'names' => $names,
                    'email' => $email,
                    'telephone' => $telephone,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]; 
                
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
            } else {
                $national_id = $request->national_id;
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
            ClientRegistered::dispatch($newUser, $newClient);
            }
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function storeFile($request, $file, $tel, $disk) {
        $uploadedFile = $request->file($file);
        $filename = time() . '_'.$tel.'.' .$uploadedFile->getClientOriginalExtension();
        $finalFile = $uploadedFile->storeAs(date('YF'),$filename, $disk);
        return $finalFile;        
    }
}
