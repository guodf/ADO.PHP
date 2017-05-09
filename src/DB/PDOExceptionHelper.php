<?php

namespace DB;

/**
 *
 */
class PDOExceptionHelper
{
    /**
     * 创建SqlException
     * @param PDO|PDOStatement  $obj
     * @return void
     */
    public static function createSqlException($obj)
    {
        return new SqlException($obj->errorInfo()[2],$obj->errorCode());
    }
}
