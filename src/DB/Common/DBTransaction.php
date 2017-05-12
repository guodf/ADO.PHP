<?php

namespace DB\Common;

use DB\TransactionState;
use DB\IDBTransaction;

 /**
 * 数据库事务
 */
abstract class DBTransaction implements IDBTransaction
{
    /**
     * 数据库连接对象
     *
     * @var DBConnection
     */
    protected $conn;

    /**
     * 事务状态
     *
     * @var TransactionState
     */
    protected $state=TransactionState::UnOpen;

    abstract public function __construct($conn);

    /**
     * 提交事务
     *
     * @return void
     */
    abstract public function commit();

    /**
     * 回滚事务
     *
     * @return void
     */
    abstract public function rollback();

}
