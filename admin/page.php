<?php 

session_start();

include("database.php");

if((isset($_SESSION)) && (isset($_SESSION['uid']))) 
{
	$user_type=$_SESSION['type'];
	if ($user_type == "Branch") {
		echo '<script>		
			alert("You do not have access to this page, you will be redirected to the dashboard...");			
			  </script>';
		header("Refresh: 0; url= dashboard.php");

		exit();
	}	
if(isset($_GET['ac']))

{

if($_GET['ac'] == 'upd')

{

	$dbConntent=addslashes($_POST['content']);
	$qry="UPDATE pages SET page_content='$dbConntent' WHERE page_id=1 and status='A'";

	$sql=mysqli_query($dbConn,$qry);
	
	if($sql)

	{

		echo "<script>alert(' Updated Successfully');window.location.href = 'page.php';</script>";

	}

	else

	{

		echo "<script>alert('Not Updated');</script>";

	}



}

if($_GET['ac'] == 'del')

{

	$sql="DELETE from pagess WHERE page_id='$_GET[id]'";

	if(mysqli_query($dbConn,$sql))

	{

		echo "<script>alert('Record Deleted Successfully');

		window.location.href = 'page.php';</script>";

	}

	else

	{

		echo "<script>alert('Error in Deleting the record');

		window.location.href = 'page.php';</script>";

	}

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
							<li class="active">About Us</li>
						</ul><!-- /.breadcrumb -->

<!-- /.nav-search -->
					</div>


					<div class="page-content">

						<!-- /.page-header -->

						<?php

						if(isset($_GET['ac']) && $_GET['ac']== 'edit')

						{

							$res=mysqli_query($dbConn, "select * from pages where page_id='$_GET[id]'");

							while($rw=mysqli_fetch_array($res)){

						?>

							<div class="row">

							<div class="col-xs-12">

							<form class="form-horizontal" role="form" action="page.php?ac=upd" method="POST">

									<div class="form-group">

										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Page Content</label>



										<div class="col-sm-9">

										<textarea rows="10"  id="content" name="content" class="jqte-test" value=""  required><?php echo $rw['page_content']?></textarea>

										</div>

									</div>

										

										<div class="col-md-offset-3 col-md-9">

											<button class="btn btn-info" type="submit">

												<i class="ace-icon fa fa-check bigger-110"></i>

												Submit

											</button>



											&nbsp; &nbsp; &nbsp;

											<button class="btn" type="reset">

												<i class="ace-icon fa fa-undo bigger-110"></i>

												Reset

											</button>

										</div>

								

									</form>

								

								<!-- PAGE CONTENT ENDS -->

							</div><!-- /.col -->

						</div><!-- /.row -->

						<?php

						}

						}

						?>

						<!--div class="page-header">

							<a href="page.php?ac=new" Class="btn btn-info">Add New pages</a>

						</div-->

						<div class="portlet box green-haze">

						<div class="portlet-title">

							<div class="page-header">

							<h1>About Us </h1>

						</div>

							<div class="tools">

								<a href="javascript:;" class="reload" data-original-title="" title="">

								</a>

								<a href="javascript:;" class="remove" data-original-title="" title="">

								</a>

							</div>

						</div>

						<div class="portlet-body">

							

                                

                                

                                

                                <div class=""><table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_2" role="grid" aria-describedby="sample_2_info">

							<thead>

							<tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="

									 Rendering engine

								: activate to sort column ascending" style="width: 191px;">

									Page Name

								</th>

									

							   <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="

									 Platform(s)

								: activate to sort column ascending" style="width: 243px;">

									Content

								</th>

							      <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="

									 CSS grade

								: activate to sort column ascending" style="width: 114px;">

									 Action

								</th></tr>

							</thead>

							<tbody>



<?php    

    $result=mysqli_query($dbConn, "select * from pages where status='A' and page_id=1 ");

	while($row=mysqli_fetch_array($result)){

?>                            

							<tr role="row" class="odd">

								<td class="sorting_1"><?php echo $row['page_name'];?></td>

								<td><?php echo $row['page_content'];?></td>

                              <td><a href="page.php?id=<?php echo $row['page_id'];?>&ac=edit"><span class="btn btn-app btn-primary btn-xs"><i class="ace-icon fa fa-pencil bigger-120"></i></span> </a>

								

								</td>

							</tr>



<?php } ?>                            

                            

                            </tbody>

							</table></div>

                            

                          

						</div>

					</div>

					</div><!-- /.page-content -->

				</div>

			</div><!-- /.main-content -->

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


		<!-- page specific plugin scripts -->
<link type="text/css" rel="stylesheet" href="texteditor/jquery-te-1.4.0.css">
<script type="text/javascript" src="texteditor/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script>
	$('.jqte-test').jqte();
	
	// settings of status
	var jqteStatus = true;
	$(".status").click(function()
	{
		jqteStatus = jqteStatus ? false : true;
		$('.jqte-test').jqte({"status" : jqteStatus})
	});
</script>

	</body>
	 <!-- redirecting to dashboard    -->

</html>

<?php 

}

else

{

	echo "<script>window.location.href = 'index.php';</script>";

}

?>



