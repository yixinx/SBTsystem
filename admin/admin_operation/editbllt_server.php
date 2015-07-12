<?php require_once 'conn.php' ?>

<!DOCTYPE html>

<html>
<body>
<head>
	<meta charset = "UTF-8">
	<title> Edit bulletins </title>
</head>

<?php

$conn = connectDB();
mysqli_query($conn, "SET NAMES 'utf8'");

//$seller = intval($_POST["seller"]);
$seller = $_POST["seller"];
$oldName = $_POST["oldName"];
echo $seller."\n";
echo $oldName."\n";
$csType = $_POST["course_type"];
//transform course_type to Type_ID:
$typeID = 0;
switch($csType) {
	case "VE": $typeID = 1; break;
	case "VM": $typeID = 2; break;
	case "VV": $typeID = 3; break;
	case "VP": $typeID = 4; break;
	case "VC": $typeID = 5; break;
	case "VR": $typeID = 6; break;
	case "VG": $typeID = 7; break;
	case "VY": $typeID = 8; break;
	case "VZ": $typeID = 9; break;
	case "TOEFL": $typeID = 10; break;
	case "GRE": $typeID = 11; break;
	case "Kao Yan": $typeID = 12; break;
	case "Extracurricular": $typeID = 13; break;	
}

echo $typeID."\n";
$csNum = $_POST["course_num"];
echo $csNum."\n";
$book = $_POST["book_name"];
echo $book."\n";
$edition = $_POST["edition"];
echo $edition."\n";
$lang = $_POST["language"];
echo $lang."\n";
$author = $_POST["author"];
echo $author."\n";
$quantity = $_POST["quantity"];
echo $quantity."\n";
$price = $_POST["price"];
echo $price."\n";
$location = $_POST["location"];
echo $location."\n";
$status = $_POST["status"];
echo $status."\n";

$sql = "UPDATE book SET Type_ID = '$typeID', Course_ID='$csNum', Book_Name='$book', Author = '$author', Version = '$edition', Language = '$lang', Quantity = '$quantity', Price = '$price', Location = '$location', Status = '$status' WHERE Student_ID = '$seller' AND Book_Name = '$oldName'";

mysqli_query($conn, $sql);	


header("Location:adminbllt.php");





?>


</body>
</html>