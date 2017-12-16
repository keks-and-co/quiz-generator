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
            ->text('name', 'Name', [
                'sortable' => true,
            ])
            ->text('starts_at', 'Start date', [
                'sortable' => true,
            ])
            ->text('ends_at', 'End date', [
                'sortable' => true,
            ])
            ->text('is_active', 'Is active', function (Column $column) {
                $column->format('castBool:is_active', 'yesno');
            })
            ->actions('', function (Actions $actions) {
                $actions
                    ->action('add', 'Create')
                    ->icon('fa fa-plus')
                    ->url(route('quizzes.create'))
                    ->setGlobal();

                $actions
                    ->action('edit', '')
                    ->icon('fa fa-edit')
                    ->define(function (Action $action, array $row) {
                        $action->url(route('quizzes.edit', [$row['id']]));
                    });
            });
    }

    protected function filters(Filters $filter)
    {
        $filter
            ->text('name', 'Quiz name')
            ->datetime('starts_at', 'Starts at')
            ->datetime('ends_at', 'Ends at');
    }
}