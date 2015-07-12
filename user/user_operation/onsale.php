<?php
session_start();
if($_SESSION["Student_ID"]){
	include('../../class/book.php');
	$onsale=new Book();
	include_once('../../class/booktype.php');
	$book_type=new booktype();
	//$obt=0;									//默认降序
	//$obp=2;									//默认不按照价格排序
	if(isset($_GET["page"]))
	{
		$page=$_GET["page"];
	}
	else{$page=1;}
	if(isset($_GET["obt"]))
	{
		$obt=$_GET["obt"];
	}
	else{$obt=0;;}
	if(isset($_GET["obp"]))
	{
		$obp=$_GET["obp"];
	}
	else{$obp=2;}
	if(isset($_GET["oblan"]))
	{
		$oblan=$_GET["oblan"];
	}
	else{$oblan=3;}
	if(isset($_GET["obloc"]))
	{
		$obloc=$_GET["obloc"];
	}
	else{$obloc=2;}
}
else{
    header("location:../../index.php");
	}
if ($_SERVER["REQUEST_METHOD"] == "POST")	//如果点击了查询
{
	$page=$_GET["page"];
	$obt=$_POST["obt"];
	$obp=$_POST["obp"];
	$oblan=$_POST["oblan"];
	$obloc=$_POST["obloc"];
	$onsale->TypeId = $_POST["type"];
	$choose=$_POST["type"];					//要被显示的，上次提交时被选中的查询条件
	if($_POST["course_id"] == "ALL" || $onsale->TypeId>9)
	{
		$onsale->CourseId = "";
	}
	else
	{
		$onsale->CourseId = $_POST["course_id"];
	}
}
else										//如果未点击查询，第一次登陆后
{
					//第一次登陆，显示第一页
	$choose=0;								//第一次登陆，要被显示的ALL
	$onsale->TypeId = "";
	$onsale->CourseId = "";	
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel = "stylesheet" href = "../../css/main.css" />
</head>
<body>

<h1>On-sale Bulletin</h1>

<form method="post" action="<?php echo htmlspecialchars("onsale.php?page=1 ");?>">
<div align = "center">
Book type:<select name="type">
<option value="0" <? if($choose=="0"){ echo "selected";}?>>ALL</option>
<option value="1" <? if($choose=="1"){ echo "selected";}?>>VE</option>
<option value="2" <? if($choose=="2"){ echo "selected";}?>>VM</option>
<option value="3" <? if($choose=="3"){ echo "selected";}?>>VV</option>
<option value="4" <? if($choose=="4"){ echo "selected";}?>>VP</option>
<option value="5" <? if($choose=="5"){ echo "selected";}?>>VC</option>
<option value="6" <? if($choose=="6"){ echo "selected";}?>>VR</option>
<option value="7" <? if($choose=="7"){ echo "selected";}?>>VG</option>
<option value="8" <? if($choose=="8"){ echo "selected";}?>>VY</option>
<option value="9" <? if($choose=="9"){ echo "selected";}?>>VZ</option>
<option value="10" <? if($choose=="10"){ echo "selected";}?>>TOEFL</option>
<option value="11" <? if($choose=="11"){ echo "selected";}?>>GRE</option>
<option value="12" <? if($choose=="12"){ echo "selected";}?>>考研</option>
<option value="13" <? if($choose=="13"){ echo "selected";}?>>Extra</option>
</select>
&nbsp;
Course number:<input type="text" name = "course_id" value="ALL" selected="selected"/>&nbsp;
Sorted by time:<select name="obt">&nbsp;
<option value="0" selected="selected">latest->earliest</option>
<option value="1" >earliest->latest</option>
<option value="2" >--</option>
</select>&nbsp;
<br /><br />
Sorted by price:<select name="obp">
<option value="0" >High->Low</option>
<option value="1" >Low->High</option>
<option value="2" selected="selected">--</option>
</select>

Sorted by Language:<select name="oblan">
<option value="0" >English</option>
<option value="1" >Chinese</option>
<option value="2" >Others</option>
<option value="3" selected="selected">--</option>
</select>&nbsp;
Sorted by Location:<select name="obloc">
<option value="0" >SJTU</option>
<option value="1" >UM</option>
<option value="2" selected="selected">--</option>
</select>&nbsp;
<br /><br />
</div>
<input align = "right" type="submit" value="Search" class = "button"> 

<?php
$numrows=$onsale->search_number_onsale(0, $obt,$obp,$oblan, $obloc, 0, 0);
//echo "numrows=$numrows";
$pagesize=20;
$numpages=floor($numrows/$pagesize);
if($numrows%$pagesize == 0){}
else{$numpages++;}
$offset=$pagesize*($page-1);
if($numpages == $page)				//有条件查询，到了最后一页
{
	$pagesize=$numrows-$offset;
}
//echo "numpages=$numpages";
//echo "pagesize=$pagesize";
?>

	<br><br>
	Page:<?php
	for($x=1;$x<$page;$x++) 
	{ ?>
	<a href="<?php echo "onsale.php?page=" .$x." &obt=".$obt." & obp=".$obp." & oblan=".$oblan." & obloc=".$obloc." " ?>"><?php echo "[$x]";?></a>
	<?php
	}
	echo "[$page]";
	for($x=$page+1;$x<=$numpages;$x++) 
	{ ?>
	<a href="<?php echo "onsale.php?page=" .$x." &obt=".$obt." & obp=".$obp." & oblan=".$oblan." & obloc=".$obloc." " ?>"><?php echo "[$x]";?></a>
	<?php		
	}
	?>
<table border="1">
<tr>
<th>Type/Course</th>
<th width = "200">Name</th>
<th>Author</th>
<th>Language</th>
<th>Price(RMB)</th>
<th>Location</th>
<th>Detail</th>
</tr>


<?php
$array = $onsale->search_number_onsale(1, $obt,$obp,$oblan, $obloc, $offset,$pagesize);
while($row=mysqli_fetch_array($array)) {
?>
    <tr>	
		<td><?php 
		$book_type->TypeId=$row["Type_ID"];
		$book_type->load_typename();
		echo $book_type->TypeNm.$row["Course_ID"];
		?></td>	
		<td><?php echo $row["Book_Name"]; ?></td>
		<td><?php echo $row["Author"]; ?></td>
		<td><?php echo $row["Language"]; ?></td>
		<td><?php echo $row["Price"]; ?></td>
		<td><?php echo $row["Location"]; ?></td>
		<td><a href="<?php echo "detail.php?book_name=" .$row["Book_Name"]." &student_id=".$row["Student_ID"]." " ?>">Detail</a></td>
    </tr>
	
<?php
}
?>


	
</table>
	<br><br>
	Page:<?php
	for($x=1;$x<$page;$x++) 
	{ ?>
	<a href="<?php echo "onsale.php?page=" .$x." &obt=".$obt." & obp=".$obp." & oblan=".$oblan." & obloc=".$obloc." " ?>"><?php echo "[$x]";?></a>
	<?php
	}
	echo "[$page]";
	for($x=$page+1;$x<=$numpages;$x++) 
	{ ?>
	<a href="<?php echo "onsale.php?page=" .$x." &obt=".$obt." & obp=".$obp." & oblan=".$oblan." & obloc=".$obloc." " ?>"><?php echo "[$x]";?></a>
	<?php		
	}
	?>
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