<?php
session_start();
if($_SESSION['login']){
    header("Refresh:0;URL='index.php'");
}else{
//username/
//passwd


$username = $_POST['username'];
$passwd = $_POST['passwd'];
$db = mysqli_connect('localhost','testx','testx','testx');
$pdpasswd = mysqli_fetch_assoc(mysqli_query($db,"select * from `user` where username = '$username'"));


if(isset($_POST['submit'])){
    if(empty($username) || empty($passwd)){
        echo "请输入完整";
        
    }else if($pdpasswd['passwd'] == $passwd){
        $_SESSION['login'] = $username;
         header("Refresh:0;URL='index.php'");
    }
    else{
        echo "账号或密码错误";
    }
    
}




?>
<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<title>    留言板-FFSir  </title>
<link rel="shortcut icon" type="image/x-icon" href="https://q2.qlogo.cn/headimg_dl?dst_uin=878038817&spec=100" media="screen" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/soxft/cdn@master/mdui/css/mdui.min.css">
<script src="https://cdn.jsdelivr.net/gh/soxft/cdn@master/mdui/js/mdui.min.js"></script>
</head>
  <style>
    a {
      text-decoration:none
    }
    a:hover {
      text-decoration:none
    }
    </style>
<body oncontextmenu="return false" onselectstart="return false" oncopy="return false" background="https://cdn.jsdelivr.net/gh/soxft/cdn@latest/time/img/background.png">
    <div style="Height:50px"></div>
    <div id='login' class="mdui-container" style="max-width: 600px;">
        <div class="mdui-card">
            <div class="mdui-card-menu">
                <button onclick="window.location.href='/'" class="mdui-btn mdui-btn-icon mdui-text-color-grey">
                  <i class="mdui-icon material-icons">home</i>
                </button>
            </div>
            <form action="" method="POST">
            <div class="mdui-card-primary">
                <div class="mdui-card-primary-title">登录</div>
                <div class="mdui-card-primary-subtitle">Login</div>
            </div>
            <div id='content' class="mdui-card-content">
                <div id='emailcheck' class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">用户名</label>
                    <input name="username" type="text" class="mdui-textfield-input" />
                </div>
                <div id='emailcheck' class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">密码</label>
                    <input name="passwd" type="password" class="mdui-textfield-input" />
                </div>
                <br />
                <div class="mdui-card-actions">
                    <center>
                        <button name="submit" class="mdui-btn mdui-ripple mdui-btn-dense">登录</button>
                    </center>
                    <a style='float: right;margin-right: 20px;color: black;' href='./register.php'>没有帐户?</a>
                    
                     <a style='float: left;margin-right: 20px;color: black;' href='./xclogin.php'>XOAUTH第三方登录</a>
                </div>
            </div>
            </form>
        </div>
    </div>



  
</body>
</html>
<?php
}
?>