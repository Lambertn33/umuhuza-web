<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        foreach (\App\Models\Role::TYPE as $type) {
            Role::create([
                'id' => Str::uuid()->toString(),
                'type' => $type,
                'created_at' => now(),
                'updated_at' =>now()
            ]);
        }
    }
}
