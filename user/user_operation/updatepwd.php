<?php
session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../../index.php");
}

include('../../class/user.php');
$up_pwd=new Users();
$up_pwd->StId = $_SESSION['Student_ID'];
$up_pwd->load_users();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  if (empty($_POST['old'])&& empty($_POST['new']) && empty($_POST['new_again']))
  {
		echo "<script>alert('Please complete the information!');</script>";
  } 
  else
  {
	if (sha1($_POST['old']) != $up_pwd->StPwd)
	{
		echo "<script>alert('The old password is wrong!');</script>";		
	}
	else
	{
		if($_POST['new']!=$_POST['new_again'])
		{
			echo "<script>alert('The new passwords are different!');</script>";
		}
		else
		{
			$up_pwd->StPwd = sha1($_POST['new']);
			$up_pwd->update_pwd();
			echo "<script>alert('Your password is updated!');</script>";			
		?>
			<meta http-equiv="refresh" content="0.1; url=<?php echo "onsale.php"; ?>">
		<?php
		}
	}
	}
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="../../css/main.css"/>
</head>
<body>
<h1>Change Password</h1>
<form method="post" action="<?php echo htmlspecialchars('updatepwd.php');?>">
<table border="1">
<tr><th>Current password </th>	<td><input type ="password" name="old" size = "20"></td></tr>
<tr><th>New password </th>	<td><input type ="password" name="new" size = "20"></td></tr>
<tr><th>New password again  </th>	<td><input type ="password" name="new_again" size = "20"></td></tr>
</table>
<input type="submit" value="save" class = "button">
<!--<input type="button" value="返回" onclick="location.href='onsale.php'">-->
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