<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (App\User::all() as $user) {
            factory(App\Tag::class)->create([
                'user_id' => $user->id,
                'name' => 'motociklai',
            ]);

            factory(App\Tag::class)->create([
                'user_id' => $user->id,
                'name' => 'programavimas',
            ]);

            factory(App\Tag::class)->create([
                'user_id' => $user->id,
                'name' => 'recipes',
            ]);
        }
    }
}
