<?php

namespace DB;

use \PDO as PDO;

/**
 *
 */
class SqlConnection
{
#region 数据库连接字符串信息

    /**
     * 连接字符串
     * @var string
     */
    public $connStr;

    /**
     * 主机
     * @var string
     */
    public $host;

    /**
     * 端口
     * @var integer
     */
    public $port;

    /**
     * 数据库名称
     * @var string
     */
    public $dbName;

    /**
     * 数据库类型
     * @var string
     */
    public $type;

    /**
     * 用户名
     * @var string
     */
    public $uName;

    /**
     * 数据库密码
     * @var string
     */
    public $pwd;

#endregioin

#region 数据库状态信息

    /**
     * 数据库连接状态
     * @var integer
     */
    public $state;

    /**
     * 数据库连接超时时间
     * @var integer  单位秒
     */
    public $connTimeout;

#endregion

#region 数据库实例

    /**
     * PDO实例
     * @var PDO
     */
    private $_pdo;

    private $_pdoTransaction;

#endregion

    function __construct($connStr,$uName,$pwd)
    {
        $this->connStr=$connStr;
        $this->uName=$uName;
        $this->pwd=$pwd;
    }

    /**
     * 打开数据库连接
     * @return void
     */
    public function open()
    {
        $this->_pdo=new PDO($this->connStr,$this->uName,$this->pwd);
    }

    /**
     * 关闭数据库连接
     * @return void
     */
    public function close()
    {
        $this->_pdo=null;
    }

    /**
     * 开启事务
     * @return SqlTransaction
     */
    public function beginTransaction()
    {
        if($this->_pdo->beginTransaction())
        {
            $this->_pdoTransaction = new SqlTransaction($this->_pdo);
            return $this->_pdoTransaction;
        }
        throw new Exception("事物启动失败", 1);
    }

    /**
     * 创建SqlCommand实例
     * @return SqlCommand
     */
    public function createCommand()
    {
        return new SqlCommand($this,$this->_pdoTransaction);
    }

    public function getPDO()
    {
        return $this->_pdo;
    }
}
