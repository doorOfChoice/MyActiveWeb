<?php
  $host = "localhost";
  $user = "root";
  $password = "1997";
  $database = "blog";
  $port = 80;
  $connect = mysqli_connect($host, $user, $password);

  if(!$connect)
  {
    die('error:'.mysqli_error($connect));
  }
  else
  {
    $checkDatabase = 'create database if not exists '.$database;
    $checkTable_artical = 'create table if not exists '.$database.'.artical(
    content_id int primary key auto_increment,
    type varchar(16) not null,
    title varchar(40) not null,
    time int not null,
    content TEXT(30000) not null
    )';

    $result_database = mysqli_query($connect, $checkDatabase)
    OR die('error data:'.mysqli_error($connect));

    $result_table_artical = mysqli_query($connect, $checkTable_artical)
    OR die('error table:'.mysqli_error($connect));

    mysqli_select_db($connect, $database);
  }
 ?>
