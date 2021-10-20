<?php
include("admin/database.php");
include("./header1.php");
?>

             <!-- Content Wrapper -->
             <article> 
                 <!-- Breadcrumb -->
                 <section class="theme-breadcrumb pad-50">                
                     <div class="theme-container container ">  
                         <div class="row">
                             <div class="col-sm-8 pull-left">
                                 <div class="title-wrap">
                                     <h2 class="section-title no-margin"> product tracking  </h2>
                                     <p class="fs-16 no-margin"> Track your product & see the current condition  </p>
                                 </div>
                             </div>
                             <div class="col-sm-4">                        
                                 <ol class="breadcrumb-menubar list-inline">
                                     <li><a href="index.php" class="gray-clr">Home </a></li>                                   
                                     <li class="active">Track </li>
                                 </ol>
                             </div>  
                         </div>
                     </div>
                 </section>
                 <!-- /.Breadcrumb -->

                 <!-- Tracking -->
                 <section class="pt-50 pb-120 tracking-wrap">    
                     <div class="theme-container container ">  
                         <div class="row pad-10">
                             <div class="col-md-8 col-md-offset-2 tracking-form wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">     
                                 <h2 class="title-1"> track your shipment  </h2>  <span class="font2-light fs-12" style="color: #000000;"> Now you can track your shipment easily </span>
                                 <div class="row">
                                     <form class="" action="tracking.php?ac=track" method="POST">
                                         <div class="col-md-7 col-sm-7">
                                             <div class="form-group">
                                                 <input type="text" placeholder="Enter your waybill no" required="" name="waybill" id="waybill" class="form-control box-shadow" style="color: #000000;" />
                                             </div>
                                         </div>
                                         <div class="col-md-5 col-sm-5">
                                             <div class="form-group">
                                                 <button class="btn-1">track your shipment </button>
                                             </div>
                                         </div>
                                     </form>
                                 </div>
                             </div>    
                         </div>
						 <?php
						 if(isset($_GET['ac'] ))
						 {
						 if(isset($_POST['waybill'] ))
						 {
							 $qry="SELECT * FROM `tbl_courier` where `waybillno`='".$_POST['waybill']."'";
							 $sql=mysqli_fetch_array(mysqli_query($dbConn,$qry));
							 $numrw=mysqli_num_rows(mysqli_query($dbConn,$qry));
							 if($numrw >0)
							 {
							 ?>
					 
                         <div class="row">
                             <!-- Removed certain details like waybill number, consignor's name etc... -->
                             <!-- <div class="col-md-7 pad-30 wow fadeInLeft" data-wow-offset="50" data-wow-delay=".30s"> 
                                 <div class="prod-info white-clr" style="color:white;">
                                     <ul>
                                         <li>  <span class="title-2" style="color:white;">Waybill Number: </span>  <span class="fs-16"><?php echo $sql['waybillno'];?> </span>  </li>
										 <li>  <span class="title-2" style="color:white;">Consignor's Name: </span>  <span class="fs-16"><?php echo $sql['consignor_name'];?> </span>  </li>
										  <li>  <span class="title-2" style="color:white;">Consignee's Name: </span>  <span class="fs-16"><?php echo $sql['consignee_name'];?> </span>  </li>
                                         <li>  <span class="title-2" style="color:white;">Delivery Address: </span>  <span class="fs-16"><?php echo $sql['consignee_add'];?> </span>  </li>
                                     </ul>
                                 </div>
                             </div> --> 
                             <div class="col-md-12 pad-30 wow fadeInLeft" data-wow-offset="50" data-wow-delay=".30s" > 
                             <center><div class="prod-info white-clr" style="color:white;">
                                     <ul>
                                        <li>  <span class="title-2" style="color:white;">Waybill Number: <span class="fs-6"><?php echo $sql['waybillno'];?> </span> </span>  <span class="title-2" style="color:white;">Booked date: <span class="fs-6"><?php echo $sql['book_date'];?> </span> </span>  </li>
                                         <!-- <li>  <span class="title-2" style="color:white;">Booking status: </span>  <span class="fs-16 theme-clr"><?php 
										 $stsql=mysqli_fetch_array(mysqli_query($dbConn,"select * from `tbl_courier_track`,book_status where tbl_courier_track.cons_no='".$_POST['waybill']."' and book_status.b_id=tbl_courier_track.bk_status"));
										 echo $stsql['bname'];?> </span>  </li> -->
                                         <!-- <li>  <span class="title-2" style="color:white;">weight (kg): </span>  <span class="fs-16"><?php if($sql['actwgt'] !='0' and $sql['actwgt'] !=""){echo $sql['actwgt'];} else {echo $sql['bxpkg']."Kg Per Box";}?> </span>  </li> -->
                                         <!-- <li>  <span class="title-2" style="color:white;">No of Qty: </span>  <span class="fs-16"><?php echo $sql['qty'];?></span>  </li> -->
                                     </ul>
                                 </div></center>
                             </div> 
                         </div>
                         <div class="progress-wrap">
                             <div class="progress-status">
                                 <!-- changes to progress bar based on the delivery status -->
                                 <?php if($stsql['bname']=="In Transit"){ ?>
                                    <!-- If consignment is in transit -->
                                    <span class="border-left"></span>
                                    <span class="border-right"></span>
                                    <span class="dot dot-left wow fadeIn" data-wow-offset="50" data-wow-delay=".40s"></span>
                                    <span class="themeclr-border wow fadeIn" data-wow-offset="50" data-wow-delay=".50s">   <span class="dot dot-center theme-clr-bg"></span>  </span>
                                    <span class="dot dot-right wow fadeIn" data-wow-offset="50" data-wow-delay=".60s"></span>
                                 
                                 <?php } 

                                    elseif($stsql['bname']=="Delivered") {?>
                                    <!-- if consignment is delivered -->
                                        <span class="border-full"></span>
                                        <span class="dot dot-left wow fadeIn" data-wow-offset="50" data-wow-delay=".40s"></span>           
                                        <span class="dot dot-delivered wow fadeIn"><span class="themeclr-border wow fadeIn" data-wow-offset="50" data-wow-delay=".50s"><span class="dot dot-center theme-clr-bg"></span></span></span>

                                 <?php } 

                                    else{ ?>
                                        <!--if consignment is about to start-->
                                        <span class="border-full"></span>
                                        <span class="dot dot-left wow fadeIn" data-wow-offset="50" data-wow-delay=".40s"></span>
                                        <span class="dot dot-right wow fadeIn" data-wow-offset="50" data-wow-delay=".60s"></span>
                                        <div class="col-md-8 col-xs-8 col-sm-4 text-center " style="left: 200px; top: 30px">
                                        <h2 class="title-1 no-margin "> <?php echo "Shipment will start shortly.";?> </h2> 
                                        </div>

                                    <?php }?>
                             </div>
                             <div class="row progress-content upper-text">
                                 <div class="col-md-3 col-xs-8 col-sm-2">
                                     <p class="fs-12 no-margin"> FROM  </p>
                                     <h2 class="title-1 no-margin">
									 <?php 
									 $offsql=mysqli_fetch_array(mysqli_query($dbConn,"select * from `city`,`tbl_offices` where tbl_offices.id='".$sql['org_off']."' and city.b_id=tbl_offices.city and tbl_offices.status='A'"));
										 echo $offsql['bname'];
									 ?> 
									 </h2>
                                 </div>
                                 <!-- <div class="col-md-2 col-xs-8 col-sm-3">
                                     <p class="fs-12 no-margin"> [  <b class="black-clr"><?php echo 'Booked On: '.$sql['book_date'];?> </b> ]  </p>                                
                                 </div> -->
                                 <?php if($stsql['bname']=="In Transit"){ ?>
                                 <div class="col-md-8 col-xs-8 col-sm-4 text-center">
                                     <p class="fs-12 no-margin"> currently in  </p>
                                     <h2 class="title-1 no-margin">
                                         <?php
                                            // if ($stsql['bname']=="Intransit"){
                                                echo $stsql['bname'];
                                            
                                         ?>
                                     </h2>
                                 </div>
                                 <?php }?>
                                 <!-- <div class="col-md-1 col-xs-8 col-sm-1 no-pad">
                                     <p class="fs-12 no-margin"> [  <b class="black-clr"><?php 
									 if($stsql['bk_status'] !='1')
									 {
										  echo $stsql['bname']." On: ".$stsql['bk_time'];
									 }	
									 else									 
									 {
										 echo "Shipment will start shortly.";
									 }
									?>  </b> ]  </p>                                
                                 </div> -->
                                 <div class="col-md-12 col-xs-8 col-sm-2 text-right" style="bottom: 38px;">
                                     <p class="fs-12 no-margin">  TO </p>
                                     <h2 class="title-1 no-margin"><?php $offsql=mysqli_fetch_array(mysqli_query($dbConn,"select * from `city`,`tbl_offices` where tbl_offices.id='".$sql['dest_off']."' and city.b_id=tbl_offices.city and tbl_offices.status='A'"));
										 echo $offsql['bname']; ?>  </h2>
                                 </div>
                             </div>
                         </div>
						 <?php
							 }
							 else
							 {
							 ?>
							<div class="row">
                             <div class="col-md-12 pad-30 wow fadeInLeft" data-wow-offset="50" data-wow-delay=".30s"> 
                                 <div class="prod-info blac-clr">
                                     <ul>
                                         <li>  <center style="color: red; font-weight:bolder; font-size:large;">Waybill Number Does Not exist. Please Try with Proper Waybill Numbers</center>  </li>
                                     </ul>
                                 </div>
                             </div>
                             </div>
							 <?php
							 }
					 }
					 }
						 ?>
                     </div>
                 </section>
                 <!-- /.Tracking -->

             </article>
             <!-- /.Content Wrapper -->

           <?php 
include("footer.php");
?>