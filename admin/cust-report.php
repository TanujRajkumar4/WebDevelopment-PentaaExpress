<?php
session_start();
include("database.php");
$total = 0;
if ((isset($_SESSION)) && (isset($_SESSION['uid']))) {
	$id = $_SESSION['uid'];

?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Report - Admin</title>

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
	<script type="text/javascript">
		function printpage(paravalue) {
			var body = document.body.innerHTML;
			var table = document.getElementById(paravalue).innerHTML;
			document.body.innerHTML = table;
			window.print();
			document.body.innerHTML = body;
		}
	</script>

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

			<div id="sidebar" class="sidebar  responsive  ace-save-state">
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
							<li class="active"> Customer</li>
						</ul><!-- /.breadcrumb -->

						<!-- /.nav-search -->
					</div>
					<div class="page-content">
						<!-- /.ace-settings-container -->
						<div class="page-header">
							<h1>
								Customer
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Report
								</small>
							</h1>
						</div><!-- /.page-header -->


						<div class="row">
							<div class="col-xs-12">
								<div class="widget-box">
									<div class="widget-header widget-header-blue widget-header-flat">
										<h4 class="widget-title lighter">Payment Details</h4>
									</div>
									<div class="widget-body">
										<div class="widget-main">
											<div>
												<div class="step-content pos-rel">
													<div class="step-pane active">
														<form class="form-horizontal" method="POST" action="cust-report.php">

															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="branch">Branch:</label>
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<select class="col-xs-12 col-sm-3" id="branch" name="branch" required>
																			<?php
																			$sqltoi = mysqli_query($dbConn, "Select * from tbl_offices where status= 'A'");
																			if ($id == 10) { ?>
																				<option value="">
																					<-----Branch----->
																				</option>
																				<?php }
																			while ($rwtoi = mysqli_fetch_array($sqltoi)) {
																				if ($id == 10) {
																				?>
																					<option value="<?php echo $rwtoi['id']; ?>"><?php echo $rwtoi['off_name']; ?></option>
																				<?php
																				}
																			}
																			if ($id != 10) {
																				$sql1 = mysqli_query($dbConn, "Select * from tbl_offices where id = $id ");
																				$row1 = mysqli_fetch_array($sql1) ?>
																				<option value="<?php echo $row1['id']; ?>"><?php echo $row1['off_name']; ?></option> <?php	} ?>
																		</select>
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right">Customer Type:</label>
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<select class="col-xs-12 col-sm-3" id="cus_type" name="cus_type" required>
																			<option value="">
																				<-----Customer Type----->
																			</option>
																			<?php
																			$sqltoi = mysqli_query($dbConn, "Select * from pay_meth where status= 'A'");
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
																<label class="control-label col-xs-12 col-sm-3 no-padding-right">Between:</label>
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<div class="col-xs-12 col-sm-3">
																			<div class="input-group">
																				<input class="form-control date-picker" id="id-date-picker-1" name="id-date-picker-1" type="text" data-date-format="yyyy-mm-dd" required />
																				<span class="input-group-addon">
																					<i class="fa fa-calendar bigger-110"></i>
																				</span>
																			</div>
																			<div class="input-group">
																				<input class="form-control date-picker" id="id-date-picker-1" name="id-date-picker-2" type="text" data-date-format="yyyy-mm-dd" required />
																				<span class="input-group-addon">
																					<i class="fa fa-calendar bigger-110"></i>
																				</span>
																			</div>
																			<div class="space"></div>
																			<div class="col-xs-12 col-sm-12">
																				<div style="padding-left: 30%;">
																					<button class="btn btn-success btn-next" type="Submit" name="search">Search</button>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-xs-12 col-sm-3" style="padding-left: 80%;">
																<a class="btn btn-success btn-next" href="" name="print-data" onclick="printpage('table');">Print</a>
															</div>
															<div style="padding-left: 85%;">
																<span class="menu-text" style="font-size: 23px;">Total:<?php echo $total; ?></span>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12">
								<div class="hr hr-dotted"></div>
								<div class="row" id="table">
									<div class="col-xs-12">
										<table id='dynamic-table' class='table table-striped table-bordered table-hover'>
											<thead>
												<tr>
													<th>SNo</th>
													<th>Name & Address</th>
													<th>Amount</th>
													<th>Type</th>

												</tr>
											</thead>

											<tbody>
												<tr>
													<?php
													$number_of_page=0;
													$filters = "";
													if (isset($_POST['search']) and isset($_POST['cus_type'])) {
														$i = 0;
														// pagination
														if (!isset($_GET['page'])) {
															$page = 1;
														} else {
															$page = $_GET['page'];
														}
														$result_per_page = 10;
														$Cust_Count = mysqli_num_rows(mysqli_query($dbConn, "select * from tbl_transactions where status='A'"));
														$page_first_result = ($page - 1) * $result_per_page;
														$filters = "Select * from tbl_transactions where Tran_Date between '" . $_POST['id-date-picker-1'] . "' and '" . $_POST['id-date-picker-2'] . "' and Branch_id='" . $_POST['branch'] . "' and Pay_Meth_ID='" . $_POST['cus_type'] . "' and status='A' ORDER BY Tran_ID DESC LIMIT ".$page_first_result.','.$result_per_page;
														$msql = mysqli_query($dbConn, $filters);
														$number_of_page = ceil($Cust_Count / $result_per_page); ?>
														<form id="cust-report" action="cust-report.php" method="POST">
															<?php while ($row = mysqli_fetch_array($msql)) {
															?>
																<td class="center"> <?php echo $i = $i + 1; ?></td>
																<?php

																if ($_POST['cus_type'] == 1) {
																	$debit = mysqli_fetch_array(mysqli_query($dbConn, "Select  SUM(`Tran_Amt`) AS Debit_Total from tbl_transactions where `Tran_Type` = 'Dr' and `Pay_Meth_ID` ='" . $_POST['cus_type'] . "' "));
																	$debit['Debit_Total'];
																	$GLOBALS['total'] = 100;
																	$row1 = mysqli_fetch_array(mysqli_query($dbConn, "select * from tbl_customer where custID= '" . $row['Cust_ID'] . "'"));
																?>
																	<td><a href="#"><?php echo $row1['consignor_name'] . ",<br>" . $row1['consignor_phone'] . ",<br>" . $row1['consignor_add']; ?></a></td>
																	<td><a href="#"><?php echo $row['Tran_Amt']; ?></a></td>
																	<td><a href="#">Topay</td>
																<?php
																} elseif ($_POST['cus_type'] == 2) {
																	$credit = mysqli_fetch_array(mysqli_query($dbConn, "Select sum(`Tran_Amt`) AS Credit_Total from tbl_transactions where Tran_Type = 'Cr' and Pay_Meth_ID ='" . $_POST['cus_type'] . "' "));
																	echo $credit['Credit_Total'];
																	$row1 = mysqli_fetch_array(mysqli_query($dbConn, "select * from tbl_customer where custID= '" . $row['Cust_ID'] . "'"));
																?>
																	<td><a href="#"><?php echo $row1['consignor_name'] . ",<br>" . $row1['consignor_phone'] . ",<br>" . $row1['consignor_add']; ?></a></td>
																	<td><a href="#"><?php echo $row['Tran_Amt']; ?></a></td>
																	<td><a href="#">Credit</td>
																<?php
																} elseif ($_POST['cus_type'] == 3) {
																	$credit = mysqli_fetch_array(mysqli_query($dbConn, "Select sum(`Tran_Amt`) AS Topay_Total from tbl_transactions where Tran_Type = 'Dr' and Pay_Meth_ID ='" . $_POST['cus_type'] . "' "));
																	echo $credit['Topay_Total'];
																	$row1 = mysqli_fetch_array(mysqli_query($dbConn, "select * from tbl_customer where custID= '" . $row['Cust_ID'] . "'"));
																?>
																	<td><a href="#"><?php echo $row1['consignee_name'] . ",<br>" . $row1['consignee_phone'] . ",<br>" . $row1['consignee_add']; ?></a></td>
																	<td><a href="#"><?php echo $row['Tran_Amt']; ?></a></td>
																	<td><a href="#">Pre-paid</td>
																<?php
																}
																?>
												</tr>

										<?php }
														}
										?>
											</tbody>
										</table>
										<div class="modal-footer no-margin-top">
											<ul class="pagination pull-right no-margin">
												<li class="prev">
													<a onclick="SetActivePage(1); SetActivePage(1);" href="cust-report.php?&page=1">
														<i class="ace-icon fa fa-angle-double-left"></i>
													</a>
												</li>
												<?php for ($page = 1; $page <= $number_of_page; $page++) { ?>
													<li id="<?php echo 'PageNo' . $page; ?>">
														<?php echo '<a onclick="SetActivePage(' . $page . '); SetActivePage(' . $page . ');" href = "cust-report.php?&page=' . $page . '">' . $page . ' </a>'; ?>
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
										</form>
									</div><!-- /.span -->
								</div><!-- /.row -->
							</div>
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

				<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
				<script src="assets/js/bootstrap-datepicker.min.js"></script>

				<!-- ace scripts -->
				<script src="assets/js/ace-elements.min.js"></script>
				<script src="assets/js/ace.min.js"></script>
				<script>
					$('.date-picker').datepicker({
							autoclose: true,
							todayHighlight: true
						})
						//show datepicker when clicking on the icon
						.next().on(ace.click_event, function() {
							$(this).prev().focus();
						});
				</script>
			<?php
		}
			?>