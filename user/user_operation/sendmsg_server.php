<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Send Message</title>
<link rel = "stylesheet" href = "../../css/main.css">

</head>



<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
		include('../../class/msg.php');
		$new_msg=new Msg();
		$new_msg->Title = $_POST['title'];
	if(empty($_POST['receiver']))
	{
	  echo "<script>alert('Receiver is required!');</script>"; 
	}
	else
	{
	  $new_msg->Receiver = $new_msg->test_input($_POST['receiver']);
	  //echo $new_msg->Receiver;
	  $sql = "SELECT * FROM user WHERE Student_ID = $new_msg->Receiver";
	  $result = $new_msg->conn->query($sql);
	  $row=mysqli_fetch_array($result);
	  //echo "meow1";
	  //echo $row["Student_ID"];
	  //echo "meow2";
	  if(!isset($row)){
		  echo "<script>alert('Receiver does not exist!');</script>";
	  }
	  else{
	  
			if (empty($_POST['title']))
			{
				echo "<script>alert('Title is required!');</script>";
			}
			else
			{
				$new_msg->Title = $new_msg->test_input($_POST['title']);
				if (empty($_POST['content']))
				{
					echo "<script>alert('Content is required!');</script>";
				}
				else
				{
					$new_msg->Content = $new_msg->test_input($_POST['content']);
					
				}
			}
		}
	}
}//空缺检验结束
 
	  
  $judge = (!empty($new_msg->Receiver)) && (!empty($new_msg->Title)) && (!empty($new_msg->Content));
  //echo $judge;
  //echo 'meow';
	//如果没有空缺
  if($judge) 
  {
		//echo 'meow2';
		$new_msg->Sender = $_POST['sender'];
		$new_msg->Receiver = $_POST['receiver'];

		$new_msg->Title = $_POST['title'];
		$new_msg->Content = $_POST['content'];
		if($new_msg->Sender == $new_msg->Receiver)
		{
			echo "Cannot send message to yourself!";
			
		}
		else{
			$result = $new_msg->insert_msg();
			//echo "Send message successfully!";

		}
		/* echo $new_msg->Sender;
		echo $new_msg->Receiver;
		echo $new_msg->Title;
		echo $new_msg->Content; */
	
	

	}
	?>
	
	<input type = "button" value = "Return" onclick = "location.href='mymsg.php'" class = "button"/>
	</body>
	</html>
