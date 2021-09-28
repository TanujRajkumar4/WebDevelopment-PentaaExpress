	<?php 
session_start();
include("database.php");
if((isset($_SESSION)) && (isset($_SESSION['uid']))) 
{
	$id=$_SESSION['uid'];
	if(isset($_GET['ty']))
	{
		$chid="";
		if($_GET['ty'] =='ts')
		{
			$tbl="toi";
			$title="Type of Consignment";
		}
		elseif($_GET['ty'] =='bm')
		{
			$tbl="book_meth";
			$title="Unit of Measurement";
		}
		elseif($_GET['ty'] =='pm')
		{
			$tbl="pay_meth";
			$title="Payment Method";
		}
		elseif($_GET['ty'] =='cty')
		{
			$tbl="city";
			$title="City";
			$chid="";
		}
		elseif($_GET['ty'] =='bx')
		{
			$tbl="freight_ch";
			$title="Box Rate";
			$chid=" and b_id='2'";
		}
		elseif($_GET['ty'] =='pin')
		{
			$tbl="pincode";
			$title="Pincode";
		}
		elseif($_GET['ty'] =='s')
		{
			$tbl="book_status";
			$title="Booking Status";
		}
		
	if(isset($_POST['Submit']))
		{
			$sql=mysqli_query($dbConn,"INSERT INTO ".$tbl." VALUES (NULL,'$_POST[masters]','A')");
			echo $sql;
			if($sql)
				{
					echo "<script>alert('Inserted Successfully');window.location.href = 'add-master.php?ty=$_GET[ty]&ac=ins';</script>";
				}
			else
				{
					echo "<script>alert('Not Inserted');window.location.href = 'add-master.php?ty=$_GET[ty]&ac=ins';</script>";
				}
		}	
		if(isset($_POST['update']))
		{
			$sql=mysqli_query($dbConn,"UPDATE ".$tbl." SET `bname`='$_POST[masters]' WHERE `b_id`=$_GET[editid] and `status`='A'  $chid");
			echo $sql;
			if($sql)
				{
					echo "<script>alert('Updated Successfully');window.location.href = 'add-master.php?ty=$_GET[ty]&ac=ins';</script>";
				}
			else
				{
					echo "<script>alert('Not Updated');window.location.href = 'add-master.php?ty=$_GET[ty]&ac=ins';</script>";
				}
		}		
		
		if($_GET['ac'] == 'del')

		{

			$sql="DELETE FROM ".$tbl." WHERE b_id='$_GET[delid]'";

			if(mysqli_query($dbConn,$sql))

			{

				echo "<script>alert('Record Deleted Successfully');

				window.location.href = 'add-master.php?ty=$_GET[ty]&ac=ins';</script>";

			}

			else

			{

				echo "<script>alert('Error in Deleting the record');

				window.location.href = 'add-master.php?ty=$_GET[ty]&ac=ins';</script>";

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

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="skin-3">
		<?php if($_SESSION['type']=="HO"){?>
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
							<li class="active">Masters</li>
						</ul><!-- /.breadcrumb -->

<!-- /.nav-search -->
					</div>
<?php
if($_GET['ac'] == "ins")
{
	?>		<div class="page-content">
						<!-- /.ace-settings-container -->
						<div class="page-header">
							<h1>
								Add Master Entry
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<?php echo $title;?>
								</small>
							</h1>
						</div><!-- /.page-header -->
<?php if($_GET['ty'] != "fre"  && $_GET['ty'] != "bx")
{
	?>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form" action="" method="POST">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <?php echo $title;?> </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="masters" id="masters" placeholder="<?php echo $title;?>" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit" name="Submit" id="Submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<?php
}
?>
	
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-12">
										<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr>													
													<th>SNo</th>
													<th><?php echo $title;?></th>
													<th class="hidden-480">Action</th>
												</tr>
											</thead>

											<tbody>
											<tr>
											<?php
											$i=0;
											$msql=mysqli_query($dbConn,"Select * from ".$tbl." where status='A' $chid");
											while($row=mysqli_fetch_array($msql))
											{
											?>
													<td class="center"> <?php echo $i=$i+1; ?></td>
													<td>
														<a href="#"><?php echo $row[1]; ?></a>
													</td>
													<td class="hidden-480">
													<a href="add-master.php?ty=<?php echo $_GET['ty'];?>&editid=<?php echo $row[0];?>&ac=edt">
														<span class="btn btn-app btn-primary btn-xs"><i class="ace-icon fa fa-pencil bigger-120"></i></span></a>
													<?php if($_GET['ty'] != "fre" && $_GET['ty'] != "bx")
													{
														?>
														<a href="add-master.php?ty=<?php echo $_GET['ty'];?>&delid=<?php echo $row[0];?>&ac=del">
														<span class="btn btn-app btn-danger btn-xs"><i class="ace-icon fa fa-trash-o  bigger-120"></i></span></a>
													<?php
													}
													?>
													</td>
													
																										
												</tr>
												<?php
												}
												?>
											</tbody>
										</table>
									</div><!-- /.span -->
								</div><!-- /.row -->
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div>
					</div>
					<?php
}
			?>
			
<?php
if($_GET['ac'] == "edt")
{
	$sqlms=mysqli_query($dbConn,"Select * from ".$tbl." where b_id = '".$_GET['editid']."'");
	$rowms=mysqli_fetch_array($sqlms);
	?>		<div class="page-content">
						<!-- /.ace-settings-container -->
						<div class="page-header">
							<h1>
								Edit Master Entry
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<?php echo $title;?>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" role="form" action="add-master.php?ty=<?php echo $_GET['ty'];?>&editid=<?php echo $_GET['editid'];?>&ac=edt" method="POST">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <?php echo $title;?> </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="masters" id="masters" placeholder="<?php echo $title;?>" value="<?php echo $rowms[1];?>" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit" name="update" id="update">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					
					</div>
					<?php
}
			?>
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
				
	</body>	<?php
	}
	// redirecting to dashboard  
	else{
		header("Refresh: 5; url= dashboard.php");
		echo "<h1>You don't have access to this page, you'll be redirected to dashboard in 5 seconds</h1>";
	}
	} } ?> 