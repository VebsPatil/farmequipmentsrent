<header>
  <div class="default-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <div class="logo"> <img src="assets/images/logo78.png" alt="image" width="250" height="55"/> </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">
         <?php
         $sql = "SELECT EmailId,ContactNo from tblcontactusinfo";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach ($results as $result) {
$email=$result->EmailId;
$contactno=$result->ContactNo;
}
?>   

            <div class="header_widgets">
              <div class=""> <i class="" aria-hidden="true"></i> </div>
              <p class="uppercase_text"></p>
              <a href="mailto:"><p></p></a> </div>
            <div class="header_widgets">
              <div class=""> <i class="" aria-hidden="true"></i> </div>
              <p class="uppercase_text"> </p>
              <a href="tel:"><p></p></a>  </div>
            <div class="social-follow">
            
            </div>

           
   <?php   if(strlen($_SESSION['login'])==0)
	{	
?>
  <div class="login_btn"> <a href="#onloginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal"> <i class="fa fa-user-circle-o"></i> Owner Login</a> </div>
  <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal"> <i class="fa fa-user-circle"></i> Farmer Login</a> </div>
 
<?php }
else{ 

echo  "<h6>Welcome To Farm Equipment Hire & Rental Hub</h6>";
 } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="header_wrap">
        <div class="user_login">
          <ul>
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i> 
<?php 
$email=$_SESSION['login'];
$sql ="SELECT FullName FROM tblusers WHERE EmailId=:email ";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
	{

	 echo htmlentities($result->FullName); }}?>
   <i class="fa fa-angle-down" aria-hidden="true"></i></a>
              <ul class="dropdown-menu">
              <!-- <a href="#loginform"  data-toggle="modal" data-dismiss="modal"> <i class="fa fa-user-circle-o"></i>प्रथम लॉगिन करा</a> -->
                <div class="first text-center">
              
              <?php if($_SESSION['login']){?>
            <li><a href="profile.php">Profile Settings</a></li>
              
            <li><a href="my-booking.php">My Booking</a></li>
            <li><a href="post-testimonial.php">Give Feedback</a></li>
          <li><a href="my-testimonials.php">My Feedback</a></li>
            <li><a href="logout.php">Sign Out</a></li>
            <?php } ?>
          </ul>
            </li>
          </ul>
        </div>
        <div class="header_search">
          <div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
          <form action="search.php" method="post" id="header-search-form">
            <input type="text" placeholder="Search..." name="searchdata" class="form-control" required="true">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navigation">
    <ul class="nav navbar-nav">
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>><a href="index.php">Home</a></li>
        <li <?php if(isset($_GET['type']) && $_GET['type'] == 'aboutus') echo 'class="active"'; ?>><a href="page.php?type=aboutus">About Us</a></li>
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'eq-listing.php') echo 'class="active"'; ?>><a href="eq-listing.php">Equipment Listing</a></li>
        <li <?php if(isset($_GET['type']) && $_GET['type'] == 'faqs') echo 'class="active"'; ?>><a href="video.php?type=faqs">Knowledge Section</a></li>
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'contact-us.php') echo 'class="active"'; ?>><a href="contact-us.php">Contact Us</a></li>
    </ul>
</div>

    </div>
  </nav>
  <!-- Navigation end --> 
  
</header>