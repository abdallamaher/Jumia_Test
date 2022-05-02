<?php

namespace App\Controllers;

use App\Core\Filter;
use App\Core\MVC\AbstractController;
use App\Models\CustomerModel;

class CustomerController extends AbstractController
{
    use Filter;

    public function defaultAction()
    {
        $this->_data['result'] = CustomerModel::getAll();
        $this->_render();
    }

    public function filterAction()
    {
        if(isset($_POST['submit']))
        {

        }
    }
}