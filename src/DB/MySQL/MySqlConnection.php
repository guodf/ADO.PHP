<?php

namespace DB\MySQL;

use DB\Common\DBConnection;
use DB\Common\DBException;

/**
 *  MySQL数据库连接对象
 */
class MySqlConnection extends DBConnection
{
    /**
     * 此链接上开启的事务
     *
     * @var MySqlTransaction
     */
    private $_pdoTransaction;

    /**
     * 打开MySQL数据库连接
     *
     * @return void
     */
    public function open()
    {
        try {
            parent::open();
        } catch (DBException $e) {
            throw new MySqlException('打开MySqlConnection连接失败',$e->getCode(),$e);
        }
    }

    /**
     * 获取当前连接上的PDO对象
     *
     * @return PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }

    /**
     * 获取当前连接上的PDO事务对象
     *
     * @return MySqlTransaction
     */
    public function getTransaction()
    {
        return $this->_pdoTransaction;
    }

    /**
     * 开启事务
     * @return MySqlTransaction
     */
    public function beginTransaction()
    {
        if ($this->pdo->beginTransaction()) {
            $this->_pdoTransaction = new MySqlTransaction($this);
            return $this->_pdoTransaction;
        }
        throw new Exception("事物启动失败", 1);
    }

    /**
     * 创建MySqlCommand实例
     * @return MySqlCommand
     */
    public function createCommand()
    {
        return new MySqlCommand($this, null);
    }
}
