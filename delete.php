<?php
  require_once("php/auth.php");
  if($_GET['content_id'])
  {
    $content_id = $_GET['content_id'];
    if(isset($_COOKIE['username']) && $_COOKIE['username'] == $AUTH['username'])
    {
        setcookie('username', $AUTH['username'], time()+60*60);

        require_once('php/connectMysql.php');
        $sql = "delete from artical where content_id=$content_id";
        $result = mysqli_query($connect, $sql) OR die(mysqli_error($connect));

        if($result)
        {
          echo '删除成功,2秒后返回主页';
          header("refresh:3;url=index.php");
        }
        else
        {
          die(mysqli_error($connect)."<br/><a href='index.php'>点击返回</a>");
        }
    }
    else
    {
      echo "你没有权限<br/>";
      echo "<a href='index.php'>返回主页</a><br/>";
      echo "<a href='edit.php?content_id=$content_id'>返回编辑界面</a>";
    }

  }
 ?>
