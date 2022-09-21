<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert(array(
            0 => array (
                'id' => Str::uuid()->toString(),
                'role_id' => Role::where('type', \App\Models\Role::ADMINISTRATOR)->value('id'),
                'names' => 'System Administrator',
                'email' => 'admin@gmail.com',
                'telephone' => +250788111111,
                'password' => Hash::make('admin12345'),
                'has_updated_password' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ),
            1 => array (
                'id' => '932813c1-dfbf-4642-9f5a-aae0a1f13dbc',
                'role_id' => Role::where('type', \App\Models\Role::NOTARY)->value('id'),
                'names' => 'Notary',
                'email' => 'notary@gmail.com',
                'telephone' => +250739050856,
                'password' => Hash::make('notary12345'),
                'has_updated_password' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ),
            2 => array (
                'id' => '7435ff53-d361-4850-afc7-ca66a2a596b8',
                'role_id' => Role::where('type', \App\Models\Role::CLIENT)->value('id'),
                'names' => 'Client',
                'email' => 'client@gmail.com',
                'telephone' => +250785292979,
                'password' => Hash::make('client12345'),
                'has_updated_password' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ));
    }
}
