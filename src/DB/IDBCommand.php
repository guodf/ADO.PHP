<?php

namespace DB;

/**
 * 执行SQL语句的对象,该对象记录当前SQL语句的信息以及需要绑定到SQL的参数信息
 */
interface IDBCommand
{
    /**
     * 执行SQL语句,并返回影响的行数,建议仅执行INSERT,UPDATE命令的SQL语句
     *
     * @return int
     */
    function executeNoQuery();

    /**
     * 执行SQL语句,返回数据集,建议仅执行SELECT命令的SQL语句
     *
     * @return Array
     */
    function executeReader();

    /**
     * 执行SQL语句,返回一行一列的数据,多用于SELECT COUNT(*) FROM TABLE等SQL语句
     *
     * @return mixed
     */
    function executeScalar();
}