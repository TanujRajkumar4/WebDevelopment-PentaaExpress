<?php
session_start();
include("database.php");
if ((isset($_SESSION)) && (isset($_SESSION['uid'])) && isset($_POST["UpdateConsignment"])) {
    $id = $_SESSION['uid'];
    $ConsignmentStatus = $_POST['Book_Status_Update'];
    $SQL = "UPDATE tbl_courier_track SET bk_status = $ConsignmentStatus WHERE cons_no IN ( ";
    $SQL1 = "UPDATE tbl_courier_track SET current_city = $id WHERE cons_no IN ( ";

    $SelectedWayBillNos[] = $_POST['SelectedWayBill'];
    foreach ($SelectedWayBillNos as $WayBillNo) {
        foreach ($WayBillNo as $WayBillNo1) {

            $SQL = $SQL . $WayBillNo1 . " , ";
            $SQL1 = $SQL1 . $WayBillNo1 . " , ";
        }
    }
    $SQL = rtrim($SQL, " , ");
    $SQL1 = rtrim($SQL1, " , ");
    $SQL = $SQL . " )";
    $SQL1 = $SQL1 . " )";
    // echo $SQL;

    $sql = mysqli_query($dbConn, $SQL);
    $sql1 = mysqli_query($dbConn, $SQL1);
    echo $sql;
    echo $sql1;
    if ($sql && $sql1) {
        echo "<script>alert('Updated Successfully');window.location.href = 'view-consignment.php';</script>";
    } else {
        echo "<script>alert('NOT Updated');window.location.href = 'view-consignment.php';</script>";
    }

?>





<?php } ?>