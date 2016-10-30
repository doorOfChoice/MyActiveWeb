<?php
  require_once("php/auth.php");
  //如果发现cookie则表示已经登陆过
  if(isset($_COOKIE['username']) && $_COOKIE['username'] == $AUTH['username'])
  {
    echo "you have been login!<br/>";
    echo "<a href='index.php'>back</a>";
    exit;
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
    <div id="loginPanel">
      <div class="detailPanel">
        <div class="detailPanel-ups">
          <!-- 用户名栏 -->
          <div class="username-panel">
            <input type="text" id="username" value="" placeholder="Username">
          </div>
          <!-- 密码栏 -->
          <div class="password-panel">
            <input type="password" id="password" value="" placeholder="Password">
          </div>
          <!-- 登陆按钮 -->
          <div class="submit-panel">
            <a href="#" class="submit" id="submit">Sign in</a>
          </div>
        </div>
      </div>
    </div>
  </body>


  <script type="text/javascript">
    var submit = document.getElementById('submit');
    //用来动态修改a的link地址
    submit.onclick = function(){
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;
      if(username && password){
        submit.href="login.php?username=" + username + "&password=" + password;
      }
      else {
        alert("username and password cannot be empty!");
      }
    }
  </script>
  <?php
  //接受到来自客户端的账号密码，进行判断
  if(isset($_GET['username']) && isset($_GET['password']))
  {
    $username = $_GET['username'];
    $password = $_GET['password'];
    if($username == $AUTH['username'] && $password == $AUTH['password'])
    {
      setcookie('username', $AUTH['username'], time()+60*60);
      header("Location:index.php");
    }
    else
    {
      echo "<script type='text/javascript'>
        alert(\"username or password isn't right\");
        document.getElementById('username').value = $username;
      </script>";
    }
  }
   ?>
</html>
