<?php
session_start();
include("database.php");
if ($_GET['ty'] == 'ch') {
	$i = 1;
	$query = "SELECT * FROM tbl_customer,pay_meth where tbl_customer.Type=pay_meth.b_id and tbl_customer.status='A'";
	if ($_GET['Type'] != "ALL") {
		$query = $query . " and tbl_customer.Type='" . $_GET['Type'] . "'";
	}
	if ($_GET['cust_id'] != "ALL") {
		$query = $query . " and tbl_customer.custID='" . $_GET['cust_id'] . "'";
	}
	$result = mysqli_query($dbConn, $query);
	$output = '<table border="1">
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
	while ($excel = mysqli_fetch_assoc($result)) {
		$output .= '<tr>
		<td align = "center">' . $i . '</td>
		<td align = "left">' . $excel['custID'] . '</td>
		<td align = "left">' . $excel['consignor_name'] . '</td>
		<td align = "right">' . $excel['consignor_phone'] . '</td>
		<td align = "left">' . $excel['consignor_add'] . '</td>
		<td align = "right">' . $excel['bala'] . '</td>
		<td align = "left">' . $excel['bname'] . '</td>
		<td align = "right">' . $excel['cre_dt'] . '</td>
		</tr>';
		$i++;
	}
	$output .= '</table>';
	$t_dy = date("d-m-Y");
	$filename = 'Customer-Details-As-On ' . $t_dy . '.xls';
	header('Content-Type:aplication/xls');
	header('Content-Disposition:attachment;filename=' . $filename);
	echo $output;
} elseif ($_GET['ty'] == 'vc') {
	$i = 1;
	if ($_SESSION['uid'] == 10) {
		$query = "SELECT * from tbl_courier,book_status where tbl_courier.book_status=book_status.b_id and tbl_courier.status='A' ORDER BY tbl_courier.book_date ASC";
	} else {
		$query = "SELECT * from tbl_courier,book_status where tbl_courier.book_status=book_status.b_id and tbl_courier.status='A' AND (tbl_courier.dest_off=$_SESSION[uid] OR tbl_courier.org_off=$_SESSION[uid]) ORDER BY tbl_courier.book_date ASC";
	}
	$result = mysqli_query($dbConn, $query);
	$output = '<table border="1">
	<tr><th colspan="6">Consignment Details</th></tr>
	<tr></tr>
	<tr>
		<th>SNo</th>
		<th>Waybill No</th>
		<th>Status</th>
		<th>Consignors Details</th>
		<th>Consignees Details</th>
		<th>Destination Office</th>
	</tr>';

	while ($excel = mysqli_fetch_assoc($result)) {
		$dsql = mysqli_fetch_array(mysqli_query($dbConn, "Select * from tbl_offices where id='" . $excel['dest_off'] . "' and status='A'"));
		$output .= '<tr>
		<td align = "center">' . $i . '</td>
		<td align = "right">' . strval($excel['waybillno']) . '</td>
		<td align = "left">' . $excel['bname'] . '</td>
		<td align = "left">' . $excel['consignor_name'] . ", " . $excel['consignor_phone'] . "," . $excel['consignor_add'] . '</td>
		<td align = "left">' . $excel['consignor_name'] . ", " . $excel['consignor_phone'] . "," . $excel['consignor_add'] . '</td>
		<td align = "left">' . $dsql['off_name'] . '</td>
		</tr>';
		$i++;
	}
	$output .= '</table>';
	$t_dy = date("d-m-Y");
	$filename = 'Consignment-Details-As-On ' . $t_dy . '.xls';
	header('Content-Type:aplication/xls');
	header('Content-Disposition:attachment;filename=' . $filename);
	echo $output;
} elseif ($_GET['ty'] == 'ts') {
	$i = 1;
	$query = "Select * from tbl_courier,tbl_courier_track where tbl_courier_track.cons_no=tbl_courier.waybillno and tbl_courier_track.current_city='" . $_SESSION['orgid'] . "'and tbl_courier_track.bk_status='1' and tbl_courier_track.status='A' ORDER BY tbl_courier.book_date ASC";
	$result = mysqli_query($dbConn, $query);
	$output = '<table border="1">
	<tr><th colspan="6">Consignment Details</th></tr>
	<tr></tr>
	<tr>
		<th>SNo</th>
		<th>Waybill No</th>
		<th>Consignors Details</th>
		<th>Consignees Details</th>
		<th>Destination Office</th>
		<th>Quantity</th>
	</tr>';

	while ($excel = mysqli_fetch_assoc($result)) {
		$dsql = mysqli_fetch_array(mysqli_query($dbConn, "Select * from tbl_offices where id='" . $excel['dest_off'] . "' and status='A'"));
		$output .= '<tr>
		<td align = "center">' . $i . '</td>
		<td align = "right">' . strval($excel['waybillno']) . '</td>
		<td align = "left">' . $excel['consignor_name'] . ", " . $excel['consignor_phone'] . "," . $excel['consignor_add'] . '</td>
		<td align = "left">' . $excel['consignor_name'] . ", " . $excel['consignor_phone'] . "," . $excel['consignor_add'] . '</td>
		<td align = "left">' . $dsql['off_name'] . '</td>
		<td align = "left">' . $excel['qty'] . '</td>
		</tr>';
		$i++;
	}
	$output .= '</table>';
	$t_dy = date("d-m-Y");
	$filename = 'Trip-Sheet-As-On ' . $t_dy . '.xls';
	header('Content-Type:aplication/xls');
	header('Content-Disposition:attachment;filename=' . $filename);
	echo $output;
}
