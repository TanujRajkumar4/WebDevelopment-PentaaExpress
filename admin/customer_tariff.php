<?php
session_start();
include("database.php");
if ((isset($_SESSION)) && (isset($_SESSION['uid']))) {

	$id = $_SESSION['uid'];
	$user_type = $_SESSION['type'];
	$title = "Customer Tariff";

	if ($user_type == "Branch") {
		// echo '<script>		
		// 	alert("You do not have access to this page, you will be redirected to the dashboard...");			
		// 	  </script>';
		header("Refresh: 0; url= error-403.php");
		exit();
	}

	if (isset($_GET['ty'])) {
		if ($_GET['ty'] == 'add') {
			$title;
		} elseif ($_GET['ty'] == "edit") {
			$title = "Edit Tariff";
		}

		if (isset($_GET['ac'])) {
			if ($_GET['ac'] == "ins") {
				$qry = "INSERT INTO `customer_tariff`(`Branch_ID`,`City_ID`,`Price_KG`,`Price_Box`,`Cust_ID`) VALUES('" . $_POST['branch'] . "','" . $_POST['destination'] . "','" . $_POST['Kg'] . "','" . $_POST['Box'] . "','" . $_GET['cid'] . "')";
				$sql = mysqli_query($dbConn, $qry);
				$CustID = $_GET['cid'];
				if ($sql) {
					echo "<script>alert('Inserted Sucessfully');window.location.href = 'customer_tariff.php?ty=add&cid=$CustID';</script>";
				} else {
					// echo $qry;
					echo "<script>alert('Not Inserted');window.location.href = 'customer_tariff.php?ty=add&cid=$CustID';</script>";
				}
			}
			if ($_GET['ac'] == "upd") {
				$qry = "UPDATE `customer_tariff` SET `Price_KG`='" . $_POST['Kg'] . "',`Price_Box`='" . $_POST['Box'] . "'WHERE `CT_ID`='" . $_GET['TID'] . "'";
				$sql = mysqli_query($dbConn, $qry);
				$CustID = $_GET['CID'];
				if ($sql) {
					// echo $qry;
					echo "<script>alert('Updated Successfully');window.location.href = 'customer_tariff.php?ty=add&cid=$CustID';</script>";
				} else {
					echo "<script>alert('Not Updated');window.location.href = 'customer_tariff.php?ty=add&cid=$CustID';</script>";
				}
			}
		}

		if ($_GET['ty'] == "del") {
			$sql = "DELETE FROM customer_tariff WHERE CT_ID='" . $_GET['TID'] . "'";
			$CustID = $_GET['CID'];
			if (mysqli_query($dbConn, $sql)) {
				echo "<script>alert('Record Deleted Successfully');

					window.location.href = 'customer_tariff.php?ty=add&cid=$CustID';</script>";
			} else {
				echo "<script>alert('Error in Deleting the record');

					window.location.href = 'customer_tariff.php?ty=add&cid=$CustID';</script>";
			}
		}


?>
		<!DOCTYPE html>
		<html lang="en">

		<head>
			<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
			<meta charset="utf-8" />
			<title>Masters - Admin</title>

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
								<li class="active"> Tariff</li>
							</ul><!-- /.breadcrumb -->
						</div>
						<?php
						if ($_GET['ty'] == "add") { ?>
							<div class="page-content">
								<!-- /.ace-settings-container -->
								<div class="page-header">
									<h1>
										<?php echo "Customer Tariff"; ?>
										<small>
											<i class="ace-icon fa fa-angle-double-right"></i>
											<?php echo "Add"; ?>
										</small>
									</h1>
								</div><!-- /.page-header -->
								<div class="row">
									<div class="col-xs-12">
										<!-- PAGE CONTENT BEGINS -->
										<div class="widget-box">
											<div class="widget-header widget-header-blue widget-header-flat">
												<h4 class="widget-title lighter">Tariff Details</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<div>
														<div class="step-content pos-rel">
															<div class="step-pane active">


																<form class="form-horizontal" method="POST" action="customer_tariff.php?ac=ins&ty=<?php echo $_GET['ty']; ?>&cid=<?php echo $_GET['cid']; ?>">
																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Kg">Customer ID:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<input type="text" name="Kg" id="Kg" class="col-xs-12 col-sm-3" required disabled value="<?php echo $_GET['cid']; ?>">
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="branch">Branch</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<select class="col-xs-12 col-sm-3" id="branch" name="branch" required>
																					<option value="">
																						<--------Select-------->
																					</option>
																					<?php
																					$sqltoi = mysqli_query($dbConn, "Select * from tbl_offices where status= 'A'");
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
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="destination">Destination City</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<select class="col-xs-12 col-sm-3" id="destination" name="destination" required>
																					<option value="">
																						<--------Select-------->
																					</option>
																					<?php
																					$sqltoi = mysqli_query($dbConn, "Select * from city");
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
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Kg">Price per Kg:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">
																				<input type="number" name="Kg" id="Kg" class="col-xs-12 col-sm-3" required />
																			</div>
																		</div>
																	</div>

																	<div class="space-2"></div>

																	<div class="form-group">
																		<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Box">Price per Box:</label>

																		<div class="col-xs-12 col-sm-9">
																			<div class="clearfix">

																				<input type="number" id="Box" name="Box" class="col-xs-12 col-sm-3" required />
																			</div>
																		</div>
																	</div>
																	<div style="padding-left: 30%;">
																		<button class="btn btn-success btn-next" onclick="window.location.assign('add-customer.php?ty=add')">
																			Back
																		</button>
																		<button class="btn btn-success btn-next" type="Submit">
																			Add to Tariff
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
										<div class="hr hr-dotted"></div>
										<div class="page-header">
											<h1>
												<?php echo "Customer Tariff"; ?>
												<small>
													<i class="ace-icon fa fa-angle-double-right"></i>
													<?php echo "Edit"; ?>
												</small>
											</h1>
										</div><!-- /.page-header -->
										<!-- <div class="form-group" style="padding-bottom: 10px;"> -->
										<!-- <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Kg">Customer ID:</label>
										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												<input type="text" name="Kg" id="Kg" class="col-xs-12 col-sm-3" required disabled value="<?php echo $_GET['cid']; ?>">
											</div>
										</div> -->
										<!-- </div> -->

										<?php
										$exportdt = "";
										$exportdt .= "<div class='row'>";
										$exportdt .= "<div class='col-xs-12'>";
										$exportdt .= "<table id='dynamic-table' class='table table-striped table-bordered table-hover'>";
										$exportdt .= "<thead>";
										$exportdt .= "<tr><th>SNo</th>
													<th>Booking Branch - City</th>
													<th>Destination City</th>
													<th>Price per KG</th>
													<th>Price per Box</th>
													<th class='hidden-480'>Action</th>
													</tr>
											</thead>

											<tbody>
											<tr>";
										$i = 0;
										$msql = mysqli_query($dbConn, "SELECT * FROM customer_tariff WHERE Status='A' AND Cust_ID = '$_GET[cid]' ");
										while ($row = mysqli_fetch_array($msql)) {
											$i = $i + 1;
											$rowbranch = mysqli_fetch_array(mysqli_query($dbConn, "SELECT * from tbl_offices where id=$row[Branch_ID] AND Status= 'A'"));
											$dsql = mysqli_fetch_array(mysqli_query($dbConn, "SELECT * from city where b_id='$row[City_ID]' AND Status = 'A' "));
											$dsql1 = mysqli_fetch_array(mysqli_query($dbConn, "SELECT * from city where b_id='$rowbranch[city]' AND Status = 'A' "));
											$exportdt .= "	<td class='center'>$i</td>";
											$exportdt .= "<td>" . $dsql1['bname'] . "</td>";
											$exportdt .= "<td>" . $dsql['bname'] . "</td>";
											$exportdt .= "<td>" . $row['Price_KG'] . "</td>";
											$exportdt .= "<td>" . $row['Price_Box'] . "</td>";
											$exportdt .= "<td class='hidden-480'><a href='customer_tariff.php?ty=edit&TID=$row[CT_ID]&CID=$row[Cust_ID]'><span class='btn btn-sm btn-primary bigger-110'><i class='ace-icon fa fa-pencil bigger-110'></i>Edit</span></a>
														<a href='customer_tariff.php?ty=del&TID=$row[CT_ID]&CID=$row[Cust_ID]'><span class='btn btn-sm btn-danger bigger-110'><i class='ace-icon fa fa-trash-o  bigger-110'></i>Delete</span></a></td></tr>";
										}

										$exportdt .= "</tbody>
										</table>
									</div><!-- /.span -->
								</div><!-- /.row -->";
										echo $exportdt;

										?>
									</div>
								</div><!-- /.span -->
							</div><!-- /.row -->
						<?php } ?>
						<!-- PAGE CONTENT ENDS -->
						<?php
						if (isset($_GET['ty'])) {
							if ($_GET['ty'] == "edit") {
								// $sql1 = mysqli_query($dbConn, "Select * from tbl_offices where id= '" . $_GET['b_id'] . "'");
								// $row1 = mysqli_fetch_array($sql1);
								// $sql2 = mysqli_query($dbConn, "Select * from city where b_id= '" . $_GET['c_id'] . "'");
								// $row2 = mysqli_fetch_array($sql2);
								// $sql3 = mysqli_query($dbConn, "Select * from tariff");
								// $row3 = mysqli_fetch_array($sql3);
								// TANUJ
								$row = mysqli_fetch_array(mysqli_query($dbConn, "SELECT * from customer_tariff where CT_ID=$_GET[TID] AND Status= 'A'"));
								$BranchName = mysqli_fetch_array(mysqli_query($dbConn, "SELECT * from tbl_offices where id=$row[Branch_ID] AND Status= 'A'"));
								$CityNameFromID = mysqli_fetch_array(mysqli_query($dbConn, "SELECT * from city where b_id='$row[City_ID]' AND Status = 'A' "));
								$CityNameFromID1 = mysqli_fetch_array(mysqli_query($dbConn, "SELECT * from city where b_id='$BranchName[city]' AND Status = 'A' "));

						?> <div class="page-content">
									<!-- /.ace-settings-container -->
									<div class="page-header">
										<h1>
											Customer Tariff
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo "Edit"; ?>
											</small>
										</h1>
									</div><!-- /.page-header -->

									<div class="row">
										<div class="col-xs-12">
											<!-- PAGE CONTENT BEGINS -->
											<form class="form-horizontal" method="POST" action="customer_tariff.php?ac=upd&ty=edit&TID=<?php echo $_GET['TID']; ?>&CID=<?php echo $_GET['CID']; ?>  ">
												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Kg">Customer ID:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="text" name="Kg" id="Kg" class="col-xs-12 col-sm-3" required disabled value="<?php echo $_GET['CID']; ?>">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="branch">Branch Name:</label>
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="text" name="branch" id="branch" class="col-xs-12 col-sm-3" value="<?php echo $CityNameFromID1['bname']; ?>" readonly />
														</div>
													</div>
												</div>

												<div class="space-2"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="destination">Destination City:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="text" name="destination" id="destination" class="col-xs-12 col-sm-3" value="<?php echo $CityNameFromID['bname']; ?>" readonly />
														</div>
													</div>
												</div>
												<div class="space-2"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Kg">Price per Kg:</label>
													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">
															<input type="text" name="Kg" id="Kg" class="col-xs-12 col-sm-3" value="<?php echo $row['Price_KG']; ?>" required />
														</div>
													</div>
												</div>

												<div class="space-2"></div>

												<div class="form-group">
													<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Box">Price per Box:</label>

													<div class="col-xs-12 col-sm-9">
														<div class="clearfix">

															<input type="text" id="Box" name="Box" class="col-xs-12 col-sm-3" value="<?php echo $row['Price_Box']; ?>" required />
														</div>
													</div>
												</div>

												<div style="padding-left: 26%;">
													<button class="btn btn-success" onclick="window.location.assign('add-customer.php?ty=add')">
														Back
													</button>
													<button class="btn btn-success btn-next " type="submit">
														Update
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
}
		?>