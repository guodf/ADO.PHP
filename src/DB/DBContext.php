<?php

namespace DB;

/**
 *
 */
class DBContext extends PDO
{
    function __construct($connStr,$uName,$pwd)
    {
        parent::__construct($connStr,$uName,$pwd);
    }

    
}
