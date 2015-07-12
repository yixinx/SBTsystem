<?php require_once 'conn.php' ?>

<!DOCTYPE html>

<html>
<body>
<head>
	<meta charset = "UTF-8">
	<title> Edit bulletins </title>
	<link rel = "stylesheet" href = "../../css/main.css">
</head>

<?php

$conn = connectDB();
mysqli_query($conn, "SET NAMES 'utf8'");

if(empty($_GET['stu_ID']))
{
	echo "Error: seller's id is not received.";
}
else
{
	//echo "meow";
	$stu_ID = $_REQUEST['stu_ID']; //?????????????????????????????why can't I use intval?????????????

	$sql = "SELECT * FROM user WHERE Student_ID = $stu_ID"; 
	$result = mysqli_query($conn, $sql);
/* 	if(mysqli_errno($conn)){
		die('cannot connect to mysql');	
	} */
	//echo $result;
	$arr = mysqli_fetch_assoc($result);
	$stu_Name = $arr['Student_Name'];
	$priv = $arr['Privilege'];
	$qq = $arr['QQ'];
	$phone = $arr['Phone'];
	$email = $arr['Email'];
	$sold_Num = $arr['SoldNum'];
	
	
}


?>
<h1>Edit User</h1>

<form action = "edituser_server.php" method = "post">

	<input type = "hidden" name = "stu_ID" value = "<?php echo $stu_ID; ?>">
	Student ID: <?php echo $stu_ID; ?><br /><br />
	<div>Student_Name:
		<input type = "text" name = "stu_name" size = "30" value = "<?php echo $stu_Name; ?>">
	</div><br />
	<div>Privilege:
		<input type = "radio" name = "privilege" value = "0" <?php if($priv == 0) echo "checked"?>>User
		<input type = "radio" name = "privilege" value = "1" <?php if($priv == 1) echo "checked"?>>Admin
	</div><br />
	<div>QQ:
		<input type = "text" name = "qq" size = "30" value = "<?php echo $qq; ?>">
	</div><br />
	<div>Phone:
		<input type = "text" name = "phone" size = "30" value = "<?php echo $phone; ?>">
	</div><br />
	<div>Email:
		<input type = "text" name = "email" size = "30" value = "<?php echo $email; ?>">
	</div><br />

	<input type = "submit" value = "Submit" class = "button">
</form>
<br />
<input type = "button" value = "Return" onclick = "location.href = 'adminuser.php'" class = "button">
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