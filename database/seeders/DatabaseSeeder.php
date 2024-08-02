<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Message;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

            $john = User::factory()->create([
                "name" => "John Doe",
                "email" => "john@example.test",
                "password" => bcrypt("password"),
                "is_admin" => true,
            ]);

            $jane = User::factory()->create([
                "name" => "Jane Doe",
                "email" => "jane@example.test",
                "password" => bcrypt("password"),
            ]);

            $additionalUsers = User::factory(20)->create();

            // Création de groupes
            for($i = 0; $i < 5; $i++){
                $group = Group::factory()->create([
                    "owner_id" => $john->id
                ]);

                // On prend entre 2 et 5 personnes
                $usersIds = User::inRandomOrder()->limit(rand(2, 5))->pluck("id")->toArray();
                // puis on les insère dans la table pivot group_user
                $group->users()->attach(array_unique([$john->id, ...$usersIds]));
            }
            
            // Créer des messages
            Message::factory(1000)->create();

        $this->command->info("Seedage terminé avec succès");
    }
}
