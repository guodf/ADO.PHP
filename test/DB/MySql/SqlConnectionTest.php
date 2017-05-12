<?php

require(__DIR__ . '../../../../vendor/autoload.php');

use DB\MySQL\MySqlConnection;
use DB\MySQL\MySqlException;

$conn=new MySqlConnection("mysql:host=194.168.1.8;port=3306;dbname=MyBlog;", 'root', 'guodf1');
try {
    $conn->open();
} catch (\Exception $e){
    echo $e;
}

$conn=new MySqlConnection('mysql:host=194.168.1.8;port=3306;dbname=MyBlog;','root','guodf');
try {
    $conn->open();
    echo 'mysql连接已打开';
} catch (\Exception $e){
    echo $e;
}
$conn->close();
