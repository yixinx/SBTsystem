<!DOCTYPE HTML>
<html>
<head>
	<meta charset = "UTF-8">
	<link rel="stylesheet" href="css/main.css"/>
</head>
<body>
<?php
	include('class/user.php');
	$new_user=new Users();
	//检测输入是否满足要求
$IDErr = $nameErr = $pwdErr= $pwd_againErr = $ALOErr = $emailErr="";
$new_user->StId = $new_user->StName = $new_user->qq = $new_user->phone = $new_user->email = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST['Sid']))
  {
    $IDErr = "Student ID is required";
  } 
  else
  {
	if(preg_match('/^\d{10}$/',$_POST['Sid']))
	{
		$new_user->StId = $new_user->test_input($_POST['Sid']);
	}
	else
	{
		$IDErr = "Student ID should have 10 digits";
	}
  }
  if (empty($_POST['Sname']))
  {
    $nameErr = "Student's name is required";
  }
  else 
  {
    $new_user->StName = $new_user->test_input($_POST['Sname']);
  }
  if (empty($_POST['password'])) 
  {
    $pwdErr = "Password is required";
  }
  else	//密码1有输入
  {
	if($_POST['password']!=$_POST['password_again'])	//密码1不等于2
	{
		$pwd_againErr = "Password again is wrong";
	}
	else
	{
	    $new_user->StPwd = sha1($new_user->test_input($_POST['password']));		//sha1之后的密码
	}
  }
  if (empty($_POST['qq']) && empty($_POST['phone']) && empty($_POST['email'])) 
  {
    $ALOErr = "At least one contact information is required";
  }
  else 
  {
	if (!empty($_POST['email']) && !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST['email'])) 
	{
	$emailErr = "email address is illegal";
	}
	else
	{
	$new_user->qq = $_POST['qq'];
    $new_user->phone = $_POST['phone'];
    $new_user->email = $_POST['email'];
    //$new_user->qq = $new_user->test_input($_POST['qq']);
    //$new_user->phone = $new_user->test_input($_POST['phone']);
    //$new_user->email = $new_user->test_input($_POST['email']);
	}	
  }
  $judge = (!empty($new_user->StId)) && (!empty($new_user->StName)) && (!empty($new_user->StPwd)) && 
		(!empty($new_user->qq)||!empty($new_user->phone)||!empty($new_user->email));
	//如果满足填写条件
  if($judge) 
  {
	$if = $new_user->if_exist();
	if($if)
	{
		echo "<script>alert('User Existed');</script>";
	}
	else
	{
		$new_user->Priv = 0;
		$new_user->SoldNum = 0;
		if(empty($new_user->qq)){
			$new_user->qq = '0';
			//echo "1";
		}
		if(empty($new_user->email)){
			$new_user->email = '';
			//echo "2";
		}
		if(empty($new_user->phone)){
			$new_user->phone = '0';
			//echo "3";
		}
		$new_user->insert();
		echo "<script>alert('Register succeed!');</script>";
		exit('<script>top.location.href="index.php"</script>');
	}
	}
}
?>

	    <h1>Register New Account</h1>
		<p><span class="error"><strong>* Required item</strong></span></p>
		<form method="post" action="<?php echo htmlspecialchars('reg.php');?>">
			<table>
				<tr><th>Student ID
				<font style = "font-size:12px">(Your SJTU ID)</font>
				</th><td><input type="text" name="Sid" value="<?php echo $new_user->StId;?>"/>
				<span class="error">* <?php echo $IDErr;?></span></td>
				<tr><th>Student Name</br>
				<font style = "font-size:12px">(Better in the form "Lastname_Firstname")</font>
				
				</th><td><input type="text" name="Sname" value="<?php echo $new_user->StName;?>"/>
				<span class="error">* <?php echo $nameErr;?></span>
				
				<tr><th>Password</th><td><input type="password" name="password" />
				<span class="error">* <?php echo $pwdErr;?></span>

				<tr><th>Password Again</th><td><input type="password" name="password_again" />
				<span class="error">* <?php echo $pwd_againErr;?></span>

				<tr><th>QQ<br />
				<font style = "font-size:12px">(Fill in at lease one among "QQ","Phone" and "Email")</font>
				</th><td><input type="text" name="qq" value="<?php echo $new_user->qq;?>"/>
				<span class="error"><?php echo $ALOErr;?></span>


				<tr><th>Phone</th><td><input type="text" name="phone" value="<?php echo $new_user->phone;?>"/>

				<tr><th>Email</th><td><input type="text" name="email" value="<?php echo $new_user->email;?>"/>
				<span class="error"><?php echo $emailErr;?></span>

			</table>

			<input type="submit" value="Register" class = "button">
		</form>
</body>
</html>