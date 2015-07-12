<?php
session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../../index.php");
}
include('../../class/book.php');
include('../../class/booktype.php');
$book_type=new booktype();
$my_book=new Book();
$my_book->StId = $_SESSION['Student_ID'];
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" href = "../../css/main.css">
</head>
<body>
<h1>My Books</h1>
<table border="1">
<tr>
<th>Type</th>
<th>Name</th>
<th>Author</th>
<th>Language</th>
<th>Version</th>
<th>Price(RMB)</th>
<th>Status</th>
<th>Edit</th>
</tr>
<?php
$array = $my_book->load_myonsale();
while($row=mysqli_fetch_array($array)) {
?>
    <tr>
		<td><?php 
		$book_type->TypeId=$row["Type_ID"];
		$book_type->load_typename();
		echo $book_type->TypeNm.$row["Course_ID"];
		?></td>		
		<td><?php echo $row["Book_Name"]; ?></td>
		<td><?php echo $row["Author"]; ?></td>
		<td><?php echo $row["Language"]; ?></td>
		<td><?php echo $row["Version"]; ?></td>
		<td><?php echo $row["Price"]; ?></td>
		<td><?php echo "on-sale" ?></td>
		<td><a href="<?php echo "edit.php?book_name=" .$row["Book_Name"]." " ?>">Edit</a></td>			
    </tr>
<?php
}
?>
</table>
<br />


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