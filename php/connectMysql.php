<?php
  $connect = mysqli_connect('localhost', 'root', '1997');

  if(!$connect)
  {
    die(mysqli_error($connect));
  }
  else
  {
    $checkDatabase = 'create database if not exists blog';
    $checkTable_artical = 'create table if not exists blog.artical(
    content_id int primary key auto_increment,
    type varchar(16) not null,
    title varchar(40) not null,
    time int not null,
    content TEXT(30000) not null
    )';

    $result_database = mysqli_query($connect, $checkDatabase)
    OR die(mysqli_error($connect));

    $result_table_artical = mysqli_query($connect, $checkTable_artical)
    OR die(mysqli_error($connect));

    mysqli_select_db($connect, 'blog');
  }
 ?>
