<?php require_once 'conn.php' ?>

<!DOCTYPE html>

<html>
<body>
<head>
	<meta charset = "UTF-8">
	<title> Edit bulletins </title>
</head>

<?php
$conn = connectDB();
mysqli_query($conn, "SET NAMES 'utf8'");
$stu_ID = $_POST["stu_ID"];
echo "$stu_ID";
$stu_Name = $_POST["stu_name"];
$priv = $_POST["privilege"];
$qq = $_POST["qq"];
/*if(empty($_POST["qq"]))
{
	$qq = 'NULL';
}*/
$phone = $_POST["phone"];
/*if(empty($_POST["phone"]))
{
	$phone = 'NULL';
}*/
$email = $_POST["email"];

$sql = "UPDATE user SET Student_Name = '$stu_Name', Privilege='$priv', QQ='$qq', Phone = '$phone', Email = '$email' WHERE Student_ID = '$stu_ID'";

$conn->query($sql);	


//header("Location:adminuser.php");





?>

<!--<a href = adminuser.php>喵</a>-->


</body>
</html>