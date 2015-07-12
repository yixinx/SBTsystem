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

//$seller = intval($_POST["seller"]);
$time = $_POST["time"];
echo $time;

//echo $typeID."\n";
$publisher = $_POST["publisher"];
echo $publisher."\n";
$title = $_POST["title"];
echo $title."\n";
$content = $_POST["content"];
echo $content."\n";




$sql = "UPDATE annce SET Admin = '$publisher', Title='$title', Content='$content' WHERE Upload_Instant = '$time'";

mysqli_query($conn, $sql);	



header("Location:adminannce.php");





?>

<!--<a href = adminuser.php>喵</a>-->


</body>
</html>