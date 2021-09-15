<?php
include("admin/database.php"); 
include("header1.php");
?>
    

             <!-- Content Wrapper -->
             <article class="about-page"> 
                 <!-- Breadcrumb -->
                 <section class="theme-breadcrumb pad-50">                
                     <div class="theme-container container ">  
                         <div class="row">
                             <div class="col-sm-8 pull-left">
                                 <div class="title-wrap">
                                     <h2 class="section-title no-margin">About us </h2>
                                     <p class="fs-16 no-margin">Know about us more </p>
                                 </div>
                             </div>
                             <div class="col-sm-4">                        
                                 <ol class="breadcrumb-menubar list-inline">
                                     <li><a href="#" class="gray-clr">Home </a></li>                                   
                                     <li class="active">About </li>
                                 </ol>
                             </div>  
                         </div>
                     </div>
                 </section>
                 <!-- /.Breadcrumb -->

                 <!-- About Us -->
                 <section class="pad-50 about-wrap">
                     <span class="bg-text"> About  </span>
                     <div class="theme-container container">               
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="about-us pt-10">
                                     <p class="fs-16 wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s">
                                       <?php
                                      $result=mysqli_query($dbConn, "select * from pages where status='A' and page_id=1 ");
                                      $row=mysqli_fetch_array($result);
                                       echo $row['page_content'];
                                       ?>                                      </p>
                                     <ul class="feature">
                                         <li> 
                                             <img alt="" src="assets/img/icons/icon-2.png" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" /> 
                                             <div class="feature-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".30s"> 
                                                 <h2 class="title-1">Fast delivery </h2> 
                                                 <p>We make your delivery on time </p>                                            
                                             </div>  
                                         </li>
										  <li> 
                                             <img alt="" src="assets/img/icons/icon-4.png" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" /> 
                                             <div class="feature-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".30s"> 
                                                 <h2 class="title-1">reliable service </h2> 
                                     <p>We make convenient reliable service for all. </p>                                              
                                             </div>  
                                         </li>
                                         <li> 
                                             <img alt="" src="assets/img/icons/icon-3.png" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" /> 
                                             <div class="feature-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".30s"> 
                                                 <h2 class="title-1">secured service </h2> 
                                                 <p>We assure for your product safety </p>                                            
                                             </div>  
                                         </li>
                                        
                                     </ul>
                                 </div>
                             </div>
                             <div class="col-md-6 text-center">                                
                                 <img alt="" src="assets/img/block/about-img.png" class="effect animated fadeInRight" />
                             </div>
                         </div>
                     </div>
                 </section>
                 <!-- /.About Us -->

                 <!-- More About Us -->
                 
                 <!-- /.More About Us -->
             </article>
             <!-- /.Content Wrapper -->
<?php 
include("footer.php");
?>