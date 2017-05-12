<?php

namespace DB\MySQL;

use DB\Common\DBCommand;
use DB\PDOExceptionHelper;

/**
 * MySQl数据库SQL语句执行对象
 */
class MySqlCommand extends DBCommand
{
    function __construct($sqlConn, $connTran = null)
    {
        $this->conn=$sqlConn;
        $this->tran=$connTran;
    }

    /**
     * 执行UPDATE/DELTE/INSERT语句
     * @return integer
     */
    public function executeNoQuery()
    {
        $this->checkCommandText();
        $pdo=$this->conn->getPDO();
        try {
            $pdo->prepare($this->commandText);
            $statement = $pdo->prepare($this->commandText);
            $statement->execute($this->params);
            return $statement->rowCount();
        } catch (\Exception $e) {
            throw new MySqlException('SQL语句执行失败');
        }
    }

    /**
     * 执行SELECT语句
     * @return SqlDataReader
     */
    public function executeReader()
    {
        $this->checkCommandText();
        $pdo=$this->conn->getPDO();
        try {
            $statement = $pdo->prepare($this->commandText);
            $statement->execute($this->params);
            return new MySqlDataReader($statement);
        } catch (\Exception $e) {
            throw new MySqlException('SQL语句执行失败');
        }
    }

    /**
     * 执行获取一列结果的SELECT
     * @return mixed
     */
    public function executeScalar()
    {
        $this->checkCommandText();
        $pdo=$this->conn->getPDO();
        try{
            $statement=$pdo->prepare($this->commandText);
            $isOK=$statement->execute($this->params);
            return $statement->fetchColumn(0);
        }catch(\Exception $e){
            throw new MySqlException('SQL语句执行失败');
        }
    }

    /**
     * 检查commandText属性是否有效
     *
     * @return void
     */
    private function checkCommandText()
    {
        if (empty($this->commandText)) {
            throw new MySqlException("commandText需要设置SQL语句");
        }
    }
}
