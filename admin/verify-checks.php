<?php
session_start();
include("database.php");
$key = $_REQUEST['key'];
switch ($key) {
	case 1: {
			$sql = mysqli_query($dbConn, "SELECT * from pincode where status = 'A' and bname='" . $_POST['pin'] . "'");
			if (mysqli_num_rows($sql) >= 1) {
				while ($row = mysqli_fetch_array($sql)) {
					$msg = 1;
				}
			} else {
				$msg = 2;
			}
			echo $msg;
			break;
		}
	case 2: {


			$select = mysqli_query($dbConn, "SELECT * FROM tbl_customer WHERE custID LIKE '%" . $_POST['term'] . "%'");
			$row = mysqli_fetch_array($select);
			// while () 
			// {
			// $data[] = ($row['freight'],$row['waych'],$row['othch'],$row['odach'],$row['topaych']);
			// }
			header('content-type: application/json');
			//return json data
			echo json_encode($row);
			break;
		}

	case 3: {
			$Customer_ID = $_POST['term'];
			$From_City_ID = $_SESSION['uid'];
			$To_City_ID = $_POST['term1'];
			$select = mysqli_query($dbConn, "SELECT * FROM customer_tariff WHERE Cust_ID LIKE '" . $Customer_ID . "' AND Branch_ID = '" . $From_City_ID . "' AND City_ID = '" . $To_City_ID . "'");
			$RowCount = mysqli_num_rows($select);
			if ($RowCount == 0) {
				$select = mysqli_query($dbConn, "SELECT * FROM tariff WHERE branch_id = '" . $From_City_ID . "' AND city_id = '" . $To_City_ID . "'");
				$RowCount1 = mysqli_num_rows($select);
				if ($RowCount1 == 0) {
					header('content-type: application/json');
					//return json data
					$row = array("0.00","0.00","0.00","0.00","0.00","0.00");
					echo json_encode($row);
					break;
				}
			}
			$row = mysqli_fetch_array($select);
			// while () 
			// {
			// $data[] = ($row['freight'],$row['waych'],$row['othch'],$row['odach'],$row['topaych']);
			// }
			header('content-type: application/json');
			//return json data
			echo json_encode($row);
			break;
		}
}
