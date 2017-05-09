<?php

namespace DB;

/**
 * 从结果集中读取返回的数据
 */
class SqlDataReader
{
    private $_pdoStatement;

    function __construct($pdoStatement)
    {
        $this->_pdoStatement=$pdoStatement;
    }

    public function read()
    {
        return $this->_pdoStatement->fetch();
    }

    public function rowCount()
    {
        return $this->_pdoStatement->rowCount();
    }

    public function columnCount()
    {
        return $this->_pdoStatement->columnCount();
    }

    // public function coulumns()
    // {
    //     return $this->_pdoStatement->getColumnMeta();
    // }
}
