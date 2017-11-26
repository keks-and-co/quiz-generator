<?php

namespace App\Http\ListViews;

use Administr\ListView\Columns\Action;
use Administr\ListView\Columns\Actions;
use Administr\ListView\Columns\Column;
use Administr\ListView\ListView;
use Administr\Filters\Filters;

class QuestionsListView extends ListView
{
    public function __construct($dataSource = null)
    {
        parent::__construct($dataSource);

        $this->class = 'table table-bordered table-hover table-striped';
    }

    protected function columns()
    {
        $this
            ->text('id', '#')
            ->actions('', function(Actions $actions) {
                $actions
                    ->action('add', 'Добави')
                    ->icon('fa fa-plus')
                    ->url( route('.questions.create') )
                    ->setGlobal();

                $actions
                    ->action('edit', '')
                    ->icon('fa fa-edit')
                    ->define(function(Action $action, array $row){
                        $action->url( route('.questions.edit', [$row['id']]) );
                    });
            })
            ;
    }

    protected function filters(Filters $filter)
    {
    }
}