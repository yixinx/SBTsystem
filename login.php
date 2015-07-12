<html>
<head>
	<meta charset = "UTF-8">
	<link rel="stylesheet" href="css/login.css"/>
</head>	   
<script language="JavaScript">
function submit(){
document.forms[0].submit()
}
</script>	
<body>

		<br />
		<br />

		<form method="post" action="<?php echo htmlspecialchars('index.php');?>" target = "_parent">
			
			Student ID: <input type="text" name="log_id"/><br>
			<br />
			Password:&nbsp;&nbsp; <input type="password" name="log_pwd"/><br>
			<br />

		</form>
		<input type="button" onClick = "submit()" value="Login" class = "button">  
		&nbsp;		
		<input type="button" value="Register" onclick="javascript:window.parent.location='reg.php'" class = "button">
		<!--<input type="button" value="Lost my pwd" onclick = >-->
</body>
