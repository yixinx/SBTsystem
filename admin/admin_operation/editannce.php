<?php require_once 'conn.php' ?>

<?php
session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../../index.php");
}
?>

<!DOCTYPE html>

<html>
<body>
<head>
	<meta charset = "UTF-8">
	<title> Edit bulletins </title>
	<link rel="stylesheet" href="../../css/main.css"/>
</head>

<h1>Edit Announcement</h1>

<?php

$conn = connectDB();
mysqli_query($conn, "SET NAMES 'utf8'");

if(empty($_GET['time']))
{
	echo "Error: seller's id is not received.";
}
else
{
	//echo "meow";
	$time = $_REQUEST['time']; //?????????????????????????????why can't I use intval?????????????

	$sql = "SELECT * FROM annce WHERE Upload_Instant = '$time'"; 
	$result = mysqli_query($conn, $sql);
/* 	if(mysqli_errno($conn)){
		die('cannot connect to mysql');	
	} */
	//echo $result;
	$arr = mysqli_fetch_assoc($result);
	$publisher = $arr['Admin'];
	$title = $arr['Title'];
	$content = $arr['Content'];
	$attach = $arr['File_Name'];
/* 	$phone = $arr['Phone'];
	$email = $arr['Email'];
	$sold_Num = $arr['SoldNum']; */
	
	
}


?>

<form action = "editannce_server.php" method = "post" enctype = "multipart/form-data">

	<input type = "hidden" name = "time" value = "<?php echo $time; ?>">
	<input type = "hidden" name = "publisher" value = "<?php echo $publisher; ?>">
	Publisher: <?php echo $publisher; ?><br />
	<br />
	Title:
		<input type = "text" name = "title" size = "60" value = "<?php echo $title; ?>">
	<br />
	<br />
	Content:
	<div>
		<textarea id = "content" name = "content" rows = "20" cols = "80" ><?php echo $content; ?></textarea><br />
		<!--<script>
		document.getElementById("content").value="<?php echo $content; ?>"
		</script>-->

	</div>
	<br />
	Attachment:
	<a href = <?php echo '../../files/annce_attach/'.$attach; ?>> <?php echo $attach; ?>  </a>
	<br /><br />
	<!--<label for="file">Filename:</label>
	<input type="file" name="file" id="file" />-->
	
	<input type = "submit" value = "Submit" class = "button" />
	&nbsp;
	<input type="button" value="Return" onclick="location.href='adminannce.php'" class = "button" />	
	
	
</form>

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