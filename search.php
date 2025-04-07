<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Farm Equipment Rental Portal</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<!-- SWITCHER -->
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
        
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/favicon5.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/favicon3.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/favicon2.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon4.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>


<!--Header--> 
<?php include('includes/header.php');?>
<!-- /Header --> 

<div class="container text-center">
<div class="widget_heading">
  <h5><i class="fa fa-search" aria-hidden="true"></i>उपकरण शोधा </h5>
</div>

<form action="search-eq.php" method="post" class="form-inline">
  <div class="form-group select mr-2">
    <select class="form-control" name="category">
      <option>Select Equipment</option>
      <?php 
      $sql = "SELECT * from  tblcategory ";
      $query = $dbh->prepare($sql);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
      $cnt = 1;
      if($query->rowCount() > 0) {
        foreach($results as $result) { ?>
          <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->CategoryName); ?></option>
        <?php }} ?>
    </select>
  </div>

  <div class="form-group select mr-2">
    <select class="form-control" name="loc">
      <option>Select Location</option>
      <option value="Songir">Songir, Dhule</option>
      <option value="Shirud">Shirud, Dhule</option>
      <option value="Kapadne">Kapadne, Dhule</option>
      <option value="Patan">Patan, Shindkheda</option>
      <option value="Chimthana">Chimthana, Shindkheda</option>
      <option value="Nardana">Nardana, Shindkheda</option>
      <option value="Dahivad">Dahivad, Shirpur</option>
      <option value="Boradi">Boradi, Shirpur</option>
      <option value="Waghadi">Waghadi, Shirpur</option>
      <option value="Shewali">Shewali, Sakri</option>
      <option value="Mhasdi">Mhasdi, Sakri</option>
      <option value="Nizampur">Nizampur, Sakri</option>
    </select>
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i>Search Equipment</button>
  </div>
</form>
</div>
        
      <!--/Side-Bar-->
<!--Listing-->
<br><br>

  <div class="container">
    <div class="row">
    <div class="col-md-27 col-md-push-0">
        <div class="result-sorting-wrapper"> 
           <div class="sorting-count">
              <?php 
              //Query for Listing count
              $searchdata=$_POST['searchdata'];
              $sql = "SELECT tblequipment.id from tblequipment 
              join tblcategory on tblcategory.id=tblequipment.EquipmentCategory
              where tblequipment.EqipmentTitle=:search || tblequipment.EquipLocation=:search || tblcategory.CategoryName=:search || tblequipment.ModelYear=:search";
              $query = $dbh -> prepare($sql);
              $query -> bindParam(':search',$searchdata, PDO::PARAM_STR);
              $query->execute();
              $results=$query->fetchAll(PDO::FETCH_OBJ);
              $cnt=$query->rowCount();
              ?>
              <p><span style="color:black;">Available Equipments</span></p> 
            </div> 
          </div>

          <?php 
          $sql = "SELECT tblequipment.*,tblcategory.CategoryName,tblcategory.id as bid ,tblowner.Name AS owner_name, tblowner.mob AS owner_mob, tblowner.address AS owner_add  from tblequipment 
          join tblcategory on tblcategory.id=tblequipment.EquipmentCategory JOIN tblowner ON tblowner.id = tblequipment.ownerid 
          where tblequipment.CurrentStatus='Available' and (tblequipment.EqipmentTitle=:search || tblequipment.EquipLocation=:search || tblcategory.CategoryName=:search || tblequipment.ModelYear=:search)";
          $query = $dbh -> prepare($sql);
          $query -> bindParam(':search',$searchdata, PDO::PARAM_STR);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          $cnt=1;
          if($query->rowCount() > 0)
          {
          ?>
         <aside class="col-md-25 col-md-pull-0">
          <table id="abcde" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Equipment Image</th>
                <th>Equipment Name</th>
                <th>Equipment Info</th>
                <th>Equipment Type</th>
                <th>Rent/Day</th>
                <th>Owner Details</th>
                
                <th>Equipment Location</th>
                <th>Status</th>
                <th>Book Now</th>
              </tr>
            </thead>
            <tbody>
            <?php
        foreach ($results as $result) {
        ?>
             <tr>
                  <td>
                      <a data-fancybox="gallery" href="admin/img/equipmentimages/<?php echo htmlentities($result->Vimage1); ?>">
                          <img src="admin/img/equipmentimages/<?php echo htmlentities($result->Vimage1); ?>" alt="<?php echo htmlentities($result->EqipmentTitle); ?>" />
                      </a>
                      
                  </td>
                  <td>
                      
                      <p><?php echo htmlentities($result->EqipmentTitle); ?>, <?php echo htmlentities($result->ModelYear); ?></p>
                  </td>

                      <td>
                          <!-- <ul class="specifications" style="width: 160px;"> -->
                          <div style="width: 160px;">
                              <li><strong>HP:</strong> <?php echo htmlentities($result->HorsePower); ?></li>
                              <li><strong>CC:</strong> <?php echo htmlentities($result->CCCapcity); ?></li>
                              <li><strong>Weight:</strong> <?php echo htmlentities($result->CropType); ?></li>
                              <li><strong>Lifting:</strong> <?php echo htmlentities($result->LifttingCapacity); ?></li>
                              <li><strong>Condition:</strong> <?php echo htmlentities($result->WorkingCondition); ?></li>
                          </div>
                         
                      </td>
                      <td>
                          <p><?php echo htmlentities($result->CategoryName); ?></p>
                      </td>
                      <td>
                          <p>Rs.<?php echo htmlentities($result->PricePerDay); ?> Per Day</p>
                      </td>
                      <td>
                          <pre style="font-family:verdana"><?php echo htmlentities("Name:".$result->owner_name . "\n"."Mobile No:" . $result->owner_mob ."\n"."Address:" . $result->owner_add);?></pre>
                      </td>

                      <td>
                          <p><?php echo htmlentities($result->EquipLocation); ?></p>
                      </td>
                      <td>
                          <p><?php echo htmlentities($result->CurrentStatus); ?></p>
                      </td>
                      <td>
                          <p><a href="eq-details.php?vhid=<?php echo htmlentities($result->id); ?>"class="btn btn-xs ">Book Now <span><i aria-hidden="true"></i></span></a></p>
                          <!-- <a href="#onbookingform" class="btn btn-xs " data-toggle="modal" data-dismiss="modal" data-vhid="<?php echo htmlentities($result->id); ?>">Book Now</a> -->

                          </td>
                  </tr>
                  <?php
        }
        ?>
            </tbody>
          </table>
        </aside>

        <?php } ?>
        </div> 
    </div>
  </div>


