<?php
session_start();
if(isset($_SESSION['Student_ID'])){
}
?>
<html>
<head>
	<meta charset = "UTF-8">
	<link rel="stylesheet" href="css/header.css"/>
</head>
<body leftmargin="0" topmargin="0">
<table border = "0">
<tr  height = "175px"><td width = "16%">
<img src = "images/logo.gif" height = "120px" align = "center"/>
</td>
<td width = "74%">
<h1 align = "center">Welcome to SBTSYS!</h1>
</td>
<td align = "center" width = "8%">
<?php echo $_SESSION['Student_ID'];?>
<br /><br />
<a href = 'logout.php'><font style = "font-size: 14px">Log out</font></a>

</td>
<td width = "8%">
<img src = "images/inv_bamboo.png" height = "174px" align = "right" />
</td></tr>
</border>







<!--<img src = "images/leaves3.png" height = "175px" align = "right" />-->
</body>
</html>