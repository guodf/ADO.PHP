<?php

namespace DB;

/**
 *
 */
class SqlCommand
{
    public $connection;

    public $transaction;

    public $params=[];

    public $commandText;

    function __construct($sqlConnection, $sqlTransaction)
    {
        $this->connection=$sqlConnection;
        $this->transaction=$sqlTransaction;
    }

    /**
     * 执行UPDATE/DELTE/INSERT语句
     * @param string $sql
     * @return integer
     */
    public function executeNoQuery($sql)
    {
        $pdo=$this->connection->getPDO();
        return $pdo->exec($sql, $params);
    }

    /**
     * 执行SELECT语句
     * @param string $sql
     * @return SqlDataReader
     */
    public function executeReader($sql)
    {
        $pdo=$this->connection->getPDO();
        //prepare将错误的发生延迟到execute之后
        $statement = $pdo->prepare($sql);
        if (!$statement) {
            throw PDOExceptionHelper::createSqlException($pdo);
        }
        $isOK = $statement->execute($this->params);
        if ($isOK) {
            return new SqlDataReader($statement);
        }
        throw PDOExceptionHelper::createSqlException($pdo);
    }

    /**
     * 执行获取一列结果的SELECT
     * @param string $sql
     * @return mixed
     */
    public function executeScalar($sql)
    {
        $pdo=$this->connection->getPDO();
        $statement=$pdo->prepare($sql);
        if (!$statement) {
            throw PDOExceptionHelper::createSqlException($pdo);
        }
        $isOK=$statement->execute($this->params);
        if ($isOK) {
            return $statement->fetchColumn(0);
        }
        throw PDOExceptionHelper::createSqlException($pdo);
    }
}
