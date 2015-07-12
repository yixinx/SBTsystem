<?php require_once '../../admin/admin_operation/conn.php' ?>

<!DOCTYPE html>

<html>
<body>
<head>
	<meta charset = "UTF-8">
	<link rel = "stylesheet" href = "../../css/main.css">
	<title> Check announcements </title>
</head>
<h1>Announcements</h1>
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
	$filename = $arr['File_Name'];
/* 	$phone = $arr['Phone'];
	$email = $arr['Email'];
	$sold_Num = $arr['SoldNum']; */
	
}
?>

Publisher:<?php echo $publisher; ?><br /><br />
Published at:<?php echo $time; ?><br /><br />
<h2><?php echo $title; ?></h2><br />
Content:<br />
<pre><?php echo $content; ?></pre><br />
Attachments:
	<a href = <?php echo '../../files/annce_attach/'.$filename; ?>> <?php echo $filename; ?>  </a>
<br />
<br /><br />

<!--<form action = "editannce_server.php" method = "post">

	<input type = "hidden" name = "time" value = "<?php echo $time; ?>">
	<input type = "hidden" name = "publisher" value = "<?php echo $publisher; ?>">
	Publisher: <?php echo $publisher; ?><br />
	<div>Title
		<input type = "text" name = "title" value = "<?php echo $title; ?>">
	</div>
	<div>Content
		<textarea id = "content" name = "content" rows = "20" cols = "50" ><?php echo $content; ?></textarea>
		<!--<script>
		document.getElementById("content").value="<?php echo $content; ?>"
		</script>-->

	<!--</div>
	<input type = "submit" value = "Submit">-->
<input type="button" value="Return" onclick="location.href='checkannce.php'" class = "button">
	
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