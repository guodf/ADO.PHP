<?php

namespace DB\Common;

use PDO;
use PDOException;
use DB\ConnectionState;
use DB\IDBConnection;

/**
 * 数据库连接抽象基类
 */
abstract class DBConnection implements IDBConnection
{
    /**
     * 数据库连接字符串
     *
     * @var string
     */
    public $connStr;

    /**
     * 数据库服务DNS
     *
     * @var string
     */
    public $host;

    /**
     * 数据库用户名
     *
     * @var string
     */
    public $uName;

    /**
     * 数据库密码
     *
     * @var string
     */
    public $pwd;

    /**
     * 数据库连接超时时间
     *
     * @var int
     */
    public $connTimeout;

    /**
     * 数据库连接状态
     *
     * @var ConnectionState
     */
    public $state=ConnectionState::Closed;

    /**
     * 数据库名称
     *
     * @var string
     */
    public $dbName;

    /**
     * 数据库类型
     *
     * @var string
     */
    public $dbType;

    /**
     * PDO对象
     *
     * @var PDO
     */
    protected $pdo;

    public function __construct($connStr, $uName, $pwd)
    {
        $this->connStr=$connStr;
        $this->uName=$uName;
        $this->pwd=$pwd;
    }

    /**
     * 打开数据库连接
     *
     * @return void
     */
    public function open()
    {
        try {
            if ($this->state==ConnectionState::Closed) {
                $this->pdo=new PDO($this->connStr, $this->uName, $this->pwd, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
                ]);
                $this->state=ConnectionState::Open;
            }
        } catch (\Exception $e) {
            throw new DBException('打开连接失败', 1, $e);
        }
    }

    /**
     * 关闭数据库连接
     *
     * @return void
     */
    public function close()
    {
        $this->state=ConnectionState::Closed;
        $this->pdo=null;
    }

    /**
     * 切换当前数据库连接对应的库
     *
     * @param string $dbName 数据库名称
     * @return void
     */
    public function changeDB($dbName)
    {
        try {
            $this->pdo->exec('use '.$dbName);
            $this->dbName=$dbName;
        } catch (\Exception $e) {
            throw new DBException('切换数据库失败', 1,$e);
        }
    }

    /**
     * 创建DBCommand对象
     *
     * @return void
     */
    abstract public function createCommand();

    /**
     * 创建DBTransaction对象
     *
     * @return void
     */
    abstract public function beginTransaction();

    /**
     * 释放PDO对象
     */
    function __destruct()
    {
        $this->close();
    }
}
