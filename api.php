<?php
		/*	$admin_user = "";
			$admin_pwd = ""; */
			
			session_start();
        $db = mysqli_connect("localhost","testx","testx","testx");
            $time = date("Y-m-d H:i:s");
    
   $xc = $_POST['xc'];
   $username = $_SESSION['login'];

 
    //GET
  $return = file_get_contents("https://api.xsot.cn/mgword/?content=$xc");
  $arr = json_decode($return,true);
  
  
 if($arr['count'] >= 1){
   echo 1;
    
 }else{
        mysqli_query($db,"INSERT INTO `content` (`content`,`time`,`username`) VALUES ('$xc','$time','$username')");
  
    echo 200;
 }
			
			?>