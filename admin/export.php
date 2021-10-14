<?php
session_start();
include("database.php");
if ($_GET['ty'] == 'ch') 
{
	$i=1;
	$query="SELECT * FROM tbl_customer,pay_meth where tbl_customer.Type=pay_meth.b_id and tbl_customer.status='A'";
	if($_GET['Type'] != "ALL") 
	{
		$query=$query." and tbl_customer.Type='".$_GET['Type']."'";
	}
	if($_GET['cust_id'] != "ALL")
	{
		$query=$query." and tbl_customer.custID='".$_GET['cust_id']."'";
	}
	$result = mysqli_query($dbConn, $query);
	$output ='<table border="1">
	<tr><th colspan="8">Customer Details</th></tr>
	<tr></tr>
	<tr>
	<th align = "center">SNO</th>
	<th align = "center">Customer ID</th>
	<th align = "center">Customer Name</th>
	<th align = "center">Customer Phone</th>
	<th align = "center">Customer Address</th>
	<th align = "center">Outstanding</th>
	<th align = "center">Customer Type</th>
	<th align = "center">Created Date</th>
	</tr>';
	while ($excel = mysqli_fetch_assoc($result)) 
	{
		$output.='<tr>
		<td align = "center">'.$i.'</td>
		<td align = "left">'.$excel['custID'].'</td>
		<td align = "left">'.$excel['consignor_name'].'</td>
		<td align = "right">'.$excel['consignor_phone'].'</td>
		<td align = "left">'.$excel['consignor_add'].'</td>
		<td align = "right">'.$excel['bala'].'</td>
		<td align = "left">'.$excel['bname'].'</td>
		<td align = "right">'.$excel['cre_dt'].'</td>
		</tr>';
		$i++;
	}
	$output.='</table>';	
	header('Content-Type:aplication/xls');
	header('Content-Disposition:attachment;filename=customerdetails.xls');
	echo $output;
 } elseif ($_GET['ty'] == 'cd') {
        $qry = mysqli_query($dbConn, "Select * from tbl_customer,cust_trans where tbl_customer.status='A' and tbl_customer.custID=cust_trans.cust_id");
        $title = '<table><tr><td></td><td></td><td></td><td></td><td></td><td></td><td>CUSTOMER PAYMENT DETAILS</td><td></td><td></td></tr></table>';
        $empty = '<table><tr><td></td></tr></table>';
        $table = '<table><tr><td>SNo</td><td>Customer Id</td><td>Customer Name</td><td>GSTIN No</td><td>Phone No.</td><td>Address</td><td>Payments</td><td>Outstanding</td><td>Repayment Date</td></tr>';
        $i = 1;
        while ($res = mysqli_fetch_assoc($qry)) {
            $table .= '<tr><td>' . $i . '</td><td>' . $res['custID'] . '</td><td>' . $res['consignor_name'] . '</td><td>' . $res['consignor_gst'] . '</td><td>' . $res['consignor_phone'] . '</td><td>' . $res['consignor_add'] . '</td><td>' . $res['repaid'] . '</td><td>' . $res['outstanding'] . '</td><td>' . $res['repaydt'] . '</td></tr>';
            $i++;
        }
        $table .= '</table>';
        $file = "customerpaymentdetails.xls";
    }
    elseif ($_GET['ty'] == 'ts') {
        $qry = mysqli_query($dbConn, "Select * from tbl_courier,tbl_courier_track where tbl_courier_track.cons_no=tbl_courier.waybillno and tbl_courier_track.current_city='" . $_SESSION['orgid'] . "'and tbl_courier_track.bk_status='1' and tbl_courier_track.status='A'");
        $title = '<table><tr><td></td><td></td><td></td><td></td><td></td><td>TRIP SHEET</td><td></td><td></td></tr></table>';
        $empty = '<table><tr><td></td></tr></table>';
        $table = '<table><tr><td>SNo</td><td>Waybill No</td><td>Consignor Name</td><td>Consignor Phone No</td><td>Consignor Address</td><td>Consignee Name</td><td>Consignee Phone No</td><td>Consignee Address</td><td>Destination Office</td><td>Qty</td></tr>';
        $i = 1;
        while ($res = mysqli_fetch_assoc($qry)) {
            $dsql = mysqli_fetch_assoc(mysqli_query($dbConn, "Select * from tbl_offices where id='$res[dest_off]' and status='A'"));
            $table .= '<tr><td>' . $i . '</td><td>' . $res['waybillno'] . '</td><td>' . $res['consignor_name'] . '</td><td>' . $res['consignor_phone'] . '</td><td>' . $res['consignor_add'] . '</td><td>' . $res['consignee_name'] . '</td><td>' . $res['consignee_phone'] . '</td><td>' . $res['consignee_add'] . '</td><td>' . $dsql['off_name'] . '</td><td>' . $res['qty'] . '</td></tr>';
            $i++;
        }
        $table .= '</table>';
        $file = "tripsheet.xls";
    }
	?>