<br><br>
<!-- <section class="listing-page"> -->
  <div class="container">
    <div class="row">
    <div class="col-md-27 col-md-push-0">
        <div class="result-sorting-wrapper"> 
           <div class="sorting-count">
              <?php 
              //Query for Listing count
              $searchdata=$_POST['searchdata'];
              $sql = "SELECT tblequipment.id from tblequipment 
              join tblcategory on tblcategory.id=tblequipment.EquipmentCategory
              where tblequipment.EqipmentTitle=:search || tblequipment.EquipLocation=:search || tblcategory.CategoryName=:search || tblequipment.ModelYear=:search";
              $query = $dbh -> prepare($sql);
              $query -> bindParam(':search',$searchdata, PDO::PARAM_STR);
              $query->execute();
              $results=$query->fetchAll(PDO::FETCH_OBJ);
              $cnt=$query->rowCount();
              ?>
              <p><span style="color:red;"> Not available </span></p> 
            </div> 
          </div>

          <?php 
          $sql = "SELECT tblequipment.*,tblcategory.CategoryName,tblcategory.id as bid, tblowner.Name AS owner_name, tblowner.mob AS owner_mob, tblowner.address AS owner_add  from tblequipment 
          join tblcategory on tblcategory.id=tblequipment.EquipmentCategory JOIN tblowner ON tblowner.id = tblequipment.ownerid 
          where tblequipment.CurrentStatus='Not Available' and (tblequipment.EqipmentTitle=:search || tblequipment.EquipLocation=:search || tblcategory.CategoryName=:search || tblequipment.ModelYear=:search)";
          $query = $dbh -> prepare($sql);
          $query -> bindParam(':search',$searchdata, PDO::PARAM_STR);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          $cnt=1;
          if($query->rowCount() > 0)
          {
          ?>
         <aside class="col-md-25 col-md-pull-0">
          <table id="abcde" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Equipment Image</th>
                <th>Equipment Name</th>
                <th>Equipment Info</th>
                <th>Equipment Type</th>
                <th>Rent/Day</th>
                <th>Owner Details</th>
                
                <th>Equipment Location</th>
                <th>Status</th>
                <th>Book Now</th>
              </tr>
            </thead>
            <tbody>
            <?php
        foreach ($results as $result) {
        ?>
             <tr>
                  <td>
                      <a data-fancybox="gallery" href="admin/img/equipmentimages/<?php echo htmlentities($result->Vimage1); ?>">
                          <img src="admin/img/equipmentimages/<?php echo htmlentities($result->Vimage1); ?>" alt="<?php echo htmlentities($result->EqipmentTitle); ?>" />
                      </a>
                      
                  </td>
                  <td>
                      
                      <p><?php echo htmlentities($result->EqipmentTitle); ?>, <?php echo htmlentities($result->ModelYear); ?></p>
                  </td>

                      <td>
                          <!-- <ul class="specifications" style="width: 160px;"> -->
                          <div style="width: 160px;">
                              <li><strong>HP:</strong> <?php echo htmlentities($result->HorsePower); ?></li>
                              <li><strong>CC:</strong> <?php echo htmlentities($result->CCCapcity); ?></li>
                              <li><strong>Weight:</strong> <?php echo htmlentities($result->CropType); ?></li>
                              <li><strong>Lifting:</strong> <?php echo htmlentities($result->LifttingCapacity); ?></li>
                              <li><strong>Condition:</strong> <?php echo htmlentities($result->WorkingCondition); ?></li>
                          </div>
                         
                      </td>
                      <td>
                          <p><?php echo htmlentities($result->CategoryName); ?></p>
                      </td>
                      <td>
                          <p>Rs.<?php echo htmlentities($result->PricePerDay); ?> Per Day</p>
                      </td>
                      <td>
                          <pre style="font-family:verdana"><?php echo htmlentities("Name:".$result->owner_name . "\n"."Mobile No:" . $result->owner_mob ."\n"."Address:" . $result->owner_add);?></pre>
                      </td>

                      <td>
                          <p><?php echo htmlentities($result->EquipLocation); ?></p>
                      </td>
                      <td>
                          <p><?php echo htmlentities($result->CurrentStatus); ?></p>
                      </td>
                      <td>
                          <p><a href="eq-details.php?vhid=<?php echo htmlentities($result->id); ?>"class="btn btn-xs ">Book Now <span><i aria-hidden="true"></i></span></a></p>
                          <!-- <a href="#onbookingform" class="btn btn-xs " data-toggle="modal" data-dismiss="modal" data-vhid="<?php echo htmlentities($result->id); ?>">Book Now</a> -->

                          </td>
                  </tr>
                  <?php
      }
      ?>
            </tbody>
          </table>
        </aside>
      <?php } ?>
      </div>
  </div>
</section>
<br><br>
<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

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