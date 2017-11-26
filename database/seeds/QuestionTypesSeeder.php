<?php

class QuestionTypesSeeder extends BaseSeeder
{
    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function model()
    {
        return \App\Models\QuestionType::class;
    }

    /**
     * @return array|\Illuminate\Support\Collection
     */
    protected function data()
    {
        return [
            ['name' => 'Multiple choice', 'slug' => 'checkbox', 'is_active' => 1, 'weight' => 1],
            ['name' => 'Single choice (Radio)', 'slug' => 'radio', 'is_active' => 1, 'weight' => 2],
            ['name' => 'Single choice (Dropdown)', 'slug' => 'dropdown', 'is_active' => 1, 'weight' => 3],
            ['name' => 'Free text', 'slug' => 'text', 'is_active' => 1, 'weight' => 4],
            ['name' => 'Range', 'slug' => 'range', 'is_active' => 1, 'weight' => 5],
        ];
    }
}
