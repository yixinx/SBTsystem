<?php
session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../index.php");
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/choose.css"/>
</head>
<body leftmargin = "0">
<br>
<ul>

<li><a href='user_operation/guidance.php' target='content'>How to Use</a></li><br />
<li><a href='user_operation/onsale.php' target='content'>On Sale</a></li><br />
<li><a href='user_operation/upload.php' target='content'>Upload</a></li><br />
<li><a href='user_operation/checkannce.php' target = 'content'>Announcements</a></li><br />
<li><a href='user_operation/mybook.php' target='content'>My Books</a></li><br />
<li><a href='user_operation/mymsg.php' target='content'>My Messages</a></li><br />
<li><a href='user_operation/myinfo.php' target='content'>My Information</a></li><br />
<li><a href='user_operation/updatepwd.php' target='content'>Change Password</a></li><br />
<li><a href='user_operation/myhistory.php' target='content'>Selling History</a></li><br />
</ul>
			<!--<input type="button" value="我要上传" name="upload" onclick="location.href='upload.php'" target="content" /><br>
			<input type="button" value="我的书单" name="mybook" onclick="location.href='mybook.php'" target="content"/><br>
			<input type="button" value="我的信息" name="myinfo" onclick="location.href='myinfo.php'" target="content"/><br>
			<input type="button" value="修改密码" name="updatepwd" onclick="location.href='updatepwd.php'" target="content"/><br> -->
</body>
</html>