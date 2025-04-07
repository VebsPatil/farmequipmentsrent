<?php
// error_reporting(0);
if(isset($_POST['signup'])) {
    $fname = strtoupper($_POST['fullname']);
    $email = strtoupper($_POST['emailid']);
    $mobile = $_POST['mobileno'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $password = md5($_POST['password']); 
    
    $sql = "INSERT INTO tblusers(FullName, EmailId, ContactNo, City, Country, Password) VALUES(:fname, :email, :mobile, :city, :country, :password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':city', $city, PDO::PARAM_STR);
    $query->bindParam(':country', $country, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    
    $query->execute();
    
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId) {
        echo "<script>alert('Registration successful. Now you can login');</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}
?>

<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>
<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">शेतकरी साइनअप</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form  method="post" name="signup" onSubmit="return valid();">
                <div class="form-group">
                  <input type="text" class="form-control" name="fullname" placeholder="संपूर्ण नाव" pattern="[a-zA-Z][a-zA-Z ]{3,30}$" required="required">
                </div>
                      <div class="form-group">
                  <input type="text" class="form-control" name="mobileno" placeholder="मोबाईल नंबर" maxlength="10" pattern="[789][0-9]{9}" required="required">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" placeholder="ईमेल" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span> 
                </div>
                <!-- <div class="form-group">
                  <textarea class="form-control" type="text" name="Address" placeholder="संपूर्ण पत्ता" required="required" rows="2" ></textarea>
                </div> -->
                <div class="form-group">
                  <input class="form-control" name="city" placeholder="गाव" required="required" type="text">
                </div>
                <div class="form-group">
                  <input class="form-control"  name="country" placeholder="तालुका" required="required"  type="text">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="पासवर्ड" required="required">
                </div>
                <div class="form-group">
                  <input type="submit" value="साइन अप" name="signup" id="submit" class="btn btn-block">
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>आधीच खाते तयार केले आहे?  <a href="#loginform" data-toggle="modal" data-dismiss="modal">येथे लॉगिन करा</a></p>
      </div>
    </div>
  </div>
</div>