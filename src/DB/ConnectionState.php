<?php

namespace DB;

/**
 * 数据库连接状态
 */
class ConnectionState
{
    /**
     * @var integer 数据库连接已关闭
     */
    const Closed = 0;

    /**
     * @var interger 数据库连接已打开
     */
    const Open = 1;
}
