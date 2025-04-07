<?php
session_start();
include('includes/config.php');
if(isset($_POST['onlogin']))
{
$email=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT Id,email,pass FROM tblowner WHERE email=:email and pass=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
	$result = $results[0]; 
$_SESSION['alogin']=$_POST['username'];
$_SESSION['userid'] = $result->Id; 

echo "<script type='text/javascript'>

 document.location = 'owner/dashboard.php?id={$result->Id}'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>

<div class="modal fade" id="onloginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"> उपकरण मालक | लॉगिन</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="username" placeholder="ईमेल">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="पासवर्ड">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember">
               
                </div>
                <div class="form-group">
                  <input type="submit" name="onlogin" value="Login" class="btn btn-block">
                </div>
              </form>

        
            </div>
           
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>तुम्ही खाते तयार केले नाही ? <a href="#onsignupform" data-toggle="modal" data-dismiss="modal">येथे साइन अप करा</a></p>


  </div>
  </div>
        
      </div>
    </div>
  </div>
</div>