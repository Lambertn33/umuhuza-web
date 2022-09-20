<?php 
 namespace App\Http\Services\Common;
 use Illuminate\Support\Facades\DB;

 class AccountStatus {
    
    public function changeAccountStatus($user)
    {
        DB::beginTransaction();
        $user->update([
            'is_active' => $user->is_active ? false : true
        ]);
        DB::commit();
        return back()->with('success', !$user->is_active ? 'Account closed successfully' : 'Account re-activated successfully');
    }
}

?>