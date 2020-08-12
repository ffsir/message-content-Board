<?php
session_start();
session_destroy();
echo"退出成功！";

header("Refresh:1;URL='login.php'");
?>