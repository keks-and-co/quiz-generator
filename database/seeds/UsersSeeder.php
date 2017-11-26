<?php

class UsersSeeder extends BaseSeeder
{

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model()
    {
        return App\Models\User::class;
    }

    /**
     * @return array|\Illuminate\Support\Collection
     */
    protected function data()
    {
        return [
            [
                'name'      => 'Test Tester',
                'email'     => 'test@test.com',
                'password'  => Hash::make('password'),
                'is_active' => 1,
            ],
        ];
    }
}