<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_m_client')->insert([
            [
                'client_name' => 'NEC',
                'client_address' => 'Jakarta'
            ],
            [
                'client_name' => 'TAM',
                'client_address' => 'Jakarta'
            ],
            [
                'client_name' => 'TUA',
                'client_address' => 'Bandung'
            ],
        ]);
    }
}
