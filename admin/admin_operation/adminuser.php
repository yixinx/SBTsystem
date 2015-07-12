<?php require_once 'conn.php' ?>

<!DOCTYPE html>

<html>
<body>
<head>
	<meta charset = "UTF-8">
	<title> All users </title>
	<link rel="stylesheet" href="../../css/main.css"/>
</head>
<h1>User Management</h1>

<!--<a href = "deluser.html"> 管理广告 </a>-->
<table border = '1'>
	<tr><th>Student ID</th><th>Student Name</th><th>Privilege</th><th>QQ</th><th>Phone</th><th>Email</th><th>SoldNum</th><th>edit</th><th>delete</th>
<?php

$conn = connectDB();
mysqli_query($conn, "SET NAMES 'utf8'");
$sql = "SELECT * FROM user ORDER BY Student_ID";
$result = $conn->query($sql);
$rowNum = mysqli_num_rows($result);

for($i = 0; $i < $rowNum; $i++)
{
	$result_arr = mysqli_fetch_assoc($result);
	
	$stu_ID = $result_arr['Student_ID'];
	$stu_Name = $result_arr['Student_Name'];
	$pwd = $result_arr['Password'];
	$priv = $result_arr['Privilege'];
	$qq = $result_arr['QQ'];
	$phone = $result_arr['Phone'];
	$email = $result_arr['Email'];
	$soldNum = $result_arr['SoldNum'];
	
	
	echo "<tr><td>$stu_ID</td><td>$stu_Name</td><td>$priv</td><td>";
	if($qq == 0) {echo "";}
	else {echo $qq;}
	echo "</td><td>";
	if($phone == 0) {echo "";}
	else {echo $phone;}
	echo "</td><td>$email</td><td>$soldNum</td><td><a href = 'edituser.php?stu_ID=$stu_ID'>edit</td><td><a href = 'deleteuser_server.php?stu_ID=$stu_ID'>delete</td>";
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

