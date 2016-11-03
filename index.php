<?php
  date_default_timezone_set('PRC');
  require_once("php/page.php");
  require_once("php/auth.php");
  //判断是否已经登陆, 若已经登陆，延长cookie的时间
  if(isset($_COOKIE['username']) && $_COOKIE['username'] == $AUTH['username'])
  {
    setcookie('username', $AUTH['username'], time()+60*60);
  }

  //获取状态，用来注销用户
  if(isset($_GET['status']))
  {
    setcookie('username');
    header("Location:index.php");
  }

  //获取要读取的内容的类型
  if(isset($_GET['type']))
  {
    require("php/connectMysql.php");

    $type = $_GET['type'];//类型
    //获取该类型数据
    $sql = "select *,substring(content,1,200) as content
     from artical where type='$type' ";
    $result = mysqli_query($connect, $sql) OR die(mysqli_error($connect));
    $content_counts = mysqli_num_rows($result);
    if($result)
    {
      $articals = "";//所有文章的html汇总
      while($row = mysqli_fetch_assoc($result))
      {
          $id = $row['content_id'];//文章唯一标识
          $title = $row['title'];//文章标题
          $time = date("Y-m-d H:i:s", $row['time']);//文章创建\修改世界
          $content = $row['content'];//文章内容
          $articals = "
            <div class='essay'>
              <div class='essay-title'>
                <span><a href='view.php?content_id=$id'>$title</a></span>
              </div>

              <div class='essay-time'>
                <span>$time</span>
              </div>

              <div class='essay-text'>
                $content
              </div>
            </div>
          ".$articals;
      }
      $articals = "<h1 align='center'>专栏:$type</h1>"
                  ."<p align='center'>文章数目: $content_counts</p>"
                  .$articals;
      page::displayPage("", $articals);
    }
  }
  //没有获取到类型，则显示主页
  else
  {
    $indexContent = "
      <h1 class='spacing'>Let life be beautiful like summer flowers</h1>
      <h2 class='spacing'>生如夏花之绚丽</h2>
      <h1 class='spacing'>Died as the quiet beauty of autumn leaves</h1>
      <h2 class='spacing'>死如秋叶之静美</h2>
      <h3 class='spacing'>然后，没有了o(^▽^)o</h3>
    ";
    page::displayPage("",$indexContent);
  }

?>
