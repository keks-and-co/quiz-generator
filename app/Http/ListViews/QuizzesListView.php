<?php

namespace App\Http\ListViews;

use Administr\ListView\Columns\Action;
use Administr\ListView\Columns\Actions;
use Administr\ListView\Columns\Column;
use Administr\Filters\Filters;

class QuizzesListView extends ListView
{
    protected function columns()
    {
        $this
            ->text('id', '#')
            ->text('name', 'Name')
            ->text('starts_at', 'Start date')
            ->text('ends_at', 'End date')
            ->text('is_active', 'Is active', function(Column $column) {
                $column->format(function(array $row) {
                    return $row['is_active'];
                }, 'yesno');
            })
            ->actions('', function(Actions $actions) {
                $actions
                    ->action('add', 'Create')
                    ->icon('fa fa-plus')
                    ->url( route('quizzes.create') )
                    ->setGlobal();

                $actions
                    ->action('edit', '')
                    ->icon('fa fa-edit')
                    ->define(function(Action $action, array $row){
                        $action->url( route('quizzes.edit', [$row['id']]) );
                    });
            })
            ;
    }

    protected function filters(Filters $filter)
    {
    }
}