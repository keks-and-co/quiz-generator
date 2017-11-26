<?php

namespace App\Http\ListViews;

use Administr\ListView\ListView as BaseListView;

class ListView extends BaseListView
{
    public function __construct($dataSource = null)
    {
        parent::__construct($dataSource);

        $this->class = 'table table-bordered table-hover table-striped';
        $this->setRequest(request());
    }
}