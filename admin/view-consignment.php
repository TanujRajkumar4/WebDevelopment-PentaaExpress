<?php
session_start();
include("database.php");
if ((isset($_SESSION)) && (isset($_SESSION['uid']))) {
	$id = $_SESSION['uid'];
	$title = "View Consignment";

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
							<li class="active"> Consignment</li>
						</ul><!-- /.breadcrumb -->
						<div class="page-header">
							<h1>
								<?php echo "Consignment"; ?>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<?php echo "View & Update"; ?>
								</small>
							</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-12">
										<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th>SNo</th>
													<th>Update</th>
													<th>Waybill No</th>
													<th>Status</th>
													<th>Consignor's Details</th>
													<th>Consignee's Details</th>
													<th>Destination Office</th>
													<th class="hidden-480">Action</th>
												</tr>
											</thead>

											<tbody>
												<tr>
													<?php
													$i = 0;

													// PAGINATION - START
													if (!isset($_GET['page'])) {
														$page = 1;
													} else {
														$page = $_GET['page'];
													}
													$results_per_page = 10;
													$msql = mysqli_query($dbConn, "Select * from tbl_courier where status='A' ORDER BY waybillno DESC");
													$Cust_Count = mysqli_num_rows($msql);
													$page_first_result = ($page - 1) * $results_per_page;
													$msql = mysqli_query($dbConn, "Select * from tbl_courier where status='A' ORDER BY waybillno DESC LIMIT " . $page_first_result . ',' . $results_per_page);
													$number_of_page = ceil($Cust_Count / $results_per_page);
													// PAGINATION - END
													?>
													<form id="UpdateConsignment" action="UpdateConsignment.php" method="POST">
														<?php
														while ($row = mysqli_fetch_array($msql)) {
															$WayBillNo = $row['waybillno'];
															$ConsignmentStatusSQL1 = mysqli_query($dbConn, "SELECT * from tbl_courier_track where status='A' AND cons_no = '$WayBillNo' ");
															$row_book_status1 = mysqli_fetch_array($ConsignmentStatusSQL1);
															$ConsignmentStatusID = $row_book_status1['bk_status'];

															$ConsignmentStatusSQL = mysqli_query($dbConn, "SELECT * from book_status where status='A' AND b_id = '$ConsignmentStatusID' ");
															$row_book_status = mysqli_fetch_array($ConsignmentStatusSQL);
															$ConsignmentStatusName = $row_book_status['bname'];
														?>
															<td class="center"> <?php echo $i = $i + 1; ?></td>
															<td class="center"><input type="checkbox" name="SelectedWayBill[]" value="<?php echo $row['waybillno']; ?>"></td>
															<td><a href="#"><?php echo $row['waybillno']; ?></a></td>
															<td><a href="#"><?php echo $ConsignmentStatusName ?></a></td>

															<td><a href="#"><?php echo $row['consignor_name'] . "," . $row['consignor_phone'] . "," . $row['consignor_add'] ?></a></td>
															<td><a href="#"><?php echo $row['consignee_name'] . "," . $row['consignee_phone'] . "," . $row['consignee_add']; ?></a></td>
															<td><a href="#"><?php $dsql = mysqli_fetch_array(mysqli_query($dbConn, "Select * from tbl_offices where id='$row[dest_off]' and status='A'"));
																			echo $dsql['off_name']; ?></a></td>
															<td class="hidden-480 center">
																<a href="add-consignment.php?ty=edit&editid=<?php echo $row[0]; ?>">
																	<span class="btn btn-sm btn-primary bigger-110"><i class="ace-icon fa fa-pencil bigger-110"></i>Edit</span></a>
																<!-- <a href="add-consignment.php?ty=status&editid=<?php echo $row[0]; ?>">
																	<span class="btn btn-sm btn-success bigger-110"><i class="ace-icon fa fa-fire bigger-110"></i>Update</span></a> -->

																<a href="add-consignment.php?ty=del&delid=<?php echo $row[0]; ?>">
																	<span class="btn btn-sm btn-danger bigger-110"><i class="ace-icon fa fa-trash-o  bigger-110"></i>Delete</span></a>

															</td>


												</tr>
											<?php
														}
											?>

											</tbody>

										</table>

										<div class="modal-footer no-margin-top">
											<div class="row">
												<p class="text-left warning-text">Update the selected Way Bill Numbers to the Status below:</p>
											</div>
											<select class="col-xs-12 col-sm-3" id="Book_Status_Update" name="Book_Status_Update">
												<?php

												$sqltoi = mysqli_query($dbConn, "SELECT * FROM book_status WHERE status= 'A'");

												?>

												<?php
												while ($rwtoi = mysqli_fetch_array($sqltoi)) {
												?>
													<option value="<?php echo $rwtoi['b_id']; ?>"><?php echo $rwtoi['bname']; ?></option>
												<?php
												}
												?>
											</select>

											<input value="Update Status" name="UpdateConsignment" type="submit" class="btn btn-sm btn-danger pull-left" data-dismiss="modal" />

											<ul class="pagination pull-right no-margin">
												<li class="prev">
													<a onclick="SetActivePage(1); SetActivePage(1);" href="view-consignment.php?&page=1">
														<i class="ace-icon fa fa-angle-double-left"></i>
													</a>
												</li>
												<?php for ($page = 1; $page <= $number_of_page; $page++) { ?>
													<li id="<?php echo 'PageNo' . $page; ?>">
														<?php echo '<a onclick="SetActivePage(' . $page . '); SetActivePage(' . $page . ');" href = "view-consignment.php?&page=' . $page . '">' . $page . ' </a>'; ?>
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
									</div><!-- /.span -->
								</div><!-- /.row -->
							</div>
							</form>
							<!-- PAGE CONTENT ENDS -->
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

					<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
					<script src="assets/js/jquery-ui.custom.min.js"></script>
					<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
					<script src="assets/js/jquery.easypiechart.min.js"></script>
					<script src="assets/js/jquery.sparkline.index.min.js"></script>
					<script src="assets/js/jquery.flot.min.js"></script>
					<script src="assets/js/jquery.flot.pie.min.js"></script>
					<script src="assets/js/jquery.flot.resize.min.js"></script>

					<!-- ace scripts -->
					<script src="assets/js/ace-elements.min.js"></script>
					<script src="assets/js/ace.min.js"></script>
				<?php

			}
				?>