<?php
session_start();
if($_SESSION["Student_ID"]){
}else{
    header("location:../../index.php");
}
	include('../../class/book.php');
	include('../../class/user.php');
	$user = new Users();
	$update_book=new Book();
	$user->StId = $_SESSION['Student_ID'];
	$update_book->StId = $_SESSION['Student_ID'];
	$update_book->BookNm=$_GET["book_name"];
	$result=$update_book->load_one_book();
	$row=mysqli_fetch_array($result);	
	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  if (empty($_POST['name']) || empty($_POST['author']) || empty($_POST['quantity']) || empty($_POST['language'])) 
  {
		echo "<script>alert('Please complete all information (comment is not required)!');</script>";		
  } 
  else 
  {
    $update_book->BookNm = $update_book->test_input($_POST['name']);
    $update_book->Author = $update_book->test_input($_POST['author']);
    $update_book->Quantity = $update_book->test_input($_POST['quantity']);
    $update_book->Language = $update_book->test_input($_POST['language']);
    $update_book->Version = $update_book->test_input($_POST['version']);
	if(empty($_POST['price'])){
		$update_book->Price = 0;
	}
	else{
		$update_book->Price = $update_book->test_input($_POST['price']);
	}
	$update_book->Location = $update_book->test_input($_POST['location']);
    $update_book->Comments = $update_book->test_input($_POST['comments']);
	//$update_book->Filename = $update_book->test_input($_POST['filename']);
	$update_book->Status = $update_book->test_input($_POST['status']);
	$update_book->update($row["Book_Name"]);
	if($update_book->Status == 1)
	{
		$user->increase_soldNum();
	}
		echo "<script>alert('Information is updated!');</script>";	
	?>
		<meta http-equiv="refresh" content="0; url=<?php echo "mybook.php"; ?>">
<?php
  }
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" href = "../../css/main.css" />
</head>
<body>
<h1>Edit My Book</h1>

<form method="post" action="<?php echo htmlspecialchars("edit.php?book_name=" .$row["Book_Name"]."");?>">
<table border="1">
<tr><th width = 150px>Book Name</th><td align = "left"><input type="text" name="name" size = "80" value="<?php echo $row["Book_Name"]?>" selected = "selected"></td></tr>
<tr><th>Author</th><td align = "left"><input type="text" name="author" size = "80" value="<?php echo $row["Author"]?>" selected = "selected"></td></tr>
<tr><th>Quantity</th><td align = "left"><input type="text" name="quantity" size = "80" value="<?php echo $row["Quantity"]?>" selected = "selected"></td></tr>
<tr><th>Language</th><td align = "left">
	<select name="language" value = "<?php echo $row["Language"]; ?>" >
	<option value="Chinese" <?php if($row["Language"] == "Chinese") {echo "selected";} ?>>Chinese</option>
	<option value="English" <?php if($row["Language"] == "English") {echo "selected";} ?>>English</option>
	<option value="Others" <?php if($row["Language"] == "Others") {echo "selected";} ?>>Others</option>
	</select></td></tr>
<tr><th>Version</th><td align = "left"><input type="text" name="version" size = "80" value="<?php echo $row["Version"]?>" selected = "selected"></td></tr>
<tr><th>Price(RMB)</th><td align = "left"><input type="text" name="price" size = "80" value="<?php echo $row["Price"]?>" selected = "selected"></td></tr>
<tr><th>Location</th><td align = "left">
	<select name="location" value = "<?php echo $row["Location"]; ?>" >
	<option value="SJTU" <?php if($row["Location"] == "SJTU") {echo "selected";} ?>>SJTU</option>
	<option value="UM" <?php if($row["Location"] == "UM") {echo "selected";} ?>>UM</option>
	<option value="Others" <?php if($row["Location"] == "Others") {echo "selected";} ?>>Others</option>
	</select></td></tr>
<tr><th>Comments</th><td align = "left"><textarea name="comments" rows = "10" cols = "80"><?php echo $row["Comments"]?></textarea><td></tr>
	

<tr><th>Status</th><td align = "left"><input type="radio" name="status" value=0 checked="checked">On-sale <input type="radio" name="status" value=1>Sold</td></tr>
</table>
<br />
Attachments:
	<a href = <?php echo '../../files/bllt_pic/'.$row['File_Name']; ?>> <?php echo $row['File_Name']; ?>  </a>
<br /><br />
<input type="submit" value="Save" class = "button">&nbsp;

</form>
<input type="button" value="Return" onclick="location.href='mybook.php'" class = "button">

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
