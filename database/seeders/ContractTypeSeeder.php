<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contractTypes = 
        [
            [
                'name' => 'Tempo Determinato',
                'description' => 'Contratto a tempo Determinato',
                'vacation' => 1.86,
                'part_time' => 0
            ],
            [
                'name' => 'Tempo Indeterminato',
                'description' => 'Contratto a tempo indeterminato',
                'vacation' => 1.86,
                'part_time' => 0
            ],
            [
                'name' => 'Apprendistato',
                'description' => 'Contratto di Apprendistato',
                'vacation' => 1.86,
                'part_time' => 0
            ],
            [
                'name' => 'Tirocinio',
                'description' => 'Contratto di Tirocinio',
                'vacation' => null,
                'part_time' => 0
            ],
            [
                'name' => 'Co.Co.Co',
                'description' => 'Contratto di collaborazione coordinata e continuativa',
                'vacation' => null,
                'part_time' => 0
            ],
            [
                'name' => 'Formazione',
                'description' => 'Contratto in Formazione',
                'vacation' => null,
                'part_time' => 0
            ],
            [
                'name' => 'Sostituzione Maternità',
                'description' => 'Contratto di sostituzione Maternità',
                'vacation' => null,
                'part_time' => 0
            ]
        ];  

        DB::table('contract_types')->insert($contractTypes);
    }
}
