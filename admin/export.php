<?php
include("database.php");
session_start();

    if ($_GET['ty'] == 'ch') {
        $qry = mysqli_query($dbConn, "SELECT * from tbl_customer where status='A'");
        $title = '<table><tr><td></td><td></td><td></td><td></td><td></td><td></td><td>CUSTOMER DETAILS</td><td></td><td></td></tr></table>';
        $empty = '<table><tr><td></td></tr></table>';
        $table = '<table><tr><td>SNo</td><td>Customer Name</td><td>GSTIN No</td><td>Phone No.</td><td>Address</td><td>Kg Rate</td><td>Box Rate</td><td>Waybill Charges</td><td>Insurance Charges</td><td>Other Charges</td><td>ODA Charges</td><td>Topay Charges</td><td>Created Date</td></tr>';
        $i = 1;
        while ($res = mysqli_fetch_assoc($qry)) {
            $table .= '<tr><td>' . $i . '</td><td>' . $res['consignor_name'] . '</td><td>' . $res['consignor_gst'] . '</td><td>' . $res['consignor_phone'] . '</td><td>' . $res['consignor_add'] . '</td><td>' . $res['freight'] . '</td><td>' . $res['boxrate'] . '</td><td>' . $res['waych'] . '</td><td>' . $res['insch'] . '</td><td>' . $res['othch'] . '</td><td>' . $res['odach'] . '</td><td>' . $res['topaych'] . '</td><td>' . $res['cre_dt'] . '</td></tr>';
            $i++;
        }
        $table .= '</table>';
        $file = "customerdetails.xls";
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
        $title = '<table><tr><td></td><td></td><td></td><td></td><td></td><td></td><td>TRIP SHEET</td><td></td><td></td></tr></table>';
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
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    echo $title;
    echo $empty;
    echo $table;

