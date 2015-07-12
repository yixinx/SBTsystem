<?php require_once 'conn.php' ?>

<!DOCTYPE html>

<html>
<head>
	<meta charset = "UTF-8">
	<title> All bulletins </title>
	<link rel="stylesheet" href="../../css/main.css"/>
</head>
<body>

<h1>Bulletin Management</h1>

<!--<a href = "deluser.html"> 管理广告 </a>-->
<table border = '1'>
	<tr><th>Seller</th><th>Course ID</th><th>Book</th><th>Language</th><th>Location</th><th>Price(RMB)</th><th>view/edit</th><th>delete</th>
<?php

$conn = connectDB();
mysqli_query($conn, "SET NAMES 'utf8'");
$sql = "SELECT * FROM book ORDER BY Upload_Instant";
$result = $conn->query($sql);
$rowNum = mysqli_num_rows($result);

for($i = 0; $i < $rowNum; $i++)
{
	$result_arr = mysqli_fetch_assoc($result);
	
	$seller = $result_arr['Student_ID'];
	$course = $result_arr['Course_ID'];
	$book = $result_arr['Book_Name'];
	$lang = $result_arr['Language'];
	$location = $result_arr['Location'];
	$price = $result_arr['Price'];
	
	echo "<tr><td>$seller</td><td>$course</td><td>$book</td><td>$lang</td><td>$location</td><td>$price</td><td><a href = 'editbllt.php?seller=$seller&book=$book'>view/edit</a></td><td><a href = 'deletebllt_server.php?seller=$seller&book=$book'>delete</td>";
}
/*<a href="<?php echo "detail.php?book_name=" .$row["Book_Name"]." &student_id=".$row["Student_ID"]." " ?>">*/
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

