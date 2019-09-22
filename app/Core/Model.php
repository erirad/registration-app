<?php

namespace App\Core;

use App\Helper\Connection;

class Model extends Connection
{
    protected $connect;

    public function __construct()
    {
        $this->connect = Connection::conn()->getConn();
    }
}
