<?php
session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../../index.php");
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../../css/main.css"/>

</head>
<body>
<h1>Post a New Book</h1>
Please fill in the following blanks: (* indicates a required one)<br /><br />
<form method="post" action="<?php echo htmlspecialchars('upload.php');?>" enctype = "multipart/form-data">
<table border="1">
<tr><th>*Book Type:</th><td align = "left">
<select name="type">
<option value="1" >VE</option>
<option value="2" >VM</option>
<option value="3" >VV</option>
<option value="4" >VP</option>
<option value="5" >VC</option>
<option value="6" >VR</option>
<option value="7" >VG</option>
<option value="8" >VY</option>
<option value="9" >VZ</option>
<option value="10" >TOEFL</option>
<option value="11" >GRE</option>
<option value="12" >考研</option>
<option value="13" >Extra</option>
</select></td></tr>

<tr><th>Course ID:</th><td align = "left">
<input type="text" name = "course_id" value = "XXX" selected="selected"/></td></tr>

<tr><th>*Book Name:</th><td align = "left">
<input type="text" name="book_name" /></td></tr>

<tr><th>*Author:</th><td align = "left">
<input type="text" name="author" /></td></tr>

<tr><th>*Language:</th><td align = "left">
<select name="language">
<option value="English" selected="selected">English</option>
<option value="Chinese" >Chinese</option>
<option value="Others" >Others</option>
</select></td></tr>

<tr><th>Version:</th><td align = "left">
<input type="text" name="version"/></td></tr>

<tr><th>*Quantity:</th><td align = "left">
<input type="text" name="quantity" /></td></tr>

<tr><th>*Price(RMB):</th><td align = "left">
<input type="text" name="price" /></td></tr>

<tr><th>*Location:</th><td align = "left">
<select name="location">
<option value="SJTU" selected="selected">SJTU</option>
<option value="UM" >UM</option>
<option value="Others" >Others</option>
</select></td></tr>

<tr><th>Comments:</th><td align = "left">
<textarea name="comments" rows="10" cols="60">
</textarea>
</td></tr>

<tr><th>Picture:</th><td align = "left">
<input type = "file" name = "file" /></td></tr>

</table>
<input type="submit" value="Upload" class = "button"/>
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
		include('../../class/book.php');
		$new_book=new Book();
		$new_book->TypeId = $_POST['type'];
	if($new_book->TypeId<10)
	{
		$new_book->CourseId = $_POST['course_id'];
	}
  if (empty($_POST['book_name']))
  {
    echo "<script>alert('Book name is required!');</script>";
  }
  else
  {
  	$new_book->BookNm = $new_book->test_input($_POST['book_name']);
    if (empty($_POST['author']))
	{
	    echo "<script>alert('Author name is required!');</script>";
	}
	else
	{
		$new_book->Author = $new_book->test_input($_POST['author']);
		if (empty($_POST['quantity']))
		{
			echo "<script>alert('Quantity of your book is required! It cannot be zero!');</script>";	
		}
		else
		{
				$new_book->Quantity = $new_book->test_input($_POST['quantity']);
			if (empty($_POST['price']))
			{
				$new_book->Price = 0;
				if(empty($_POST['location']))
				{
					echo "<script>alert('Location is required!');</script>";
				}
				else{
					$new_book->Location = $new_book->test_input($_POST['location']);
				}				
			}
			else
			{
				$new_book->Price = $new_book->test_input($_POST['price']);
				//echo "a non-zero value is in";
				if(empty($_POST['location']))
				{
					echo "<script>alert('Location is required!');</script>";
				}
				else{
					$new_book->Location = $new_book->test_input($_POST['location']);
				}
			}
		}
	}
  }
}//空缺检验结束
echo isset($_FILES["file"])."filefilefile";
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
      '../../files/bllt_pic/'.$dataNum.$randNum.$_FILES["file"]["name"]);
      echo "Stored in: "."../../files/bllt_pic/".$dataNum.$randNum.$_FILES["file"]["name"];
}

  $judge = (!empty($new_book->BookNm)) && (!empty($new_book->Author)) && (!empty($new_book->Quantity)) && (!empty($new_book->Location));
	//如果没有空缺

  if($judge) 
  {
		$new_book->StId = $_SESSION['Student_ID'];
		$new_book->Language = $_POST['language'];
		$new_book->Version = $_POST['version'];
		$new_book->Comments = $_POST['comments'];
		if(isset($_FILES["file"]) && !empty($_FILES["file"]["name"])){
			$new_book->Filename = $dataNum.$randNum.$_FILES["file"]["name"];
		}
		else{
			$new_book->Filename = '';
		}
		$result = $new_book->insert_newbook();
		if($result){
		echo "<script>alert('Uploading new book succeeds!');</script>";
		}
		else{echo "<script>alert('Uploading new book failed!');</script>";}
	}
?>