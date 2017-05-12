<?php

namespace DB\MySQL;

use DB\TransactionState;
use DB\Common\DBTransaction;

/**
 *  MySql事务对象
 */
class MySqlTransaction extends DBTransaction
{
    /**
     * 当前事务
     *
     * @var My
     */
    private $_pdoTran;

    /**
     * [有问题]如何真允许在SqlConnection中实例化此类
     * @param SqlTansaction
     */
    function __construct($conn)
    {
        $this->conn=$conn;
        $this->_pdoTran=$conn->getPDO();
        $this->state=TransactionState::Open;
    }

    public function commit()
    {
        $this->checkTransactionState();
        $this->_pdoTran->commit();
        $this->state=TransactionState::Completed;
    }

    public function rollBack()
    {
        $this->checkTransactionState();
        $this->_pdoTran->rollBack();
        $this->state=TransactionState::Completed;
    }

    private function checkTransactionState()
    {
        if($this->state==TransactionState::Open){
            return ;
        }

        if($this->state==TransactionState::UnOpen){
            throw new MySqlException("事务未开启");
        }
        if($this->state==TransactionState::Completed){
            throw new MySqlException('事务已完成,不可重复执行');
        }
    }
}

