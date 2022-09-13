<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['adminMiddleware','auth.session']);
    }

    public function getAllClients()
    {
        $allSystemClients = Client::with('user')->get();
        return view('administrator.clients.index', compact('allSystemClients'));
    }

    public function changeAccountStatus($clientId)
    {
        try {
            DB::beginTransaction();
            $client = Client::find($clientId);
            $user = $client->user;
            if ($user->is_active) {
                $user->update([
                    'is_active' => false
                ]);
                //TODO logout user on other devices

                DB::commit();
                return back()->with('success','user account closed successfully');
            } else {
                $user->update([
                    'is_active' => true
                ]);
                DB::commit();
                return back()->with('success','user account re-activated successfully');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
