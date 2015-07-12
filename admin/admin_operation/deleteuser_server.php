<?php require_once 'conn.php' ?>

<!DOCTYPE html>

<html>
<body>
<head>
	<meta charset = "UTF-8">
	<title> Delete bulletins </title>
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
	$sql = "DELETE FROM user WHERE Student_ID='$stu_ID'";
	$result = mysqli_query($conn, $sql);
}

header("Location:adminuser.php");

?>




</body>
</html>