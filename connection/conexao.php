<?php
    $connect = new PDO(
        "mysql:host=localhost;dbname=crud_pdo", 
        "root", 
        "",
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        )
    );
?>