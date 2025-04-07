<?php
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">

<head>

  <title>Farm Equipment Hire & Rental Hub</title>
  <!--Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
  <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
  <link href="assets/css/slick.css" rel="stylesheet">
  <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
    data-default-color="true" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
  <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/favicon5.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114"
    href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/favicon3.png">
  <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/favicon2.png">
  <link rel="shortcut icon" href="assets/images/favicon-icon/favicon4.png">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

  <style>
    .bordered-block {
      border: 2px solid #000; /* You can adjust the thickness and color as needed */
      padding: 10px; /* Adjust padding as needed */
      margin-bottom: 20px; /* Adjust margin as needed */
    }
  </style>
</head>

<body>
  <!--Header-->
  <?php include('includes/header2.php'); ?>
  <!-- /Header -->
  <section class="section-padding:1px gray-bg">
    <div class="container">
      <br>
    <aside class="col-md-4 col-md-pull-0 bordered-block">
  <div class="section-header text-center">
    <p> </p>
    <p> <strong>
      आपले स्वागत आहे
    <!-- <h6>Farm Equipment Hire & Rental Hub </h6> -->
   </strong> </p>
    <p> <strong>
    हे प्लॅटफॉर्म शेतकर्‍यांना उपकरणे भाड्याने घेण्यासाठी आणि मालकाला उपकरणे भाड्याने देण्यासाठी उपयुक्त आहे,येथे शेतकऱ्याला शेतीसाठी सर्व उपकरणे योग्य किंमतीत मिळतील,त्यापूर्वी तुम्ही खाते तयार केले आहे याची खात्री करा.</strong></p>
  </div>
