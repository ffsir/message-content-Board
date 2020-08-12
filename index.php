<?php 
session_start();
$lockfile = "config.php";

if(!file_exists($lockfile))
{
   header("Refresh:0;url='/install'"); 
   
}else{
require_once('config.php');


    
if($_SESSION['login'])
{
 
}else{
    header("Refresh:0;URL='login.php'");
    exit();
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
<body>
<header class="mdui-appbar mdui-appbar-fixed">
  <body background="https://cdn.jsdelivr.net/gh/soxft/cdn@master/lovewall/background.png" class="mdui-drawer-body-left mdui-appbar-with-toolbar mdui-theme-primary-white">
    <div class="mdui-toolbar mdui-color-theme">
      <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#main-drawer'}">
        <i class="mdui-icon material-icons">menu</i>
      </span>
      <a href="" class="mdui-typo-title">留言蔷</a>
    </header>
    <div class="mdui-drawer" id="main-drawer">
      <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 68px;">
        <div class="mdui-list">
          <a href="/" class="mdui-list-item">
            <i class="mdui-list-item-icon mdui-icon material-icons">filter_none</i>
            &emsp;主页
          </a>

        </div>

        <div class="mdui-collapse-item ">
          <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">&#xe80d;</i>
            &emsp;友链
            <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
          </div>
          <div class="mdui-collapse-item-body mdui-list">
            <a href="//ffsir.cf" class="mdui-list-item mdui-ripple ">FFSir</a>
            <a href="//oauth.xsot.cn" class="mdui-list-item mdui-ripple ">XOAUTH</a>
          </div>
        </div>
      </div>
    </div>
    <br />
<h1>欢迎回来：<?php echo $_SESSION['login'] ?>      <a href="logout.php">退出登录</a></h1>
<?php
 
    $nr = mysqli_query($db,"SELECT * from `content`");
    while($xh = mysqli_fetch_object($nr)){
        echo "   
        <div class=\"mdui-card\">
          <div class=\"mdui-card-primary\">
            <div class=\"mdui-card-primary-title\"></div>
            <div class=\"mdui-card-primary-subtitle\">" . $xh->time . "</div>
            <div class=\"mdui-card-content\" style=\"word-break:break-all;\">「" . $xh->content . "」</div>
            <div style=\"float:right; class=\" mdui-card-primary-subtitle=\"\">FROM:" . $xh->username . "</div>
        
          </div>    
        </div>
        <div style='height:5px'></div>";
    }
    
   ?>
   <div id='after'></div>
<div style='height:10px'></div>
<center>
  
<!--        <form action='index.php' method="POST"> -->
            <div class="mdui-textfield mdui-textfield-floating-label">
              
                

                <textarea rows="10" cols="20" id="xc" name="xc" class="mdui-textfield-input" type="text" placeholder="你想说的话"></textarea>
            </div>
            <div style='height:5px'></div>
            <button class="mdui-btn mdui-btn-dense mdui-color-theme-accent mdui-ripple" onclick='submit()' type='submit' id='submit' value="提交"><i class="mdui-icon material-icons">near_me</i></button>
      <!--  </form>-->
  
</center>

<script>
var $ = mdui.JQ;

function submit() {
    if($('#xc').val() == '')
    {
        mdui.snackbar({
        message: '输入的内容为空',
        position: 'left-top'
    })
    } else {
    $('#submit').attr('disabled', true);
    $('#submit').val('提交中...');
    var mb = mdui.snackbar({
        message: '提交中',
        position: 'left-top'
    })
    console.log($('#xc').val())
    $.ajax({
        method: 'post',
        url: 'api.php',
        data: {
            xc: $('#xc').val()
        },
        success: function(data) {
            console.log(data)
            mb.close()
            if (data == 200) {
                mdui.snackbar({
                    message: '提交成功',
                    position: 'left-top'
                })
                setTimeout('window.location.reload()', 2000)
            } else {
                mdui.snackbar({
                    message: '非法的内容',
                    position: 'left-top'
                })
            }
            $('#submit').removeAttr('disabled');
            $('#submit').val('提交');
        }
    });
    }
}
</script>
</body>
</html>
<?php
}
?>