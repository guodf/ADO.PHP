<?php
date_default_timezone_set('Asia/Shanghai');
require(__DIR__ . '../../../../vendor/autoload.php');

use DB\MySQL\MySqlConnection;
use DB\MYSQL\MySqlException;

try
{
    $conn=new MySqlConnection("mysql:host=194.168.1.8;port=3306;dbname=MyBlog;",'root','guodf');
    $conn->open();
    $tran=$conn->beginTransaction();
    $comm=$conn->createCommand();
    $comm->tran=$tran;
    $comm->commandText='select * from post';
    $reader=$comm->executeReader();
    while(!empty($read=$reader->read()))
    {
        print_r($read);
    }
    $comm->commandText='insert into post(Title,Context,CreateTime,ModifyTime) values(?,?,?,?)';
    $comm->params=['hello','hellohellohello',date('Y-m-d'),date('Y-m-d')];
    echo $comm->executeNoQuery();
    $cmd2=$conn->createCommand();
    $cmd2->commandText='insert into post(Title,Context,CreateTime,ModifyTime) values(?,?,?,?)';
    $cmd2->params=['bbbbbb','bbbbbbbbbbbb',date('Y-m-d'),date('Y-m-d')];
    echo $cmd2->executeNoQuery();

    $tran->commit();
    $conn->changeDB("rs_esm_log");

    $cmd2->commandText='select * from groupinfo_ACC9FFC448294252';
    $reader=$cmd2->executeReader();
    while(!empty($read=$reader->read()))
    {
        print_r($read);
    }
}

catch(MySqlException $e){
    echo $e;
}
catch(Exception $e){
    echo $e;
}