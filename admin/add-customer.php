<?php
session_start();
include("database.php");
if ((isset($_SESSION)) && (isset($_SESSION['uid']))) {
	$id = $_SESSION['uid'];
	$user_type = $_SESSION['type'];

	if (isset($_GET['ty'])) {
		if ($_GET['ty'] == 'add') {


			$mobile = "";
			$title = "Add Customer";
			if (isset($_POST['search'])) {
				if ($_POST['mobile'] != "") {
					$mobile = " AND consignor_phone ='" . $_POST['mobile'] . "' OR custID='" . $_POST['mobile'] . "'";
				}
			}
			if (isset($_POST['export_data'])) {
				// --------------------------------------------------------------------------- start export excel --------------------------------------------------------------------------------
				//error_reporting (E_ALL ^ E_NOTICE); 
				require_once("excelwriter.class.php");
				$rec = array();
				$excel = new ExcelWriter("customerdetails.xls");
				if ($excel == false)
					echo $excel->error;
				$myArr = array("");
				$myArr = array("CUSTOMER DETAILS");
				$excel->writeLine($myArr);
				$myArr = array("");
				$excel->writeLine($myArr);
				$myArr = array("SNo", "Customer Name", "GSTIN No", "Phone No.", "Address", "Kg Rate", "Box Rate", "Waybill Charges", "Insurance Charges", "Other Charges", "ODA Charges", "Topay Charges", "Created Date");
				$excel->writeLine($myArr);
				//echo "SELECT * from classified inner join district $condition";
				$qry = mysqli_query($dbConn, "SELECT * from tbl_customer where status='A'");


				if ($qry != false) {
					$i = 1;
					while ($res = mysqli_fetch_array($qry)) {

						$myArr = array($i, $res['consignor_name'], $res['consignor_gst'], $res['consignor_phone'], $res['consignor_add'], $res['freight'], $res['boxrate'], $res['waych'], $res['insch'], $res['othch'], $res['odach'], $res['topaych'], $res['cre_dt']);
						array_push($rec, $myArr);
						$excel->writeLine($myArr);
						$i++;
					}
				}
				$file = "customerdetails.xls";
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=' . basename($file));
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				ob_clean();
				flush();
				readfile($file);
			}
		} elseif ($_GET['ty'] == 'edit') {
			$title = "Edit Customer";
			$Cust_ID = $_GET['editid'];
		} elseif ($_GET['ty'] == 'repay') {
			$title = "Customer Repayments";
		}

		if (isset($_GET['ac'])) {
			if ($_GET['ac'] == "ins") {
				$today = date("Y-m-d");

				// ADD NEW CUSTOMER INTO TBL_CUSTOMER
				$qry = "INSERT INTO `tbl_customer`(`cid`,`custID`,`consignor_name`, `consignor_gst`, `consignor_phone`, `consignor_add`, `freight`,`boxrate`, `waych`,`insch`, `othch`, `odach`, `topaych`,`bala`,`cre_dt`,`status`,`Type`,`User_Access`) VALUES (NULL,'" . $_POST['custID'] . "','" . $_POST['consignor'] . "','" . $_POST['gstincon'] . "','" . $_POST['phone'] . "','" . $_POST['cusAddrs'] . "','" . $_POST['freight'] . "','" . $_POST['boxrate'] . "','" . $_POST['waybillch'] . "','" . $_POST['insurch'] . "','" . $_POST['otherch'] . "','" . $_POST['oda'] . "','" . $_POST['topay'] . "','','" . $today . "','A','" . $_POST['Cust_Type'] .  "','" . $user_type . "')";
				$sql = mysqli_query($dbConn, $qry);
				echo $qry;

				if ($sql) {
					echo "<script>alert('Inserted Successfully');window.location.href = 'add-customer.php?ty=$_GET[ty]';</script>";
				} else {
					echo "<script>alert('Not Inserted');</script>";
				}
				// window.location.href = 'add-customer.php?ty=$_GET[ty]';
			}
			if ($_GET['ac'] == "upd") {
				$sql = mysqli_query($dbConn, "UPDATE `tbl_customer` SET `custID`='" . $_POST['custID'] . "',`consignor_name`='" . $_POST['consignor'] . "',`Type`='" . $_POST['Cust_Type_Edit'] . "',`consignor_gst`='" . $_POST['gstincon'] . "', `consignor_phone`='" . $_POST['phone'] . "',`consignor_add`='" . $_POST['cusAddrs'] . "',`freight`='" . $_POST['freight'] . "',`boxrate`='" . $_POST['boxrate'] . "', `waych`='" . $_POST['waybillch'] . "',`insch`='" . $_POST['insurch'] . "', `othch`='" . $_POST['otherch'] . "', `odach`='" . $_POST['oda'] . "',`topaych`='" . $_POST['topay'] . "' WHERE `cid`='" . $_GET['editid'] . "' and `status`='A'");

				// $sql = mysqli_query($dbConn, "UPDATE 'tbl_customer' SET 'custID'='" . $_POST['custID'] . "','consignor_name'='" . $_POST['consignor'] . "','consignor_gst'='" . $_POST['gstincon'] . "', 'consignor_phone'='" . $_POST['phone'] . "','consignor_add'='" . $_POST['cusAddrs'] . "','freight'='" . $_POST['freight'] . "','boxrate'='" . $_POST['boxrate'] . "', 'waych'='" . $_POST['waybillch'] . "','insch'='" . $_POST['insurch'] . "', 'othch'='" . $_POST['otherch'] . "', 'odach'='" . $_POST['oda'] . "','topaych'='" . $_POST['topay'] . "' WHERE 'cid'='" . $_GET['editid'] . "' and 'status'='A'");
				echo $sql;
				if ($sql) {
					echo "<script>alert('Updated Successfully');window.location.href = 'add-customer.php?ty=add';</script>";
				} else {
					echo "<script>alert('Not Updated');window.location.href = 'add-customer.php?ty=add';</script>";
				}
			}
			if ($_GET['ac'] == "repay") {
				$today = date("Y-m-d");
				// $ins = mysqli_query($dbConn, "INSERT INTO 'cust_trans'('tid', 'cust_id', 'repaid', 'outstanding', 'repaydt', 'status') VALUES (NULL,'" . $_POST['custID'] . "','" . $_POST['payment'] . "','" . $_POST['balance'] . "','" . $today . "','A')");
				// // echo $ins;
				// if ($ins) {
				// 	$sql = mysqli_query($dbConn, "UPDATE 'tbl_customer' SET 'bala'='" . $_POST['balance'] . "' WHERE 'custID'='" . $_POST['custID'] . "' and 'cid'='" . $_GET['editid'] . "' and 'status'='A'");

				// 	if ($sql) {
				// 		echo "<script>alert('Updated Successfully');window.location.href = 'add-customer.php?ty=add';</script>";
				// 	} else {
				// 		echo "<script>alert('Not Updated');window.location.href = 'add-customer.php?ty=add';</script>";
				// 	}
				// } else {
				// 	echo "<script>alert('Not Inserted ".$ins." ');window.location.href = 'add-customer.php?ty=add';</script>";
				// }

				$CustDetails = mysqli_fetch_array(mysqli_query($dbConn, "SELECT * FROM tbl_customer WHERE custID = '" . $_GET['editid'] . "'  AND Status = 'A' "));

				$Tran_Upd_SQL = "INSERT INTO `tbl_transactions` (`Tran_ID`, `Tran_Date`, `Cust_ID`, `Branch_ID`, `Pay_Meth_ID`, `Tran_Type`, `Tran_Remarks`, `Tran_Amt`, `Status`) VALUES (NULL, '$today', '$_GET[editid]', '$_SESSION[uid]', '$CustDetails[Type]', 'Dr', 'Credit Repayment', '$_POST[payment]', 'A')";

				$ins = mysqli_query($dbConn, $Tran_Upd_SQL);
				if ($ins) {
					echo "<script>alert('Updated Successfully');window.location.href = 'add-customer.php?ty=add';</script>";
				} else {
					echo "<script>alert('Transaction NOT Updated');window.location.href = 'add-customer.php?ty=add';</script>";
				}
			}
		}


		if ($_GET['ty'] == 'del') {

			$sql = "DELETE FROM tbl_customer WHERE cid='" . $_GET['delid'] . "'";

			if (mysqli_query($dbConn, $sql)) {

				echo "<script>alert('Record Deleted Successfully');

				window.location.href = 'add-customer.php?ty=add';</script>";
			} else {

				echo "<script>alert('Error in Deleting the record');

				window.location.href = 'add-customer.php?ty=add';</script>";
			}
		}
?>
		<!DOCTYPE html>
		<html lang="en">

		<head>
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
			<meta charset="utf-8" />
			<title>Customer - Admin</title>

			<meta name="description" content="overview &amp; stats" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

			<!-- bootstrap & fontawesome -->
			<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
			<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

			<!-- page specific plugin styles -->

			<!-- text fonts -->
			<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

			<!-- ace styles -->
			<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

			<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
			<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
			<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

			<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

			<!-- inline styles related to this page -->

			<!-- ace settings handler -->
			<script src="assets/js/ace-extra.min.js"></script>
			<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css" />

			<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

			<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		</head>

		<body class="skin-3">

			<div id="navbar" class="navbar navbar-default          ace-save-state">
				<div class="navbar-container ace-save-state" id="navbar-container">
					<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
						<span class="sr-only">Toggle sidebar</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>
					</button>

					<div class="navbar-header pull-left">
						<a href="index.html" class="navbar-brand">
							<small>
								<i class="fa fa-leaf"></i>
								PENTA LOGISTICS (XPRESS CARGO)- Admin
							</small>
						</a>
					</div>

					<div class="navbar-buttons navbar-header pull-right" role="navigation">
						<ul class="nav ace-nav">
							<li class="light-blue dropdown-modal">
								<a data-toggle="dropdown" href="#" class="dropdown-toggle">
									<img class="nav-user-photo" src="assets/images/avatars/user.jpg" alt="Jason's Photo" />
									<span class="user-info">
										<small>Welcome,</small>
										<?php echo $_SESSION['username']; ?>
									</span>

									<i class="ace-icon fa fa-caret-down"></i>
								</a>

								<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
									<li>
										<a href="changepwd.php">
											<i class="ace-icon fa fa-cog"></i>
											Change Password
										</a>
									</li>
									<li>
										<a href="logout.php">
											<i class="ace-icon fa fa-power-off"></i>
											Logout
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div><!-- /.navbar-container -->
			</div>

			<div class="main-container ace-save-state" id="main-container">
				<script type="text/javascript">
					try {
						ace.settings.loadState('main-container')
					} catch (e) {}
				</script>

				<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
					<script type="text/javascript">
						try {
							ace.settings.loadState('sidebar')
						} catch (e) {}
					</script>

					<!-- /.sidebar-shortcuts -->
					<?php
					include("sidebar.php");
					?>
					<!-- /.nav-list -->

					<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
						<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
					</div>
				</div>

				<div class="main-content">
					<div class="main-content-inner">
						<div class="breadcrumbs ace-save-state" id="breadcrumbs">
							<ul class="breadcrumb">
								<li>
									<i class="ace-icon fa fa-home home-icon"></i>
									<a href="dashboard.php">Home</a>
								</li>
								<li class="active">Customer</li>
							</ul><!-- /.breadcrumb -->

							<!-- /.nav-search -->
						</div>
						<!-- BEGINNING OF TYPE ADD CUSTOMER -->
						<?php
						if ($_GET['ty'] == "add") {
						?> <div class="page-content">
								<!-- /.ace-settings-container -->
								<div class="page-header">
									<h1>
										<?php echo 'Customer'; ?>
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
											<?php echo 'Add'; ?>
										</small>
									</h1>
								</div><!-- /.page-header -->

								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->
										<div class="widget-box">
											<div class="widget-header widget-header-blue widget-header-flat">
												<h4 class="widget-title lighter">Customer Details</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<div>
														<div class="step-content pos-rel">
															<div class="step-pane active">
																<h3 class="lighter block green">Consignor's Details</h3>

																<form class="form-horizontal" method="POST" action="add-customer.php?ac=ins&ty=<?php echo $_GET['ty']; ?>">
																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="custID">Customer Id:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<input type="text" name="custID" id="custID" class="col-xs-12 col-sm-6" placeholder="Ex:PLX123456" required />
																			</div>
																		</div>
																	</div>
																	<div class="space-2"></div>
																	<!-- CUSTOMER TYPE DROP DOWN LIST START-->
																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="custID">Customer Type:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<!-- <input type="text" name="custID" id="custID" class="col-xs-12 col-sm-6" placeholder="Ex:PLX123456" /> -->
																				<select class="col-xs-12 col-sm-3" id="Cust_Type" name="Cust_Type" required>
																					<?php
																					if ($user_type == "Branch") {
																						$sqltoi = mysqli_query($dbConn, "SELECT * FROM pay_meth WHERE status= 'A' AND User_Access = 'Branch'");
																					} else {
																						$sqltoi = mysqli_query($dbConn, "SELECT * FROM pay_meth WHERE status= 'A'");
																					}
																					while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																					?>
																						<option value="<?php echo $rwtoi['b_id']; ?>">
																							<?php echo $rwtoi['bname']; ?>
																						</option>
																					<?php
																					}
																					?>
																				</select>
																			</div>
																		</div>
																	</div>
																	<div class="space-2"></div>
																	<!-- CUSTOMER TYPE DROP DOWN LIST END-->


																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consignor">Customer's Name:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<input type="text" name="consignor" id="consignor" class="col-xs-12 col-sm-6" required />
																			</div>
																		</div>
																	</div>

																	<div class="space-2"></div>

																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="gstincon">GSTTIN Number:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">

																				<input type="text" id="gstincon" name="gstincon" class="col-xs-12 col-sm-6" />
																			</div>
																		</div>
																	</div>

																	<div class="space-2"></div>

																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="phone">Phone Number:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="input-group">
																				<span class="input-group-addon">
																					<i class="ace-icon fa fa-phone"></i>
																				</span>

																				<input type="tel" id="phone" name="phone" required />
																			</div>
																		</div>
																	</div>

																	<div class="space-2"></div>

																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="cusAddrs">Address:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<textarea class="input-xlarge" name="cusAddrs" id="cusAddrs" required></textarea>
																			</div>
																		</div>
																	</div>

																	<!-- 
																	<h3 class="lighter block green">Charges Details</h3>
																	<div class="hr hr-dotted"></div>

																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="freight">Kg Rate:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<input type="number" name="freight" id="freight" class="col-xs-12 col-sm-5 " value="0.00" required />
																			</div>
																		</div>
																	</div>

																	<div class="space-2"></div>

																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="otherch">Box Rate:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<input type="number" name="boxrate" id="boxrate" class="col-xs-12 col-sm-5 " value="0.00" required />
																			</div>
																		</div>
																	</div>
																	<div class="space-2"></div>

																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="otherch">Waybill Charges:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<input type="number" name="waybillch" id="waybillch" class="col-xs-12 col-sm-5 " value="0.00" />
																			</div>
																		</div>
																	</div>
																	<div class="space-2"></div>

																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="otherch">Insurance Charges:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<input type="number" name="insurch" id="insurch" class="col-xs-12 col-sm-5 " value="0.00" />
																			</div>
																		</div>
																	</div>
																	<div class="space-2"></div>

																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="otherch">Other Charges:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<input type="number" name="otherch" id="otherch" class="col-xs-12 col-sm-5 " value="0.00" />
																			</div>
																		</div>
																	</div>


																	<div class="space-2"></div>

																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="oda">ODA Charges:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<input type="number" name="oda" id="oda" class="col-xs-12 col-sm-5 " value="0.00" />
																			</div>
																		</div>
																	</div>


																	<div class="space-2"></div>

																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="topay">To Pay Charges:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<input type="number" name="topay" id="topay" class="col-xs-12 col-sm-5 " value="0.00" />
																			</div>
																		</div>
																	</div> -->

																	<div>
																		<button class="btn btn-success btn-next" type="Submit">
																			Submit

																		</button>
																		<button class="btn btn-prev">

																			Clear
																		</button>


																	</div>
																</form>
															</div>

														</div>


													</div>

												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<h3 class="lighter block green" id="CD">Customer Details</h3>
										<div class="hr hr-dotted"></div>
										<?php
										$exportdt = "";
										$exportdt .= "<div class='row'>";
										$exportdt .= "<div class='col-xs-12'>";
										$exportdt .= "<table id='dynamic-table' class='table table-striped table-bordered table-hover'>";
										$exportdt .= "<thead>";
										$exportdt .= "<tr><th>SNo</th>
													<th>Customer ID</th>
													<th>Customer Name</th>
													<th>Type</th>
													<!--<th>GSTIN No.</th>-->
													<th>Phone No.</th>
													<th>Address</th>

													<!-- <th>Kg Rate</th>
													<th>Box Rate</th>
													<th>Waybill Charges</th>
													<th>Insurance Charges</th>
													<th>Other Charges</th>
													<th>ODA Charges</th>
													<th>Topay Charges</th> -->

													<th>Created Date</th>
													<th>Outstanding Amount</th>

													<th class='hidden-480'>Action</th>
													</tr>
											</thead>

											<tbody>
											<tr>";
										$i = 0;
										$msql = mysqli_query($dbConn, "SELECT * FROM tbl_customer where status='A' $mobile ");
										$Cust_Count = mysqli_num_rows($msql);
										$results_per_page = 15;
										$number_of_page = ceil($Cust_Count / $results_per_page);

										// PAGINATION - START
										if (!isset($_GET['page'])) {
											$page = 1;
										} else {
											$page = $_GET['page'];
										}
										$results_per_page = 15;
										if (isset($_POST['Cust_Type_Edit'])) {
											$Cust_Type = $_POST['Cust_Type_Edit'];
										} else {
											$msql = mysqli_query($dbConn, "SELECT * FROM tbl_customer where status='A' $mobile ");
											$Cust_Count = mysqli_num_rows($msql);
											$page_first_result = ($page - 1) * $results_per_page;
											$msql = mysqli_query($dbConn, "SELECT * from tbl_customer where status='A' $mobile LIMIT " . $page_first_result . ',' . $results_per_page);
											$number_of_page = ceil($Cust_Count / $results_per_page);
										}
										// PAGINATION - END


										//START OF WHILE - CUSTOMER DETAILS
										while ($row = mysqli_fetch_array($msql)) {
											$i = $i + 1;
											$exportdt .= "	<td class='center'>  $i</td>";
											$exportdt .= "<td>" . $row['custID'] . "</td>";
											$exportdt .= "<td>" . $row['consignor_name'] . "</td>";
											$Query = "SELECT * from pay_meth where status='A'AND b_id = " . $row['Type'];
											$msql1 = mysqli_query($dbConn, $Query);
											$row1 = mysqli_fetch_array($msql1);

											$exportdt .= "<td>" . $row1['bname']  . "</td>";
											// $exportdt .= "<td>" . $row['consignor_gst'] . "</td>";
											$exportdt .= "<td>" . $row['consignor_phone'] . "</td>";
											$exportdt .= "<td>" . $row['consignor_add'] . "</td>";

											// $exportdt .= "<td>" . $row['freight'] . "</td>";
											// $exportdt .= "<td>" . $row['boxrate'] . "</td>";
											// $exportdt .= "<td>" . $row['waych'] . "</td>";
											// $exportdt .= "<td>" . $row['insch'] . "</td>";
											// $exportdt .= "<td>" . $row['othch'] . "</td>";
											// $exportdt .= "<td>" . $row['odach'] . "</td>";
											// $exportdt .= "<td>" . $row['topaych'] . "</td>";

											$exportdt .= "<td>" . $row['cre_dt'] . "</td>";

											$SQL = "SELECT `Cust_ID`, SUM(`Tran_Amt`) AS Amount FROM tbl_transactions WHERE `Cust_ID` = '" . $row['custID'] . "'";
											$Tran_Sum = mysqli_fetch_array(mysqli_query($dbConn, $SQL));
											$Tran_Amt_Sum = $Tran_Sum['Amount'];
											if ($Tran_Amt_Sum == NULL) {
												$Tran_Amt_Sum = 0;
											}
											$exportdt .= "<td> Rs. " . $Tran_Amt_Sum . "/-</td>";

											//START of IF - BRANCH ACCESS											
											if ($user_type == "Branch") {
												$exportdt .= "<td class='hidden-480'>";

												$exportdt .= "
													 <a href='add-customer.php?ty=edit&editid=$row[0]'><span class='btn btn-sm btn-primary bigger-110'><i class='ace-icon fa fa-pencil bigger-110'></i>Edit</span></a>";

												if ($Tran_Amt_Sum < 0) {
													$exportdt .= " 
													 <!-- Customer Pending Payment - Repayment Button -->
													 <a href='add-customer.php?ty=repay&editid=$row[0]'><span class='btn btn-sm btn-primary bigger-110'><i class='ace-icon fa fa-credit-card bigger-110'></i>Repay</span></a>";
												}
												$exportdt .= "
													 </td>
													</tr>";
											} //END of IF - BRANCH ACCESS
											else { //START of ELSE - HO ACCESS
												$exportdt .= "<td class='hidden-480'>";

												$exportdt .= "
													<a href='add-customer.php?ty=edit&editid=$row[0]'><span class='w-15 btn btn-sm btn-primary bigger-110 '><i class='ace-icon fa fa-pencil bigger-110'></i>Edit</span></a>";
												if ($Tran_Amt_Sum < 0) {
													$exportdt .= "
													<a href='add-customer.php?ty=repay&editid=$row[1]'><span class='w-15 btn btn-sm btn-primary bigger-110'><i class='ace-icon fa fa-credit-card bigger-110'></i>Repay</span></a>";
												}
												$exportdt .= "
													<a href='customer_tariff.php?ty=add&cid=$row[1]'><span class='w-15 btn btn-sm btn-primary bigger-110'><i class='ace-icon fa fa-credit-card bigger-110'></i>Tariff</span></a>";

												$exportdt .= "
													<a id='Delete_Customer_Btn' href='add-customer.php?ty=del&delid=$row[0]'><span class='w-15 btn btn-sm btn-danger bigger-110'><i class='ace-icon fa fa-trash-o  bigger-110'></i>Delete</span></a>";

												$exportdt .= "
													</td>
													</tr>";
											} //END of ELSE - HO ACCESS


										} //END OF WHILE - CUSTOMER DETAILS

										$exportdt .= '</tbody>
											


										</table>
									</div><!-- /.span -->
								</div><!-- /.row -->';

										?>

										<form class="form-horizontal" method="POST" action="add-customer.php?ty=add">

											<div class="form-group">
												<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="mobile">Customer Id:</label>
												<div class="col-xs-12 col-sm-9">
													<div class="clearfix">
														<input type="text" name="mobile" id="mobile" class="col-xs-12 col-sm-4 " />

														<div class="col-xs-12 col-sm-5">
															<div class="clearfix">
																<button class="btn btn-success btn-next" type="Submit" name="search" id="search">Search</button>
																<button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-info">Export to excel</button>
																<!-- CUSTOMER DETAILS FILTERING BASED ON TYPE FORM -->
																<form id="CustomerTypeFiltering" method="POST" action="add-customer.php?ty=add">
																	<div class="form-group">
																		<label class="control-label" for="custID">Customer Type:</label>

																		<!-- <div class="col-xs-12 col-sm-9"> -->
																		<!-- <div class="clearfix"> -->

																		<select class="" id="Cust_Type_Edit" name="Cust_Type_Edit" onchange="document.getElementById('CustomerTypeFiltering').submit();">
																			<?php

																			$sqltoi = mysqli_query($dbConn, "SELECT * FROM pay_meth WHERE status= 'A'");

																			?>
																			<option value="All">All</option>
																			<?php
																			while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																			?>
																				<option value="<?php echo $rwtoi['b_id']; ?>"><?php echo $rwtoi['bname']; ?></option>
																			<?php
																			}
																			?>
																		</select>
																		<!-- </div>
																		</div> -->
																	</div>
																</form>
															</div>
														</div>

													</div>
												</div>
												<div class="">

												</div>
											</div>

										</form>


										<!-- PAGE CONTENT BEGINS

								<div class="row">
									<div class="col-xs-12">
										<table id="dynamic-table" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>													
													<th>SNo</th>
													<th>Customer Id</th>
													<th>Customer Name</th>
													<th>GSTIN No.</th>
													<th>Phone No.</th>
													<th>Address</th>
													<th>Freight Charges</th>
													<th>Waybill Charges</th>
													<th>Insurance Charges</th>
													<th>Other Charges</th>
													<th>ODA Charges</th>
													<th>Topay Charges</th>
													<th>Created Date</th>
													<th class="hidden-480">Action</th>
												</tr>
											</thead>

											<tbody>
											<tr>
											<?php
											$i = 0;
											$msql = mysqli_query($dbConn, "Select * from tbl_customer where status='A' $mobile");
											while ($row = mysqli_fetch_array($msql)) {
											?>
													<td class="center"> <?php echo $i = $i + 1; ?></td>
													<td><a href="#"><?php echo $row['custID']; ?></a></td>
													<td><a href="#"><?php echo $row['consignor_name']; ?></a></td>
													<td><a href="#"><?php echo $row['consignor_gst']; ?></a></td>
													<td><a href="#"><?php echo $row['consignor_phone']; ?></a></td>
													<td><a href="#"><?php echo $row['consignor_add']; ?></a></td>
													<td><a href="#"><?php echo $row['freight'];  ?></a></td>
													<td><a href="#"><?php echo $row['waych'];  ?></a></td>
													<td><a href="#"><?php echo $row['insch'];  ?></a></td>
													<td><a href="#"><?php echo $row['othch'];  ?></a></td>
													<td><a href="#"><?php echo $row['odach'];  ?></a></td>
													<td><a href="#"><?php echo $row['topaych'];  ?></a></td>
													<td><a href="#"><?php echo $row['cre_dt'];  ?></a></td>
													<td class="hidden-480">
													<a href="add-customer.php?ty=edit&editid=<?php echo $row[0]; ?>">
														<span class="btn btn-sm btn-primary bigger-110"><i class="ace-icon fa fa-pencil bigger-110"></i>Edit</span></a>
													<a href="add-customer.php?ty=repay&editid=<?php echo $row[0]; ?>">
													<span class="btn btn-sm btn-primary bigger-110"><i class="ace-icon fa fa-credit-card bigger-110"></i>Repay</span></a>
													<a href="add-customer.php?ty=del&delid=<?php echo $row[0]; ?>">
														<span class="btn btn-sm btn-danger bigger-110"><i class="ace-icon fa fa-trash-o  bigger-110"></i>Delete</span></a>
													
													</td>
													
																										
												</tr>
												<?php
											}

												?>
											</tbody>
										</table>
									</div><!-- /.span 
								</div><!-- /.row -->
										<?php echo $exportdt; ?>

										<div class="modal-footer no-margin-top">
											<!-- <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Close
												</button> -->



											<ul class="pagination pull-right no-margin">
												<li class="prev disabled">
													<a href="#">
														<i class="ace-icon fa fa-angle-double-left"></i>
													</a>
												</li>
												<?php for ($page = 1; $page <= $number_of_page; $page++) { ?>
													<li id="<?php echo 'PageNo' . $page; ?>">
														<?php echo '<a onclick="SetActivePage(' . $page . '); SetActivePage(' . $page . ');" href = "add-customer.php?ty=add&page=' . $page . '#CD' . '">' . $page . ' </a>'; ?>
													</li>

												<?php } ?>
												<script>
													function SetActivePage(page) {

														for (var i = 0; i < 3; i++) {
															var PageNum = "PageNo" + page;
															document.getElementById(PageNum).className = "active";

														}


													}
												</script>

												<li class="next">
													<a href="#">
														<i class="ace-icon fa fa-angle-double-right"></i>
													</a>
												</li>
											</ul>
										</div>

									</div>
								</div>
							</div>
							<!-- END OF TYPE ADD CUSTOMER -->
						<?php
						}
						?>

						<?php
						if (isset($_GET['ty'])) {
							if ($_GET['ty'] == "repay") {
								$sqlms = "SELECT `Cust_ID`, SUM(`Tran_Amt`) AS Amount FROM tbl_transactions WHERE `Cust_ID` = '" . $_GET['editid'] . "' AND Status = 'A'";
								$sqlms = mysqli_query($dbConn, $sqlms);
								// $sqlms = mysqli_query($dbConn, "Select * from tbl_customer where cid = '" . $_GET['editid'] . "'");
								$rowms = mysqli_fetch_array($sqlms);
								$CustDetails = mysqli_fetch_array(mysqli_query($dbConn, "SELECT * FROM tbl_customer WHERE custID = '" . $_GET['editid'] . "'  AND Status = 'A' "));
						?> <div class="page-content">
									<!-- /.ace-settings-container -->
									<div class="page-header">
										<h1>
											Repayment Section
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $title; ?>
											</small>
										</h1>
									</div><!-- /.page-header -->

									<div class="row">
										<div class="col-xs-12">
											<!-- PAGE CONTENT BEGINS -->
											<form class="form-horizontal" method="POST" action="add-customer.php?ac=repay&ty=repay&editid=<?php echo $_GET['editid']; ?>">
												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="custID">Customer Id:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="text" name="custID" id="custID" class="col-xs-12 col-sm-6" value="<?php echo $rowms['Cust_ID']; ?>" readonly />
														</div>
													</div>
												</div>

												<div class="space-2"></div>
												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consignor">Customer Name:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="text" name="consignor" id="consignor" class="col-xs-12 col-sm-6" value="<?php echo $CustDetails['consignor_name']; ?>" readonly />
														</div>
													</div>
												</div>

												<div class="space-2"></div>
												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="outstanding">Current Outstanding:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="text" name="outstanding" id="outstanding" class="col-xs-12 col-sm-6" value="<?php echo $rowms['Amount']; ?>" readonly />
														</div>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="payment">Payment:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="number" name="payment" id="payment" class="col-xs-12 col-sm-5 " value="0.00" />
														</div>
													</div>
												</div>
												<div class="space-2"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="balance">Balance:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="number" name="balance" id="balance" class="col-xs-12 col-sm-5 " value="0.00" />
														</div>
													</div>
												</div>
												<div>
													<button class="btn btn-success btn-next" type="Submit"> Submit</button> <button class="btn btn-prev">Clear</button>
												</div>
											</form>
										</div>
									</div>

								</div>
						<?php
							}
						}
						?>
						<?php
						if (isset($_GET['ty'])) {
							// EDIT DETAILS OF CUSTOMER - START
							if ($_GET['ty'] == "edit") {
								$sqlms = mysqli_query($dbConn, "Select * from tbl_customer where cid = '" . $_GET['editid'] . "'");
								$rowms = mysqli_fetch_array($sqlms);
						?> <div class="page-content">
									<!-- /.ace-settings-container -->
									<div class="page-header">
										<h1>
											Edit Section
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $title; 
												$CustDetails1 = mysqli_fetch_array(mysqli_query($dbConn, "SELECT * FROM pay_meth WHERE b_id = '" . $rowms['Type'] . "'  AND Status = 'A' "));
												?>
											</small>
										</h1>
									</div><!-- /.page-header -->

									<div class="row">
										<div class="col-xs-12">
											<!-- PAGE CONTENT BEGINS -->
											<form class="form-horizontal" method="POST" action="add-customer.php?ac=upd&ty=edit&editid=<?php echo $_GET['editid']; ?>">
												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="custID">Customer Id:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="text" name="custID" id="custID" class="col-xs-12 col-sm-6" value="<?php echo $rowms['custID']; ?>" />
														</div>
													</div>
												</div>
												<div class="space-2"></div>
												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consignor">Consignor's Name:</label>
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="text" name="consignor" id="consignor" class="col-xs-12 col-sm-6" value="<?php echo $rowms['consignor_name']; ?>" />
														</div>
													</div>
												</div>

												<!-- CUSTOMER TYPE DROP DOWN LIST START-->
												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="custID">Customer Type:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<!-- <input type="text" name="custID" id="custID" class="col-xs-12 col-sm-6" placeholder="Ex:PLX123456" /> -->
															<select class="col-xs-12 col-sm-3" id="Cust_Type_Edit" name="Cust_Type_Edit">
																<?php
																if ($user_type == "Branch") {
																	$sqltoi = mysqli_query($dbConn, "SELECT * FROM pay_meth WHERE status= 'A' AND User_Access = 'Branch'");
																} else {
																	$sqltoi = mysqli_query($dbConn, "SELECT * FROM pay_meth WHERE status= 'A'");
																}
																?>
																<option value="<?php echo $rowms['Type']; ?>"><?php echo $CustDetails1['bname']; ?></option>
																<?php
																while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																?>
																	<option value="<?php echo $rwtoi['b_id']; ?>"><?php echo $rwtoi['bname']; ?></option>
																<?php
																}
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="space-2"></div>
												<!-- CUSTOMER TYPE DROP DOWN LIST END-->

												<div class="space-2"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="gstincon">GSTTIN Number:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">

															<input type="text" id="gstincon" name="gstincon" class="col-xs-12 col-sm-6" value="<?php echo $rowms['consignor_gst']; ?>" />
														</div>
													</div>
												</div>

												<div class="space-2"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="phone">Phone Number:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="ace-icon fa fa-phone"></i>
															</span>

															<input type="tel" id="phone" name="phone" value="<?php echo $rowms['consignor_phone']; ?>" />
														</div>
													</div>
												</div>

												<div class="space-2"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="cusAddrs">Address:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<textarea class="input-xlarge" name="cusAddrs" id="cusAddrs"><?php echo $rowms['consignor_add']; ?></textarea>
														</div>
													</div>
												</div>

												<!-- <h3 class="lighter block green">Charges Details</h3>
												<div class="hr hr-dotted"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="freight">Kg Rate:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="number" name="freight" id="freight" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['freight']; ?>" required />
														</div>
													</div>
												</div>
												<div class="space-2"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="waybillch">Box Rate:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="number" name="boxrate" id="boxrate" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['boxrate']; ?>" required />
														</div>
													</div>
												</div>
												<div class="space-2"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="waybillch">Waybill Charges:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="number" name="waybillch" id="waybillch" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['waych']; ?>" />
														</div>
													</div>
												</div>
												<div class="space-2"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="waybillch">Insurance Charges:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="number" name="insurch" id="insurch" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['insch']; ?>" />
														</div>
													</div>
												</div>
												<div class="space-2"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="otherch">Other Charges:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="number" name="otherch" id="otherch" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['othch']; ?>" />
														</div>
													</div>
												</div>


												<div class="space-2"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="oda">ODA Charges:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="number" name="oda" id="oda" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['odach']; ?>" />
														</div>
													</div>
												</div>


												<div class="space-2"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="topay">To Pay Charges:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="number" name="topay" id="topay" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['topaych']; ?>" />
														</div>
													</div>
												</div> -->

												<div>
													<button class="btn btn-success btn-next" type="Submit">
														Submit

													</button>
													<button class="btn btn-prev">

														Clear
													</button>
												</div>
											</form>
										</div>
									</div>

								</div>
						<?php
							}
						}
						//  EDIT CUSTOMER DETAILS - END
						?>
					</div>
				</div>

				<div class="footer">
					<div class="footer-inner">
						<div class="footer-content">
							<span class="bigger-120">
								<span class="blue bolder">PENTA LOGISTICS (XPRESS CARGO)</span>
								&copy; <?php echo date('Y'); ?> Shakthisoftsolutions
							</span>

							&nbsp; &nbsp;

						</div>
					</div>
				</div>

				<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
					<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
				</a>
			</div><!-- /.main-container -->

			<!-- basic scripts -->

			<!--[if !IE]> -->
			<script src="assets/js/jquery-2.1.4.min.js"></script>

			<!-- <![endif]-->

			<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
			<script type="text/javascript">
				if ('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
			</script>
			<script src="assets/js/bootstrap.min.js"></script>

			<!-- page specific plugin scripts -->
			<script src="assets/js/wizard.min.js"></script>
			<script src="assets/js/jquery.validate.min.js"></script>
			<script src="assets/js/jquery-additional-methods.min.js"></script>
			<script src="assets/js/bootbox.js"></script>
			<script src="assets/js/jquery.maskedinput.min.js"></script>
			<script src="assets/js/select2.min.js"></script>
			<script src="assets/js/moment.min.js"></script>
			<script src="assets/js/daterangepicker.min.js"></script>
			<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
			<script src="master/assets/js/daterangepicker.min.js"></script>
			<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

			<!-- ace scripts -->
			<script src="assets/js/ace-elements.min.js"></script>
			<script src="assets/js/ace.min.js"></script>
			<script type="text/javascript">
				jQuery(function($) {

					$('[data-rel=tooltip]').tooltip();

					$('.select2').css('width', '200px').select2({
							allowClear: true
						})
						.on('change', function() {
							$(this).closest('form').validate().element($(this));
						});


					var $validation = false;
					// $('#fuelux-wizard-container')
					// .ace_wizard({
					// //step: 2 //optional argument. wizard will jump to step "2" at first
					// //buttons: '.wizard-actions:eq(0)'
					// })
					// .on('actionclicked.fu.wizard' , function(e, info){
					// if(info.step == 1 && $validation) {
					// if(!$('#validation-form').valid()) e.preventDefault();
					// }
					// })
					// //.on('changed.fu.wizard', function() {
					// //})
					// .on('finished.fu.wizard', function(e) {
					// bootbox.dialog({
					// message: "Thank you! Your information was successfully saved!", 
					// buttons: {
					// "success" : {
					// "label" : "OK",
					// "className" : "btn-sm btn-primary"
					// }
					// }
					// });
					// }).on('stepclick.fu.wizard', function(e){
					// //e.preventDefault();//this will prevent clicking and selecting steps
					// });

					$(document).on("change", "#payment", function() {
						calTot();
					});

					function calTot() {
						var sgst = 0;
						var subtot = 0.0;
						var tot = 0.0;
						sgst = $("#payment").val();
						subtot = $("#outstanding").val();
						tot = parseFloat(subtot) + parseFloat(sgst);
						$('#balance').val(tot.toFixed(2));
					}

					//jump to a step
					/**
					var wizard = $('#fuelux-wizard-container').data('fu.wizard')
					wizard.currentStep = 3;
					wizard.setState();
					*/

					//determine selected step
					//wizard.selectedItem().step
					if (!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
						format: 'DD/MM/YYYY h:mm:ss A', //use this option to display seconds
						icons: {
							time: 'fa fa-clock-o',
							date: 'fa fa-calendar',
							up: 'fa fa-chevron-up',
							down: 'fa fa-chevron-down',
							previous: 'fa fa-chevron-left',
							next: 'fa fa-chevron-right',
							today: 'fa fa-arrows ',
							clear: 'fa fa-trash',
							close: 'fa fa-times'
						}
					}).next().on(ace.click_event, function() {
						$(this).prev().focus();
					});




					//hide or show the other form which requires validation
					//this is for demo only, you usullay want just one form in your application
					$('#skip-validation').removeAttr('checked').on('click', function() {
						$validation = this.checked;
						if (this.checked) {
							$('#sample-form').hide();
							$('#validation-form').removeClass('hide');
						} else {
							$('#validation-form').addClass('hide');
							$('#sample-form').show();
						}
					})



					//documentation : http://docs.jquery.com/Plugins/Validation/validate


					$.mask.definitions['~'] = '[+-]';
					$('#phone').mask('999 999 9999');

					jQuery.validator.addMethod("phone", function(value, element) {
						return this.optional(element) || /^\d{3}\ \d{3}\ \d{4}( x\d{1,6})?$/.test(value);
					}, "Enter a valid phone number.");

					$('#validation-form').validate({
						errorElement: 'div',
						errorClass: 'help-block',
						focusInvalid: false,
						ignore: "",
						rules: {
							email: {
								required: true,
								email: true
							},
							password: {
								required: true,
								minlength: 5
							},
							password2: {
								required: true,
								minlength: 5,
								equalTo: "#password"
							},
							name: {
								required: true
							},
							phone: {
								required: true,
								phone: 'required'
							},
							url: {
								required: true,
								url: true
							},
							comment: {
								required: true
							},
							state: {
								required: true
							},
							platform: {
								required: true
							},
							subscription: {
								required: true
							},
							gender: {
								required: true,
							},
							agree: {
								required: true,
							}
						},

						messages: {
							email: {
								required: "Please provide a valid email.",
								email: "Please provide a valid email."
							},
							password: {
								required: "Please specify a password.",
								minlength: "Please specify a secure password."
							},
							state: "Please choose state",
							subscription: "Please choose at least one option",
							gender: "Please choose weight choice",
							agree: "Please accept our policy"
						},


						highlight: function(e) {
							$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
						},

						success: function(e) {
							$(e).closest('.form-group').removeClass('has-error'); //.addClass('has-info');
							$(e).remove();
						},

						errorPlacement: function(error, element) {
							if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
								var controls = element.closest('div[class*="col-"]');
								if (controls.find(':checkbox,:radio').length > 1) controls.append(error);
								else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
							} else if (element.is('.select2')) {
								error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
							} else if (element.is('.chosen-select')) {
								error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
							} else error.insertAfter(element.parent());
						},

						submitHandler: function(form) {},
						invalidHandler: function(form) {}
					});




					$('#modal-wizard-container').ace_wizard();
					$('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');


					/**
					$('#date').datepicker({autoclose:true}).on('changeDate', function(ev) {
						$(this).closest('form').validate().element($(this));
					});
					
					$('#mychosen').chosen().on('change', function(ev) {
						$(this).closest('form').validate().element($(this));
					});
					*/


					$(document).one('ajaxloadstart.page', function(e) {
						//in ajax mode, remove remaining elements before leaving page
						$('[class*=select2]').remove();
						$('.bootstrap-datetimepicker-widget.dropdown-menu').remove();
					});
				})
			</script>
			<script src="assets/js/jquery.dataTables.min.js"></script>
			<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
			<script src="assets/js/dataTables.buttons.min.js"></script>
			<script src="assets/js/buttons.flash.min.js"></script>
			<script src="assets/js/buttons.html5.min.js"></script>
			<script src="assets/js/buttons.print.min.js"></script>
			<script src="assets/js/buttons.colVis.min.js"></script>
			<script src="assets/js/dataTables.select.min.js"></script>

			<!-- ace scripts -->
			<script src="assets/js/ace-elements.min.js"></script>
			<script src="assets/js/ace.min.js"></script>

			<!-- inline scripts related to this page -->
			<script type="text/javascript">
				jQuery(function($) {
					//initiate dataTables plugin
					var myTable =
						$('#dynamic-table')
						//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
						.DataTable({
							bAutoWidth: false,
							"aoColumns": [{
									"bSortable": false
								},
								null, null, null, null, null,
								{
									"bSortable": false
								}
							],
							"aaSorting": [],


							//"bProcessing": true,
							//"bServerSide": true,
							//"sAjaxSource": "http://127.0.0.1/table.php"	,

							//,
							//"sScrollY": "200px",
							//"bPaginate": false,

							//"sScrollX": "100%",
							//"sScrollXInner": "120%",
							//"bScrollCollapse": true,
							//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
							//you may want to wrap the table inside a "div.dataTables_borderWrap" element

							//"iDisplayLength": 50


							select: {
								style: 'multi'
							}
						});



					$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

					new $.fn.dataTable.Buttons(myTable, {
						buttons: [{
								"extend": "colvis",
								"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
								"className": "btn btn-white btn-primary btn-bold",
								columns: ':not(:first):not(:last)'
							},
							{
								"extend": "copy",
								"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
								"className": "btn btn-white btn-primary btn-bold"
							},
							{
								"extend": "csv",
								"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
								"className": "btn btn-white btn-primary btn-bold"
							},
							{
								"extend": "excel",
								"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
								"className": "btn btn-white btn-primary btn-bold"
							},
							{
								"extend": "pdf",
								"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
								"className": "btn btn-white btn-primary btn-bold"
							},
							{
								"extend": "print",
								"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
								"className": "btn btn-white btn-primary btn-bold",
								autoPrint: false,
								message: 'This print was produced using the Print button for DataTables'
							}
						]
					});
					myTable.buttons().container().appendTo($('.tableTools-container'));

					//style the message box
					var defaultCopyAction = myTable.button(1).action();
					myTable.button(1).action(function(e, dt, button, config) {
						defaultCopyAction(e, dt, button, config);
						$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
					});


					var defaultColvisAction = myTable.button(0).action();
					myTable.button(0).action(function(e, dt, button, config) {

						defaultColvisAction(e, dt, button, config);


						if ($('.dt-button-collection > .dropdown-menu').length == 0) {
							$('.dt-button-collection')
								.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
								.find('a').attr('href', '#').wrap("<li />")
						}
						$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
					});

					////

					setTimeout(function() {
						$($('.tableTools-container')).find('a.dt-button').each(function() {
							var div = $(this).find(' > div').first();
							if (div.length == 1) div.tooltip({
								container: 'body',
								title: div.parent().text()
							});
							else $(this).tooltip({
								container: 'body',
								title: $(this).text()
							});
						});
					}, 500);





					myTable.on('select', function(e, dt, type, index) {
						if (type === 'row') {
							$(myTable.row(index).node()).find('input:checkbox').prop('checked', true);
						}
					});
					myTable.on('deselect', function(e, dt, type, index) {
						if (type === 'row') {
							$(myTable.row(index).node()).find('input:checkbox').prop('checked', false);
						}
					});




					/////////////////////////////////
					//table checkboxes
					$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

					//select/deselect all rows according to table header checkbox
					$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function() {
						var th_checked = this.checked; //checkbox inside "TH" table header

						$('#dynamic-table').find('tbody > tr').each(function() {
							var row = this;
							if (th_checked) myTable.row(row).select();
							else myTable.row(row).deselect();
						});
					});

					//select/deselect a row when the checkbox is checked/unchecked
					$('#dynamic-table').on('click', 'td input[type=checkbox]', function() {
						var row = $(this).closest('tr').get(0);
						if (this.checked) myTable.row(row).deselect();
						else myTable.row(row).select();
					});



					$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
						e.stopImmediatePropagation();
						e.stopPropagation();
						e.preventDefault();
					});



					//And for the first simple table, which doesn't have TableTools or dataTables
					//select/deselect all rows according to table header checkbox
					var active_class = 'active';
					$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function() {
						var th_checked = this.checked; //checkbox inside "TH" table header

						$(this).closest('table').find('tbody > tr').each(function() {
							var row = this;
							if (th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
							else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
						});
					});

					//select/deselect a row when the checkbox is checked/unchecked
					$('#simple-table').on('click', 'td input[type=checkbox]', function() {
						var $row = $(this).closest('tr');
						if ($row.is('.detail-row ')) return;
						if (this.checked) $row.addClass(active_class);
						else $row.removeClass(active_class);
					});



					/********************************/
					//add tooltip for small view action buttons in dropdown menu
					$('[data-rel="tooltip"]').tooltip({
						placement: tooltip_placement
					});

					//tooltip placement on right or left
					function tooltip_placement(context, source) {
						var $source = $(source);
						var $parent = $source.closest('table')
						var off1 = $parent.offset();
						var w1 = $parent.width();

						var off2 = $source.offset();
						//var w2 = $source.width();

						if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
						return 'left';
					}




					/***************/
					$('.show-details-btn').on('click', function(e) {
						e.preventDefault();
						$(this).closest('tr').next().toggleClass('open');
						$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
					});
					/***************/





					/**
					//add horizontal scrollbars to a simple table
					$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
					  {
						horizontal: true,
						styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
						size: 2000,
						mouseWheelLock: true
					  }
					).css('padding-top', '12px');
					*/


				})
			</script>
		</body>
<?php
		// }
		// redirecting to dashboard  

	}
} ?>