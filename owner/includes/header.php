<?php
session_start(); // Start the session if not started already

$oid = $_SESSION['userid'];

// Assuming $dbh is your PDO database connection
$sql = "SELECT Name AS owner_name FROM tblowner WHERE Id = :oid";
$query = $dbh->prepare($sql);
$query->bindParam(':oid', $oid, PDO::PARAM_STR);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

// Check if the query executed successfully and fetched a result
if ($result) {
    $owner_name = $result['owner_name'];
} else {
    // Handle the case where no owner name is found
    $owner_name = "Unknown"; // or any default value
}
?>

<div class="brand clearfix">
    <label style="font-size: 25px;">Farm Equipment Hire & Rental Hub | Owner Panel</label>  
    <span class="menu-btn"><i class="fa fa-bars"></i></span>
    <ul class="ts-profile-nav">
        <li class="ts-account">
            <a href="#">Hello, <?php echo $owner_name; ?><i class="fa fa-angle-down hidden-side"></i></a>
            <ul>
                <li><a href="onpro.php?id=<?php echo $oid;?>">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</div>
