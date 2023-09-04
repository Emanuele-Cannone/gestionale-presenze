<?php

namespace Database\Seeders;


use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $this->call([
            ContractTypeSeeder::class,
            ProofSeeder::class,
            // ComunicationSeeder::class,
        ]);

        // Comunication::factory(10)->create();

        User::create([
            'name' => 'Emanuele',
            'email' => 'emanuele@mail.it',
            'password' => Hash::make('emanuele'),
            'remember_token' => Str::random(10),
            'current_team_id' => Team::factory()->create()->id
        ]);

        User::create([
            'name' => 'Guest',
            'email' => 'guest@guest.it',
            'password' => Hash::make('emanuele'),
            'remember_token' => Str::random(10),
            'current_team_id' => Team::factory()->create()->id
        ]);
    }
}
