<?php 
session_start();
include('config.php');
error_reporting(0);

if(isset($_POST['submitbook'])) {
    // Fetch form data
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate']; 
    $message = $_POST['message'];
    $useremail = $_SESSION['login'];
    $status = 0;
    $vhid = $_GET['vhid'];
    $bookingno = mt_rand(100, 999);

    // Check for conflicting bookings
    $check_booking_query = "SELECT * FROM tblrent WHERE (:fromdate BETWEEN date(FromDate) AND date(ToDate) OR :todate BETWEEN date(FromDate) AND date(ToDate) OR date(FromDate) BETWEEN :fromdate AND :todate) AND equipmentId = :vhid";
    $check_booking_stmt = $dbh->prepare($check_booking_query);
    $check_booking_stmt->bindParam(':vhid', $vhid, PDO::PARAM_STR);
    $check_booking_stmt->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
    $check_booking_stmt->bindParam(':todate', $todate, PDO::PARAM_STR);
    $check_booking_stmt->execute();
    $conflicting_bookings = $check_booking_stmt->rowCount();

    if($conflicting_bookings == 0) {
        // Insert booking into database
        $insert_booking_query = "INSERT INTO tblrent (BookingNumber, userEmail, equipmentId, FromDate, ToDate, message, Status) VALUES (:bookingno, :useremail, :vhid, :fromdate, :todate, :message, :status)";
        $insert_booking_stmt = $dbh->prepare($insert_booking_query);
        $insert_booking_stmt->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
        $insert_booking_stmt->bindParam(':useremail', $useremail, PDO::PARAM_STR);
        $insert_booking_stmt->bindParam(':vhid', $vhid, PDO::PARAM_STR);
        $insert_booking_stmt->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
        $insert_booking_stmt->bindParam(':todate', $todate, PDO::PARAM_STR);
        $insert_booking_stmt->bindParam(':message', $message, PDO::PARAM_STR);
        $insert_booking_stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $insert_booking_stmt->execute();

        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId) {
            echo "<script>alert('Booking successful!');</script>";
            echo "<script>window.location.href='my-booking.php';</script>";
            exit;
        } else {
            echo "<script>alert('Something went wrong! Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Equipment already booked for these days');</script>";
    }
}
?>

<div class="modal fade" id="onbookingform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"> Book Now</h3>
      </div>
      <div class="sidebar_widget">
         
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
                  fromDateInput.addEventListener('change', function() {
                      setMinDate();
                      validateToDate();
                  });

                  toDateInput.addEventListener('change', validateToDate);
                  </script>

            </div>
            <input type="hidden" id="vhidInput" name="vhid" value="">


            <div class="form-group">
              <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
            </div>
          <?php if($_SESSION['login'])
              {?>
              <div class="form-group">
                <input type="submit" class="btn"  name="submitbook" value="Book Now">
              </div>
              <?php } else { ?>
                    <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For Book</a>

              <?php } ?>
          </form>
        </div>
    
  </div>
        
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        // Handler for modal show event
        $('#onbookingform').on('show.bs.modal', function (event) {
            var link = $(event.relatedTarget); // Link that triggered the modal
            var vhid = link.data('vhid'); // Extract vhid from data-vhid attribute

            // Set the vhid in the booking form
            $('#vhidInput').val(vhid);
        });
    });
</script>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>