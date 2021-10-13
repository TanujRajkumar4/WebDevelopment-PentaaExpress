<?php 
include("database.php");
$qry = mysqli_query($dbConn, "SELECT * from tbl_customer where status='A'");
$title='<table><tr><td></td><td></td><td></td><td></td><td></td><td></td><td>Customer Table</td><td></td><td></td></tr></table>';
$empty='<table><tr><td></td></tr></table>';
$table = '<table><tr><td>SNo</td><td>Customer Name</td><td>GSTIN No</td><td>Phone No.</td><td>Address</td><td>Kg Rate</td><td>Box Rate</td><td>Waybill Charges</td><td>Insurance Charges</td><td>Other Charges</td><td>ODA Charges</td><td>Topay Charges</td><td>Created Date</td></tr>';
$i = 1;
while ($res = mysqli_fetch_assoc($qry)) {
    $table.= '<tr><td>'.$i.'</td><td>'.$res['consignor_name'].'</td><td>'.$res['consignor_gst'].'</td><td>'.$res['consignor_phone'].'</td><td>'.$res['consignor_add'].'</td><td>'.$res['freight'].'</td><td>'.$res['boxrate'].'</td><td>'.$res['waych'].'</td><td>'.$res['insch'].'</td><td>'.$res['othch'].'</td><td>'.$res['odach'].'</td><td>'.$res['topaych'].'</td><td>'.$res['cre_dt'].'</td></tr>';
    $i++;
}
$table.='</table>';
$file = "customerdetails.xls";
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename($file));
echo $title;
echo $empty;
echo $table;

