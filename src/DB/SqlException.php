<?php

namespace DB;

/**
 *  SqlException
 */
class SqlException extends PDOException
{
    public function __construct($message=null,$code=null)
    {
        $this->message=$message;
        $this->code=$code;
    }
}
