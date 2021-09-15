<?php
session_start();
include("database.php");
$key=$_REQUEST['key'];
switch($key)
{
case 1:
{
$sql=mysqli_query($dbConn,"select * from pincode where status = 'A' and bname='".$_POST['pin']."'");
if(mysqli_num_rows($sql) >= 1)
{
while($row = mysqli_fetch_array($sql))
{
$msg=1; 
}
}
else
{
	$msg=2;
}
echo $msg;
break;
}
case 2:
{
	
$select =mysqli_query($dbConn,"SELECT * FROM tbl_customer WHERE custID LIKE '%".$_POST['term']."%'");
$row=mysqli_fetch_array($select);
// while () 
// {
 // $data[] = ($row['freight'],$row['waych'],$row['othch'],$row['odach'],$row['topaych']);
// }
header('content-type: application/json');
//return json data
echo json_encode($row);
}
}
?>
