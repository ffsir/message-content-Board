<?php
header("Content-type:text/html;charset=utf-8");
$lockfile = "../api.php";

if(file_exists($lockfile))
{
    exit("如果想重复安装，请删除api文件。");
   header("Refresh:0;url:'./index.php'"); 
}else{








//获得配置
//$adminuser = $_POST["adminuser"];
//$adminpwd = $_POST["adminpwd"];
$servername = $_POST["dbservername"];
$username = $_POST["dbusername"];
$password = $_POST["dbpassword"];
$dbname = $_POST["dbname"];
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
 
// 创建内容数据表
$content = "CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` mediumtext NOT NULL,
  `time` mediumtext NOT NULL,
  `username` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
)";


// 创建用户数据表
$user = "CREATE TABLE `user` (
  `username` mediumtext NOT NULL,
  `passwd` mediumtext NOT NULL
)";




 


if ($conn->query($content) === TRUE) {

	if ($conn->query($user) === TRUE) {

			//开始创建本地配置文件
			$mysql_data = '<?php
		/*	$admin_user = "'.$adminuser.'";
			$admin_pwd = "'.$adminpwd.'"; */
			
			session_start();
        $db = mysqli_connect("'. $servername .'","'. $username .'","'. $password .'","'. $dbname .'");
            $time = date("Y-m-d H:i:s");
    
   $xc = $_POST[\'xc\'];
   $username = $_SESSION[\'login\'];

 
    //GET
  $return = file_get_contents("https://api.xsot.cn/mgword/?content=$xc");
  $arr = json_decode($return,true);
  
  
 if($arr[\'count\'] >= 1){
   echo 1;
    
 }else{
        mysqli_query($db,"INSERT INTO `content` (`content`,`time`,`username`) VALUES (\'$xc\',\'$time\',\'$username\')");
  
    echo 200;
 }
			
			?>';
			//生成json文件
			file_put_contents('../api.php', $mysql_data);
			//输出结果
			echo "<div style='width:300px;margin:50px auto 5px;'><img src='https://ae01.alicdn.com/kf/H25c45c759fcf43ae9ac3e98e65305a11J.jpg' width='300'/></div>";
			echo "<h2 style='text-align:center;margin-top:50px;'>安装成功！！</h2>";
			echo "<h2 style='text-align:center;margin-top:5px;'><a href='../' style='text-decoration:underline;color:#333;'>前往首页>> </a> </h2>";
			} else {
				
		    	echo $conn->error."<br/>";
			}

		} else {
		
	    echo $conn->error."<br/>";
	}


//断开数据库连接
$conn->close();
    
    
}
?>