<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notaries')->delete();

        DB::table('notaries')->insert(array(
            0 => array (
                'id' => Str::uuid()->toString(),
                'user_id' => '932813c1-dfbf-4642-9f5a-aae0a1f13dbc',
                'national_id_photocopy' => 'draft',
                'notary_code' => 'notary123',
                'district' => 'Kicukiro',
                'sector' => 'Kigarama',
                'cell' => 'Nyarurama',
                'national_id' => 9999999999999999,
                'image' => 'draft image',
                'status' => \App\Models\Notary::APPROVED,
                'created_at' => now(),
                'updated_at' => now(),
            ),
        ));
    }
}
