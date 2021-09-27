<?php
session_start();
define('CLINT_ID','20210927387');  //这里可以自己到xoauth申请id  网址9420.ltd
define('APP_SECRET','Mq1s9fRaeKWpI1V3fFtdu6FmSor6WuaN7bDoc36hM');  //密钥
$code = $_GET['token'];
if(empty($code))
{
  header("Refresh:0;URL='https://9420.ltd/v1/connect.php?appid=". CLINT_ID ."&redirect_uri=http://". $_SERVER['SERVER_NAME'] ."/xclogin.php'");
  exit();
}


$arr = json_decode(curl_post('https://9420.ltd/v1/userInfo.php','token='. $code . "&appid=".CLINT_ID."&app_secret=".APP_SECRET),true);
//$url = 'https://oauth.xsot.cn/api/resourse.php?access_token=' . $arr['access_token'];
//$return = json_decode(file_get_contents($url),true);

if($arr['code'] == '200')
{
    
  $_SESSION['login'] = "XOAUTH用户 - ".md5($arr['data']['open_id']);
  header("Refresh:0;URL='http://". $_SERVER['SERVER_NAME'] ."'");
} else{
  header("Refresh:0;URL='https://9420.ltd/v1/connect.php?appid=". CLINT_ID ."&redirect_uri=http://". $_SERVER['SERVER_NAME'] ."/xclogin.php'");
  exit();
}

function curl_post($url,$data,$cookie = "",$ref = "") {
        $headers = array(
            'referer: '.$ref,
            'cookie: '.$cookie,
            'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 11_2_1 like Mac OS X) AppleWebKit/604.4.7 (KHTML, like Gecko) Mobile/15C153 MicroMessenger/6.6.1 NetType/WIFI Language/zh_CN'
        );
    
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        
      //  curl_setopt($ch, CURLOPT_REFERER, $url);
        
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // POST数据
        
        curl_setopt($ch, CURLOPT_POST, 1);

        // 把post的变量加上

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $output = curl_exec($ch);

        curl_close($ch);

        return $output;
    }

