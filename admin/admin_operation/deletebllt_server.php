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

if(empty($_GET['seller']))
{
	echo "Error: seller's id is not received.";
}
else
{
	//echo "meow";
	$seller = $_REQUEST['seller']; //?????????????????????????????why can't I use intval?????????????
	$book = $_REQUEST['book'];
	echo $seller;
	echo $book;
	$sql = "DELETE FROM book WHERE Book_Name='$book' AND Student_ID = $seller";
	$result = mysqli_query($conn, $sql);
}

header("Location:adminbllt.php");

?>




</body>
</html>