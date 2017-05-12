<?php

namespace DB\MySQL;

use DB\Common\IDataReader;

/**
 * 从结果集中读取返回的数据
 */
class MySqlDataReader
{
    /**
     * PSOStatement 对象
     *
     * @var PSOStatement
     */
    private $_pdoStatement;

    function __construct($pdoStatement)
    {
        $this->_pdoStatement=$pdoStatement;
    }

    /**
     * 持续读去数据
     *
     * @return void
     */
    public function read()
    {
        return $this->_pdoStatement->fetch();
    }

    /**
     * 获取SQL语句影响的行数
     *
     * @return int
     */
    public function rowCount()
    {
        return $this->_pdoStatement->rowCount();
    }

    /**
     * 获取结果集中的列数
     *
     * @return int
     */
    public function columnCount()
    {
        return $this->_pdoStatement->columnCount();
    }

}
