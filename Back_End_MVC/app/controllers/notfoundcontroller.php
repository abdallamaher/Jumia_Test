<?php
namespace App\Controllers;
use App\Core\MVC\AbstractController;

class NotFoundController extends AbstractController
{
    public function defaultAction()
    {
        $this->_render();
    }
}