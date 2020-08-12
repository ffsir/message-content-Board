<?php
session_start();
define('CLINT_ID','Dd8rpmsledJl0V3w4nKATu6YAbMjhc');  //这里可以自己到xoauth申请id
$code = $_GET['code'];
if(empty($code))
{
  header("Refresh:0;URL='http://oauth.xsot.cn/oauth.php?response_type=code&client_id=". CLINT_ID ."&redirect_uri=http://". $_SERVER['SERVER_NAME'] ."/xclogin.php'");
  exit();
}


$arr = json_decode(file_get_contents('https://oauth.xsot.cn/api/token.php?code='. $code . "&client_id=".CLINT_ID),true);
$url = 'https://oauth.xsot.cn/api/resourse.php?access_token=' . $arr['access_token'];
$return = json_decode(file_get_contents($url),true);

if($arr['code'] == '200')
{
    
  $_SESSION['login'] = $return['username'];
  header("Refresh:0;URL='http://". $_SERVER['SERVER_NAME'] ."'");
} else{
   header("Refresh:0;URL='http://oauth.xsot.cn/oauth.php?response_type=code&client_id=". CLINT_ID ."&redirect_uri=http://". $_SERVER['SERVER_NAME'] ."/xclogin.php'");
  exit();
}



?>