<?php


$tbl_name="counter"; // Table name 

include("db_connect.php");
//mysqli_select_db($con,"$db_name")or die("cannot select DB");

$sql="SELECT * FROM $tbl_name";
$result=mysqli_query($con,$sql);
$rows=mysqli_fetch_array($result);
$counter=$rows['counter'];

// if have no counter value set counter = 1
if(empty($counter)){
$counter=1;
$sql1="INSERT INTO $tbl_name(counter) VALUES('$counter')";
$result1=mysql_query($sql1);
}
echo "visitors : ";
echo $counter;

// count more value
$addcounter=$counter+1;
$sql2="update $tbl_name set counter='$addcounter'";
$result2=mysqli_query($con,$sql2);

mysqli_close($con);
?>