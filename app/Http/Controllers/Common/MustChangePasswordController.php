<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Services\Auth\CheckUserRoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MustChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function getPasswordChangePage()
    {
        $authenticatedUser = Auth::user();
        return view('common.updatePassword', compact('authenticatedUser'));
    }

    public function updatePassword(Request $request)
    {
        $currentUser =  Auth::user();
        $password = $request->password;
        $password_confirm = $request->confirm_password;

        if ($password !== $password_confirm) {
            return back()->withInput()->with('error','password confirmation do not match');
        } else {
           try {
                DB::beginTransaction();
                $userTuUpdatePassword = User::find($currentUser->id);
                $userTuUpdatePassword->update([
                    'password' => Hash::make($password),
                    'has_updated_password' => true
                ]);
                DB::commit();
                if ((new CheckUserRoleService)->isNotary($currentUser)) {
                    return redirect()->route('getNotaryDashboardOverview');
                } else {
                    return redirect()->route('getClientDashboardOverview');
                }
           } catch (\Throwable $th) {
                DB::rollback();
                return back()->withInput()->with('danger', 'an error occured...please try again');
           }
        }
    }
}
