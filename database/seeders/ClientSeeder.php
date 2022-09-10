<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->delete();

        DB::table('clients')->insert(array(
            0 => array (
                'id' => Str::uuid()->toString(),
                'user_id' => '7435ff53-d361-4850-afc7-ca66a2a596b8',
                'national_id' => 8888888888888888,
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ));
    }
}
