<?php 
 namespace App\Http\Services;
 use App\Models\Role;
 use Illuminate\Support\Facades\Auth;

 class CheckUserRoleService {

    public function isAdministrator($user)
    {
        return $this->checkRole($user, \App\Models\Role::ADMINISTRATOR) ? true : false;
    }

    public function isNotary($user)
    {
        return $this->checkRole($user, \App\Models\Role::NOTARY) ? true : false;
    }

    public function isClient($user)
    {
        return $this->checkRole($user, \App\Models\Role::CLIENT) ? true : false;
    }

    public function checkRole($currentUser, $role)
    {
        $RoleId = Role::where('type', $role)->first();
        return $currentUser->role_id == $RoleId->id ? true : false;
    }
 }

?>