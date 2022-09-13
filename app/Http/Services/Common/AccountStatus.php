<?php 
 namespace App\Http\Services\Common;
 use Illuminate\Support\Facades\DB;

 class AccountStatus {
    
    public function changeAccountStatus($user)
    {
        DB::beginTransaction();
        if ($user->is_active) {
            $user->update([
               'is_active' => false
            ]);
            DB::commit();
            return back()->with('success','Account closed successfully');
        } else {
            $user->update([
               'is_active' => true
            ]);
            DB::commit();
            return back()->with('success','Account re-activated successfully');
        }
    }
}

?>