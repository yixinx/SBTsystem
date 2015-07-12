

<?php
session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../../index.php");
}
include('../../class/msg.php');
$my_msg=new Msg();
$my_msg->id = $_SESSION['Student_ID'];
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="../../css/main.css"/>
</head>
<body>
<h1>My Messages</h1>
<table border="1">
<tr>
<th>Sender</th>
<th>Receiver</th>
<th>Title</th>
<th>Time</th>
<th>Check</th>
</tr>
<?php
$array = $my_msg->load_mymsg();
while($row=mysqli_fetch_array($array)) {

?>
    <tr>
		<td><?php echo $row["Sender"]; ?></td>
		<td><?php echo $row["Receiver"]; ?></td>
		<td><?php echo $row["Title"]; ?></td>	
		<td><?php  $datetime=strtotime($row["Send_Instant"]);echo date('Y-M-d H:m:s', $datetime);?></td>
		<!--<td><?php echo $row["Send_Instant"]; ?></td>-->
		<td><a href="<?php echo "checkmsg.php?time=" .$row["Send_Instant"]." " ?>">check</a></td>		
    </tr>
<?php
}
?>
</table>
<!--<input type="button" value="Return" onclick="location.href='.php'">-->
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