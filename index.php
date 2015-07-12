<?php
	/* php Jaccount */
/*require_once('./jaccount/clsJAccount.php');
session_start();//启动session 
function hex2bin($HexStr) {
	return pack('H*',$HexStr);
}

$jam=new JAccountManager('jaji20150623','./jaccount');
$strReturnURL='/user/user_main.php';

$ht = $jam->checkLogin($strReturnURL);
if (($ht !=NULL) && ($jam->hasTicketInURL)) {
	$jam->redirectWithoutTicket();
}

$DisplayForm=false;
if (isset($_POST['Random_iv']) && ($_POST['Random_iv']=='343243abdecf3a7e')) {
	$src=$_POST["Name"].'@'.$_POST["Domain"];
	$encrypted=$jam->encrypt($src);
	$decrypt_d=$jam->decrypt(urldecode($encrypted));
}else{
	$DisplayForm=true;
}*/

/* php Jaccount end */

	include('class/user.php');
	$log_user=new Users();
if(!isset($_SESSION['Student_ID']))
{
    if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$log_user->StId = $log_user->test_input($_POST['log_id']);
		$log_user->StPwd = sha1($log_user->test_input($_POST['log_pwd']));
		
		if (empty($_POST['log_id']))
		{
			{
				echo "<script>alert('Please input username');</script>";
			}
		}
		else
		{
			if(empty($_POST['log_pwd']))
			{
				echo "<script>alert('Please input password');</script>";
			}
			else
			{
				if($log_user->verify())
				{
				echo "<script>alert('Login Success!');</script>";
					session_start();
				    $_SESSION['Student_ID']=$log_user->StId;
					//echo $_SESSION['Student_ID'];
					$result = $log_user->load_privilege();
					if (!$result)
					{
						$url = 'user/user_main.php';
						header('Location: '.$url);
					}
					else
					{
						$url = 'admin/admin_main.php';
						header('Location: '.$url);
					}					
				}
				else 
				{
					echo "<script>alert('Wrong Username or Password')</script>";
				}
			}
		}
	}
}//end of isset
else
{//如果用户已经登录，则直接跳转到已经登录页面
    $home_url = 'user/user_main.php';
    header('Location: '.$home_url);
	
	
}  
?>
<html>
<head>
	<meta charset = "UTF-8">
	<link rel="stylesheet" href="css/main.css"/>
</head>
<body>
	<img src = "images/logo.gif" height = "120px">
     <center>
	 <h2 font style = "font-size:32px;">Second-hand Book Trading System</h2>
	 <br />
	 <br />
	 <iframe  frameborder = "0" src="login.php" width="450px" height="280ox">

	</iframe>
	 </center>
	 
<div id = "footer">
<br />
<br />
<br />
<br />
<br />
<h6 align = "center">Copyright &copy; 2015 Yixin Xue and Yanrong Li. All rights reserved.</h6>
</div>
	<!--Jaccount test-->
	 <td><a href="http://202.120.46.152/jaccountauth?jatkt=">Jaccount Login</a></td>

</body>
</html>