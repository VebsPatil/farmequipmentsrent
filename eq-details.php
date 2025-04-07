<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['submit'])) {
  $fromdate = $_POST['fromdate'];
  $todate = $_POST['todate'];
  $message = $_POST['message'];
  $useremail = $_SESSION['login'];
  $status = 0;
  $vhid = $_GET['vhid'];
  $bookingno = mt_rand(100, 999);
  $ret = "SELECT * FROM tblrent where (:fromdate BETWEEN date(FromDate) and date(ToDate) || :todate BETWEEN date(FromDate) and date(ToDate) || date(FromDate) BETWEEN :fromdate and :todate) and equipmentId=:vhid";
  $query1 = $dbh->prepare($ret);
  $query1->bindParam(':vhid', $vhid, PDO::PARAM_STR);
  $query1->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
  $query1->bindParam(':todate', $todate, PDO::PARAM_STR);
  $query1->execute();
  $results1 = $query1->fetchAll(PDO::FETCH_OBJ);

  // Check if equipment is available for booking
  if ($query1->rowCount() == 0) {
    // Fetch the current status of the equipment
    $currentStatusQuery = "SELECT CurrentStatus FROM tblequipment WHERE id = :vhid";
    $currentStatusStmt = $dbh->prepare($currentStatusQuery);
    $currentStatusStmt->bindParam(':vhid', $vhid, PDO::PARAM_STR);
    $currentStatusStmt->execute();
    $currentStatus = $currentStatusStmt->fetch(PDO::FETCH_ASSOC);

    // Check if the current status is "Available"
    if ($currentStatus['CurrentStatus'] != "Not Available") {
      // Proceed with booking
      $sql = "INSERT INTO  tblrent(BookingNumber,userEmail,equipmentId,FromDate,ToDate,message,Status) VALUES(:bookingno,:useremail,:vhid,:fromdate,:todate,:message,:status)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
      $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
      $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
      $query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
      $query->bindParam(':todate', $todate, PDO::PARAM_STR);
      $query->bindParam(':message', $message, PDO::PARAM_STR);
      $query->bindParam(':status', $status, PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $dbh->lastInsertId();
      if ($lastInsertId) {
        echo "<script>alert('Booking successfull!');</script>";
        echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";
      } else {
        echo "<script>alert('Something went wrong! Please try again');</script>";
        echo "<script type='text/javascript'> document.location = 'eq-listing.php'; </script>";
      }
    } else {
      // Display alert if equipment is not available
      echo "<script>alert('Sorry,Equipment is not available for booking!');</script>";
      echo "<script type='text/javascript'> document.location = 'eq-listing.php'; </script>";
    }
  } else {
    echo "<script>alert('Equipment already booked for these days!');</script>";
    echo "<script type='text/javascript'> document.location = 'eq-listing.php'; </script>";
  }
}
?>



<!DOCTYPE HTML>
<html lang="en">

<head>

  <title>Farm Equipment Hire & Rental Hub | equipment Details</title>
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
  <script src="script.js" defer></script>

  <style>
    .inline {
      display: flex;
    }

    .inline>div {
      margin-right: 10px;
    }

    .inline>div:last-child {
      margin-right: 0;
    }
  </style>
  
</head>

<body>


  <!--Header-->
  <?php include('includes/header.php'); ?>
  <!-- /Header -->

  <!--Listing-Image-Slider-->

 <?php
$vhid = intval($_GET['vhid']);
//$sql = "SELECT tblequipment.*,tblcategory.CategoryName,tblcategory.id as bid, tblowner.Name AS owner_name, tblowner.mob AS owner_mob, tblowner.address AS owner_add from tblequipment join tblcategory on tblcategory.id=tblequipment.EquipmentCategory JOIN tblowner ON tblowner.id = tblequipment.ownerid where tblequipment.id=:vhid";
$sql = "SELECT tblequipment.*, tblcategory.CategoryName, tblcategory.id as bid, 
        tblowner.Name AS owner_name, tblowner.mob AS owner_mob, tblowner.address AS owner_add,
        AVG(rating.rating) AS average_rating
        FROM tblequipment
        JOIN tblcategory ON tblcategory.id = tblequipment.EquipmentCategory
        JOIN tblowner ON tblowner.id = tblequipment.ownerid
        LEFT JOIN rating ON rating.eq_id = tblequipment.id
        WHERE tblequipment.id = :vhid";

$query = $dbh->prepare($sql);
$query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;

if ($query->rowCount() > 0) {
  foreach ($results as $result) {
    $_SESSION['brndid'] = $result->bid;

    $averageRating = $result->average_rating;
        // Check if the average rating is null and set it to 0 if null
    $averageRating = $averageRating ? $averageRating : 0;
    ?>

      <br>
      <section class="inline">
        <div><img src="admin/img/equipmentimages/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive"
            alt="image" width="250" height="300"></div>
        <div><img src="admin/img/equipmentimages/<?php echo htmlentities($result->Vimage2); ?>" class="img-responsive"
            alt="image" width="250" height="300"></div>
        <div><img src="admin/img/equipmentimages/<?php echo htmlentities($result->Vimage3); ?>" class="img-responsive"
            alt="image" width="250" height="300"></div>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


        <div class="row">
          <div class="col-md-19">
            <div class="main_features">
              <ul>
                <li><i class="glyphicon glyphicon-star-empty" aria-hidden="true"></i>
                  <h5><strong>
                      <?php echo number_format($averageRating, 1); ?>
                    </strong></h5>
                  <p>Average Rating</p>
                </li>
                <li><i class="fa fa-calendar" aria-hidden="true"></i>
                  <h5><strong>
                      <?php echo htmlentities($result->ModelYear); ?>
                    </strong></h5>
                  <p>Manufacturing Year</p>
                </li>
                <li> <i class="fa fa-globe" aria-hidden="true"></i>
                  <h5><strong>
                      <?php echo htmlentities($result->EquipLocation); ?>
                    </strong></h5>
                  <p>Location</p>
                </li>

                <br>

              </ul>
            </div>
          </div>
        </div>
      </section>
      <!--/Listing-Image-Slider-->




      <!--Listing-detail-->
      <section class="listing-detail">
        <div class="container">
          <div class="listing_detail_head row">
            <div class="col-md-8">
              <h3>
                <?php echo htmlentities($result->EqipmentTitle); ?>
              </h3>
            </div>
            <div class="col-md-3">
              <div class="price_info">
                <p>Rs.
                  <?php echo htmlentities($result->PricePerDay); ?>
                </p><strong>Per Day</strong>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-9">
              <div class="listing_more_info">
                <div class="listing_detail_wrap">

                  <ul class="nav nav-tabs gray-bg" role="tablist">
                    <!-- <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab"> Overview </a></li> -->
                    <!-- <div><img src="admin/img/equipmentimages/<?php echo htmlentities($result->Vimage); ?>" class="img-responsive" alt="image" width="200" height="200"></div> -->

                    <!-- <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Equipment Overview</a></li> -->
                  </ul>




                  <div class="text">
                    <!-- Equipment-overview -->
                    <div role="text" class="text" id="vehicle-overview">
                      <div class="strong">
                        <pre
                          style="font-family:verdana"><?php echo htmlentities("Name:" . $result->owner_name . "\n" . "Mobile No:" . $result->owner_mob . "\n" . "Address:" . $result->owner_add); ?></pre>
                      </div>
                    </div>

                    <!-- Overview -->
                    <div role="table" class="Etable" id="accessories">
                      <table>

                        <tr>
                          <td><strong>Horse Power</strong></td>
                          <td> <strong>
                              <?php echo htmlentities($result->HorsePower); ?>
                            </strong></td>

                        </tr>
                        <tr>
                          <td><strong>CC Capacity</strong></td>
                          <td> <strong>
                              <?php echo htmlentities($result->CCCapcity); ?>
                            </strong></td>

                        </tr>
                        <tr>
                          <td><strong>Power Required</strong></td>
                          <td> <strong>
                              <?php echo htmlentities($result->PowerRequired); ?>
                            </strong></td>

                        </tr>
                        <tr>
                          <td><strong>Lifting Capacity</strong></td>
                          <td> <strong>
                              <?php echo htmlentities($result->LifttingCapacity); ?>
                            </strong></td>

                        </tr>
                        <tr>
                          <td><strong>Working Condition</strong></td>
                          <td> <strong>
                              <?php echo htmlentities($result->WorkingCondition); ?>
                            </strong></td>

                        </tr>
                        <tr>
                          <td><strong>Total Weight</strong></td>
                          <td><strong>
                              <?php echo htmlentities($result->CropType); ?>
                            </strong> </td>

                        </tr>

                        <tr>
                          <td><strong>Current Status</strong></td>
                          <td> <strong style="color:red;">
                              <?php echo htmlentities($result->CurrentStatus); ?>
                            </strong></td>
                        </tr>
                      
                      </table>

  
    </div>
    </div>
    </div>

    </div>
  <?php }
  } ?>

</div>

<!--Side-Bar-->
<aside class="col-md-3">


  <div class="sidebar_widget">
    <div class="widget_heading">
      <h5><i class="fa fa-envelope" aria-hidden="true"></i> Book Now</h5>
    </div>
    <form method="post">
      <div class="form-group">
        <label>From Date:</label>

        <input type="date" class="form-control" name="fromdate" id="fromdate" placeholder="From Date" required>

        <script>
          // Get the From Date input element
          var fromDateInput = document.getElementById('fromdate');

          // Get the current date
          var currentDate = new Date();
          var year = currentDate.getFullYear();
          var month = ('0' + (currentDate.getMonth() + 1)).slice(-2); // Adding 1 because JavaScript months are 0 indexed
          var day = ('0' + currentDate.getDate()).slice(-2);
          var minDate = year + '-' + month + '-' + day;

          // Set the minimum date for From Date input field
          fromDateInput.setAttribute('min', minDate);
        </script>

      </div>

      <div class="form-group">
        <label>To Date:</label>

        <input type="date" class="form-control" name="todate" id="todate" placeholder="To Date" required>

        <script>
          // Get the To Date and From Date input elements
          var toDateInput = document.getElementById('todate');
          var fromDateInput = document.getElementById('fromdate');

          // Function to set the minimum date for To Date input field
          function setMinDate() {
            var fromDateValue = fromDateInput.value;
            toDateInput.setAttribute('min', fromDateValue);
          }

          // Function to validate To Date against From Date
          function validateToDate() {
            var fromDateValue = fromDateInput.value;
            var toDateValue = toDateInput.value;

            // Check if To Date is same as From Date
            if (toDateValue === fromDateValue) {
              alert("Please Book Equipment for Minimum 1 Day");
              toDateInput.value = ""; // Clear the To Date input field
            }
          }

          // Add event listeners
          fromDateInput.addEventListener('change', function () {
            setMinDate();
            validateToDate();
          });

          toDateInput.addEventListener('change', validateToDate);
        </script>

      </div>


      <div class="form-group">
              <textarea rows="4" class="form-control" name="message" placeholder="Message"></textarea>
            </div>
          <?php if($_SESSION['login'])
              {?>
              <div class="form-group">
                <input type="submit" class="btn"  name="submit" value="Book Now">
              </div>
              <?php } else { ?>
                <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For Book</a>

              <?php } ?>
    </form>
  </div>
</aside>
<!--/Side-Bar-->


<!--/Listing-detail-->

<!-- ratings -->


<div class="divider"></div> 
<h6 class="text-capitalize text-center section-heading" style="padding-top: 3px;padding-bottom: 13px;margin-bottom: 40px;margin-top: 58px;"><strong>Equipment's Ratings & Reviews</strong></h6>

<!-- Form -->
<div class="container">

  <div class="row">
    
    <div class="col-md-6" style="padding: 35px;">
    
      <div class="table-responsive" style="height: fit-content;max-height: 500px;">
        <table class="table">
          <thead>
            <tr>
              <th colspan="5">
                <?php
                $server_name = "localhost";
                $user_name = "root";
                $password = "";
                $db_name = "farmrent";

                $conn = new mysqli($server_name, $user_name, $password, $db_name);

                if ($conn) {

                } else {

                  die("connection failed" . mysqli_connect_error());
                }

                // Function to get average rating for a equipment based on equipment_id
                if (isset($_GET['vhid'])) {
                  $eqId = $_GET['vhid'];
                }
                function getAverageRating($conn, $eqId)
                {
                  // Prepare the SQL query
                  $sql = "SELECT AVG(rating) AS average_rating FROM rating WHERE eq_id = '$eqId'";
                  // Execute the query
                  $result = mysqli_query($conn, $sql);

                  // Check if the query was successful
                  if ($result) {
                    // Fetch the result as an associative array
                    $row = mysqli_fetch_assoc($result);

                    // Free the result set
                    mysqli_free_result($result);

                    // Return the average rating
                    return $row['average_rating'];
                  } else {
                    // If the query failed, handle the error (you may log it or return an error message)
                    return false;
                  }
                }
                $averageRating = getAverageRating($conn, $eqId);
                ?>
                <p class="d-inline-flex"><strong>Avg Rating :&nbsp;</strong> <?php echo number_format($averageRating, 1); // Display the average rating with one decimal place  ?>     
                
                </p>
              </th>
            </tr>
            <tr>
										  <th>Name</th>
											<th>Date</th>
											<th>Rating</th>
											<th>Review</th>
											
							</tr>
          </thead>
          <tbody>
            <?php
            // var_dump($_SESSION['login']);
            // Assuming you have a database connection in $conn
            

            if (isset($_GET['vhid'])) {
              $eqId = $_GET['vhid'];
            }

            // Function to fetch reviews for a specific equipment
            function fetchRoomReviews($conn, $eqId)
            {
              // Prepare the SQL query to fetch reviews
              $sql = "SELECT * FROM rating WHERE eq_id = '$eqId'";
              // Execute the query
              $result = mysqli_query($conn, $sql);
              // Check for errors
              if (!$result) {
                die("Error: " . mysqli_error($conn));
              }
              // Fetch the result as an associative array
              $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
              // Free the result set
              mysqli_free_result($result);
              return $reviews;
            }
            // Function to fetch farmer information based on user_id
            function fetchStudentInfo($conn, $stud_id)
            {
              // Prepare the SQL query to fetch farmer information
              $sql = "SELECT FullName FROM tblusers WHERE id = '$stud_id'";
              // Execute the query
              $result = mysqli_query($conn, $sql);
              // Check if the query was successful
              if ($result) {
                // Fetch the result as an associative array
                $studentInfo = mysqli_fetch_assoc($result);
                // Free the result set
                mysqli_free_result($result);
                return $studentInfo;
              } else {
                // If the query failed, handle the error (you may log it or return an error message)
                return [];
              }
            }

            // Example usage to fetch and display reviews for a specific equipment_id
            $reviews = fetchRoomReviews($conn, $eqId);
            // Display the reviews
            foreach ($reviews as $review) {
              $rr_date = $review['rating_date'];
              $rr_rating = $review['rating'];
              $rr_review = $review['review'];
              $stud_id = $review['user_id'];
              // Fetch farmer information
              $studentInfo = fetchStudentInfo($conn, $stud_id);
              $user_name = $studentInfo['FullName'];
              $originalDate = $review['rating_date'];
              $dateTime = new DateTime($originalDate);
              // Format the date as "DD MM YYYY"
              $formattedDate = $dateTime->format('d-m-Y');
            
            ?>
              <!-- // Display the information as needed
              echo '<tr>';
              echo '<td>';
              echo '<div class="d-flex" style="margin-top: 0;margin-left: 0;">';
              echo '<div>';
            
              echo "<p class='fw-bold mb-0' style='margin-top: 11px;'><b>Name:</b> $user_name</p>";
              echo '</div>';
              echo "<p class='fw-bold mb-0' style='margin-top: 11px;'><b>Rating:</b> $rr_rating <span class='bi bi-star-fill'></span></p>";

              // echo '<div class="d-inline-flex" style="height: 36px;margin: 3px;margin-left: 46px;margin-right: 38px;">
              //           <p class="d-inline-flex float-start" style="margin-left: 7px;margin-top: 1px;font-size: 20px;">';
              // echo "<p class='fw-bold mb-0' style='margin-top: 11px;'><b>Rating:</b> $rr_rating</p>";
              // echo '</p><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
              //             viewBox="0 0 16 16" class="bi bi-star-fill"
              //             style="color: var(--bs-yellow);margin: 0;margin-left: 14px;height: 38px;width: 25px;">
              //             <path
              //               d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
              //             </path>
              //           </svg>
              //         </div>';
              // ... Display the rest of the information as needed
              // echo '.';
              echo '</div>';
              echo '<div class="d-flex" style="margin-top: 0;margin-left: 0;">';
              echo "<p class='fw-bold mb-0' style='margin-top: 11px;'><b>Date:</b>$formattedDate</span></p>";
              echo '</div>';
              echo "<p class='fw-bold mb-0' style='margin-top: 11px;'><b>Review:</b>$rr_review</span></p>";
              echo '</td>';
              echo '</tr>'; -->

              <tr>
											
											<td><?php echo htmlentities($user_name);?></td>
											<td><?php echo htmlentities($formattedDate);?></td>
											<td>
                        <?php
                        // Convert the rating to integer
                        $rating = intval($rr_rating);
                        // Loop to display stars based on the rating
                        for ($i = 0; $i < $rating; $i++) {
                          echo '<i class="fa fa-star" style="color: gold;"></i>';
                        }
                        ?>
                      </td>
											<td><?php echo htmlentities($rr_review);?></td>
											
              </tr>
              <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-6">
      <div id="contact-1" style="background-image: url('assets/img/map-image.png?h=dde716a63e31eca254a82a274d4f56c0');">
        <div class="container" style="height: 302.234px;margin-top: 0px;">
          <div class="row">
            <div class="col-lg-12 text-center">
              <!-- <h6 class="text-capitalize section-heading" style="margin-bottom: 27px;"><strong><em>
                    Give your own review</em></strong></h6> -->
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <form action="addReview.php" method="POST" id="contactForm-1" name="contactForm">
                <div class="card mb-5">
                  <div class="card-body p-sm-5">
                    <form method="post">
                      <form action="addReview.php" method="post">
                        <input hidden type="text" name="eq_id" value="<?php echo $eqId; ?>">
                        <div class="mb-3">
                          <strong><label class="form-label">Select Ratings:</label></strong>
                          

                          <!-- Radio button for rating 1 -->
                          <div class="form-check d-inline-flex">
                              <input class="form-check-input" type="radio" id="rating-1" name="rating" value="1" style="margin-left: -4px; margin-right: 0px;">
                              <label class="form-check-label" for="rating-1" style="margin-left: 5px; margin-right: 0px;">1 <i class="fa fa-star"></i></label>
                              &nbsp; &nbsp;

                              <input class="form-check-input" type="radio" id="rating-2" name="rating" value="2" style="margin-left: -4px; margin-right: 0px;">
                              <label class="form-check-label" for="rating-2" style="margin-left: 5px; margin-right: 0px;">2 <i class="fa fa-star"></i></label>
                              &nbsp; &nbsp;

                              <input class="form-check-input" type="radio" id="rating-3" name="rating" value="3" style="margin-left: -4px; margin-right: 0px;">
                              <label class="form-check-label" for="rating-3" style="margin-left: 5px; margin-right: 0px;">3 <i class="fa fa-star"></i></label>
                              &nbsp; &nbsp;

                              <input class="form-check-input" type="radio" id="rating-4" name="rating" value="4" style="margin-left: -4px; margin-right: 0px;">
                              <label class="form-check-label" for="rating-4" style="margin-left: 5px; margin-right: 0px;">4 <i class="fa fa-star"></i></label>
                              &nbsp; &nbsp;

                              <input class="form-check-input" type="radio" id="rating-5" name="rating" value="5" style="margin-left: -4px; margin-right: 0px;">
                              <label class="form-check-label" for="rating-5" style="margin-left: 5px; margin-right: 0px;">5 <i class="fa fa-star"></i></label>
                          </div>

                          

                          <!-- Radio button for rating 2 -->
                         
                      </div>

                        <strong><label class="form-label">Give Review:</label></strong>

                        <div class="mb-3">
                          <textarea class="form-label" id="message-1" name="message" rows="3" cols="70" placeholder="Your Review"></textarea>
                        </div>

                        <br>
                        <div>
                          <button class="btn btn-primary d-block w-100" type="submit" name="submit">Submit Review</button>
                        </div>
                      </form>
                    </form>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
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

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/interface.js"></script>
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>

</body>

</html>