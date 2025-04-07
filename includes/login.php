<?php
if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password,FullName,ContactNo FROM tblusers WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['login']=$_POST['email'];

$_SESSION['fname']=$results->FullName;
$currentpage=$_SERVER['REQUEST_URI'];
echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>

<div class="modal fade" id="loginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">शेतकरी लॉगिन</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="ईमेल">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="पासवर्ड">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember">
               
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block">
                </div>
              </form>
            </div>
           
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>तुम्ही खाते तयार केले नाही?<a href="#signupform" data-toggle="modal" data-dismiss="modal">
येथे साइन अप करा</a></p>

        <!-- <div class="col-md-6"> -->
    <!-- <h6>Moduals</h6> -->
     <!-- <br>
    <div class="container">
      <div class="row">
        <div class="col-md-11 bg-light text-left">
        <i class="fa fa-user-circle-o"></i> 
        <h6> Login as Admin</h6>
        <button><a href="admin/">Admin Login</a></button>
        
        </div>
      </div>
    </div>
  
  </div>
  </div>  -->

    

  <!-- <div class="col-md-6"> -->
    <!-- <h6>Moduals</h6> -->
    <!-- <br>
    <div class="container">
      <div class="row text-center">
        <div class="col-md-5 bg-light text-right">
        <i class ="fa fa-user-circle-o"></i>
         <h6>जर तुम्ही उपकरणाचे मालक असाल तर येथे लॉग इन करा</h6>
        <button align="center"><a href="owner/">Owner Login</a></button>

        </div>
      </div>
    </div>
  </div>
  </div> -->

  </div>
  </div>
        <!-- <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Forgot Password ?</a></p> -->
      </div>
    </div>
  </div>
</div>