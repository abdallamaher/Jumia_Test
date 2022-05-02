<?php

namespace App\Models;

use App\Core\MVC\AbstractModel;

class CustomerModel extends AbstractModel
{

    public $id;

    public $name;

    public $phone;

    protected static $tableName = 'customer';

    protected static $primaryKey = 'id';

    protected static $tableSchema = array(
        'name' => self::DATA_TYPE_STR,
        'phone' => self::DATA_TYPE_STR,
    );

}