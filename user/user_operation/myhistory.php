<?php
session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../../index.php");
}

include('../../class/book.php');
$my_book=new Book();
$my_book->StId = $_SESSION['Student_ID'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="../../css/main.css"/>
</head>
<body>
<h1>Selling History</h1>
<table border="1">

<tr>
<th>Type/Course</th>
<th>Book Name</th>
<th>Author</th>
<th>Language</th>
<th>Version</th>
<th>Price</th>
<th>Status</th>
</tr>
<?php
$array = $my_book->load_myhistory();
while($row=mysqli_fetch_array($array)) {
?>
    <tr>
		<td><?php echo $row["Course_ID"]; ?></td>
		<td><?php echo $row["Book_Name"]; ?></td>
		<td><?php echo $row["Author"]; ?></td>
		<td><?php echo $row["Language"]; ?></td>
		<td><?php echo $row["Version"]; ?></td>
		<td><?php echo $row["Price"]; ?></td>
		<td><?php echo "Sold" ?></td>			
    </tr>
<?php
}
?>
</table>
<!--<input type="button" value="Return" onclick="location.href='onsale.php'">-->

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