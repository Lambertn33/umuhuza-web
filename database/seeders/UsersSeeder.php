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
                'created_at' => now(),
                'updated_at' => now(),
            )
        ));
    }
}
