<?php

use \Illuminate\Database\Seeder;

abstract class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->data())->each(function($item) {
            ($this->model())::create($item);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract protected function model();

    /**
     * @return array|\Illuminate\Support\Collection
     */
    abstract protected function data();
}