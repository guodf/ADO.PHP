<?php

namespace DB;

/**
 * 事务对象,定义事务对象功能
 */
interface IDBTransaction
{
    /**
     * 提交当前事务
     *
     * @return void
     */
    function commit();

    /**
     * 回滚当前事务
     *
     * @return void
     */
    function rollback();
}