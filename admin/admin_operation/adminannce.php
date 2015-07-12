<?php require_once 'conn.php' ?>
<?php
session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../../index.php");
}
?>

<!DOCTYPE html>

<html>
<head>
	<meta charset = "UTF-8">
	<title> All announcements </title>
	<link rel="stylesheet" href="../../css/main.css"/>
</head>


<body>

<!--<a href = "deluser.html"> 管理广告 </a>-->
<div>
<include file = "adminbllt.php"> 
</div>

<h1>Announcement Management</h1>

<table>
	<tr><th>Publisher</th><th>Title</th><th>Published Time</th><th>edit</th><th>delete</th>
<?php

$conn = connectDB();
mysqli_query($conn, "SET NAMES 'utf8'");
$sql = "SELECT * FROM annce ORDER BY Upload_Instant";
$result = $conn->query($sql);
$rowNum = mysqli_num_rows($result);

for($i = 0; $i < $rowNum; $i++)
{
	$result_arr = mysqli_fetch_assoc($result);
	
	$publisher = $result_arr['Admin'];
	$title = $result_arr['Title'];
	$time = $result_arr['Upload_Instant'];
/*	$dpltime = date('Y-m-d H:i:s', $time);
 	$priv = $result_arr['Privilege'];
	$qq = $result_arr['QQ'];
	$phone = $result_arr['Phone'];
	$email = $result_arr['Email'];
	$soldNum = $result_arr['SoldNum']; */
	
	
	echo "<tr><td>$publisher</td><td>$title</td><td>";
	$datetime = strtotime($time); echo date('Y-M-d H:m:s', $datetime);
	echo "</td><td><a href = 'editannce.php?time=$time'>edit</td><td><a href = 'deleteannce_server.php?time=$time'>delete</td>";
}
?>


</table>

<div id = "footer">
<br />
<br />
<br />
<br />
<br />
<h6 align = "center">Copyright &copy; 2015 Yixin Xue and Yanrong Li. All rights reserved.</h6>
</div>	


</body>
</html>

