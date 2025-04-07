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
		$airconditioner = $_POST['HorcePower'];
		$powerdoorlocks = $_POST['CC'];
		$antilockbrakingsys = $_POST['lift'];
		$brakeassist = $_POST['Crop'];
		$powersteering = $_POST['Cutting'];
		$driverairbag = $_POST['WorkingCondition'];
		$passengerairbag = $_POST['CurrentStatus'];
		$id = intval($_GET['id']);

		$sql = "update tblequipment set EqipmentTitle=:equiptitle,EquipmentCategory=:category,OwnerDetails=:ownerview,PricePerDay=:priceperday,EquipLocation=:loc,ModelYear=:modelyear,HorsePower=:HorcePower,CCCapcity=:CC,LifttingCapacity=:lift,CropType=:Crop,PowerRequired=:Cutting,WorkingCondition=:WorkingCondition,CurrentStatus=:CurrentStatus where id=:id";
		$query = $dbh->prepare($sql);
		$query->bindParam(':equiptitle', $equiptitle, PDO::PARAM_STR);
		$query->bindParam(':category', $category, PDO::PARAM_STR);
		$query->bindParam(':ownerview', $ownerview, PDO::PARAM_STR);
		$query->bindParam(':priceperday', $priceperday, PDO::PARAM_STR);
		$query->bindParam(':loc', $loc, PDO::PARAM_STR);
		$query->bindParam(':modelyear', $modelyear, PDO::PARAM_STR);


		$query->bindParam(':HorcePower', $airconditioner, PDO::PARAM_STR);
		$query->bindParam(':CC', $powerdoorlocks, PDO::PARAM_STR);
		$query->bindParam(':lift', $antilockbrakingsys, PDO::PARAM_STR);
		$query->bindParam(':Crop', $brakeassist, PDO::PARAM_STR);
		$query->bindParam(':Cutting', $powersteering, PDO::PARAM_STR);
		$query->bindParam(':WorkingCondition', $driverairbag, PDO::PARAM_STR);
		$query->bindParam(':CurrentStatus', $passengerairbag, PDO::PARAM_STR);
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();
		
		// $oid = isset($_GET['id']) ? $_GET['id'] : null;
		// echo "<script>alert('Equipment Added Successfully');</script>";
		// echo "<script type='text/javascript'> window.location = 'manage-eq.php?oid=$oid'; </script>";
		$msg = "Equipment Updated successfully";
		// exit; 


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
		<meta name="theme-color" content="#3e454c">

		<title>Farm Equipment Hire & Rental Hub | Owner Edit Equipment Info</title>

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

							<h2 class="page-title">Edit Equipment</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Basic Info</div>
										<div class="panel-body">
											<?php if ($msg) { ?>
												<div class="succWrap"><strong>SUCCESS</strong>:
													<?php echo htmlentities($msg); ?>
												</div>
											<?php } ?>
											<?php
											$id = intval($_GET['id']);
											$sql = "SELECT tblequipment.*,tblcategory.CategoryName,tblcategory.id as bid, tblowner.Name AS owner_name, tblowner.mob AS owner_mob, tblowner.address AS owner_add from tblequipment join tblcategory on tblcategory.id=tblequipment.EquipmentCategory JOIN tblowner ON tblowner.id = tblequipment.ownerid where tblequipment.id=:id";
											$query = $dbh->prepare($sql);
											$query->bindParam(':id', $id, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) { ?>

												<form method="post" class="form-horizontal" enctype="multipart/form-data">
														<div class="form-group">

														<label class="col-sm-2 control-label">Select Equipment<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<select class="selectpicker" name="categoryname" required>
																	<option value="<?php echo htmlentities($result->bid); ?>">
																		<?php echo htmlentities($bdname = $result->CategoryName); ?>
																	</option>
																	<?php $ret = "select id,CategoryName from tblcategory";
																	$query = $dbh->prepare($ret);
																	//$query->bindParam(':id',$id, PDO::PARAM_STR);
																	$query->execute();
																	$resultss = $query->fetchAll(PDO::FETCH_OBJ);
																	if ($query->rowCount() > 0) {
																		foreach ($resultss as $results) {
																			if ($results->CategoryName == $bdname) {
																				continue;
																			} else {
																				?>
																				<option value="<?php echo htmlentities($results->id); ?>">
																					<?php echo htmlentities($results->CategoryName); ?>
																				</option>
																			<?php }
																		}
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
																<label class="col-sm-2 control-label">Select Village<span style="color:red">*</span></label>
																	<div class="col-sm-3">
																	<select class="selectpicker" name="loc" required>
																				<option
																					value="<?php echo htmlentities($result->EquipLocation); ?>">
																					<?php echo htmlentities($result->EquipLocation); ?>
																				</option>
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
															<label class="col-sm-2 control-label">Equipment Name <span
																	style="color:red">*</span></label>
															<div class="col-sm-3">
																<input type="text" name="equiptitle" class="form-control" value="<?php echo htmlentities($result->EqipmentTitle); ?>" required>
															</div>

															<label class="col-sm-3 control-label">Upload Equipment Images<span style="color:red">*</span></label>
															<div class="col-sm-3">
																	Image 1 <img src="img/equipmentimages/<?php echo htmlentities($result->Vimage1); ?>" width="100" height="100" style="border:solid 1px #000">
																	<a href="changeimage1.php?imgid=<?php echo htmlentities($result->id) ?>">Change Image 1</a>
															</div>
														</div>

														<div class="form-group">
																<label class="col-sm-2 control-label">Equipment Manufacting Year <span style="color:red">*</span></label>
																<div class="col-sm-3">
																	<input type="text" name="modelyear" class="form-control"value="<?php echo htmlentities($result->ModelYear); ?>" required>
																</div>

																<label class="col-sm-3 control-label"><span style="color:red"></span></label>
																<div class="col-sm-3">
																	Image 2<img src="img/equipmentimages/<?php echo htmlentities($result->Vimage2); ?>" width="100" height="100" style="border:solid 1px #000">
																	<a href="changeimage2.php?imgid=<?php echo htmlentities($result->id) ?>">Change Image 2</a>
																</div>
														</div>

														

														<div class="form-group">
															<label class="col-sm-2 control-label">Horse Power<span style="color:red">*</span></label>
															<div class="col-sm-3">
																<?php if ($result->HorsePower) { ?>
																		
																		<div class="textarea textarea-inline">
																			<input type="textarea" id="inlineTextarea1" name="HorcePower"
																				class="form-control"
																				value="<?php echo htmlentities($result->HorsePower); ?>">
																		</div>
																	<?php } else { ?>
																		
																		<div class="textarea textarea-success textarea-inline">
																			<input type="textarea" id="inlineTextarea1" name="HorcePower"
																				class="form-control"
																				value="<?php echo htmlentities($result->HorsePower); ?>">
																		</div>
																	<?php } ?>
															</div>
															<label class="col-sm-3 control-label"><span style="color:red"></span></label>
															<div class="col-sm-3">
																Image 3<img src="img/equipmentimages/<?php echo htmlentities($result->Vimage3); ?>" width="100" height="100" style="border:solid 1px #000">
																	<a href="changeimage3.php?imgid=<?php echo htmlentities($result->id) ?>">Change Image 3</a>
															</div>

														
												</div>

												<div class="form-group">
														<label class="col-sm-2 control-label">Lifting Capacity (in Kg)</label>
														<div class="col-sm-3">
														<?php if ($result->LifttingCapacity) { ?>
																	
																	<div class="textarea textarea-inline">
																		<input type="textarea" id="inlineTextarea1" name="lift"
																			class="form-control"
																			value="<?php echo htmlentities($result->LifttingCapacity); ?>">
																	</div>
																<?php } else { ?>
																	
																	<div class="textarea textarea-success textarea-inline">
																		<input type="textarea" id="inlineTextarea1" name="lift"
																			class="form-control"
																			value="<?php echo htmlentities($result->LifttingCapacity); ?>">

																	</div>
														<?php } ?>
														</div>

														
														
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">CC Capacity (in CC)</label>
														<div class="col-sm-3">
															<?php if ($result->CCCapcity) { ?>
																		
																		<div class="textarea textarea-inline">
																			<input type="textarea" id="inlineTextarea1" class="form-control"
																				name="CC"
																				value="<?php echo htmlentities($result->CCCapcity); ?>">
																		</div>
																	<?php } else { ?>
																		
																		<div class="textarea textarea-success textarea-inline">
																			<input type="textarea" id="inlineTextarea1" name="CC"
																				class="form-control"
																				value="<?php echo htmlentities($result->CCCapcity); ?>">

																		</div>
																	<?php } ?>
														</div>

														
														
													</div>


													<div class="form-group">
														<label class="col-sm-2 control-label">Total Weight (in Kg) <span style="color:red">*</span></label>
														<div class="col-sm-3">
														<?php if ($result->CropType) { ?>
																	
																	<div class="textarea textarea-inline">
																		<input type="textarea" id="inlineTextarea1" name="Crop"
																			class="form-control"
																			value="<?php echo htmlentities($result->CropType); ?>">
																	</div>
																<?php } else { ?>
																	
																	<div class="textarea textarea-success textarea-inline">
																		<input type="textarea" id="inlineTextarea1" name="Crop"
																			class="form-control"
																			value="<?php echo htmlentities($result->CropType); ?>">

																	</div>
																<?php } ?>
														</div>

														
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">Power Required (in HP) <span style="color:red">*</span></label>
														<div class="col-sm-3">
															<?php if ($result->PowerRequired) { ?>
																	
																	<div class="textarea textarea-inline">
																		<input type="textarea" id="inlineTextarea1" name="Cutting"
																			class="form-control"
																			value="<?php echo htmlentities($result->PowerRequired); ?>">
																	</div>
																<?php } else { ?>
																	
																	<div class="textarea textarea-success textarea-inline">
																		<input type="textarea" id="inlineTextarea1" name="Cutting"
																			class="form-control"
																			value="<?php echo htmlentities($result->PowerRequired); ?>">

																	</div>
																<?php } ?>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-2 control-label">Working Condition<span style="color:red">*</span></label>
														<div class="col-sm-3">
															<select class="selectpicker" name="WorkingCondition" required>
																<option value="">Select</option>
																<option value="Good" <?php if($result->WorkingCondition == "Good") echo "selected"; ?>>Good</option>
																<option value="Moderate" <?php if($result->WorkingCondition == "Moderate") echo "selected"; ?>>Moderate</option>
																<option value="Low" <?php if($result->WorkingCondition == "Low") echo "selected"; ?>>Low</option>
															</select>
														</div>
													</div>

												<div class="form-group">
														<label class="col-sm-2 control-label">Price Per Day <span style="color:red">*</span></label>
														<div class="col-sm-3">
														<input type="text" name="priceperday" class="form-control" value="<?php echo htmlentities($result->PricePerDay); ?>" required>
														</div>
												</div>
												<div class="form-group">
														<label class="col-sm-2 control-label">Current Status<span style="color:red">*</span></label>
														<div class="col-sm-3">
														<?php if ($result->CurrentStatus) {
																	?>
																	
																	<div class="textarea textarea-inline">
																		<input type="text" id="inlineTextarea1" name="CurrentStatus" class="form-control" value="<?php echo htmlentities($result->CurrentStatus); ?>">
																	</div>
																<?php } else { ?>
																	
																	<div class="textarea textarea-inline">
																		<input type="text" id="inlineTextarea1" name="CurrentStatus" class="form-control" value="<?php echo htmlentities($result->CurrentStatus); ?>">
																	</div>
																<?php } ?>
														</div>
												</div>
												<div class="form-group">
													<div class="col-sm-3 col-sm-offset-4">
														<button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
														<!-- <a href="manage-eq.php" class="btn btn-primary">Back</a> -->
														<!-- <a href="manage-eq.php?owner_id=<?php echo htmlentities($oid);?>"><button class="btn btn-primary">Back</button></a> -->
													</div>
													<br><br>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>

			<?php }
											} ?>


		

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