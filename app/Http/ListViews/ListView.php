<?php

namespace App\Http\ListViews;

use Administr\ListView\ListView as BaseListView;

class ListView extends BaseListView
{
    public function __construct($dataSource = null)
    {
        $this->class = 'table table-bordered table-hover table-striped';
        $this->setRequest(request());

        parent::__construct($dataSource);
    }
}