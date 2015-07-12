<?php require_once 'conn.php' ?>

<!DOCTYPE html>

<html>
<body>
<head>
	<meta charset = "UTF-8">
	<title> Edit bulletins </title>
	<link rel="stylesheet" href="../../css/main.css"/>
</head>
<h1>Edit Bulletin</h1>
<?php

$conn = connectDB();
mysqli_query($conn, "SET NAMES 'utf8'");

if(empty($_GET['seller']))
{
	echo "Error: seller's id is not received.";
}
else
{
	//echo "meow";
	$seller = $_REQUEST['seller']; //?????????????????????????????why can't I use intval?????????????
	$book = $_REQUEST['book'];
	echo "Seller: ".$seller;

	//echo $book;
	$sql = "SELECT * FROM book WHERE Student_ID = $seller AND Book_Name = '$book'"; // 注意$book是字符串所以要加''!!!!!
	$result = mysqli_query($conn, $sql);
/* 	if(mysqli_errno($conn)){
		die('cannot connect to mysql');	
	} */
	//echo $result;
	$arr = mysqli_fetch_assoc($result);
	
	$csType = $arr['Type_ID'];	
	$sql2 = "SELECT * FROM book_type WHERE Type_ID = $csType";
	$result2 = mysqli_query($conn, $sql2);
	$arr2 = mysqli_fetch_assoc($result2);
	$csLetter = $arr2['Type_Name'];
	
	$csNum = $arr['Course_ID'];
	$book = $arr['Book_Name'];
	$author = $arr['Author'];
	$language = $arr['Language'];
	$quantity = $arr['Quantity'];
	$price = $arr['Price'];
	$edition = $arr['Version'];
	$status = $arr['Status'];
	$location = $arr['Location'];
	$comments = $arr['Comments'];
	$filename = $arr['File_Name'];
	$time = $arr['Upload_Instant'];
	$datetime = strtotime($arr['Upload_Instant']);

	
}


?>
<br /><br />
<?php echo "Upload time: ".date('Y-M-d H:m:s', $datetime); ?>


<form action = "editbllt_server.php?seller=$seller" method = "post">

	<input type = "hidden" name = "seller" value = "<?php echo $seller; ?>">
	<input type = "hidden" name = "oldName" value = "<?php echo $book; ?>">
	</div>
	<br />
	<div>Course Type:
		<select name = "course_type" value = "<?php echo $csType; ?>">
		<option value = "VE" <?php if($csLetter == "VE") echo "selected"; else echo 0;?>>VE</option>;
		<option value = "VP" <?php if($csLetter == "VP") echo "selected"; else echo 0;?>>VP</option>;
		<option value = "VC" <?php if($csLetter == "VC") echo "selected"; else echo 0;?>>VC</option>;
		<option value = "VV" <?php if($csLetter == "VV") echo "selected"; else echo 0;?>>VV</option>;
		<option value = "VM" <?php if($csLetter == "VM") echo "selected"; else echo 0;?>>VM</option>;
		<option value = "VG" <?php if($csLetter == "VG") echo "selected"; else echo 0;?>>VG</option>;
		<option value = "VR" <?php if($csLetter == "VR") echo "selected"; else echo 0;?>>VR</option>;
		<option value = "VY" <?php if($csLetter == "VY") echo "selected"; else echo 0;?>>VY</option>;
		<option value = "VZ" <?php if($csLetter == "VZ") echo "selected"; else echo 0;?>>VZ</option>;
		<option value = "GRE" <?php if($csLetter == "GRE") echo "selected"; else echo 0;?>>GRE</option>;
		<option value = "TOEFL" <?php if($csLetter == "TOEFL") echo "selected"; else echo 0;?>>TOEFL</option>;
		<option value = "考研" <?php if($csLetter == "考研") echo "selected"; else echo 0;?>>考研</option>;
		<option value = "Extracurricular" <?php if($csLetter == "Extra") echo "selected"; else echo 0;?>>Extracurricular</option>;
		</select>
		
	</div>
	<br />
	<div>Course Number:
		<input type = "text" name = "course_num" value = "<?php echo $csNum; ?>">
	</div>
	<br />
	<div>Book Name:
		<input type = "text" name = "book_name" value = "<?php echo $book; ?>">
	</div>
	<br />
	<div>Edition:
		<input type = "text" name = "edition" value = "<?php echo $edition; ?>">
	</div>
	<br />
	<div>Author:
		<input type = "text" name = "author" value = "<?php echo $author; ?>">
	</div>
	<br />
	<div>Language: 
	<select name="language" value = "<?php echo $language; ?>" >
	<option value="Chinese" <?php if($language == "Chinese") {echo "selected";} ?>>Chinese</option>
	<option value="English" <?php if($language == "English") {echo "selected";} ?>>English</option>
	<option value="Others" <?php if($language == "Others") {echo "selected";} ?>>Others</option>
	</select>
	</div>
	<br />
	<div>Quantity:
		<input type = "text" name = "quantity" value = "<?php echo $quantity; ?>">
	</div>
	<br />
	<div>Price:
		<input type = "text" name = "price" value = "<?php echo $price; ?>">
	</div>
	<br />
	<div>Location:
	<select name="location" value = "<?php echo $location; ?>" >
	<option value="SJTU" <?php if($location == "SJTU") {echo "selected";} ?>>SJTU</option>
	<option value="UM" <?php if($location == "UM") {echo "selected";} ?>>UM</option>
	<option value="Others" <?php if($location == "Others") {echo "selected";} ?>>Others</option>
	</select>
	</div>
	<br />
	<div>Status:
		<input type = "radio" name = "status" value = "0" checked = "checked">On sale
		<input type = "radio" name = "status" value = "1">Sold
	</div>
	<br />
	
	<input type = "submit" value = "Submit" class = "button">
	&nbsp;

</form>
<br />
<input type = "button" value = "Return" onclick = "location.href = 'adminbllt.php'" class = "button">
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