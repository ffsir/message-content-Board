<?php
$lockfile = "config.php";

if(!file_exists($lockfile))
{
  
   header("Refresh:0;url='./install'"); 
}else{
    
$username = $_POST['username'];
$passwd = $_POST['passwd'];
$repasswd = $_POST['repasswd'];

require_once('config.php');
$rename = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM `user` WHERE username = '$username'"));



if(isset($_POST['submit'])){
    if(empty($username) || empty($passwd) || empty($repasswd))
    {
       echo "请输入完整"; 
        header("Refresh:1;URL='register.php'");
    }else if(!empty($rename['passwd'])){
       echo "用户名已存在";
        header("Refresh:1;URL='register.php'");
    }else if($passwd !== $repasswd){
       echo "两次密码输入不相同";
        header("Refresh:1;URL='register.php'");
    }
    else{
         $reg = mysqli_query($db,"INSERT INTO `user` (`username`,`passwd`) VALUES('$username','$passwd')");
         echo "注册成功！";
         header("Refresh:2;URL='login.php'");
    }
    
   
    exit();
}

//是否为空
//用户名是否重复
//两次密码输入是否相同


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
                  <div id='emailcheck' class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">重复密码</label>
                    <input name="repasswd" type="password" class="mdui-textfield-input" />
                </div>
                <br />
                <div class="mdui-card-actions">
                    <center>
                        <button name="submit" class="mdui-btn mdui-ripple mdui-btn-dense">登录</button>
                    </center>
                    <a style='float: right;margin-right: 20px;color: black;' href='./login.php'>已经有账号？登录</a>
                    
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