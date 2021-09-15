<?php 
session_start();
include("database.php");
if((isset($_SESSION)) && (isset($_SESSION['uid']))) 
{
	$id=$_SESSION['uid'];
	if(isset($_POST['export_data']))
				{
					// --------------------------------------------------------------------------- start export excel --------------------------------------------------------------------------------
			//error_reporting (E_ALL ^ E_NOTICE); 
			require_once("excelwriter.class.php");
			$rec = array();
			$excel=new ExcelWriter("customerpaymentdetails.xls");
			if($excel==false)	
			echo $excel->error;
			$myArr=array("");
			$myArr=array("CUSTOMER PAYMENT DETAILS");
			$excel->writeLine($myArr);
			$myArr=array("");
			$excel->writeLine($myArr);
			$myArr=array("SNo", "Customer Id", "Customer Name", "GSTIN No", "Phone No.", "Address", "Payments", "Outstanding", "Repayment Date");
			$excel->writeLine($myArr);
			//echo "SELECT * from classified inner join district $condition";
			//$qry = mysqli_query($dbConn,"SELECT * from tbl_customer where status='A'");
			if($_POST['mobile'] != "" || $_POST['mobile1'] != "")
				{
					$mobile=" And tbl_customer.consignor_phone ='".$_POST['mobile']."' or tbl_customer.consignor_phone='".$_POST['mobile1']."'";
					$qry=mysqli_query($dbConn,"Select * from tbl_customer,cust_trans where tbl_customer.status='A' and tbl_customer.custID=cust_trans.cust_id $mobile");
				}
				else
				{
					$qry=mysqli_query($dbConn,"Select * from tbl_customer,cust_trans where tbl_customer.status='A' and tbl_customer.custID=cust_trans.cust_id");
				}	
			if($qry!=false)
			{
				$i=1;
				while($res=mysqli_fetch_array($qry))
				{ 
											
					$myArr=array($i,$res['custID'],$res['consignor_name'],$res['consignor_gst'],$res['consignor_phone'],$res['consignor_add'],$res['repaid'],$res['outstanding'],$res['repaydt']);
					array_push($rec,$myArr);
					$excel->writeLine($myArr);
					$i++;
				}
			}
		


		$file = "customerpaymentdetails.xls";	
		header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
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
									<?php echo $_SESSION['username'];?>
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
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
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
							<li class="active">	Customer</li>
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
									Payment History
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<h3 class="lighter block green">Customer Details</h3><div class="hr hr-dotted"></div>
							<form class="form-horizontal" method="POST" action="history.php">
							
								<div class="form-group" >
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="mobile">Customer Id:</label>
									<div class="col-xs-12 col-sm-9">
										<div class="clearfix">
											<input type="text" name="mobile" id="mobile" class="col-xs-12 col-sm-4 " />
											<input type="hidden" name="mobile1" id="mobile1" value="<?php if(isset($_POST['mobile'])) echo $_POST['mobile'];?>" class="col-xs-12 col-sm-4 " />
											<div class="col-xs-12 col-sm-5">
										<div class="clearfix">
											<button class="btn btn-success btn-next" type="Submit" name="search" id="search">Search</button>
											<button class="btn btn-success btn-next" type="Submit" name="export_data" id="export_data">Export to Excel</button>
										</div>
									</div>
											
										</div>
									</div>
									<div class="">
									
									</div>
								</div>
									
							</form>
							<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr>													
													<th>SNo</th>
													<th>Customer Id</th>
													<th>Customer Name</th>
													<th>GSTIN No.</th>
													<th>Phone No.</th>
													<th>Address</th>
													<th>Payments</th>
													<th>Outstanding</th>
													<th>Repayment Date</th>
													
												</tr>
											</thead>

											<tbody>
											<tr>
											<?php
											$i=0;
											if(isset($_POST['search']))
													{
														if($_POST['mobile'] != "")
															{
																$mobile=" And tbl_customer.consignor_phone ='".$_POST['mobile']."' or tbl_customer.custID='".$_POST['mobile']."'";
															
											$msql=mysqli_query($dbConn,"Select * from tbl_customer,cust_trans where tbl_customer.status='A' and tbl_customer.custID=cust_trans.cust_id $mobile");
											while($row=mysqli_fetch_array($msql))
											{
											?>
													<td class="center"> <?php echo $i=$i+1; ?></td>
													<td><a href="#"><?php echo $row['custID']; ?></a></td>
													<td><a href="#"><?php echo $row['consignor_name']; ?></a></td>
													<td><a href="#"><?php echo $row['consignor_gst']; ?></a></td>
													<td><a href="#"><?php echo $row['consignor_phone']; ?></a></td>
													<td><a href="#"><?php echo $row['consignor_add']; ?></a></td>
													<td><a href="#"><?php  echo $row['repaid'];  ?></a></td>
													<td><a href="#"><?php  echo $row['outstanding'];  ?></a></td>
													<td><a href="#"><?php  echo $row['repaydt'];  ?></a></td>
													</tr>
												<?php
												}
												}
													}
												?>
											</tbody>
										</table>
										</div><!-- /.span -->
								</div>
								</div>
								<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">PENTA LOGISTICS (XPRESS CARGO)</span>
							&copy; <?php echo date('Y');?>  Shakthisoftsolutions
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
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
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
	<?php
}
	?>