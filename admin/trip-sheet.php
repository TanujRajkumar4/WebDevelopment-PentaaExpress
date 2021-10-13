<?php
session_start();
include("database.php");
if ((isset($_SESSION)) && (isset($_SESSION['uid']))) {
	$id = $_SESSION['uid'];
	$user_type = $_SESSION['type'];
	// if ($user_type == "Branch") {
	// 	echo '<script>		
	// 		alert("You do not have access to this page, you will be redirected to the dashboard...");			
	// 		  </script>';
	// 	header("Refresh: 0; url= dashboard.php");

	// 	exit();
	// }

?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Trip Sheet - Admin</title>

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

	<body class="skin-3" id="body">
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
					<div class="page-content">
						<!-- /.ace-settings-container -->
						<div class="page-header">
							<h1>
								Consignment
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Trip Sheet
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<form class="form-horizontal" method="POST" action="trip-sheet.php">

									<div class="form-group">
										<div class="col-xs-12 col-sm-3">

											<a class="btn btn-success btn-next" href="" name="print-data" onclick="printpage('table');">Print</a>
											<a  class="btn btn-success btn-next" href="export.php?ty=ts" name="print-data" >Export to excel</a>
										</div>
									</div>
									<div class="">

									</div>
							</div>

							</form>
							<!-- PAGE CONTENT BEGINS -->
							<div class="row">
								<div class="col-xs-12">
									<div  id="table">
									<table id="simple-table" class="table  table-bordered table-hover">
										<thead>
											<tr>
												<th>SNo</th>
												<th>Waybill No</th>
												<th>Consignor's Details</th>
												<th>Consignee's Details</th>
												<th>Destination Office</th>
												<th>Qty</th>
											</tr>
										</thead>

										<tbody>
											<tr>
												<?php
												$today = date("d-m-Y");
												$number_of_page = 0;
												$i = 0;
												// pagination
												if (!isset($_GET['page'])) {
													$page = 1;
												} else {
													$page = $_GET['page'];
												}
												$result_per_page = 10;
												$Cust_Count = mysqli_num_rows(mysqli_query($dbConn, "Select * from tbl_courier,tbl_courier_track where tbl_courier_track.cons_no=tbl_courier.waybillno and tbl_courier_track.current_city='" . $_SESSION['orgid'] . "'and tbl_courier_track.bk_status='1' and tbl_courier_track.status='A'"));
												$page_first_result = ($page - 1) * $result_per_page;
												$msql = mysqli_query($dbConn, "Select * from tbl_courier,tbl_courier_track where tbl_courier_track.cons_no=tbl_courier.waybillno and tbl_courier_track.current_city='" . $_SESSION['orgid'] . "'and tbl_courier_track.bk_status='1' and tbl_courier_track.status='A' ORDER BY book_date DESC LIMIT " . $page_first_result . ',' . $result_per_page);
												$number_of_page = ceil($Cust_Count / $result_per_page); ?>
												<form id="trip-report" action="trip-sheet.php" method="POST">
													<?php while ($row = mysqli_fetch_array($msql)) {
													?>
														<td class="center"> <?php echo $i = $i + 1; ?></td>

														<td><a href="#"><?php echo $row['waybillno']; ?></a></td>
														<td><a href="#"><?php echo $row['consignor_name'] . ",<br>" . $row['consignor_phone'] . ",<br>" . $row['consignor_add'] ?></a></td>
														<td><a href="#"><?php echo $row['consignee_name'] . ",<br>" . $row['consignee_phone'] . ",<br>" . $row['consignee_add']; ?></a></td>
														<td><a href="#"><?php $dsql = mysqli_fetch_array(mysqli_query($dbConn, "Select * from tbl_offices where id='$row[dest_off]' and status='A'"));
																		echo $dsql['off_name']; ?></a></td>
														<td><a href="#"><?php echo $row['qty']; ?></a></td>

											</tr>
										<?php
													}
										?>
										</tbody>
									</table>
									</div>
									<div class="modal-footer no-margin-top">
										<ul class="pagination pull-right no-margin">
											<li class="prev">
												<a onclick="SetActivePage(1); SetActivePage(1);" href="trip-sheet.php?&page=1">
													<i class="ace-icon fa fa-angle-double-left"></i>
												</a>
											</li>
											<?php for ($page = 1; $page <= $number_of_page; $page++) { ?>
												<li id="<?php echo 'PageNo' . $page; ?>">
													<?php echo '<a onclick="SetActivePage(' . $page . '); SetActivePage(' . $page . ');" href = "trip-sheet.php?&page=' . $page . '">' . $page . ' </a>'; ?>
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
	</body>
<?php
} ?>