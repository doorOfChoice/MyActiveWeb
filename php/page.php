<?php
  class Page{
    //打印总的框架
    public static function displayPage($head="", $content="")
    {
      Page::displayHead($head);
      Page::displayNavigater();
      Page::displayContent($content);
      Page::displayTail();
    }
    /*
    @@打印首部到<body>
    参数$head: 指所有能加载到head之间的语句;
    */
    public static function displayHead($head="")
    {
      echo"<!DOCTYPE html>
      <html>
      <head>
      <meta charset='utf-8'>
      <title>door of choice</title>
      <link rel='stylesheet' href='css/index.css' charset='utf-8'>"
       .$head."</head><body>";
    }
    /*
    @@打印尾部，从</body>-></html>
    */
    public static function displayTail(){
        echo"</body></html>";
    }
    /*
    @@打印整个导航框
    */
    public static function displayNavigater()
    {
      echo"<div id='navigator'>
        <div class='headshot'>
          <img src='image/headshot.png' alt='' class='large circle'/>
        </div>

        <div class='personal'>
          <div class='detail'>
            <img src='image/me.png' alt='' class='icon middle' />
            <span class='spacing'>王锐</span>
          </div>

          <div class='detail'>
            <img src='image/address.png' alt='' class='icon middle' />
            <span class='spacing'>重庆市江北区</span>
          </div>

          <div class='detail'>
            <img src='image/phone.png' alt='' class='icon middle' />
            <span class='spacing'>15023010707</span>
          </div>

        </div>

        <div class='content-navigator'>
            <div class='detail'>
              <img src='image/home.png' alt='icon middle' />
              <span class='spacing'><a href='index.php'>主页</a></span>
            </div>

            <div class='detail'>
              <img src='image/content.png' alt='icon middle' />
              <span class='spacing'><a href='index.php?type=life'>生活闲事</a></span>
            </div>

            <div class='detail'>
              <img src='image/content.png' alt='icon middle' />
              <span class='spacing'><a href='index.php?type=tech'>网络技术</a></span>
            </div>";

        if(!isset($_COOKIE['username']))
        {
          echo "<div class='detail'>
          <img src='image/login.png' alt='icon middle' />
          <span class='spacing'><a href='login.php'>登陆</a></span>
          </div>";
        }
        else
        {
          echo "<div class='detail'>
          <img src='image/write.png' alt='icon middle' />
          <span class='spacing'><a href='add.php'>写文章</a></span>
          </div>";

          echo "<div class='detail'>
          <img src='image/logoff.png' alt='icon middle' />
          <span class='spacing'><a href='index.php?status=0'>注销</a></span>
          </div>";
        }
        echo "</div></div>";
    }
    /*
    @@打印右边文章栏目
    参数content: 通常指加入的文章标题、时间、内容;
    */
    public static function displayContent($content="")
    {
      echo "<div id='content'>".$content."</div>";
    }
  }

 ?>
