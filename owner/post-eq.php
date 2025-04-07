<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	$redirectPage = 'http://localhost/FinalYear/farmrent/index.php';

header("location: $redirectPage"); 
} else {

	if (isset($_POST['submit'])) {
		$equiptitle = $_POST['equiptitle'];
		$category = $_POST['categoryname'];
		$ownerview = $_POST['ownerimp'];
		$priceperday = $_POST['priceperday'];
		$loc = $_POST['loc'];
		$modelyear = $_POST['modelyear'];
		$vimage1 = $_FILES["img1"]["name"];
		$vimage2 = $_FILES["img2"]["name"];
		$vimage3 = $_FILES["img3"]["name"];

		$HorcePower = $_POST['HorcePower'];
		$CC = $_POST['CC'];
		$lift = $_POST['lift'];
		$Crop = $_POST['Crop'];
		$Cutting = $_POST['Cutting'];
		$WorkingCondition = $_POST['WorkingCondition'];
		$CurrentStatus = $_POST['CurrentStatus'];
		$oid = $_POST['oid'];

		move_uploaded_file($_FILES["img1"]["tmp_name"], "img/equipmentimages/" . $_FILES["img1"]["name"]);
		move_uploaded_file($_FILES["img2"]["tmp_name"], "img/equipmentimages/" . $_FILES["img2"]["name"]);
		move_uploaded_file($_FILES["img3"]["tmp_name"], "img/equipmentimages/" . $_FILES["img3"]["name"]);


		$sql = "INSERT INTO tblequipment(EqipmentTitle,EquipmentCategory,OwnerDetails,PricePerDay,EquipLocation,ModelYear,Vimage1,Vimage2,Vimage3,HorsePower,CCCapcity,LifttingCapacity,CropType,PowerRequired,WorkingCondition,CurrentStatus,ownerid) VALUES(:equiptitle,:category,:ownerview,:priceperday,:loc,:modelyear,:vimage1,:vimage2,:vimage3,:HorcePower,:CC,:lift,:Crop,:Cutting,:WorkingCondition,:CurrentStatus,:oid)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':equiptitle', $equiptitle, PDO::PARAM_STR);
		$query->bindParam(':category', $category, PDO::PARAM_STR);
		$query->bindParam(':ownerview', $ownerview, PDO::PARAM_STR);
		$query->bindParam(':priceperday', $priceperday, PDO::PARAM_STR);
		$query->bindParam(':loc', $loc, PDO::PARAM_STR);
		$query->bindParam(':modelyear', $modelyear, PDO::PARAM_STR);
		$query->bindParam(':vimage1', $vimage1, PDO::PARAM_STR);
		$query->bindParam(':vimage2', $vimage2, PDO::PARAM_STR);
		$query->bindParam(':vimage3', $vimage3, PDO::PARAM_STR);

		$query->bindParam(':HorcePower', $HorcePower, PDO::PARAM_STR);
		$query->bindParam(':CC', $CC, PDO::PARAM_STR);
		$query->bindParam(':lift', $lift, PDO::PARAM_STR);
		$query->bindParam(':Crop', $Crop, PDO::PARAM_STR);
		$query->bindParam(':Cutting', $Cutting, PDO::PARAM_STR);
		$query->bindParam(':WorkingCondition', $WorkingCondition, PDO::PARAM_STR);
		$query->bindParam(':CurrentStatus', $CurrentStatus, PDO::PARAM_STR);
		$query->bindParam(':oid', $oid, PDO::PARAM_STR);

		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId) {
			echo "<script>alert('Equipment Added Successfully');</script>";
            echo "<script type='text/javascript'> document.location = 'manage-eq.php?id=$id'; </script>";
			//$msg = "Equipment posted successfully";
		} else {
			$error = "Something went wrong. Please try again";
		}
		
	}

	$id = isset($_GET['id']) ? $_GET['id'] : null;
	?>
	<!doctype html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>Farm Equipment Hire & Rental Hub | Owner Control</title>

		<!-- Font awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>

	</head>

	<body>
		<?php include('includes/header.php'); ?>
		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Add Equipment</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Equipment Info</div>
										<?php if ($error) { ?>
											<div class="errorWrap"><strong>ERROR</strong>:
												<?php echo htmlentities($error); ?>
											</div>
										<?php } else if ($msg) { ?>
												<div class="succWrap"><strong>SUCCESS</strong>:
												<?php echo htmlentities($msg); ?>
												</div>
										<?php } ?>

										<div class="panel-body">
											<form method="post" class="form-horizontal" enctype="multipart/form-data">
											<div class="form-group">
												<label class="col-sm-2 control-label">Select Equipment<span style="color:red"> *</span></label>
												<div class="col-sm-4">
													<select class="selectpicker" name="categoryname" required>
														<option value=""> Select </option>
														<?php
														$ret = "select id,CategoryName from tblcategory";
														$query = $dbh->prepare($ret);
														$query->execute();
														$results = $query->fetchAll(PDO::FETCH_OBJ);
														if ($query->rowCount() > 0) {
															foreach ($results as $result) {
														?>
																<option value="<?php echo htmlentities($result->id); ?>">
																	<?php echo htmlentities($result->CategoryName); ?>
																</option>
														<?php }
														} ?>
													</select>
												</div>

												<?php
												$sql = "SELECT * FROM tblowner WHERE id = :id";
												$query = $dbh->prepare($sql);
												$query->bindParam(':id', $id, PDO::PARAM_INT);
												$query->execute();
												$user = $query->fetch(PDO::FETCH_ASSOC);
												?>
												<label class="col-sm-2 control-label">Owner Name</label>
												<div class="col-sm-3">
													<textarea class="form-control" name="ownerimp" rows="1" readonly><?php echo isset($user['Name']) ? $user['Name'] : '';?></textarea>
												</div>

											</div>


												<div class="form-group">
													<label class="col-sm-2 control-label">Equipment Name  <span style="color:red"> *</span></label>
													<div class="col-sm-3">
														<input type="text" name="equiptitle" class="form-control" required>
													</div>

													<label class="col-sm-3 control-label">Owner Phone</label>
													<div class="col-sm-3">
														<textarea class="form-control" name="ownerimp" rows="1" readonly><?php echo isset($user['mob']) ? $user['mob'] : ''; ?></textarea>
													</div>
												</div>
													
												<div class="form-group">
														<label class="col-sm-2 control-label">Manufacturing Year <span style="color:red">*</span></label>
														<div class="col-sm-3">
															<input type="text" name="modelyear" class="form-control" required>
														</div>

														<label class="col-sm-3 control-label">Owner Address</label>
														<div class="col-sm-3">
														<textarea class="form-control" name="ownerimp" rows="2" readonly><?php echo isset($user['address']) ? $user['address'] : ''; ?></textarea>
														</div>
												</div>

												<!-- <div class="form-group">
														<label class="col-sm-2 control-label">Equipment Number <span style="color:red">*</span></label>
														<div class="col-sm-3">
															<input type="text" name="modelyear" class="form-control" required>
														</div>

												</div> -->

												<div class="form-group">
														<label class="col-sm-2 control-label">Horse Power (in HP)<span style="color:red"> *</span></label>
														<div class="col-sm-3">
														<input type="textarea" id="inlineTextarea1" name="HorcePower" class="form-control" required>
														</div>

														<label class="col-sm-3 control-label">Select Location<span style="color:red">*</span></label>
														<div class="col-sm-3">
														<select class="selectpicker" name="loc" required>
															<option value=""> Select </option>
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
														<input type="hidden" name="oid" value="<?php echo $id;?>">
												</div>

												<div class="form-group">
														<label class="col-sm-2 control-label">Lifting Capacity (in Kg)</label>
														<div class="col-sm-3">
														<input type="textarea" id="inlineTextarea1" name="lift" class="form-control">
														</div>

														<label class="col-sm-3 control-label">Upload Equipment Images<span style="color:red">*</span></label>
														<div class="col-sm-3">
																Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
														</div>
														
															
														
												</div>

												<div class="form-group">
														<label class="col-sm-2 control-label">CC Capacity (in CC)</label>
														<div class="col-sm-3">
														<input type="textarea" id="inlineTextarea1" name="CC" class="form-control">
														</div>

														<label class="col-sm-3 control-label"><span style="color:red"></span></label>
															<div class="col-sm-3">
																Image 2<span style="color:red">*</span><input type="file" name="img2" required>
															</div>
														
												</div>

												<div class="form-group">
														<label class="col-sm-2 control-label">Total Weight (in Kg) <span style="color:red">*</span></label>
														<div class="col-sm-3">
														<input type="textarea" id="inlineTextarea1" name="Crop" class="form-control" required>
														</div>

														<label class="col-sm-3 control-label"><span style="color:red"></span></label>
														<div class="col-sm-3">
																Image 3<span style="color:red">*</span><input type="file" name="img3" required>
															</div>
												</div>
												<div class="form-group">
														<label class="col-sm-2 control-label">Power Required (in HP) <span style="color:red">*</span></label>
														<div class="col-sm-3">
														<input type="textarea" id="inlineTextarea1" name="Cutting" class="form-control" required>
														</div>
												</div>
												<div class="form-group">
														<!-- <label class="col-sm-2 control-label">Working Condition<span style="color:red">*</span></label>
														<div class="col-sm-3">
														<input type="text" id="inlineTextarea1" name="WorkingCondition" class="form-control" required>
														</div> -->

														<label class="col-sm-2 control-label">Working Condition<span style="color:red"> *</span></label>
														<div class="col-sm-3">
														    <select class="selectpicker" name="WorkingCondition" required>
															   <option value=""> Select </option>
															   <option value="Good">Good</option>
															   <option value="Modarate">Modarate</option>
														 	   <option value="Low">Bad</option>
															
														    </select>
														</div>
												</div>
												<div class="form-group">
														<label class="col-sm-2 control-label">Price Per Day <span style="color:red">*</span></label>
														<div class="col-sm-3">
														<input type="text" id="inlineTextarea1" name="priceperday" class="form-control" required>
														</div>
												</div>
												<div class="form-group">

												<label class="col-sm-2 control-label">Current Status<span style="color:red"> *</span></label>
														<div class="col-sm-3">
														    <select class="selectpicker" name="CurrentStatus" required>
															   <option value=""> Select </option>
															   <option value="Good">Available</option>
															   <option value="Modarate">Not Available</option>
														 	   
															
														    </select>
														</div>
														
												</div>
												
												<div class="form-group">
													<div class="col-sm-5 col-sm-offset-5">
														<button class="btn btn-default" type="reset">Cancel</button>
														<button class="btn btn-primary" name="submit" type="submit">Add Equipment</button>
													
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
<?php } ?>