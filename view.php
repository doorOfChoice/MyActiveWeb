<?php
  date_default_timezone_set("PRC");
  require_once('php/auth.php');
  #判断是否登陆
  $login = false;
  if(isset($_COOKIE['username']) && $_COOKIE['username'] == $AUTH['username'])
  {
    setcookie('username', $AUTH['username'], time()+60*60);
    $login = true;
  }
  #是否检测到文章id传入
  if(isset($_GET['content_id']))
  {
    require_once('php/connectMysql.php');
    $content_id = $_GET['content_id'];
    //选择此篇文章
    $sql = "select * from artical where content_id=$content_id";
    $result = mysqli_query($connect, $sql) OR die(mysqli_error($connect));
    #判断文件不存在 或 文件数大于1 或 读取出错
    if($result && mysqli_num_rows($result) != 1)
    {
      die("此文件有异常无法读取<br/><a href='index.php'>back</a>");
    }
  }
  else
  {
    die("没有获取到文件<br/><a href='index.php'>back</a>");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/view.css">
    <title></title>
  </head>
  <body>
    <!--#63B8FF #5CACEE #4F94CD -->
    <div id="view">
        <?php
          //获取到当前文章数据
          $row = mysqli_fetch_assoc($result);
          {
            $type = $row['type'];
            $title = $row['title'];
            $time = date("Y-m-d H:i:s", $row['time']);
            $content = $row['content'];

            echo "
            <div class='view-title'>
                <h1>$title</h1>
            </div>
            <div class='view-time'>
                <span><b>时间</b>:$time</span>
                <span><b>类型</b>:<a href='index.php?type=$type'>$type</a></span>
            </div>";

            if($login)
            {
            echo "<div class='operation'>
              <a href='edit.php?content_id=$content_id'>编辑</a>
              <a href='delete.php?content_id=$content_id'>删除</a>
            </div>";
            }

            echo "
            <div class='view-content'>
              $content
            </div>
            ";
          }
         ?>
    </div>
  </body>
</html>
