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
            $client = Client::find($clientId);
            $user = $client->user;
            DB::beginTransaction();
            if ($user->is_active) {
                $user->update([
                    'is_active' => false
                ]);
                DB::commit();
                return back()->with('success','client account closed successfully');
            } else {
                $user->update([
                    'is_active' => true
                ]);
                DB::commit();
                return back()->with('success','client account re-activated successfully');
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->withInput()->with('error','an error occured..please try again');
        }
    }

    public function getClientFiles($clientId)
    {
        $client = Client::find($clientId);
        $clientFiles =  $client->sentFiles()->get();
         return view('administrator.clients.files', compact('client','clientFiles'));
    }
}
