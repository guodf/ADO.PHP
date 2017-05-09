<?php

require(__DIR__ . '../../../vendor/autoload.php');

use DB\SqlConnection;

$conn=new SqlConnection("mysql:host=192.168.20.171;port=3306;dbname=rs_esm_center;",'root','rising');
$conn->open();
$tran=$conn->beginTransaction();
print_r($tran);
