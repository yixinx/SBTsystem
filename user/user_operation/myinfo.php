<?php
session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../../index.php");
}

include('../../class/user.php');
$my_info=new Users();
$my_info->StId = $_SESSION['Student_ID'];
$my_info->load_users();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST['name']))
	{
		echo "<script>alert('Name is required!');</script>";		
	}
	else
	{
	  if (empty($_POST['qq']) && empty($_POST['phone']) && empty($_POST['email'])) 
  {
		echo "<script>alert('At least one contact info is required!');</script>";
  } 
  else 
  {
 	if (!empty($_POST['email']) && !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST['email']))
	{
		echo "<script>alert('email format is illegal');</script>";	
	}
	else
	{
	$my_info->StName = $my_info->test_input($_POST['name']);
    $my_info->qq = $my_info->test_input($_POST['qq']);
    $my_info->phone = $my_info->test_input($_POST['phone']);
    $my_info->email = $my_info->test_input($_POST['email']);
	$my_info->update_info();
		echo "<script>alert('Your information is updated!');</script>";	
	}//end of illegal email
  }//end of at least one contact 
  }//end of name
}
?>
    <!--$my_info->StName = $my_info->test_input($_POST['name']);
	$my_info->qq = $my_info->test_input($_POST['qq']);
    $my_info->phone = $my_info->test_input($_POST['phone']);
    $my_info->email = $my_info->test_input($_POST['email']);
	$my_info->update_info();
		echo "<script>alert('Your information is updated!');</script>";	
    //$home_url = 'onsale.php';
    //header('Location: '.$home_url);
  }
}
?>-->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="../../css/main.css"/>
</head>
<body>
<h1>Personal Information</h1>
<form method="post" action="<?php echo htmlspecialchars('myinfo.php');?>">
<table border="1">
<tr><th>StudentID</th>	<td><?php echo $my_info->StId?></td></tr>
<tr><th>Name<br />
<font style = "font-size: 12px">(Better in format Lastname_Firstname)</font>
</th>	<td><input type ="text" name="name" size = "40" value="<?php echo $my_info->StName?>" selected = "selected"></td></tr>
<tr><th>QQ<br />	
<font style = "font-size: 12px">(Please fill at least one among QQ, Phone and Email)</font>
</th>	<td><input type ="text" name="qq" size = "40" value="<?php echo $my_info->qq?>" selected = "selected"></td></tr>
<tr><th>Phone</th>	<td><input type ="text" name="phone" size = "40" value="<?php echo $my_info->phone?>" selected = "selected"></td></tr>
<tr><th>Email</th>	<td><input type ="text" name="email" size = "40" value="<?php echo $my_info->email?>" selected = "selected"></td></tr>
</table>
<input type="submit" value="Save" class = "button" />
<!--<input type="button" value="Return" onclick="location.href='onsale.php'" class = "button"/>-->
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