<?php
require_once("php/auth.php");
require_once("php/page.php");
?>

<?php
if(isset($_COOKIE['username']) && $_COOKIE['username'] == $AUTH['username'])
{
  setcookie('username', $AUTH['username'], time()+60*60);
  #读取数据库中的文章内容
  if(isset($_GET['content_id']))
  {
    require_once('php/connectMysql.php');
    $sql = "select * from artical where content_id={$_GET['content_id']}";
    $result = mysqli_query($connect, $sql) OR die(mysqli_error($connect));
    #之前的标题, 之前的类型, 之前的内容
    $pre_title="";$pre_type="";$pre_content="";
    #mysql成功且文章只有一篇
    if($result && mysqli_num_rows($result) == 1)
    {
      #将原来的数据加载进编辑框
      $row = mysqli_fetch_assoc($result);
      $pre_title = $row['title'];
      $pre_type = $row['type'];
      $pre_content = $row['content'];
    }
    else
    {
      #文件不存在
      die("文件不存在兄弟<br/><a href='index.php?type=$pre_type'>back</a>");
    }

    #对用户新修改的内容进行了提交
    if(isset($_POST['type'])  &&
    isset($_POST['title']) &&
    isset($_POST['content']))
    {
      $type = $_POST['type'];
      $title = $_POST['title'];
      $time = time();
      $content = $_POST['content'];
      //修改原始数据
      $sql = "update artical set type='$type',title='$title',time=$time,content='$content'
       where content_id={$_GET['content_id']}";
      $result = mysqli_query($connect, $sql) OR die(mysqli_error($connect));

      if($result)
      {
        //修改成功，直接跳转
        header("location:index.php?type=$type");
      }
      else
      {
        //修改失败
        die("修改失败!".mysqli_error($connect));
      }
    }
  }
  else
  {
    die("兄弟，权限不够啊!<br/><a href='index.php?type=$pre_type'>back</a>");
  }

  page::displayHead("<link rel='stylesheet' href='css/edit.css'>");

  page::displayNavigater();

  page::displayContent(
  "<div id='edit'>
    <form action='' method='post'>

      <div class='container-title'>
        <input type='text' class='title' name='title' placeholder='标题' value='$pre_title'></input>
      </div>

      <div class='container-mark' >
        <select  name='type' value='$pre_type'>
          <option value='life'>生活</option>
          <option value='tech'>技术</option>
        </select>
      </div>

      <div class='container-content'>
        <textarea name='content' class='content' placeholder='内容' >$pre_content</textarea>
      </div>

      <div class='container-submit'>
        <input type='submit' class='submit' value='修改' placeholder='内容'></textarea>
      </div>
    </form>
  </div>"
  );

  page::displayTail();
}
?>
