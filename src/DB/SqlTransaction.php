<?php

namespace DB;

/**
 *
 */
class SqlTransaction
{
    protected $_pdo;

    /**
     * [有问题]如何真允许在SqlConnection中实例化此类
     * @param SqlTansaction
     */
    function __construct($pdo)
    {
        $this->_pdo=$pdo;
    }

    public function commit()
    {
        $this->_pdo->commit();
    }

    public function rollBack()
    {
        $this->_pdo->rollBack();
    }
}

