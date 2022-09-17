<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Common\TextFormat;
use Illuminate\Http\Request;
use App\Models\Password_Recover;
use App\Models\User;
use App\Http\Services\Common\ValidateInputs;
use App\Jobs\SMS\Auth\ForgotPasswordCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class PasswordResetController extends Controller
{
    public function getPasswordRecoverPage(Request $request)
    {
        if ($request->session()->has('currentUser')) {
            $request->session()->forget('currentUser');
        }
        return view('auth.password_recover.phoneInput');
    }   

    public function providePhoneForPasswordReset(Request $request)
    {
        $phoneFormat = 2507;
        $phoneTotalDigits = 12;
        $telephone = $request->telephone;
        if (!(new ValidateInputs)->validatePhoneNumber($telephone, $phoneFormat, $phoneTotalDigits)) {
            return back()->withInput()->with('error','The Telephone number must start with '. $phoneFormat .'... and consists of '.$phoneTotalDigits.' digits');
        }
        try {
           DB::beginTransaction();
           $user = User::where('telephone', $telephone);
           if (!$user->exists()) {
               return back()->withInput()->with('error','the telephone number provided does not exist in our records');
           } else {
               // Generate confirmation code;
               $user = $user->first();
               $code = rand(100000,999999);
               $encryptedCode =  $code;
               $newPasswordRecover = [
                   'id' => Str::uuid()->toString(),
                   'user_id' => $user->id,
                   'confirmation_code' => $encryptedCode,
                   'created_at' => now(),
                   'updated_at' => now()
               ];
               if (Password_Recover::where('user_id', $user->id)->exists()) {
                   Password_Recover::where('user_id', $user->id)->delete();
               }
               Password_Recover::insert($newPasswordRecover);
               $request->session()->put('currentUser', $user);
               DB::commit();
               dispatch(new ForgotPasswordCode($user, $code));
               return redirect()->route('getCodeRecoverPage');

           }
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
            return back()->withInput()->with('error','an error occured...please try again');
        }
    }

    public function getCodeRecoverPage(Request $request)
    {
        $currentUser =  $request->session()->get('currentUser');
        if (!$currentUser) {
            return redirect()->route('getLoginPage');
        }
        return view('auth.password_recover.codeInput', compact('currentUser'));
    }

    public function provideCodeForPasswordReset(Request $request)
    {
        $currentUser =  $request->session()->get('currentUser');
        if (!$currentUser) {
            return redirect()->route('getLoginPage');
        }
        $code = $request->code;
        $codeCheck = Password_Recover::where('user_id', $currentUser->id)
                    ->where('confirmation_code', $code);
        if (!$codeCheck->exists()) {
            return back()->withInput()->with('error', 'Wrong Password Recover Confirmation Code');
        } else {
            return redirect()->route('getNewPasswordRecoverPage')->with('success', 'Code provided successfully.. you can reset your password');
        }
    }

    public function getNewPasswordRecoverPage(Request $request)
    {
        $currentUser =  $request->session()->get('currentUser');
        if (!$currentUser) {
            return redirect()->route('getLoginPage');
        }
        return view('auth.password_recover.newPasswordInput', compact('currentUser'));
    }

    public function provideNewPasswordForPasswordReset(Request $request)
    {
        $currentUser =  $request->session()->get('currentUser');
        $password = $request->password;
        $password_confirm = $request->password_confirm;

        if ($password !== $password_confirm) {
            return back()->withInput()->with('error','password confirmation do not match');
        } else {
           try {
                DB::beginTransaction();
                $userTuUpdatePassword = User::find($currentUser->id);
                $userTuUpdatePassword->update([
                    'password' => Hash::make($password)
                ]);
                Password_Recover::where('user_id', $currentUser->id)->delete();
                $request->session()->forget('currentUser');
                DB::commit();
                return redirect()->route('getLoginPage')->with('success','password recovered successfully..you can now login');
           } catch (\Throwable $th) {
                DB::rollback();
                return back()->withInput()->with('error','password confirmation do not match');
           }
        }
        
    }
}
