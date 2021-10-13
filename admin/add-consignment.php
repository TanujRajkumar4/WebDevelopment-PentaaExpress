	<?php
	session_start();
	include("database.php");
	if ((isset($_SESSION)) && (isset($_SESSION['uid']))) {
		$id = $_SESSION['uid'];

		if (isset($_GET['ty'])) {
			if ($_GET['ty'] == 'add') {
				$title = "Add Consignment";
			} elseif ($_GET['ty'] == 'edit') {
				$title = "Edit Consignment";
			} elseif ($_GET['ty'] == 'status') {
				$title = "Consignment status";
			}
			if (isset($_GET['ac'])) {
				if ($_GET['ac'] == "ins") {
					$today = date("Y-m-d");
					$qry = "INSERT INTO `tbl_courier`(`cid`, `waybillno`,`consignor_name`, `consignor_gst`, `consignor_phone`, `consignor_add`, `consignee_name`, `consignee_gst`, `consignee_phone`, `consignee_pincode`, `consignee_add`, `toi`, `weight`, `actwgt`, `volh`, `volw`, `voll`, `volq`, `volh1`, `volw1`, `voll1`, `volq1`, `volh2`, `volw2`, `voll2`, `volq2`, `cubft`, `boxes`,`bxpkg`, `qty`, `units`, `invoice_no`, `invoice_val`, `setto`, `pay_mode`, `pick_date`, `dest_off`,`org_off`, `freight`, `insurance`, `waych`, `othch`, `odach`, `topaych`, `subtot`, `sgst`,`cgst`, `tot`, `comments`, `book_status`, `status`, `book_date`) VALUES (NULL,'" . $_POST['waybillno'] . "','" . $_POST['consignor'] . "','" . $_POST['gstincon'] . "','" . $_POST['phone'] . "','" . $_POST['cusAddrs'] . "','" . $_POST['Consignee'] . "','" . $_POST['gstincong'] . "','" . $_POST['consigneephone'] . "','" . $_POST['pincode'] . "','" . $_POST['consigneeAddrs'] . "','" . $_POST['contyp'] . "','" . $_POST['gender'] . "','" . $_POST['actualwgt'] . "','" . $_POST['volwgth'] . "','" . $_POST['volwgtw'] . "','" . $_POST['volwgtl'] . "','" . $_POST['volqty'] . "','" . $_POST['volwgth1'] . "','" . $_POST['volwgtw1'] . "','" . $_POST['volwgtl1'] . "','" . $_POST['volqty1'] . "','" . $_POST['volwgth2'] . "','" . $_POST['volwgtw2'] . "','" . $_POST['volwgtl2'] . "','" . $_POST['volqty2'] . "','" . $_POST['cubft'] . "','" . $_POST['boxesrt'] . "','" . $_POST['boxpkg'] . "','" . $_POST['qty'] . "','" . $_POST['uom'] . "','" . $_POST['invono'] . "','" . $_POST['invoval'] . "','" . $_POST['setto'] . "','" . $_POST['platform'] . "','" . $_POST['date-timepicker1'] . "','" . $_POST['desoff'] . "','" . $_SESSION['orgid'] . "','" . $_POST['freight'] . "','" . $_POST['insrance'] . "','" . $_POST['waybillch'] . "','" . $_POST['otherch'] . "','" . $_POST['oda'] . "','" . $_POST['topay'] . "','" . $_POST['subtot'] . "','" . $_POST['sgst'] . "','" . $_POST['consignno'] . "','" . $_POST['tot'] . "','" . $_POST['comment'] . "','1','A','$today')";
					echo $qry;
					// $sql = mysqli_query($dbConn, $qry);
					if ($sql) {
						$qry1 = "INSERT INTO `tbl_courier_track`(`id`, `cons_no`, `current_city`, `bk_status`, `comments`, `bk_time`,`status`) VALUES(NULL,'" . $_POST['waybillno'] . "','" . $_SESSION['orgid'] . "','1','" . $_POST['comment'] . "','$today','A')";
						//echo $qry1;
						$trksql = mysqli_query($dbConn, $qry1);
						$selbal = mysqli_fetch_array(mysqli_query($dbConn, "SELECT bala from tbl_customer where `custID`='" . $_POST['custID'] . "' and status='A'"));
						$cust_bal = $selbal['bala'] + $_POST['tot'];
						$ins = mysqli_query($dbConn, "UPDATE `tbl_customer` SET `bala`='" . $cust_bal . "' where `custID`='" . $_POST['custID'] . "' and status='A'");
						if ($_POST['platform'] == '1') {
							$TranType = "Dr";
							$TranRemarks = "To Pay Payment";
						}
						if ($_POST['platform'] == '2') {
							$TranType = "Dr";
							$TranRemarks = "Credit Payment";
						}
						if ($_POST['platform'] == '3') {
							$TranType = "Cr";
							$TranRemarks = "Credit Payment";
						}
						$ins = mysqli_query($dbConn, "INSERT INTO `tbl_transactions`(`Tran_Date`, `Cust_ID`, `Branch_ID`, `Pay_Meth_ID`, `Tran_Type`, `Tran_Remarks`, `Tran_Amt`, `Status`) VALUES ('$today','$_POST[custID]','$_SESSION[uid]','$_POST[platform]','$TranType','$TranRemarks','$_POST[tot]','A')");
						echo "<script>alert('Inserted Successfully');window.location.href = 'add-consignment.php?ty=$_GET[ty]';</script>";
					} else {
						echo "<script>alert('Not Inserted');window.location.href = 'add-consignment.php?ty=$_GET[ty]';</script>";
					}
				}
				if ($_GET['ac'] == "upd") {
					$sql = mysqli_query($dbConn, "UPDATE `tbl_courier` SET `cgst`='" . $_POST['consignno'] . "',`waybillno`='" . $_POST['waybillno'] . "',`consignor_name`='" . $_POST['consignor'] . "',`consignor_gst`='" . $_POST['gstincon'] . "',`consignor_phone`='" . $_POST['phone'] . "',`consignor_add`='" . $_POST['cusAddrs'] . "',`consignee_name`='" . $_POST['Consignee'] . "',`consignee_gst`='" . $_POST['gstincong'] . "',`consignee_phone`='" . $_POST['consigneephone'] . "',`consignee_pincode`='" . $_POST['pincode'] . "',`consignee_add`='" . $_POST['consigneeAddrs'] . "',`toi`='" . $_POST['contyp'] . "',`weight`='" . $_POST['gender'] . "',`actwgt`='" . $_POST['actualwgt'] . "',`volh`='" . $_POST['volwgth'] . "',`volw`='" . $_POST['volwgtw'] . "',`voll`='" . $_POST['volwgtl'] . "',`volq`='" . $_POST['volqty'] . "',`volh`='" . $_POST['volwgth1'] . "',`volw`='" . $_POST['volwgtw1'] . "',`voll`='" . $_POST['volwgtl1'] . "',`volq`='" . $_POST['volqty1'] . "',`volh`='" . $_POST['volwgth2'] . "',`volw`='" . $_POST['volwgtw2'] . "',`voll`='" . $_POST['volwgtl2'] . "',`volq`='" . $_POST['volqty2'] . "',`cubft`='" . $_POST['cubft'] . "',`boxes`='" . $_POST['boxesrt'] . "',`bxpkg`='" . $_POST['boxpkg'] . "',`qty`='" . $_POST['qty'] . "',`units`='" . $_POST['uom'] . "',`invoice_no`='" . $_POST['invono'] . "',`invoice_val`='" . $_POST['invoval'] . "',`setto`='" . $_POST['setto'] . "',`pay_mode`='" . $_POST['platform'] . "',`pick_date`='" . $_POST['date-timepicker1'] . "',`dest_off`='" . $_POST['desoff'] . "',`freight`='" . $_POST['freight'] . "',`insurance`='" . $_POST['insrance'] . "',`waych`='" . $_POST['waybillch'] . "',`othch`='" . $_POST['otherch'] . "',`odach`='" . $_POST['oda'] . "',`topaych`='" . $_POST['topay'] . "',`subtot`='" . $_POST['subtot'] . "',`sgst`='" . $_POST['sgst'] . "',`tot`='" . $_POST['tot'] . "',`comments`='" . $_POST['comment'] . "' WHERE `cid`='" . $_GET['editid'] . "' and `status`='A'");
					//echo $sql;
					if ($sql) {
						if ($_POST['platform'] == '2') {
							$selbal = mysqli_fetch_array(mysqli_query($dbConn, "SELECT bala from tbl_customer where `custID`='" . $_POST['custID'] . "' and status='A'"));
							$cust_bal = $selbal['bala'] + $_POST['tot'];
							$ins = mysqli_query($dbConn, "UPDATE `tbl_customer` SET `bala`='" . $cust_bal . "' where `custID`='" . $_POST['custID'] . "' and status='A'");
						}
						echo "<script>alert('Updated Successfully');window.location.href = 'view-consignment.php';</script>";
					} else {
						echo "<script>alert('Not Updated');window.location.href = 'view-consignment.php';</script>";
					}
				}
				if ($_GET['ac'] == "status") {
					$today = date("Y-m-d");
					$qry = "UPDATE `tbl_courier_track` SET `current_city`='" . $_SESSION['orgid'] . "',`bk_status`='" . $_POST['book_status'] . "', `comments`='" . $_POST['comment'] . "',`bk_time`='" . $today . "' WHERE `cons_no`='" . $_POST['waybillno'] . "' and status='A'";
					$sql = mysqli_query($dbConn, $qry);
					//echo $qry;
					if ($sql) {
						echo "<script>alert('Updated Successfully');window.location.href = 'view-consignment.php';</script>";
					} else {
						echo "<script>alert('Not Updated');window.location.href = 'view-consignment.php';</script>";
					}
				}
			}
			if ($_GET['ty'] == 'del') {
				$sql = "DELETE FROM tbl_courier WHERE waybillno='" . $_GET['delid'] . "'";
				$sql1 = "DELETE FROM tbl_courier_track WHERE cons_no='" . $_GET['delid'] . "'";
				if (mysqli_query($dbConn, $sql) && mysqli_query($dbConn, $sql1)) {
					echo "<script>alert('Record Deleted Successfully');
					window.location.href = 'view-consignment.php';</script>";
				} else {
					echo "<script>alert('Error in Deleting the record');
					window.location.href = 'view-consignment.php';</script>";
				}
			}
	?>
			<!DOCTYPE html>
			<html lang="en">
			<head>
				<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
				<meta charset="utf-8" />
				<title>Consignment - Admin</title>
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
				<link rel="stylesheet" href="assets/css/select2.min.css" />
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
										<a href="#">Home</a>
									</li>
									<li class="active"> Consignment</li>
								</ul><!-- /.breadcrumb -->

								<!-- /.nav-search -->
							</div>
							<?php
							if ($_GET['ty'] == "add") {
							?> <div class="page-content">
									<!-- /.ace-settings-container -->
									<div class="page-header">
										<h1>
											<?php echo $title; ?>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $title; ?>
											</small>
										</h1>
									</div><!-- /.page-header -->

									<div class="row">
										<div class="col-xs-12">
											<!-- PAGE CONTENT BEGINS -->
											<div class="widget-box">
												<div class="widget-header widget-header-blue widget-header-flat">
													<h4 class="widget-title lighter">Consignment Details</h4>
												</div>

												<div class="widget-body">
													<div class="widget-main">
														<div>
															<div class="step-content pos-rel">
																<div class="step-pane active">
																	<h3 class="lighter block green">Consignor's Details</h3>

																	<form class="form-horizontal" method="POST" action="add-consignment.php?ac=ins&ty=<?php echo $_GET['ty']; ?>">
																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="custID">Customer ID :</label>
																			<div class="col-xs-12 col-sm-9">
																				<select name="custID" id="custID" class="select2" data-placeholder="Click to Choose...">
																					<option value="">&nbsp;</option>
																					<?php
																					$cus = mysqli_query($dbConn, "SELECT * FROM tbl_customer A,pay_meth B WHERE A.Type = B.b_id AND A.status = 'A' ORDER BY A.custID");
																					while ($cussql = mysqli_fetch_array($cus)) {
																					?>
																						<option value="<?php echo $cussql['custID']; ?>"><?php echo $cussql['custID']; ?></option>
																					<?php
																					}
																					?>
																				</select>
																			</div>
																		</div>

																		<div class="space-2"></div>
																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consignor">Consignor's Name:</label>

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

																		<h3 class="lighter block green">Consignee's Details</h3>
																		<div class="hr hr-dotted"></div>
																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consignor">Consignee's Name:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="text" name="Consignee" id="Consignee" class="col-xs-12 col-sm-6" required />
																				</div>
																			</div>
																		</div>

																		<div class="space-2"></div>

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="gstincong">GSTTIN Number:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">

																					<input type="text" id="gstincong" name="gstincong" class="col-xs-12 col-sm-6" />
																				</div>
																			</div>
																		</div>
																		<div class="space-2"></div>

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consigneephone">Phone Number:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="input-group">
																					<span class="input-group-addon">
																						<i class="ace-icon fa fa-phone"></i>
																					</span>

																					<input type="tel" id="consigneephone" name="consigneephone" required />
																				</div>
																			</div>
																		</div>


																		<div class="space-2"></div>

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="pincode">Pincode:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="input-group">
																					<span class="input-group-addon">
																						<i class="ace-icon fa fa-map-marker"></i>
																					</span>

																					<input type="number" id="pincode" name="pincode" required />
																				</div>
																			</div>
																		</div>

																		<div class="space-2"></div>

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consigneeAddrs">Address:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<textarea class="input-xlarge" name="consigneeAddrs" id="consigneeAddrs" required></textarea>
																				</div>
																			</div>
																		</div>

																		<!-- CONSIGNMENT DETAILS - ADD FORM - START -->
																		<h3 class="lighter block green">Consignment Details</h3>
																		<div class="hr hr-dotted"></div>
																		<div class="space-2"></div>

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="date-timepicker1">
																				Pick Up Date/Time: </label>
																			<div class="col-xs-12 col-sm-9">
																				<div class="input-group">
																					<span class="input-group-addon">
																						<i class="fa fa-clock-o bigger-110"></i>
																					</span>
																					<input id="date-timepicker1" name="date-timepicker1" type="text" class="col-xs-12 col-sm-3" />
																				</div>
																			</div>
																		</div>
																		<div class="space-2"></div>
																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="desoff">Destination City:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<select class="col-xs-12 col-sm-5" id="descity" name="descity" required>
																						<option value="">
																							<--------Select-------->
																						</option>
																						<?php
																						$sqltoi = mysqli_query($dbConn, "SELECT * FROM city WHERE status= 'A'");
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

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="desoff">Destination Office:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<select class="col-xs-12 col-sm-5" id="desoff" name="desoff" required>
																						<option value="">
																							<--------Select-------->
																						</option>
																						<?php
																						$sqltoi = mysqli_query($dbConn, "SELECT * from tbl_offices where status= 'A'");
																						while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																						?>
																							<option value="<?php echo $rwtoi['id']; ?>"><?php echo $rwtoi['off_name']; ?></option>
																						<?php
																						}
																						?>
																					</select>
																				</div>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Payment Mode:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<select class="input-medium" id="platform" name="platform" required>
																						<option value="">
																							<--------Select-------->
																						</option>
																						<?php
																						$sqltoi = mysqli_query($dbConn, "SELECT * from pay_meth where status= 'A'");
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
																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right">Weight:</label>
																			<div class="col-xs-12 col-sm-9">
																				<div>
																					<label class="line-height-1 blue" style="Display: none">
																						<input name="gender" style="Display: none" value="0" id="None" type="radio" class="ace" onclick="enableTextbox()" checked />
																						<span class="lbl" style="Display: none"> None</span>
																					</label>
																				</div>
																			</div>
																			<div class="col-xs-12 col-sm-9">
																				<div>
																					<label class="line-height-1 blue">
																						<input name="gender" value="1" id="Wgt" type="radio" class="ace" onclick="enableTextbox()" />
																						<span class="lbl"> Weight</span>
																					</label>
																				</div>
																				<div>
																					<label class="line-height-1 blue">
																						<input name="gender" value="2" id="Boxrt" type="radio" class="ace" onclick="enableTextbox()" />
																						<span class="lbl"> Box Rate</span>
																					</label>
																				</div>
																			</div>
																		</div>
																		<div class="space-2"></div>

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="contyp">Type of Consignment:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<select class="col-xs-12 col-sm-3" id="contyp" name="contyp">
																						<option value="">
																							<--------Select-------->
																						</option>
																						<?php
																						$sqltoi = mysqli_query($dbConn, "SELECT * from toi where status= 'A'");
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



																		<div id="ActWgt" style="display: none;">
																			<div class="space-2"></div>
																			<div class="form-group">
																				<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="actualwgt">Actual Weight:</label>

																				<div class="col-xs-12 col-sm-9">
																					<div class="clearfix">
																						<input type="text" name="actualwgt" id="actualwgt" class="col-xs-12 col-sm-6" value="0" placeholder="Total Weight" />
																					</div>
																				</div>
																			</div>

																			<div class="space-2"></div>

																			<div class="form-group">
																				<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="actualwgt">Volumentric Weight:</label>

																				<div class="col-xs-12 col-sm-9">
																					<div class="clearfix">
																						<label class="control-label col-xs-12 col-sm-1" for="H">H:</label><input type="text" name="volwgth" id="volwgth" class="col-xs-12 col-sm-2" value="0" placeholder="Height" /><label class="control-label col-xs-12 col-sm-1" for="W">W:</label>
																						<input type="text" name="volwgtw" id="volwgtw" class="col-xs-12 col-sm-2" value="0" placeholder="Width" /><label class="control-label col-xs-12 col-sm-1" for="L">L:</label>
																						<input type="text" name="volwgtl" id="volwgtl" class="col-xs-12 col-sm-2" value="0" placeholder="Length" /><label class="control-label col-xs-12 col-sm-1" for="L">Qty:</label>
																						<input type="text" name="volqty" id="volqty" class="col-xs-12 col-sm-2" value="0" placeholder="Quantity" /><label class="control-label col-xs-12 col-sm-1" for="H">H:</label><input type="text" name="volwgth1" id="volwgth1" class="col-xs-12 col-sm-2" value="0" placeholder="Height" /><label class="control-label col-xs-12 col-sm-1" for="W">W:</label>
																						<input type="text" name="volwgtw1" id="volwgtw1" class="col-xs-12 col-sm-2" value="0" placeholder="Width" /><label class="control-label col-xs-12 col-sm-1" for="L">L:</label>
																						<input type="text" name="volwgtl1" id="volwgtl1" class="col-xs-12 col-sm-2" value="0" placeholder="Length" /><label class="control-label col-xs-12 col-sm-1" for="L">Qty:</label>
																						<input type="text" name="volqty1" id="volqty1" class="col-xs-12 col-sm-2" value="0" placeholder="Quantity" /><label class="control-label col-xs-12 col-sm-1" for="H">H:</label><input type="text" name="volwgth2" id="volwgth2" class="col-xs-12 col-sm-2" value="0" placeholder="Height" /><label class="control-label col-xs-12 col-sm-1" for="W">W:</label>
																						<input type="text" name="volwgtw2" id="volwgtw2" class="col-xs-12 col-sm-2" value="0" placeholder="Width" /><label class="control-label col-xs-12 col-sm-1" for="L">L:</label>
																						<input type="text" name="volwgtl2" id="volwgtl2" class="col-xs-12 col-sm-2" value="0" placeholder="Length" /><label class="control-label col-xs-12 col-sm-1" for="L">Qty:</label>
																						<input type="text" name="volqty2" id="volqty2" class="col-xs-12 col-sm-2" value="0" placeholder="Quantity" />
																						<label class="control-label col-xs-12 col-sm-1" for="CFT">CFT:</label>
																						<input type="text" name="cubft" id="cubft" class="col-xs-12 col-sm-2" value="0" placeholder="Cubic Feet" />
																					</div>
																				</div>
																			</div>
																		</div>
																		<div id="BoxWgt" style="display: none;">
																			<div class="space-2"></div>
																			<div class="form-group">
																				<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="actualwgt">Boxes:</label>

																				<div class="col-xs-12 col-sm-9">
																					<div class="clearfix">
																						<input type="text" name="boxesrt" id="boxesrt" class="col-xs-12 col-sm-3" value="0" placeholder="No of Boxes" />

																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="space-2"></div>

																		<div class="form-group">
																			<!-- Price per KG or Price per Box -->
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="boxpkg">Price Per Kg / Box:</label>
																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="text" name="boxpkg" id="boxpkg" value="0.00" placeholder="Price Per Kg / Box" required readonly />
																				</div>

																			</div>
																		</div>
																		<div class="space-2"></div>

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="qty">Quantity:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="number" name="qty" id="qty" class="col-xs-12 col-sm-3 " />
																				</div>

																			</div>
																		</div>


																		<div class="space-2"></div>

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="qty">Units:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<select class="input-medium " id="uom" name="uom">
																						<option value="">
																							<--------Select-------->
																						</option>
																						<?php
																						$sqltoi = mysqli_query($dbConn, "SELECT * from book_meth where status= 'A'");
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

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="invono">Invoice No:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="text" name="invono" id="invono" class="col-xs-12 col-sm-6" />
																				</div>
																			</div>
																		</div>

																		<div class="space-2"></div>

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="invoval">Invoice Value:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="text" name="invoval" id="invoval" class="col-xs-12 col-sm-6" />
																				</div>
																			</div>
																		</div>

																		<div class="space-2"></div>

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="setto">Said To Contain:</label>
																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="text" name="setto" id="setto" class="col-xs-12 col-sm-6" />
																				</div>
																			</div>
																		</div>
																		<div class="space-2"></div>
																		<div class="hr hr-dotted"></div>
																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="freight">Total Freight:</label>
																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="number" name="freight" id="freight" class="col-xs-12 col-sm-5 " value="0.00" readonly />
																					<input type="hidden" name="freightch" id="freightch" class="col-xs-12 col-sm-5 " value="" readonly />
																					<input type="hidden" name="boxrtch" id="boxrtch" class="col-xs-12 col-sm-5 " value="" readonly />
																				</div>
																			</div>
																		</div>
																		<div class="space-2"></div>
																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="insrance">Insurance:</label>
																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="number" name="insrance" id="insrance" class="col-xs-12 col-sm-5 " value="0.00" />
																				</div>
																			</div>
																		</div>
																		<div class="space-2"></div>
																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="otherch">Waybill Charges:</label>
																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="number" name="waybillch" id="waybillch" class="col-xs-12 col-sm-5 " value="0.00" requried />
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
																		<div class="form-group" id="odasec" style="display:block;">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="oda">ODA Charges:</label>
																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="number" name="oda" id="oda" class="col-xs-12 col-sm-5 " value="0.00" />
																				</div>
																			</div>
																		</div>
																		<div class="space-2"></div>
																		<div class="form-group" id="paysec">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="topay">To Pay Charges:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="number" name="topay" id="topay" class="col-xs-12 col-sm-5 " value="0.00" />
																				</div>
																			</div>
																		</div>
																		<div class="space-2"></div>
																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="subtot">Sub Total:</label>
																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="number" name="subtot" id="subtot" class="col-xs-12 col-sm-5 " value="0.00" readonly />
																				</div>
																			</div>
																		</div>
																		<div class="space-2"></div>
																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="sgst">SGST(%):</label>
																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="number" name="sgst" id="sgst" class="col-xs-12 col-sm-5 " value="9" requried />
																				</div>
																			</div>
																		</div>

																		<div class="space-2"></div>

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consignno">CGST(%):</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="number" name="consignno" id="consignno" class="col-xs-12 col-sm-5" value="9" requried />
																				</div>
																			</div>
																		</div>
																		<div class="space-2"></div>
																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="tot">Total:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="number" name="tot" id="tot" class="col-xs-12 col-sm-5 " value="0.00" readonly />
																				</div>
																			</div>
																		</div>
																		<div class="space-2"></div>

																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Comment:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<textarea class="input-xlarge" name="comment" id="comment"></textarea>
																				</div>
																			</div>
																		</div>
																		<div class="form-group">
																			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="waybillno">Waybill No:</label>

																			<div class="col-xs-12 col-sm-9">
																				<div class="clearfix">
																					<input type="text" name="waybillno" id="waybillno" class="col-xs-12 col-sm-6" requiredonloadstart="this.focus();" onmouseover="this.focus();" required />
																				</div>
																			</div>
																		</div>
																		<hr />
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

								</div>
							<?php
							}
							?>
							<!-- CONSIGNMENT DETAILS - ADD FORM - END -->


							<!-- CONSIGNMENT DETAILS - EDIT FORM - START -->
							<?php
							if (isset($_GET['ty'])) {
								if ($_GET['ty'] == "edit") {
									$sqlms = mysqli_query($dbConn, "Select * from tbl_courier where cid = '" . $_GET['editid'] . "'");
									$rowms = mysqli_fetch_array($sqlms);
							?> <div class="page-content">
										<!-- /.ace-settings-container -->
										<div class="page-header">
											<h1>
												Edit Section
												<small>
													<i class="ace-icon fa fa-angle-double-right"></i>
													<?php echo $title; ?>
												</small>
											</h1>
										</div><!-- /.page-header -->

										<div class="row">
											<div class="col-xs-12">
												<!-- PAGE CONTENT BEGINS -->
												<form class="form-horizontal" method="POST" action="add-consignment.php?ac=upd&ty=edit&editid=<?php echo $_GET['editid']; ?>">
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="custID">Customer ID:</label>

														<div class="col-xs-12 col-sm-9">
															<select name="custID" id="custID" class="select2" data-placeholder="Click to Choose...">
																<option value="">&nbsp;</option>
																<?php
																$cus = mysqli_query($dbConn, "select * from tbl_customer where status='A'");
																while ($cussql = mysqli_fetch_array($cus)) {
																?>
																	<option value="<?php echo $cussql['custID']; ?>"><?php echo $cussql['custID']; ?></option>
																<?php
																}
																?>
															</select>
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

													<h3 class="lighter block green">Consignee's Details</h3>
													<div class="hr hr-dotted"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consignor">Consignee's Name:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="text" name="Consignee" id="Consignee" class="col-xs-12 col-sm-6" value="<?php echo $rowms['consignee_name']; ?>" />
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="gstincong">GSTTIN Number:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">

																<input type="text" id="gstincong" name="gstincong" class="col-xs-12 col-sm-6" value="<?php echo $rowms['consignee_gst']; ?>" />
															</div>
														</div>
													</div>
													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consigneephone">Phone Number:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-phone"></i>
																</span>

																<input type="tel" id="consigneephone" name="consigneephone" value="<?php echo $rowms['consignee_phone']; ?>" />
															</div>
														</div>
													</div>


													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="pincode">Pincode:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-map-marker"></i>
																</span>

																<input type="number" id="pincode" name="pincode" value="<?php echo $rowms['consignee_pincode']; ?>" />
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consigneeAddrs">Address:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<textarea class="input-xlarge" name="consigneeAddrs" id="consigneeAddrs"><?php echo $rowms['consignee_add']; ?></textarea>
															</div>
														</div>
													</div>
													<h3 class="lighter block green">Consignment Details</h3>
													<div class="hr hr-dotted"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="waybillno">Waybill No:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="text" name="waybillno" id="waybillno" class="col-xs-12 col-sm-6" value="<?php echo $rowms['waybillno']; ?>" />
															</div>
														</div>
													</div>

													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="date-timepicker1">
															Pick Up Date/Time </label>
														<div class="col-xs-12 col-sm-9">
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-clock-o bigger-110"></i>
																</span>
																<input id="date-timepicker1" name="date-timepicker1" type="text" class="col-xs-12 col-sm-3" value="<?php echo $rowms['pick_date']; ?>" />
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="desoff">Destination Office</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<select class="col-xs-12 col-sm-5" id="desoff" name="desoff">
																	<option value="">
																		<--------Select-------->
																	</option>
																	<?php
																	$sqltoi = mysqli_query($dbConn, "Select * from tbl_offices where status= 'A'");
																	while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																	?>
																		<option value="<?php echo $rwtoi['id']; ?>" <?php if ($rwtoi['id'] == $rowms['dest_off']) {
																														echo "selected";
																													} ?>><?php echo $rwtoi['off_name']; ?></option>
																	<?php
																	}
																	?>
																</select>
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="contyp">Type of Consignment</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<select class="col-xs-12 col-sm-3" id="contyp" name="contyp">
																	<option value="">
																		<--------Select-------->
																	</option>
																	<?php
																	$sqltoi = mysqli_query($dbConn, "Select * from toi where status= 'A'");
																	while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																	?>
																		<option value="<?php echo $rwtoi['b_id']; ?>" <?php if ($rwtoi['b_id'] == $rowms['toi']) {
																															echo "selected";
																														} ?>><?php echo $rwtoi['bname']; ?></option>
																	<?php
																	}
																	?>
																</select>
															</div>
														</div>
													</div>

													<div class="space-2"></div>
													<?php $blk = "none"; ?>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right">Weight</label>

														<div class="col-xs-12 col-sm-9">
															<div>
																<label class="line-height-1 blue">
																	<input name="gender" value="1" id="Wgt" type="radio" class="ace" onclick="enableTextbox()" <?php if ($rowms['weight'] == 1) {
																																									echo "checked";
																																									$blk = "block";
																																								} ?> />
																	<span class="lbl"> Weight</span>
																</label>
															</div>
															<div>
																<label class="line-height-1 blue">
																	<input name="gender" value="2" id="Boxrt" type="radio" class="ace" onclick="enableTextbox()" <?php if ($rowms['weight'] == 2) {
																																										echo "checked";
																																										$blk = "block";
																																									} ?> />
																	<span class="lbl"> Box Rate</span>
																</label>
															</div>
														</div>
													</div>

													<div id="ActWgt" style="display: <?php if ($rowms['weight'] != 1) {
																							echo "none";
																						} ?>;/>">
														<div class="space-2"></div>
														<div class="form-group">
															<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="actualwgt">Actual Weight:</label>

															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	<input type="text" name="actualwgt" id="actualwgt" class="col-xs-12 col-sm-6" value="<?php echo $rowms['actwgt']; ?>" placeholder="Total Weight" />
																</div>
															</div>
														</div>

														<div class="space-2"></div>

														<div class="form-group">
															<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="actualwgt">Volumentric Weight:</label>

															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	<label class="control-label col-xs-12 col-sm-1" for="H">H:</label><input type="text" name="volwgth" id="volwgth" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volh']; ?>" placeholder="Height" /><label class="control-label col-xs-12 col-sm-1" for="W">W:</label>
																	<input type="text" name="volwgtw" id="volwgtw" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volw']; ?>" placeholder="Width" /><label class="control-label col-xs-12 col-sm-1" for="L">L:</label>
																	<input type="text" name="volwgtl" id="volwgtl" class="col-xs-12 col-sm-2" value="<?php echo $rowms['voll']; ?>" placeholder="Length" />
																	<label class="control-label col-xs-12 col-sm-1" for="L">Qty:</label>
																	<input type="text" name="volqty" id="volqty" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volq']; ?>" placeholder="Quantity" /><label class="control-label col-xs-12 col-sm-1" for="H">H:</label><input type="text" name="volwgth1" id="volwgth1" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volh1']; ?>" placeholder="Height" /><label class="control-label col-xs-12 col-sm-1" for="W">W:</label>
																	<input type="text" name="volwgtw1" id="volwgtw1" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volw1']; ?>" placeholder="Width" /><label class="control-label col-xs-12 col-sm-1" for="L">L:</label>
																	<input type="text" name="volwgtl1" id="volwgtl1" class="col-xs-12 col-sm-2" value="<?php echo $rowms['voll1']; ?>" placeholder="Length" /><label class="control-label col-xs-12 col-sm-1" for="L">Qty:</label>
																	<input type="text" name="volqty1" id="volqty1" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volq1']; ?>" placeholder="Quantity" /><label class="control-label col-xs-12 col-sm-1" for="H">H:</label><input type="text" name="volwgth2" id="volwgth2" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volh2']; ?>" placeholder="Height" /><label class="control-label col-xs-12 col-sm-1" for="W">W:</label>
																	<input type="text" name="volwgtw2" id="volwgtw2" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volw2']; ?>" placeholder="Width" /><label class="control-label col-xs-12 col-sm-1" for="L">L:</label>
																	<input type="text" name="volwgtl2" id="volwgtl2" class="col-xs-12 col-sm-2" value="<?php echo $rowms['voll2']; ?>" placeholder="Length" /><label class="control-label col-xs-12 col-sm-1" for="L">Qty:</label>
																	<input type="text" name="volqty2" id="volqty2" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volq2']; ?>" placeholder="Quantity" />
																	<label class="control-label col-xs-12 col-sm-1" for="CFT">CFT:</label>
																	<input type="text" name="cubft" id="cubft" class="col-xs-12 col-sm-2" value="<?php echo $rowms['cubft']; ?>" placeholder="Cubic Feet" />
																</div>
															</div>
														</div>
													</div>
													<div id="BoxWgt" style="display: <?php if ($rowms['weight'] != 2) {
																							echo "none";
																						} ?>;">
														<div class="space-2"></div>
														<div class="form-group">
															<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="actualwgt">Boxes:</label>

															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">






																	<input type="text" name="boxesrt" id="boxesrt" class="col-xs-12 col-sm-3" value="<?php echo $rowms['boxes']; ?>" placeholder="No of Boxes" />
																	<label class="control-label col-xs-12 col-sm-3" for="CFT">Box per KG:</label>
																	<input type="text" name="boxpkg" id="boxpkg" class="col-xs-12 col-sm-3" value="<?php echo $rowms['bxpkg']; ?>" placeholder="Box Per Kg" />
																</div>
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="qty">Quantity:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="text" name="qty" id="qty" class="col-xs-12 col-sm-3 " value="<?php echo $rowms['qty']; ?>" />
															</div>

														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="qty">Units:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<select class="input-medium " id="uom" name="uom">
																	<option value="">
																		<--------Select-------->
																	</option>
																	<?php
																	$sqltoi = mysqli_query($dbConn, "SELECT * from book_meth where status= 'A'");
																	while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																	?>
																		<option value="<?php echo $rwtoi['b_id']; ?>" <?php if ($rwtoi['b_id'] == $rowms['units']) {
																															echo "selected";
																														} ?>><?php echo $rwtoi['bname']; ?></option>
																	<?php
																	}
																	?>
																</select>
															</div>

														</div>
													</div>
													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="invono">Invoice No:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="text" name="invono" id="invono" class="col-xs-12 col-sm-6" value="<?php echo $rowms['invoice_no']; ?>" />
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="invoval">Invoice Value:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="text" name="invoval" id="invoval" class="col-xs-12 col-sm-6" value="<?php echo $rowms['invoice_val']; ?>" />
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="setto">Said To Contain:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="text" name="setto" id="setto" class="col-xs-12 col-sm-6" value="<?php echo $rowms['setto']; ?>" />
															</div>
														</div>
													</div>


													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Payment Mode</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<select class="input-medium" id="platform" name="platform">
																	<option value="">
																		<--------Select-------->
																	</option>
																	<?php
																	$sqltoi = mysqli_query($dbConn, "Select * from pay_meth where status= 'A'");
																	while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																	?>
																		<option value="<?php echo $rwtoi['b_id']; ?>" <?php if ($rwtoi['b_id'] == $rowms['pay_mode']) {
																															echo "selected";
																														} ?>><?php echo $rwtoi['bname']; ?></option>
																	<?php
																	}
																	?>
																</select>
															</div>
														</div>
													</div>


													<div class="hr hr-dotted"></div>


													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="freight">Total Freight:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="freight" id="freight" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['freight']; ?>" readonly />
																<?php
																if ($rowms['pay_mode'] == '2') {
																	$Org_City = $_SESSION['uid'];
																	$Des_City = "";

																	$cussql = mysqli_fetch_array(mysqli_query($dbConn, "SELECT * from tbl_customer where consignor_gst='" . $rowms['consignor_gst'] . "' and status='A'"));
																	$fre = $cussql['freight'];
																}
																?>
																<input type="hidden" name="freightch" id="freightch" class="col-xs-12 col-sm-5 " value="<?php echo $fre; ?>" readonly />
																<input type="hidden" name="boxrtch" id="boxrtch" class="col-xs-12 col-sm-5 " value="<?php echo $fre; ?>" readonly />
															</div>
														</div>
													</div>
													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="insrance">Insurance:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="insrance" id="insrance" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['insurance']; ?>" />
															</div>
														</div>
													</div>
													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="otherch">Waybill Charges:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="waybillch" id="waybillch" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['waych']; ?>" required />
															</div>
														</div>
													</div>
													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="otherch">Other Charges:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="otherch" id="otherch" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['othch']; ?>" required />
															</div>
														</div>
													</div>


													<div class="space-2"></div>

													<div class="form-group" id="odasec" style="display:
															<?php
															$pinsql = mysqli_fetch_array(mysqli_query($dbConn, "SELECT * from pincode where bname='$rowms[consignee_pincode]'"));
															if ($pinsql['bname'] == $rowms['consignee_pincode']) {
																echo "none";
															} else {
																echo "block";
															}
															?>;">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="oda">ODA Charges:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="oda" id="oda" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['odach']; ?>" />
															</div>
														</div>
													</div>


													<div class="space-2"></div>

													<div class="form-group" id="paysec" style="display:<?php if ($rowms['pay_mode'] == 1) {
																											echo "block";
																										} else {
																											echo "none";
																										} ?>" ;>
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="topay">To Pay Charges:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="topay" id="topay" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['topaych']; ?>" />
															</div>
														</div>
													</div>

													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="subtot">Sub Total:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="subtot" id="subtot" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['subtot']; ?>" readonly />
															</div>
														</div>
													</div>

													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="sgst">SGST(%):</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="sgst" id="sgst" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['sgst']; ?>" required />
															</div>
														</div>
													</div>

													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consignno">CGST(%):</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="consignno" id="consignno" class="col-xs-12 col-sm-5" value="<?php echo $rowms['cgst']; ?>" required />
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="tot">Total:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="tot" id="tot" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['tot']; ?>" readonly />
															</div>
														</div>
													</div>
													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Comment</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<textarea class="input-xlarge" name="comment" id="comment"><?php echo $rowms['comments']; ?></textarea>
															</div>
														</div>
													</div>
													<hr />
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
							?>
							<!-- CONSIGNMENT DETAILS - EDIT FORM - END -->

							<!-- CONSIGNMENT DETAILS - STATUS FORM - START -->
							<?php
							if (isset($_GET['ty'])) {
								if ($_GET['ty'] == "status") {
									$sqlms = mysqli_query($dbConn, "Select * from tbl_courier where cid = '" . $_GET['editid'] . "'");
									$rowms = mysqli_fetch_array($sqlms);
							?> <div class="page-content">
										<!-- /.ace-settings-container -->
										<div class="page-header">
											<h1>
												Status Section
												<small>
													<i class="ace-icon fa fa-angle-double-right"></i>
													<?php echo $title; ?>
												</small>
											</h1>
										</div><!-- /.page-header -->

										<div class="row">
											<div class="col-xs-12">
												<!-- PAGE CONTENT BEGINS -->
												<form class="form-horizontal" method="POST" action="add-consignment.php?ac=status&ty=status&editid=<?php echo $_GET['editid']; ?>">

													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consignor">Consignor's Name:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="text" name="consignor" id="consignor" class="col-xs-12 col-sm-6" value="<?php echo $rowms['consignor_name']; ?>" readonly />
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="gstincon">GSTTIN Number:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">

																<input type="text" id="gstincon" name="gstincon" class="col-xs-12 col-sm-6" value="<?php echo $rowms['consignor_gst']; ?>" readonly />
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

																<input type="tel" id="phone" name="phone" value="<?php echo $rowms['consignor_phone']; ?>" readonly />
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="cusAddrs">Address:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<textarea class="input-xlarge" name="cusAddrs" id="cusAddrs" readonly><?php echo $rowms['consignor_add']; ?></textarea>
															</div>
														</div>
													</div>

													<h3 class="lighter block green">Consignee's Details</h3>
													<div class="hr hr-dotted"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consignor">Consignee's Name:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="text" name="Consignee" id="Consignee" class="col-xs-12 col-sm-6" value="<?php echo $rowms['consignee_name']; ?>" readonly />
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="gstincong">GSTTIN Number:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">

																<input type="text" id="gstincong" name="gstincong" class="col-xs-12 col-sm-6" value="<?php echo $rowms['consignee_gst']; ?>" readonly />
															</div>
														</div>
													</div>
													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consigneephone">Phone Number:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-phone"></i>
																</span>

																<input type="tel" id="consigneephone" name="consigneephone" value="<?php echo $rowms['consignee_phone']; ?>" readonly />
															</div>
														</div>
													</div>


													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="pincode">Pincode:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="ace-icon fa fa-map-marker"></i>
																</span>

																<input type="number" id="pincode" name="pincode" value="<?php echo $rowms['consignee_pincode']; ?>" readonly />
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consigneeAddrs">Address:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<textarea class="input-xlarge" name="consigneeAddrs" id="consigneeAddrs" readonly><?php echo $rowms['consignee_add']; ?></textarea>
															</div>
														</div>
													</div>
													<h3 class="lighter block green">Consignment Details</h3>
													<div class="hr hr-dotted"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="waybillno">Waybill No:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="text" name="waybillno" id="waybillno" class="col-xs-12 col-sm-6" value="<?php echo $rowms['waybillno']; ?>" readonly />
															</div>
														</div>
													</div>

													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="date-timepicker1">
															Pick Up Date/Time </label>
														<div class="col-xs-12 col-sm-9">
															<div class="input-group">
																<span class="input-group-addon">
																	<i class="fa fa-clock-o bigger-110"></i>
																</span>
																<input id="date-timepicker1" name="date-timepicker1" type="text" class="col-xs-12 col-sm-3" value="<?php echo $rowms['pick_date']; ?>" />
															</div>
														</div>
													</div>
													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="contyp">Type of Consignment</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<select class="col-xs-12 col-sm-3" id="contyp" name="contyp">
																	<option value="">
																		<--------Select-------->
																	</option>
																	<?php
																	$sqltoi = mysqli_query($dbConn, "Select * from toi where status= 'A'");
																	while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																	?>
																		<option value="<?php echo $rwtoi['b_id']; ?>" <?php if ($rwtoi['b_id'] == $rowms['toi']) {
																															echo "selected";
																														} ?>><?php echo $rwtoi['bname']; ?></option>
																	<?php
																	}
																	?>
																</select>
															</div>
														</div>
													</div>

													<div class="space-2"></div>
													<?php $blk = "none"; ?>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right">Weight</label>

														<div class="col-xs-12 col-sm-9">
															<div>
																<label class="line-height-1 blue">
																	<input name="gender" value="1" id="Wgt" type="radio" class="ace" onclick="enableTextbox()" <?php if ($rowms['weight'] == 1) {
																																									echo "checked";
																																									$blk = "block";
																																								} ?> />
																	<span class="lbl"> Weight</span>
																</label>
															</div>
															<div>
																<label class="line-height-1 blue">
																	<input name="gender" value="2" id="Boxrt" type="radio" class="ace" onclick="enableTextbox()" <?php if ($rowms['weight'] == 2) {
																																										echo "checked";
																																										$blk = "block";
																																									} ?> />
																	<span class="lbl"> Box Rate</span>
																</label>
															</div>
														</div>
													</div>

													<div id="ActWgt" style="display: <?php if ($rowms['weight'] != 1) {
																							echo "none";
																						} ?>;/>">
														<div class="space-2"></div>
														<div class="form-group">
															<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="actualwgt">Actual Weight:</label>

															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	<input type="text" name="actualwgt" id="actualwgt" class="col-xs-12 col-sm-6" value="<?php echo $rowms['actwgt']; ?>" placeholder="Total Weight" />
																</div>
															</div>
														</div>

														<div class="space-2"></div>

														<div class="form-group">
															<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="actualwgt">Volumentric Weight:</label>

															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	<label class="control-label col-xs-12 col-sm-1" for="H">H:</label><input type="text" name="volwgth" id="volwgth" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volh']; ?>" placeholder="Height" /><label class="control-label col-xs-12 col-sm-1" for="W">W:</label>
																	<input type="text" name="volwgtw" id="volwgtw" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volw']; ?>" placeholder="Width" /><label class="control-label col-xs-12 col-sm-1" for="L">L:</label>
																	<input type="text" name="volwgtl" id="volwgtl" class="col-xs-12 col-sm-2" value="<?php echo $rowms['voll']; ?>" placeholder="Length" />
																	<label class="control-label col-xs-12 col-sm-1" for="L">Qty:</label>
																	<input type="text" name="volqty" id="volqty" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volq']; ?>" placeholder="Quantity" /><label class="control-label col-xs-12 col-sm-1" for="H">H:</label><input type="text" name="volwgth1" id="volwgth1" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volh1']; ?>" placeholder="Height" /><label class="control-label col-xs-12 col-sm-1" for="W">W:</label>
																	<input type="text" name="volwgtw1" id="volwgtw1" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volw1']; ?>" placeholder="Width" /><label class="control-label col-xs-12 col-sm-1" for="L">L:</label>
																	<input type="text" name="volwgtl1" id="volwgtl1" class="col-xs-12 col-sm-2" value="<?php echo $rowms['voll1']; ?>" placeholder="Length" /><label class="control-label col-xs-12 col-sm-1" for="L">Qty:</label>
																	<input type="text" name="volqty1" id="volqty1" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volq1']; ?>" placeholder="Quantity" /><label class="control-label col-xs-12 col-sm-1" for="H">H:</label><input type="text" name="volwgth2" id="volwgth2" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volh2']; ?>" placeholder="Height" /><label class="control-label col-xs-12 col-sm-1" for="W">W:</label>
																	<input type="text" name="volwgtw2" id="volwgtw2" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volw2']; ?>" placeholder="Width" /><label class="control-label col-xs-12 col-sm-1" for="L">L:</label>
																	<input type="text" name="volwgtl2" id="volwgtl2" class="col-xs-12 col-sm-2" value="<?php echo $rowms['voll2']; ?>" placeholder="Length" /><label class="control-label col-xs-12 col-sm-1" for="L">Qty:</label>
																	<input type="text" name="volqty2" id="volqty2" class="col-xs-12 col-sm-2" value="<?php echo $rowms['volq2']; ?>" placeholder="Quantity" />
																	<label class="control-label col-xs-12 col-sm-1" for="CFT">CFT:</label>
																	<input type="text" name="cubft" id="cubft" class="col-xs-12 col-sm-2" value="<?php echo $rowms['cubft']; ?>" placeholder="Cubic Feet" />
																</div>
															</div>
														</div>
													</div>
													<div id="BoxWgt" style="display: <?php if ($rowms['weight'] != 2) {
																							echo "none";
																						} ?>;">
														<div class="space-2"></div>
														<div class="form-group">
															<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="actualwgt">Boxes:</label>

															<div class="col-xs-12 col-sm-9">
																<div class="clearfix">
																	<input type="text" name="boxesrt" id="boxesrt" class="col-xs-12 col-sm-3" value="<?php echo $rowms['boxes']; ?>" placeholder="No of Boxes" />
																	<label class="control-label col-xs-12 col-sm-3" for="CFT">Box Per Kg:</label>
																	<input type="text" name="boxesrt" id="boxesrt" class="col-xs-12 col-sm-3" value="<?php echo $rowms['bxpkg']; ?>" placeholder="Box Per Kg" />
																</div>
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="qty">Quantity:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="text" name="qty" id="qty" class="col-xs-12 col-sm-3 " value="<?php echo $rowms['qty']; ?>" />
															</div>

														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="qty">Units:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<select class="input-medium " id="uom" name="uom">
																	<option value="">
																		<--------Select-------->
																	</option>
																	<?php
																	$sqltoi = mysqli_query($dbConn, "Select * from book_meth where status= 'A'");
																	while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																	?>
																		<option value="<?php echo $rwtoi['b_id']; ?>" <?php if ($rwtoi['b_id'] == $rowms['units']) {
																															echo "selected";
																														} ?>><?php echo $rwtoi['bname']; ?></option>
																	<?php
																	}
																	?>
																</select>
															</div>

														</div>
													</div>
													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="invono">Invoice No:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="text" name="invono" id="invono" class="col-xs-12 col-sm-6" value="<?php echo $rowms['invoice_no']; ?>" readonly />
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="invoval">Invoice Value:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="text" name="invoval" id="invoval" class="col-xs-12 col-sm-6" value="<?php echo $rowms['invoice_val']; ?>" readonly />
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="setto">Said To Contain:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="text" name="setto" id="setto" class="col-xs-12 col-sm-6" value="<?php echo $rowms['setto']; ?>" readonly />
															</div>
														</div>
													</div>


													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Payment Mode</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<select class="input-medium" id="platform" name="platform">
																	<option value="">
																		<--------Select-------->
																	</option>
																	<?php
																	$sqltoi = mysqli_query($dbConn, "Select * from pay_meth where status= 'A'");
																	while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																	?>
																		<option value="<?php echo $rwtoi['b_id']; ?>" <?php if ($rwtoi['b_id'] == $rowms['pay_mode']) {
																															echo "selected";
																														} ?>><?php echo $rwtoi['bname']; ?></option>
																	<?php
																	}
																	?>
																</select>
															</div>
														</div>
													</div>


													<div class="hr hr-dotted"></div>


													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="freight">Total Freight:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="freight" id="freight" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['freight']; ?>" readonly />
															</div>
														</div>
													</div>
													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="insrance">Insurance:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="insrance" id="insrance" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['insurance']; ?>" />
															</div>
														</div>
													</div>
													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="otherch">Waybill Charges:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="waybillch" id="waybillch" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['waych']; ?>" />
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

													<div class="form-group" id="odasec" style="display:
															<?php
															$pinsql = mysqli_fetch_array(mysqli_query($dbConn, "select * from pincode where bname='$rowms[consignee_pincode]'"));
															if ($pinsql['bname'] == $rowms['consignee_pincode']) {
																echo "none";
															} else {
																echo "block";
															}
															?>;">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="oda">ODA Charges:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="oda" id="oda" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['odach']; ?>" />
															</div>
														</div>
													</div>


													<div class="space-2"></div>

													<div class="form-group" id="paysec" style="display:<?php if ($rowms['pay_mode'] == 1) {
																											echo "block";
																										} else {
																											echo "none";
																										} ?>" ;>
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="topay">To Pay Charges:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="topay" id="topay" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['topaych']; ?>" />
															</div>
														</div>
													</div>

													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="subtot">Sub Total:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="subtot" id="subtot" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['subtot']; ?>" readonly />
															</div>
														</div>
													</div>

													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="sgst">SGST(%):</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="sgst" id="sgst" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['sgst']; ?>" />
															</div>
														</div>
													</div>

													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consignno">CGST(%):</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="consignno" id="consignno" class="col-xs-12 col-sm-5" value="<?php echo $rowms['cgst']; ?>" required />
															</div>
														</div>
													</div>
													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="tot">Total:</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<input type="number" name="tot" id="tot" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['tot']; ?>" readonly />
															</div>
														</div>
													</div>

													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="desoff">Destination Office</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<select class="col-xs-12 col-sm-5" id="desoff" name="desoff">
																	<option value="">
																		<--------Select-------->
																	</option>
																	<?php
																	$sqltoi = mysqli_query($dbConn, "Select * from tbl_offices where status= 'A'");
																	while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																	?>
																		<option value="<?php echo $rwtoi['id']; ?>" <?php if ($rwtoi['id'] == $rowms['dest_off']) {
																														echo "selected";
																													} ?>><?php echo $rwtoi['off_name']; ?></option>
																	<?php
																	}
																	?>
																</select>
															</div>
														</div>
													</div>

													<div class="space-2"></div>
													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="book_status">Consignment Status</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<select class="col-xs-12 col-sm-5" id="book_status" name="book_status">
																	<option value="">
																		<--------Select-------->
																	</option>
																	<?php
																	$sqltoi = mysqli_query($dbConn, "Select * from book_status where status= 'A'");
																	while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																	?>
																		<option value="<?php echo $rwtoi['b_id']; ?>" <?php if ($rwtoi['b_id'] == $rowms['book_status']) {
																															echo "selected";
																														} ?>><?php echo $rwtoi['bname']; ?></option>
																	<?php
																	}
																	?>
																</select>
															</div>
														</div>
													</div>

													<div class="space-2"></div>

													<div class="form-group">
														<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="comment">Comment</label>

														<div class="col-xs-12 col-sm-9">
															<div class="clearfix">
																<textarea class="input-xlarge" name="comment" id="comment"><?php echo $rowms['comments']; ?></textarea>
															</div>
														</div>
													</div>
													<hr />
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
							?>
						</div>
					</div>
					<!-- CONSIGNMENT DETAILS - STATUS FORM - END -->
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
						var substringMatcher = function(strs) {
							return function findMatches(q, cb) {
								var matches, substringRegex;
								// an array that will be populated with substring matches
								matches = [];
								// regex used to determine if a string contains the substring `q`
								substrRegex = new RegExp(q, 'i');
								// iterate through the pool of strings and for any string that
								// contains the substring `q`, add it to the `matches` array
								$.each(strs, function(i, str) {
									if (substrRegex.test(str)) {
										// the typeahead jQuery plugin expects suggestions to a
										// JavaScript object, refer to typeahead docs for more info
										matches.push({
											value: str
										});
									}
								});
								cb(matches);
							}
						}

						function getTariff() {
							// ADD Consignment - Consignor's Details Feed Function - START
							var term = $("#custID").val();
							var term1 = $("#descity").val();
							if (term == "" || term == null) {
								alert("Please Select a Customer...");
								window.location.assign("add-consignment.php?ty=add");
							}
							if (term1 == "" || term1 == null) {
								alert("Please Select a Destination City before Choosing the Weight Type");
								window.location.assign("add-consignment.php?ty=add");
							}
							$.ajax({
								type: "POST",
								url: "verify-checks.php?key=3",
								data: "term=" + term + "&term1=" + term1,
								success: function(data) {
									$('#freightch').val(data[4]);
									$('#boxrtch').val(data[5]);
								}
							});
							// ADD Consignment - Consignor's Details Feed Function - END	
						}
						$("input[type='radio']").change(function() {
							getTariff();
							if ($(this).val() == "1") {
								$("#ActWgt").show();
								$("#BoxWgt").hide();
								$("#boxpkg").val($('#freightch').val());
								calculate();
							} else if ($(this).val() == "2") {

								$("#ActWgt").hide();
								$("#BoxWgt").show();
								$("#boxpkg").val($('#boxrtch').val());
								calculate1();
							}
						});

						$("#platform").change(function() {
							$("input[type=radio][name=gender]").prop('checked', false);
							if ($("#platform").val() == 1) {
								$("#paysec").show();
							} else {
								$("#paysec").hide();
							}
							if ($("#platform").val() == 1 || $("#platform").val() == 3) {
								// alert("Credit Pay,");
								document.getElementById("boxpkg").removeAttribute("readonly");
							}
							if ($("#platform").val() == 2) {
								// alert("Credit Pay,");
								document.getElementById("boxpkg").setAttribute("readonly", "true");

							}
						});

						// ADD Consignment - Consignor's Details Feed Function - START
						$("#custID").change(function() {
							var term = $("#custID").val();
							$.ajax({
								type: "POST",
								url: "verify-checks.php?key=2",
								data: "term=" + term,
								success: function(data) {
									// alert("Hello");
									$('#consignor').val(data[2]);
									$('#gstincon').val(data[4]);
									$('#phone').val(data[5]);
									$('#cusAddrs').val(data[6]);
									// $('#freightch').val(data[6]);
									// $('#boxrtch').val(data[7]);
									// $('#insrance').val(data[8]);
									// $('#waybillch').val(data[9]);
									// $('#otherch').val(data[10]);
									// $('#oda').val(data[11]);
									// $('#topay').val(data[12]);
								}
							});
						});
						// ADD Consignment - Consignor's Details Feed Function - END

						// Destination City Change - START
						$("#descity").change(function() {
							$("input[type=radio][name=gender]").prop('checked', false);
							getTariff();
						});
						// Destination City Change - END
						$(document).on("change keyup blur", "#pincode", function() {
							var pincode = $("#pincode").val();
							calpin(pincode);
						});

						function calpin(pincode) {
							$.ajax({
								type: "POST",
								url: "verify-checks.php?key=1",
								data: "pin=" + pincode,
								success: function(msg) {
									if (msg == 1) {
										$("#odasec").hide();
									} else if (msg == 2) {
										$("#odasec").show();
									}

								}
							});
						}
						$(document).on("change keyup blur", "#actualwgt", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#volwgth", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#volwgtw", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#volwgtl", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#volwgth1", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#volwgtw1", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#volwgtl1", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#volwgth2", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#volwgtw2", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#volwgtl2", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#volqty", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#volqty1", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#volqty2", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#cubft", function() {
							calculate();
						});
						$(document).on("change keyup blur", "#boxesrt", function() {
							calculate1();
						});


						$(document).on("change", "#freight", function() {
							calSubTot();
						});
						$(document).on("change", "#insrance", function() {
							calSubTot();
						});
						$(document).on("change", "#waybillch", function() {
							calSubTot();
						});
						$(document).on("change", "#otherch", function() {
							calSubTot();
						});
						$(document).on("change", "#topay", function() {
							calSubTot();
						});
						$(document).on("change", "#oda", function() {
							calSubTot();
						});
						$(document).on("change", "#sgst", function() {
							calTot();
						});
						$(document).on("change", "#consignno", function() {
							calTot();
						});

						function calTot() {
							var sgst = 0;
							var cgst = 0;
							var subtot = 0.0;
							var tot = 0.0;
							sgst = $("#sgst").val();
							cgst = $("#consignno").val();
							subtot = $("#subtot").val();
							tot = parseFloat(subtot) + (parseFloat(subtot) * (parseFloat(sgst) / 100)) + (parseFloat(subtot) * (parseFloat(cgst) / 100));
							$('#tot').val(tot.toFixed(2));
						}

						function calSubTot() {
							var freight = $("#freight").val();
							var insur = $("#insrance").val();
							var waybill = $("#waybillch").val();
							var otherch = $("#otherch").val();
							var topay = 0.0;
							if ($("#platform").val == 1) {
								topay = $("#topay").val();
							}

							var odach = 0.0;
							odach = $("#oda").val();
							var subtot = parseFloat(freight) + parseFloat(insur) + parseFloat(waybill) + parseFloat(otherch) + parseFloat(topay) + parseFloat(odach);
							$('#subtot').val(subtot.toFixed(2));
							calTot();
						}

						function calculate1() {
							var qty = $("#boxesrt").val();
							var price = $("#boxpkg").val();
							tot_price = (qty * price);

							$('#freight').val(tot_price.toFixed(2));
							$('#qty').val(qty);
							calSubTot();
						}

						function calculate() {
							var qty = $("#actualwgt").val();
							var hgt = $("#volwgth").val();
							var wgt = $("#volwgtw").val();
							var leng = $("#volwgtl").val();
							var qty1 = $("#volqty").val();
							var hgt1 = $("#volwgth1").val();
							var wgt1 = $("#volwgtw1").val();
							var leng1 = $("#volwgtl1").val();
							var qty2 = $("#volqty1").val();
							var hgt2 = $("#volwgth2").val();
							var wgt2 = $("#volwgtw2").val();
							var leng2 = $("#volwgtl2").val();
							var qty3 = $("#volqty2").val();
							var price = $("#boxpkg").val();
							var cubft = $("#cubft").val();
							var totqty = parseInt(qty1) + parseInt(qty2) + parseInt(qty3);
							$('#qty').val(totqty);
							tot_price = (qty * price);
							tot_price1 = (((((hgt * wgt * leng) / 1728) * cubft) * qty1) + ((((hgt1 * wgt1 * leng1) / 1728) * cubft) * qty2) + ((((hgt2 * wgt2 * leng2) / 1728) * cubft) * qty3)) * price;
							if (tot_price > tot_price1) {
								$('#freight').val(tot_price.toFixed(2));
							} else if (tot_price1 > tot_price) {
								$('#freight').val(tot_price1.toFixed(2));
							}
							calSubTot();

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
		<?php
		}
	}
		?>