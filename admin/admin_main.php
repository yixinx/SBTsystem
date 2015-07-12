<?php
session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../index.php");
}
?>

<html>
<head>
	<meta charset = "UTF-8">
	<link rel="stylesheet" href="../css/main.css"/>
</head>
<!--<frameset rows="5%,*">
  <frame name="log" src="../log.php">
<frameset cols="120,*">

  <frame name="index" src="user_choose.php">
  <frame name="content" src="user_operation/onsale.php">
</frameset>
</frameset>-->
<div class="main">
	<div class="header">
		<iframe frameborder = "0" src="../log_admin.php" width="100%" height="100%"></iframe> 
	</div>
	<div class="content">
		<div class="leftcontent">
			<iframe frameborder = "0" src="admin_choose.php" width="100%" height="100%"></iframe>
		</div>
		<div class="rightcontent">
			<iframe frameborder = "0" name="content" src="admin_operation/adminbllt.php" width="100%" height="100%" ></iframe>
		</div>
	</div>
</div>
</html>