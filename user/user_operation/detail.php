<?php
session_start();
if($_SESSION["Student_ID"])
{
	include('../../class/user.php');
	$contri=new users();
	$contri->StId=$_GET["student_id"];
	$contri->load_users();
	
	include('../../class/book.php');
	$interest=new Book();
	$interest->StId=$_GET["student_id"];
	$interest->BookNm=$_GET["book_name"];
	$result=$interest->load_one_book();
	$row=mysqli_fetch_array($result);	
}
else
{
    header("location:../../index.php");
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel = "stylesheet" href = "../../css/main.css">
</head>
<body>
<h1>Book Information</h1>

<table>
<caption><h2>Book Information</h2></caption>
<tr><th width = "180px">Book Name</th><td><?php echo $row["Book_Name"]?></td></tr>
<tr><th width = "180px">Author</th><td><?php echo $row["Author"]?></td></tr>
<tr><th width = "180px">Language</th><td><?php echo $row["Language"]?></td></tr>
<tr><th width = "180px">Version</th><td><?php echo $row["Version"]?></td></tr>
<tr><th width = "180px">Quantity</th><td><?php echo $row["Quantity"]?></td></tr>
<tr><th width = "180px">Price</th><td><?php echo $row["Price"]?></td></tr>
<tr><th width = "180px">Location</th><td><?php echo $row["Location"]?></td><tr>
<tr><th width = "180px">Last Update</th><td><?php  $datetime=strtotime($row["Upload_Instant"]);echo date('Y-M-d H:m:s', $datetime);?></td></tr>
<tr><th width = "180px">Comments</th><td><?php echo $row["Comments"]?></td></tr>
<tr><th width = "180px">Attachment</th><td><a href = <?php echo '../../files/bllt_pic/'.$row["File_Name"]; ?>> <?php echo $row["File_Name"]; ?>  </a></td></tr>
<br />
</table>



<table>
<caption><h2>Seller Information</h2></caption>
<tr><th width = "180px">Seller</th><td><?php echo $contri->StId ."\n". $contri->StName?></td></tr>
<tr><th width = "180px">QQ</th><td><?php echo $contri->qq ?></td></tr>
<tr><th width = "180px">Phone</th><td><?php echo $contri->phone ?></td></tr>
<tr><th width = "180px">Email</th><td><?php echo $contri->email ?></td></tr>

</table>
<br />
<br />

<form method = "post" action = "<?php echo htmlspecialchars('sendmsg.php');?>">
<input type = "hidden" name = "sender" value = "<?php echo $_SESSION["Student_ID"]?>">
<input type = "hidden" name = "receiver" value = "<?php echo $_GET["student_id"]?>">

<input type="submit" value="Send message to sender" class = "button"> &nbsp;
<input type="button" value = "Return" onclick="location.href='onsale.php'" class = "button">
</form>


<div id = "footer">
<br />
<br />
<br />
<br />
<br />
<h6 align = "center">Copyright &copy; 2015 Yixin Xue and Yanrong Li. All rights reserved.</h6>
</div>



</table>
</body>
</html>