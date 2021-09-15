<?php
include('./header1.php');
include('./admin/database.php');
?>
<!-- Content Wrapper -->
<article class="about-page">
    <!-- Breadcrumb -->
    <section class="theme-breadcrumb pad-50">
        <div class="theme-container container ">
            <div class="row">
                <div class="col-sm-8 pull-left">
                    <div class="title-wrap">
                        <h2 class="section-title no-margin">Service Areas </h2>
                        <!-- <p class="fs-16 no-margin">Know about us more </p> -->
                    </div>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb-menubar list-inline">
                        <li><a href="index.php" class="gray-clr">Home </a></li>
                        <li class="active">Service Areas </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- /.Breadcrumb -->

    <!-- About Us -->
    <section class="pad-50 about-wrap">
        <span class="bg-text"> Service Areas </span>
        <div class="theme-container container">
            <div class="row">
                <div class="col-md-3">
                    <div class="about-us pt-10">
                        <p class="fs-16 wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s" style="padding-left: 30%; text-transform: uppercase; font-weight: bold;color: #009746;">
                            <?php
                            $row = mysqli_query($dbConn, "SELECT * FROM city WHERE status='A' ORDER BY `b_id` ASC limit 0 , 6");
                            foreach ($row as $row1) :
                            ?>
                                <img class="" alt="" src="assets/img/icons/marker-1.png" />
                                <?php echo $row1['bname']; ?>
                                <br> <br>
                            <?php endforeach; ?>
                        </p>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="about-us pt-10">
                        <p class="fs-16 wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s" style="padding-left: 30%; text-transform: uppercase; font-weight: bold;color: #009746;">
                            <?php
                            $row = mysqli_query($dbConn, "SELECT * FROM city WHERE status='A' ORDER BY `b_id` ASC limit 6 , 6");
                            foreach ($row as $row1) :
                            ?>
                                <img class="" alt="" src="assets/img/icons/marker-1.png" />
                                <?php echo $row1['bname']; ?>
                                <br> <br>
                            <?php endforeach; ?>
                        </p>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="about-us pt-10">
                        <p class="fs-16 wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s" style="padding-left: 30%; text-transform: uppercase; font-weight: bold;color: #009746;">
                            <?php
                            $row = mysqli_query($dbConn, "SELECT * FROM city WHERE status='A' ORDER BY `b_id` ASC limit 12,6");
                            foreach ($row as $row1) :
                            ?>
                                <img class="" alt="" src="assets/img/icons/marker-1.png" />
                                <?php echo $row1['bname']; ?>
                                <br> <br>
                            <?php endforeach; ?>
                        </p>
                    </div>
                </div>
                  <div class="col-md-3">
                    <div class="about-us pt-10">
                        <p class="fs-16 wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s" style="padding-left: 30%; text-transform: uppercase; font-weight: bold;color: #009746;">
                            <?php
                            $row = mysqli_query($dbConn, "SELECT * FROM city WHERE status='A' ORDER BY `b_id` ASC limit 18,7");
                            foreach ($row as $row1) :
                            ?>
                                <img class="" alt="" src="assets/img/icons/marker-1.png" />
                                <?php echo $row1['bname']; ?>
                                <br> <br>
                            <?php endforeach; ?>
                        </p>
                    </div>
                </div>
                <!--div class="col-md-4 text-center">
                    <img alt="" src="assets/img/block/about-img.png" class="effect animated fadeInRight" />
                </div-->
            </div>
        </div>
    </section>

</article>
<!-- /.Content Wrapper -->


<?php include('./footer.php'); ?>
