<?php

namespace DB\Common;

/**
 * 数据库异常处理基类
 */
class DBException extends \Exception
{
    public function __construct($message,$code,\Exception $exception)
    {
        parent::__construct($message,$code,$exception);
    }
}
