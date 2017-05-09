<?php

$pdo=new PDO('mysql:host=192.168.20.171;port=3306;dbname=rs_esm_center;','root','rising');

$drives=PDO::getAvailableDrivers();

print_r($pdo);