<?php

namespace DB;

/**
 * 数据库连接对象,定义连接对象功能
 */
interface IDBConnection
{
    /**
     * 打开数据库连接
     *
     * @return void
     */
    function open();

    /**
     * 关闭数据库连接
     *
     * @return void
     */
    function close();

    /**
     * 改变当前连接数对应的据库
     *
     * @param string $dbName 数据库名称
     * @return void
     */
    function changeDB($dbName);

    /**
     * 创建IDBCommand对象
     *
     * @return IDBCommand
     */
    function createCommand();

    /**
     * 开始事务,并返回事务对象
     *
     * @return IDBTransaction
     */
    function beginTransaction();
}
