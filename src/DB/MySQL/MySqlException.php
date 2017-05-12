<?php

namespace DB\MySQL;

use DB\Common\DBException;

/**
 *  MySql异常信息类型
 */
class MySqlException extends DBException
{
    public function __construct($message, $code=0, \Exception $exception=null)
    {
        parent::__construct($message,$code,$exception);
    }
}
