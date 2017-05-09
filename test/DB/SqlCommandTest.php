<?php

require(__DIR__ . '../../../vendor/autoload.php');

use DB\SqlConnection;
use DB\DB\SqlCommand;
use DB\SqlTransaction;

$conn=new SqlConnection("mysql:host=192.168.20.171;port=3306;dbname=rs_esm_center;",'root','rising');
$conn->open();

//$tran=$conn->beginTransaction();
$comm=$conn->createCommand();
$comm->params=[307];
$reader=$comm->executeReader('select * from auth_grant where ID=?');

while(!empty($read=$reader->read()))
{
    print_r($read);
}

$reader=$comm->executeReader("select * from auth_today_link");
while(!empty($read=$reader->read()))
{
    print_r($read);
}