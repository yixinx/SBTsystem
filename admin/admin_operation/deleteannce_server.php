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

if(empty($_REQUEST['time']))
{
	echo "Error: posting time is not received.";
}
else
{
	//echo "meow";
	$time = $_REQUEST['time']; //?????????????????????????????why can't I use intval?????????????
	$sql = "DELETE FROM annce WHERE Upload_Instant='$time'";
	$result = mysqli_query($conn, $sql);
}

header("Location:adminannce.php");

?>




</body>
</html>