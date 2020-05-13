<?php

use Illuminate\Database\Seeder;
use App\Poll;

class PollsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 60; $i++) {
            $poll = new Poll();

            $question = $faker->sentences(4, true);
            $poll->question = Str::replaceLast('.', '?', $question);
            
            $options = $faker->words(4, false);
            $poll->options = json_encode($options);
            
            $poll->ismultiple = false;

            $poll->save();
        }

    }
}
