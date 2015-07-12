<?php require_once '../../admin/admin_operation/conn.php';

session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../../index.php");
	
}?>

<!DOCTYPE html>

<html>
<body>
<head>
	<meta charset = "UTF-8">
	<title> View message </title>
		<link rel="stylesheet" href="../../css/main.css"/>
</head>

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

	$sql = "SELECT * FROM message WHERE Send_Instant = '$time'"; 
	$result = mysqli_query($conn, $sql);
/* 	if(mysqli_errno($conn)){
		die('cannot connect to mysql');	
	} */
	//echo $result;
	$arr = mysqli_fetch_assoc($result);
	$sender = $arr['Sender'];
	$receiver = $arr['Receiver'];
	$title = $arr['Title'];
	$content = $arr['Content'];
/* 	$phone = $arr['Phone'];
	$email = $arr['Email'];
	$sold_Num = $arr['SoldNum']; */
	$sql2 = "SELECT * FROM user WHERE Student_ID = '$sender'";
	$result2 = mysqli_query($conn, $sql2);
	$arr2 = mysqli_fetch_assoc($result2);
	$senderName = $arr2['Student_Name'];
	$sql2 = "SELECT * FROM user WHERE Student_ID = '$receiver'";
	$result2 = mysqli_query($conn, $sql2);
	$arr2 = mysqli_fetch_assoc($result2);
	$receiverName = $arr2['Student_Name'];
	
}
?>
<h1>Check the Message</h1>
<br />
Sender:<?php echo $sender." ".$senderName; ?><br /><br />
Receiver:<?php echo $receiver." ".$receiverName; ?><br /><br />
Title:<strong><?php echo $title; ?></strong><br /><br />
Content:
<pre><?php echo $content; ?></pre><br />
<br />


<form method = "post" action = "<?php echo htmlspecialchars('sendmsg.php');?>">
	<input type = "hidden" name = "sender" value = "<?php if ($sender == $_SESSION["Student_ID"]) {
																echo $sender;
															} 
														  else {
															  echo $receiver;
														  }?>" />
	<input type = "hidden" name = "receiver" value = "<?php if ($sender == $_SESSION["Student_ID"]) {
																echo $receiver;
															} 
														  else {
															  echo $sender;
														  }?>" />
	<input type = "submit" value = "Reply" class = "button"/><br />
</form>
<!--<form action = "editannce_server.php" method = "post">

	<input type = "hidden" name = "time" value = "<?php //echo $time; ?>">
	<input type = "hidden" name = "publisher" value = "<?php //echo $publisher; ?>">
	Publisher: <?php //echo $publisher; ?><br />
	<div>Title
		<input type = "text" name = "title" value = "<?php //echo $title; ?>">
	</div>
	<div>Content
		<textarea id = "content" name = "content" rows = "20" cols = "50" ><?php //echo $content; ?></textarea>
		<!--<script>
		document.getElementById("content").value="<?php //echo $content; ?>"
		</script>-->

	<!--</div>
	<input type = "submit" value = "Submit">-->
<br />
<input type="button" value="Return" onclick="location.href='mymsg.php'" class = "button">
	
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