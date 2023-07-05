<?php

$HOST = 'localhost';
$DATABASE_NAME = 'jobpilot';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';

try {
    $connection = new PDO("mysql:host=$HOST;dbname=$DATABASE_NAME", $DATABASE_USER, $DATABASE_PASS);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e)
{
    echo $e->getMessage();
}


