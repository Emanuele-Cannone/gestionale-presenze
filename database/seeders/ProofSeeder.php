<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProofSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proofs = [
            ['name' => 'Allattamento'],
            ['name' => 'Aspettativa'],
            ['name' => 'Assistenza Familiare Con Grave Patologia'],
            ['name' => 'Cambio Turno'],
            ['name' => 'Congedo Matrimoniale'],
            ['name' => 'Congedo Parentale'],
            ['name' => 'Donazione Sangue'],
            ['name' => 'Ferie'],
            ['name' => 'Infortuno'],
            ['name' => 'Lavoro Fuori Sede'],
            ['name' => 'Lutto'],
            ['name' => 'Malattia'],
            ['name' => 'Maternità'],
            ['name' => 'Paternità'],
            ['name' => 'Permesso'],
            ['name' => 'Permesso Sindacale'],
            ['name' => 'Permesso 104'],
            ['name' => 'Riposo'],
            ['name' => 'SmartWorking'],
            ['name' => 'Seggio Elettorale'],
            ['name' => 'Studio'],
            ['name' => 'Ufficio'],
            ['name' => 'Visite Prenatali'],

        ];


        DB::table('proofs')->insert($proofs);

    }
}
