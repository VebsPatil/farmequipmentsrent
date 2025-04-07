<?php
//error_reporting(0);

$host = "localhost";
$dbname = "farmrent";
$username = "root";
$password = "";

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_POST['signup'])) {
    $fname = $_POST['username'];
    $email = $_POST['emailid'];
    $mobile = $_POST['mobileno'];
    $address = $_POST['address'];
    $password = md5($_POST['password']);
    
    $sql = "INSERT INTO tblowner(Name, mob, email, address, pass) VALUES(:fname, :mobile, :email, :address, :password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);

    try {
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Registration successful. Now you can login');  document.location = 'index.php';</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Farm Equipment Hire & Rental Hub | Owner Control</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
        <div class="form-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <h1 class="text-center text-bold mt-4x" style="color:#fff">Owner | Sign Up</h1>
                        <div class="well row pt-2x pb-3x bk-light">
                            <div class="col-md-8 col-md-offset-2">

                                <form method="post" name="signup" onSubmit="return valid();">

                                    <label for="" class="text-uppercase text-sm">संपूर्ण नाव </label>
                                    <input type="text" placeholder="name" name="username" class="form-control mb" pattern="[a-zA-Z][a-zA-Z ]{3,30}$" required="required">

                                    <label for="" class="text-uppercase text-sm">मोबाईल नंबर </label>
                                    <input type="text" class="form-control mb" name="mobileno" placeholder="Mobile Number" maxlength="10" pattern="[789][0-9]{9}" required="required">

                                    <label for="" class="text-uppercase text-sm">ईमेल</label>
                                    <input type="email" class="form-control mb" name="emailid" id="emailid" onBlur="checkAvailability()" pattern="[a-z]+[0-9]*@[a-z]+[0-9]*\.[a-z]{2,3}" placeholder="Email Address" required="required">
                                    
                                    <label for="" class="text-uppercase text-sm">संपूर्ण पत्ता</label>
                                    <textarea class="form-control mb" type="text" name="address" placeholder="Address" required="required" rows="2"></textarea>
                                   
                                    <label for="" class="text-uppercase text-sm">पासवर्ड</label>
                                    <input type="password" placeholder="Password" name="password" class="form-control mb" required="required">


                                    <button class="btn btn-primary btn-block" type="submit" value="Sign Up" name="signup" id="submit">Sign Up</button>

                                </form>

                                <p>आधीच खाते तयार केले आहे? <a href="index.php">येथे लॉगिन करा</a></p>
                                
                                
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>

</body>

</html>

