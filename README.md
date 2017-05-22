# ADO.PHP

### 目标：
1. 实现类似ADO.NET的编程接口 （已实现基本功能）
2. 实现SQL自动分库功能分表功能 （计划中）
2. 实现ORM功能 （计划中）
3. 实现仓储模式 （开发中...）
4. 实现工作单元  (开发中...)

# MySQL

## 连接到MySql

```php
use DB\MySQL\MySqlConnection;

$conn=new MySqlConnection('mysql:host=127.0.0.1;port=3306;dbname=table;','root','test');
try {
    $conn->open();
} catch (\Exception $e){
    echo $e;
}
$conn->close();
```

## 执行MySQL查询语句

```php
use DB\MySQL\MySqlCommand;

//创建MySqlCommand的两种方式:
//1. MySqlConnection::createCommand();
$cmd=$conn->createCommand();
//2. new MySqlCommand($conn);
$cmd=$conn->createCommand();

//设置查询SQL
$cmd->commandText='select * from table1';
$reader=$cmd->executeReader();
//逐条读取查询结果
while(!empty($read=$reader->read()))
{
    print_r($read);
}
```

## 事务支持

```php
//开启事务
$tran=$conn->beginTransaction();

//提交事务
$tran->commit();

//回滚事务
$tran->rollback();

```