</aside>

    <aside class="col-md-4 col-md-pull-0">
    <div class="section-header text-center">
    <p></p>
    <p><strong>Our Reviews</strong></p>

    <?php
    $tid = 1;
    $sql = "SELECT tbltestimonial.Testimonial, tblusers.FullName FROM tbltestimonial JOIN tblusers ON tbltestimonial.UserEmail=tblusers.EmailId WHERE tbltestimonial.status=:tid LIMIT 4";
    $query = $dbh->prepare($sql);
    $query->bindParam(':tid', $tid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;

    if ($query->rowCount() > 0) {
        echo '<table class="table table-bordered">';
        echo '<thead>';
        // echo '<tr>';
        // echo '<th scope="col">Farmer Name</th>';
        // echo '<th scope="col">Feedbacks</th>';
        // echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($results as $result) {
            echo '<tr>';
            
            
            echo '<td><strong>' . htmlentities($result->Testimonial) . '</strong>
            ' . htmlentities($result->FullName) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No reviews available</p>';
    }
    ?>
<section>
    <div class="row">
        <div class="col-lg-3 col-xs-6 col-sm-3">
            <div class="fun-facts-s">
                <div class="cell">
                    <p><i class="fa fa-calendar" aria-hidden="true"></i> 05+</p>
                    <p>Months In Business</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6 col-sm-3">
            <div class="fun-facts-s">
                <div class="cell">
                    <p><i class="glyphicon glyphicon-wrench" aria-hidden="true"></i> 20+</p>
                    <p>New Equipment For Hire</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6 col-sm-3">
            <div class="fun-facts-s">
                <div class="cell">
                    <p><i class="glyphicon glyphicon-wrench" aria-hidden="true"></i> 15+</p>
                    <p>Used Equipment For Rent</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6 col-sm-3">
            <div class="fun-facts-s">
                <div class="cell">
                    <p><i class="fa fa-user-circle-o" aria-hidden="true"></i> 20+</p>
                    <p>Satisfied Farmers</p>
                </div>
            </div>
        </div>
    </div>
</section>

</div>

    </aside>
    
    <aside class="col-md-4 col-md-pull-0">
      <div class="section-header text-center bordered-block">
        <div id="newdiv">
        <p> </p>
        <!-- <p> <strong>
          आपले स्वागत आहे
        <h6>Farm Equipment Hire & Rental Hub </h6> -->
       <!-- </strong> </p> -->
        <p> <strong>
        तुम्ही आमच्याशी थेट संपर्क साधू शकता</strong></p>
        <div class="login_btn">     <a href="contact-us.php?vhid=<?php echo htmlentities($result->id);?>" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal"> <i class="fa fa-phone"></i>Contact us</a> </div>
        &nbsp;
        <br>
        <p> <strong>
        तुम्ही शेतकरी असाल तर येथे लॉग इन करा</strong></p>
        <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal"> <i class="fa fa-user-circle"></i> Farmer Login</a> </div>
        <p> <strong>
        तुम्ही उपकरण मालक असाल तर येथे लॉग इन करा</strong></p>
        <div class="login_btn"> <a href="#onloginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal"> <i class="fa fa-user-circle-o"></i> Owner Login</a> </div>
      </div>
      </div>
    </aside>
    <div class="divider"></div>
  
   
      
      <div class="row">
      <aside class="col-md-12 col-md-pull-0">
      
        <div class="recent-tab">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab"> उपकरणे </a></li>
          </ul>
        </div>
      </aside> 
       
        <div class="tab-content" onclick="fun">
          <div role="tabpanel" class="tab-pane active" id="resentnewcar">

            <?php $sql = "SELECT tblequipment.EqipmentTitle,tblcategory.CategoryName,tblequipment.PricePerDay,tblequipment.EquipLocation,tblequipment.ModelYear,tblequipment.id,tblequipment.OwnerDetails,tblequipment.Vimage1, tblowner.Name AS owner_name, tblowner.mob AS owner_mob, tblowner.address AS owner_add from tblequipment join tblcategory on tblcategory.id=tblequipment.EquipmentCategory JOIN tblowner ON tblowner.id = tblequipment.ownerid limit 9";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;
            if ($query->rowCount() > 0) {
              foreach ($results as $result) {
                ?>

                <div class="col-list-3">
                  <div class="recent-car-list">
                    <div class="car-info-box"> <a href="eq-details.php?vhid=<?php echo htmlentities($result->id); ?>"><img
                          src="admin/img/equipmentimages/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive"
                          alt="image"></a>
                      <ul>
                        <li><i class="fa fa-globe" aria-hidden="true"></i>
                          <?php echo htmlentities($result->EquipLocation); ?>
                        </li>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i>
                          <?php echo htmlentities($result->ModelYear); ?> Model
                        </li>
                    
                        
                      </ul>
                    </div>
                    <div class="car-title-m">
                      <h6><a href="eq-details.php?vhid=<?php echo htmlentities($result->id); ?>">
                          <?php echo htmlentities($result->EqipmentTitle); ?>
                        </a></h6>
                      <span class="price">Rs.
                        <?php echo htmlentities($result->PricePerDay); ?> /Day
                      </span>
                    </div>
                    <div class="inventory_info_m">
                      <p><strong>
                      <?php echo htmlentities("Name:".$result->owner_name .", " . $result->owner_mob);?>
                      <br>
                      <?php echo htmlentities("Address:" . $result->owner_add);?>
                      </strong></p>
                    </div>
                  </div>
                </div>
              <?php }
            } ?>

          </div>
        </div>
      </div>
  </section>
  
  
     


  <!--Footer -->
  <?php include('includes/footer.php'); ?>
  <!-- /Footer-->

  <!--Back to top-->
  <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
  <!--/Back to top-->

  <!--Login-Form -->
  <?php include('includes/login.php'); ?>
  <!--/Login-Form -->

  <!--Register-Form -->
  <?php include('includes/registration.php'); ?>

  <!--/Register-Form -->
  
  <?php include('includes/onwerlog.php'); ?>
 
  <?php include('includes/onwerreg.php'); ?>

  <!-- Scripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/interface.js"></script>
  <!--Switcher-->
  <script src="assets/switcher/js/switcher.js"></script>
  <!--bootstrap-slider-JS-->
  <script src="assets/js/bootstrap-slider.min.js"></script>
  <!--Slider-JS-->
  <script src="assets/js/slick.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>