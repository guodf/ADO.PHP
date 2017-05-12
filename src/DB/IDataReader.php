<?php

namespace DB;

/**
 * 从链接中持续取数据
 */
interface IDataReader
{
    /**
     * 读取一条消息,需要循环读取,直到无数据为止
     *
     * @return Array
     */
    function read();

    /**
     * 获取SQL语句影响的行数
     *
     * @return void
     */
    function rowCount();

    /**
     * 获取结果集中数据的列数
     *
     * @return void
     */
    function columnCount();
}