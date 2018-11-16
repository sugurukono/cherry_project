<?php

    $dsn = 'mysql:dbname=Cherry;host=localhost';
    $user = 'root';
    $password='';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//SQLのエラーも表示してよ、というコード
    $dbh->query('SET NAMES utf8');


?>