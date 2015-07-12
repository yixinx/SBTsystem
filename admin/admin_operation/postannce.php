<?php
session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../../index.php");
}
?>

<?php require_once 'conn.php' ?>

<html>
<head>
	<meta charset = "UTF-8">
	<link rel="stylesheet" href="../../css/main.css"/>
<title>Post Announcement</title>
<!--<script type="text/javascript">
function addimg(){
 //包含所有文件域的DIV
 var div = document.getElementById('imgs');
 //文件域
 var input = document.createElement("input");
 input.name = "img[]";
 input.type = 'file';

 //添加
 div.appendChild(input);
 //删除按钮
 var button = document.createElement("a");
 button.href = "javascript:;";
 button.innerHTML = '删除';
 div.appendChild(button);
 //换行
 var br = document.createElement("br");
 div.appendChild(br);
 //在按钮上增加删除的事件
 button.onclick = function(){
  input.parentNode.removeChild(input);
  this.parentNode.removeChild(this);
  br.parentNode.removeChild(br);
 }

}
</script>-->

</head>



<body>
<h1>Post Announcement</h1>

<form method="post" action="<?php echo htmlspecialchars('postannce.php');?>" enctype = "multipart/form-data">
Title:
<input type="text" name = "title" size = "60" /><br />
<br />
Content:
<br />

<textarea name="content" rows = "20" cols = "80"/>
</textarea>
<br />
<input type="hidden" name="publisher" value = <?php echo $_SESSION["Student_ID"]?> />
<br />
Upload Attachment:
<!--<div id="imgs">
<input type="file" name="img[]"/><br/>
</div>
<input type="button" onclick="addimg()" value="增加"/>

<a class = "file"><input type = "file" name = "file" /></a><br />-->
<input type = "file" name = "file" id = "file"/>
<br /><br />
<input type="submit" value="Post Announcement" class = "button"/>

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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
		include('../../class/annce.php');
		$new_annce=new Annce();
		$new_annce->Title = $_POST['title'];

  if (empty($_POST['title']))
  {
    echo "<script>alert('Title is required!');</script>";
  }
  else
  {
  	$new_annce->Title = $new_annce->test_input($_POST['title']);
    if (empty($_POST['content']))
	{
	    echo "<script>alert('Content is required!');</script>";
	}
	else
	{
		$new_annce->Content = $new_annce->test_input($_POST['content']);
		
	}
  }
}//空缺检验结束
//文件处理	
	
if(isset($_FILES["file"]) && !empty($_FILES["file"]["name"])){
	
/* 	  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	  echo "Type: " . $_FILES["file"]["type"] . "<br />";
	  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	  echo "Stored in: " . $_FILES["file"]["tmp_name"]; */
	$randNum = rand(100,999);
	$dataNum = date('YmdHis');
	$_FILES["file"]["name"] = str_replace(' ','_',$_FILES["file"]["name"]);
/* 	if (file_exists("../../files/annce_attach/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      { */
      move_uploaded_file($_FILES["file"]["tmp_name"],
      '../../files/annce_attach/'.$dataNum.$randNum.$_FILES["file"]["name"]);
      echo "Stored in: "."../../files/annce_attach/".$dataNum.$randNum.$_FILES["file"]["name"];
      //}
}	  
	  
  $judge = (!empty($new_annce->Title)) && (!empty($new_annce->Content));
	//如果没有空缺
  if($judge) 
  {
		$new_annce->St_ID = $_POST['publisher'];

		$new_annce->Title = $_POST['title'];
		$new_annce->Content = $_POST['content'];
		if(isset($_FILES["file"]) && !empty($_FILES["file"]["name"])){
			$new_annce->Filename = $dataNum.$randNum.$_FILES["file"]["name"];
		}
		else{
			$new_annce->Filename = '';
		}
 		//echo $_SESSION["Student_ID"];
		//echo $new_annce->St_ID;
		//echo $new_annce->Title;
		//echo $new_annce->Content; 
		$result = $new_annce->insert_annce();
		if($result){
		echo "<script>alert('Posting new announcement succeeds!');</script>";
		}
		else{echo "<script>alert('Posting new announcement failed!');</script>";}
	}
	
?>