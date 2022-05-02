<?php

namespace App\Controllers;

use App\Core\MVC\AbstractController;

class IndexController extends AbstractController
{
    public function defaultAction()
    {
        $this->_render();
    }
}