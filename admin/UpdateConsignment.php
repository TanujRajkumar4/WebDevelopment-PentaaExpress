<?php
session_start();
include("database.php");
if ((isset($_SESSION)) && (isset($_SESSION['uid'])) && isset($_POST["UpdateConsignment"])) {
    $id = $_SESSION['uid'];
    $ConsignmentStatus = $_POST['Book_Status_Update'];
    $SQL = "UPDATE tbl_courier_track SET bk_status = $ConsignmentStatus WHERE cons_no IN ( ";

    $SelectedWayBillNos[] = $_POST['SelectedWayBill'];
    foreach ($SelectedWayBillNos as $WayBillNo) {
        foreach ($WayBillNo as $WayBillNo1) {

            $SQL = $SQL . $WayBillNo1 . " , ";
        }
    }
    $SQL = rtrim($SQL, " , ");
    $SQL = $SQL . " )";
    // echo $SQL;

    $sql = mysqli_query($dbConn, $SQL);
    echo $sql;
    if ($sql) {
        echo "<script>alert('Updated Successfully');window.location.href = 'view-consignment.php';</script>";
    } else {
        echo "<script>alert('Not Updated');window.location.href = 'view-consignment.php';</script>";
    }

?>





<?php } ?>