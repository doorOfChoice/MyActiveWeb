<?php
require_once("php/auth.php");
require_once("php/page.php");
if(isset($_COOKIE['username']) && $_COOKIE['username'] == $AUTH['username'])
{
  setcookie('username', $AUTH['username'], time()+60*60);
  //进行提交判断
  if(isset($_POST['type'])  &&
     isset($_POST['title']) &&
     isset($_POST['content']))
  {
    require("php/connectMysql.php");

    $title = trim($_POST['title']);//标题
    $type = $_POST['type'];//类型
    $content = htmlspecialchars($_POST['content']);//内容
    #往artical表里面添加内容
    $sql = 'insert into artical(type, title, time, content) '
          ."values(\"$type\", \"$title\",".time().", \"$content\")";
    #接受数据库返回的内容
    $result = mysqli_query($connect, $sql) OR die(mysqli_error($connect));

    if($result)
    {
      header("location:index.php?type=$type");
    }
    else
    {
       "<script type='text/javascript'>alert('提交失败');</script>";
       exit;
    }
  }

  page::displayHead("<link rel='stylesheet' href='css/edit.css'>");

  page::displayNavigater();

  page::displayContent(
  "<div id='edit'>
    <form action='' method='post'>

      <div class='container-title'>
        <input type='text' class='title' name='title' placeholder='标题'></input>
      </div>

      <div class='container-mark'>
        <select  name='type'>
          <option value='life'>生活</option>
          <option value='tech'>技术</option>
        </select>
      </div>

      <div class='container-content'>
        <textarea name='content' class='content' placeholder='内容'></textarea>
      </div>

      <div class='container-submit'>
        <input type='submit' class='submit' value='提交' placeholder='内容'></textarea>
      </div>
    </form>
  </div>"
  );

  page::displayTail();
}

?>
