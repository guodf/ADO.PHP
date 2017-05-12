<?php

namespace DB;

/**
 * 事务状态
 */
class TransactionState
{
    /**
     * 未开启事务
     */
    const UnOpen=0;

    /**
     * 事务处于运行状态
     */
    const Open=1;

    /**
     * 事务已完成,已经执行了IDBTransaction::commit()/IDBTransaction::rollback()
     */
    const Completed=2;
}
