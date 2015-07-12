<?php
session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../../index.php");
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel = "stylesheet" href = "../../css/main.css">

<title>Send Message</title>

</head>



<body>

<h1>Send Message</h1>
<form method="post" action="<?php echo htmlspecialchars('sendmsg_server.php');?>" enctype = "multipart/form-data">
<input type="hidden" name="sender" value = <?php echo $_POST["sender"] ?> />
Receiver:
<input type="text" name="receiver" value = <?php echo $_POST["receiver"] ?> /><br />
<br />

Title:
<input type="text" name = "title" size = "60"/><br />
<br />
Content:
<br />
<textarea name="content" rows = "20" cols = "80"/>
</textarea>
<br />
<br />
<input type="submit" value="Send Message" class = "button"/>
&nbsp;
<input type="button" value = "Return" onclick="location.href='mymsg.php'" class = "button">
<!--<input type="button" value="Return" onclick="location.href='onsale.php'">-->
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

