<?php

namespace DB\Common;

use DB\IDBCommand;

/**
 * 执行SQL语句的IDBCommand抽象基类
 */
abstract class DBCommand implements IDBCommand
{
    /**
     * 当前DBCommand关联的IDBConnection实例
     *
     * @var IDBConnection
     */
    public $conn;

    /**
     * 当前DBCommand关联的IDBTransactioin实例
     *
     * @var IDBTransaction
     */
    public $tran;

    /**
     * 当前DBCommand对象需要绑定到SQL的参数集合
     *
     * @var array
     */
    public $params=[];

    /**
     * 当前DBCOmmand对象需要执行的SQL语句
     *
     * @var string
     */
    public $commandText;

    /**
     * 要求继承类必须实现构成函数
     *
     * @param IDBConnection $conn
     * @param IDBTransaction $connTran
     */
    abstract public function __construct($conn,$connTran);

    /**
     * 执行INSERT,UPDATE命令SQL语句,返回影响的行数
     *
     * @return int
     */
    abstract public function executeNoQuery();

    /**
     * 执行SELECT命令SQL语句,返回查询结果集合
     *
     * @return Array
     */
    abstract public function executeReader();

    /**
     * 返回SQL语句的统计结果,需要是一行一列的返回值
     *
     * @return mixed
     */
    abstract public function executeScalar();
}
