<?php

use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (App\User::all() as $user) {

            factory(App\Note::class, 10)->create([
                'user_id' => $user->id,
            ]);

        }
    }
}
