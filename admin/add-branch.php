<?php 
session_start();
include("database.php");
if((isset($_SESSION)) && (isset($_SESSION['uid']))) 
{
	$id=$_SESSION['uid'];
	$user_type=$_SESSION['type'];
	if ($user_type == "Branch") {
		echo '<script>		
			alert("You do not have access to this page, you will be redirected to the dashboard...");			
			  </script>';
		header("Refresh: 0; url= dashboard.php");

		exit();
	}	
	
	if(isset($_GET['ty']))
	{
		if($_GET['ty'] =='add')
		{ $mobile="";
			$title="Add Branch";
			if(isset($_POST['search']))
				{
					if($_POST['mobile'] != "")
						{
							$mobile=" And ph_no ='".$_POST['mobile']."'";
						}
				}
				
		}
		elseif($_GET['ty'] =='edit')
		{
			$title="Edit Branch";
		}
		
		
		if(isset($_GET['ac']))
		{
			if($_GET['ac'] =="ins")
			{
				$today=date("Y-m-d");
				$qry="INSERT INTO `tbl_offices`(`id`, `off_name`, `address`, `city`, `ph_no`, `office_time`, `contact_person`, `status`) VALUES (NULL,'".$_POST['consignor']."','".$_POST['cusAddrs']."','".$_POST['gstincon']."','".$_POST['phone']."','".$_POST['timing']."','".$_POST['conper']."','A')";
				$sql=mysqli_query($dbConn,$qry);
				//echo $qry;
					if($sql)
				{
					echo "<script>alert('Inserted Successfully');window.location.href = 'add-branch.php?ty=$_GET[ty]';</script>";
				}
			else
				{
					echo "<script>alert('Not Inserted');</script>";
				}
			}
			if($_GET['ac'] =="upd")
			{
				
				$qry="UPDATE `tbl_offices` SET `off_name`='".$_POST['consignor']."',`address`='".$_POST['cusAddrs']."',`city`='".$_POST['gstincon']."',`ph_no`='".$_POST['phone']."',`office_time`='".$_POST['timing']."',`contact_person`='".$_POST['conper']."' WHERE `id`='".$_GET['editid']."' and `status`='A'";
				$sql=mysqli_query($dbConn,$qry);
			
			if($sql)
				{
					echo "<script>alert('Updated Successfully');window.location.href = 'add-branch.php?ty=add';</script>";
				}
			else
				{
					echo "<script>alert('Not Updated');</script>";
				}
			}
			
		}	
				
		
		if($_GET['ty'] == 'del')

		{

			$sql="DELETE FROM tbl_offices WHERE office='".$_GET['delid']."'";

			if(mysqli_query($dbConn,$sql))

			{

				echo "<script>alert('Record Deleted Successfully');

				window.location.href = 'add-branch.php?ty=add';</script>";

			}

			else

			{

				echo "<script>alert('Error in Deleting the record');

				window.location.href = 'add-branch.php?ty=add';</script>";

			}

		}
	?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Branch - Admin</title>

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
							<li class="active">	Consignment</li>
						</ul><!-- /.breadcrumb -->

<!-- /.nav-search -->
					</div>
<?php
if($_GET['ty'] == "add")
{
	?>		<div class="page-content">
						<!-- /.ace-settings-container -->
						<div class="page-header">
							<h1>
								<?php echo $title;?> 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<?php echo $title;?>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							<div class="widget-box">
									<div class="widget-header widget-header-blue widget-header-flat">
										<h4 class="widget-title lighter">Branch Details</h4>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<div >
												<div class="step-content pos-rel">
													<div class="step-pane active" >
														
													
														<form class="form-horizontal" method="POST" action="add-branch.php?ac=ins&ty=<?php echo $_GET['ty'];?>">
														
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consignor">Branch Name:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="consignor" id="consignor" class="col-xs-12 col-sm-6" required />
																	</div>
																</div>
															</div>

															<div class="space-2"></div>

															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="gstincon">City:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<select class="col-xs-12 col-sm-3" id="gstincon" name="gstincon" required >
																			<option value=""><--------Select--------></option>
																			<?php 
																			$sqltoi= mysqli_query($dbConn,"Select * from city where status= 'A'");
																			while($rwtoi=mysqli_fetch_array($sqltoi))
																			{																				
																			?>
																			<option value="<?php echo $rwtoi['b_id'];?>" ><?php echo $rwtoi['bname'];?></option>
																			<?php
																			}
																			?>
																		</select>
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
																		<textarea class="input-xlarge" name="cusAddrs" id="cusAddrs" required ></textarea>
																	</div>
																</div>
															</div>
														<div class="space-2"></div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="freight">Timing:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="timing" id="timing" class="col-xs-12 col-sm-5 " required />
																	</div>
																</div>
															</div>
														<div class="space-2"></div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="freight">Contact Person:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" name="conper" id="conper" class="col-xs-12 col-sm-5 " required />
																	</div>
																</div>
															</div>
															
															
											<div >
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
							<div class="hr hr-dotted"></div>
							<?php
								$exportdt="";
								$exportdt.="<div class='row'>";
								$exportdt.="<div class='col-xs-12'>";
								$exportdt.="<table id='dynamic-table' class='table table-striped table-bordered table-hover'>";
								$exportdt.="<thead>";
								$exportdt.="<tr><th>SNo</th>
													<th>Branch Name</th>
													<th>Phone No.</th>
													<th>Address</th>
													<th>City</th>
													<th>Timing</th>
													<th>Contact Person</th>
													<th class='hidden-480'>Action</th>
													</tr>
											</thead>

											<tbody>
											<tr>";
											$i=0;
											$msql=mysqli_query($dbConn,"Select * from tbl_offices where status='A' $mobile");
											
											while($row=mysqli_fetch_array($msql))
											{
												$rowcty=mysqli_fetch_array(mysqli_query($dbConn,"select * from city where b_id=$row[city]"));
											$i=$i+1;
												$exportdt.="<td class='center'>  $i</td>";
													$exportdt.="<td>".$row['off_name']."</td>";
													$exportdt.="<td>".$row['ph_no']."</td>";
													$exportdt.="<td>".$row['address']."</td>";
													$exportdt.="<td>".$rowcty['bname']."</td>";
													$exportdt.="<td>".$row['office_time']."</td>";
													$exportdt.="<td>".$row['contact_person']."</td>";
													$exportdt.="<td class='hidden-480'><a href='add-branch.php?ty=edit&editid=$row[id]'><span class='btn btn-sm btn-primary bigger-110'><i class='ace-icon fa fa-pencil bigger-110'></i>Edit</span></a>
													<a href='add-branch.php?ty=del&delid=$row[id]'>
														<span class='btn btn-sm btn-danger bigger-110'><i class='ace-icon fa fa-trash-o  bigger-110'></i>Delete</span></a></td></tr>";
												
												}
												
											$exportdt.="</tbody>
										</table>
									</div><!-- /.span -->
								</div><!-- /.row -->";
								
								
								?>
							<form class="form-horizontal" method="POST" action="add-branch.php?ty=add">
							
								<div class="form-group" >
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="mobile">Phone Number:</label>
									<div class="col-xs-12 col-sm-9">
										<div class="clearfix">
											<input type="text" name="mobile" id="mobile" class="col-xs-12 col-sm-4 " />
											
											<div class="col-xs-12 col-sm-5">
										<div class="clearfix">
											<button class="btn btn-success btn-next" type="Submit" name="search" id="search">Search</button>
											
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
													<th>Branch Id</th>
													<th>Branch Name</th>
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
											$i=0;
											$msql=mysqli_query($dbConn,"Select * from tbl_offices where status='A' $mobile");
											while($row=mysqli_fetch_array($msql))
											{
											?>
													<td class="center"> <?php echo $i=$i+1; ?></td>
													<td><a href="#"><?php echo $row['custID']; ?></a></td>
													<td><a href="#"><?php echo $row['consignor_name']; ?></a></td>
													<td><a href="#"><?php echo $row['consignor_gst']; ?></a></td>
													<td><a href="#"><?php echo $row['consignor_phone']; ?></a></td>
													<td><a href="#"><?php echo $row['consignor_add']; ?></a></td>
													<td><a href="#"><?php  echo $row['freight'];  ?></a></td>
													<td><a href="#"><?php  echo $row['waych'];  ?></a></td>
													<td><a href="#"><?php  echo $row['insch'];  ?></a></td>
													<td><a href="#"><?php  echo $row['othch'];  ?></a></td>
													<td><a href="#"><?php  echo $row['odach'];  ?></a></td>
													<td><a href="#"><?php  echo $row['topaych'];  ?></a></td>
													<td><a href="#"><?php  echo $row['cre_dt'];  ?></a></td>
													<td class="hidden-480">
													<a href="add-branch.php?ty=edit&editid=<?php echo $row[0];?>">
														<span class="btn btn-sm btn-primary bigger-110"><i class="ace-icon fa fa-pencil bigger-110"></i>Edit</span></a>
													<a href="add-branch.php?ty=repay&editid=<?php echo $row[0];?>">
													<span class="btn btn-sm btn-primary bigger-110"><i class="ace-icon fa fa-credit-card bigger-110"></i>Repay</span></a>
													<a href="add-branch.php?ty=del&delid=<?php echo $row[0];?>">
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
									<?php echo $exportdt;?>
								
								
								
								</div>
					</div>
					</div>
					<?php
}
			?>
			

<?php
if(isset($_GET['ty']))
{
if($_GET['ty'] == "edit")
{
	$sqlms=mysqli_query($dbConn,"Select * from tbl_offices where id = '".$_GET['editid']."'");
	$rowms=mysqli_fetch_array($sqlms);
	?>		<div class="page-content">
						<!-- /.ace-settings-container -->
						<div class="page-header">
							<h1>
								Edit Section
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<?php echo $title;?>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<form class="form-horizontal" method="POST" action="add-branch.php?ac=upd&ty=edit&editid=<?php echo $_GET['editid'];?>">
									
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="consignor">Branch Name:</label>
											<div class="col-xs-12 col-sm-9">
												<div class="clearfix">
													<input type="text" name="consignor" id="consignor" class="col-xs-12 col-sm-6" value="<?php echo $rowms['off_name'];?>" required />
												</div>
											</div>
									</div>

									<div class="space-2"></div>

									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="gstincon">City:</label>

										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												<select class="col-xs-12 col-sm-3" id="gstincon" name="gstincon" required>
													<option value=""><--------Select--------></option>
													<?php 
													$sqltoi= mysqli_query($dbConn,"Select * from city where status= 'A'");
													while($rwtoi=mysqli_fetch_array($sqltoi))
													{																				
													?>
													<option value="<?php echo $rwtoi['b_id'];?>" 
													<?php if($rwtoi['b_id'] == $rowms['city']){echo "selected";}?> ><?php echo $rwtoi['bname'];?></option>
													<?php
													}
													?>
												</select>
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

												<input type="tel" id="phone" name="phone" value="<?php echo $rowms['ph_no'];?>" required />
											</div>
										</div>
									</div>

									<div class="space-2"></div>

									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="cusAddrs">Address:</label>

										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												<textarea class="input-xlarge" name="cusAddrs" id="cusAddrs" required ><?php echo $rowms['address'];?></textarea>
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="freight">Timing:</label>

										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												<input type="text" name="timing" id="timing" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['office_time'];?>" required />
											</div>
										</div>
									</div>
									<div class="space-2"></div>
									<div class="form-group">
										<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="freight">Contact Person:</label>

										<div class="col-xs-12 col-sm-9">
											<div class="clearfix">
												<input type="text" name="conper" id="conper" class="col-xs-12 col-sm-5 " value="<?php echo $rowms['contact_person'];?>" required />
											</div>
										</div>
									</div>
													
									<div >
									<button class="btn btn-success btn-next" type="Submit">
											Submit
											
										</button>
										<button class="btn btn-prev" type="reset">
											
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
		<script type="text/javascript">
			jQuery(function($) {
			
				$('[data-rel=tooltip]').tooltip();
			
				$('.select2').css('width','200px').select2({allowClear:true})
				.on('change', function(){
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
function calTot()
{
var sgst=0;
var subtot=0.0;
var tot=0.0;
sgst=$("#payment").val();
subtot=$("#outstanding").val();
tot=  parseFloat(subtot)- parseFloat(sgst);
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
			if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
				 format: 'DD/MM/YYYY h:mm:ss A',//use this option to display seconds
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
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
			
			
			
				//hide or show the other form which requires validation
				//this is for demo only, you usullay want just one form in your application
				$('#skip-validation').removeAttr('checked').on('click', function(){
					$validation = this.checked;
					if(this.checked) {
						$('#sample-form').hide();
						$('#validation-form').removeClass('hide');
					}
					else {
						$('#validation-form').addClass('hide');
						$('#sample-form').show();
					}
				})
			
			
			
				//documentation : http://docs.jquery.com/Plugins/Validation/validate
			
			
				$.mask.definitions['~']='[+-]';
				$('#phone').mask('9999999999');
			
				jQuery.validator.addMethod("phone", function (value, element) {
					return this.optional(element) || /^\d{10}\ ( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");
			
				$('#validation-form').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					ignore: "",
					rules: {
						freight: {
							required: true,
							email:true
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
						freight: {
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
			
			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
					},
			
					errorPlacement: function (error, element) {
						if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					},
			
					submitHandler: function (form) {
					},
					invalidHandler: function (form) {
					}
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
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null, null,
					  { "bSortable": false }
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
			    } );
			
				
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
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
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
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
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
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
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
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
		</script> </body>
		<?php
	}
}?>		