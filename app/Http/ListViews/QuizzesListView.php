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
            ->text('is_anonymous', 'Is anonymous', function (Column $column) {
                $column->format('castBool:is_anonymous', 'yesno');
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

                $actions
                    ->action('share', '')
                    ->icon('fa fa-share-square-o')
                    ->define(function (Action $action, array $row) {
                        $action
                            ->showIf($row['is_active'])
                            ->url(route('quizzes.share', [$row['id']]));
                    });

                $actions
                    ->action('answers', '')
                    ->icon('fa fa-file-o')
                    ->define(function (Action $action, array $row) {
                        $action->url(route('quizzes.answers.index', [$row['id']]));
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