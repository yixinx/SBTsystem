<?php require_once '../../admin/admin_operation/conn.php' ?>

<!DOCTYPE html>

<html>
<body>
<head>
	<meta charset = "UTF-8">
	<link rel = "stylesheet" href = "../../css/main.css">
	<title> All announcements </title>
</head>
<h1>Announcements</h1>

<!--<a href = "deluser.html"> 管理广告 </a>-->
<table border = '1'>
	<tr><th>Publisher</th><th>Title</th><th>Time</th><th>Details</th><!--<th>delete</th>-->
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
	$filename = $result_arr['File_Name'];
	if ($filename == ''){
		$iffile = 0;
	}
	else $iffile = 1;
	
	/* 	$priv = $result_arr['Privilege'];
	$qq = $result_arr['QQ'];
	$phone = $result_arr['Phone'];
	$email = $result_arr['Email'];
	$soldNum = $result_arr['SoldNum']; */
	
	
	echo "<tr><td>$publisher</td><td>$title</td><td>$time</td><td><a href = 'checkanncedetail.php?time=$time'>Details</td>";
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

