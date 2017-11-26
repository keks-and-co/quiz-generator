<?php

class QuizzesSeeder extends BaseSeeder
{
    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model()
    {
        return \App\Models\Quiz::class;
    }

    /**
     * @return array|\Illuminate\Support\Collection
     */
    protected function data()
    {
        $faker = \Faker\Factory::create();
        $userIds = \App\Models\User::pluck('id')->toArray();

        $quizzes = collect();

        foreach (range(0, 99) as $i) {
            $ends_at = $faker->dateTimeThisMonth();

            $quizzes->push([
                'user_id'   => $faker->randomElement($userIds),
                'per_page'  => $faker->randomElement([1, 2, 3, 4]),
                'name'      => $faker->sentence(),
                'starts_at' => $faker->dateTimeThisYear($ends_at),
                'ends_at'   => $ends_at,
            ]);
        }

        return $quizzes;
    }
}
