<?php
error_reporting(0);
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "farmrent";

// Establish a connection to the database
$conn = new mysqli($server_name, $user_name, $password, $db_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

// Assuming your session variable is set and contains a valid email address
if (isset($_SESSION['login'])) {
    $email = $_SESSION['login'];

    // Query to retrieve the user ID based on the email (use prepared statement)
    $sql = "SELECT id FROM tblusers WHERE EmailId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userID = $row['id'];

        // Get other form data
        $id = uniqid();
        $eq_Id = $_POST['eq_id'];
        $rating = $_POST['rating'];
        $review = $_POST['message'];
        $rr_date = date('Y-m-d');

        // Check if the user has booked this equipment
        $existingBookingQuery = "SELECT * FROM tblrent WHERE userEmail = ? AND equipmentId = ?";
        $stmt = $conn->prepare($existingBookingQuery);
        $stmt->bind_param("si", $email, $eq_Id);
        $stmt->execute();
        $existingBookingResult = $stmt->get_result();

        if ($existingBookingResult->num_rows > 0) {
            $bookingRow = $existingBookingResult->fetch_assoc();
            $bookingStatus = $bookingRow['Status'];
            $toDate = $bookingRow['ToDate'];
            $currentDate = date('Y-m-d');

            // Check if the booking is rejected
            if ($bookingStatus == 2) {
                echo "<script>
                        alert('Your booking is rejected! You cannot give ratings.');
                        window.history.back();
                      </script>";
            } elseif ($bookingStatus == 0) {
                echo "<script>
                        alert('Your booking is not accepted yet! You cannot give ratings.');
                        window.history.back();
                      </script>";
            } elseif ($bookingStatus == 1 && $currentDate < $toDate) {
                echo "<script>
                        alert('Your booking is accepted but your work is not done yet!');
                        window.history.back();
                      </script>";
            } else {
                // Check if the user has already submitted a rating for this equipment
                $existingReviewQuery = "SELECT * FROM rating WHERE user_id = ? AND eq_id = ?";
                $stmt = $conn->prepare($existingReviewQuery);
                $stmt->bind_param("is", $userID, $eq_Id);
                $stmt->execute();
                $existingReviewResult = $stmt->get_result();

                if ($existingReviewResult->num_rows > 0) {
                    echo "<script>
                            alert('You have already submitted a rating for this equipment👍');
                            window.history.back();
                          </script>";
                } else {
                    // Insert the review into the database
                    $insertReviewQuery = "INSERT INTO rating (id, rating_date, eq_id, rating, review, user_id) 
                                          VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($insertReviewQuery);
                    $stmt->bind_param("sssssi", $id, $rr_date, $eq_Id, $rating, $review, $userID);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        echo "<script>
                                alert('Review submitted successfully!, Thanks for Review.');
                                window.history.back();
                              </script>";
                    } else {
                        echo "<script>
                                alert('You haven\\'t selected Ratings!');
                                window.history.back();
                              </script>";
                    }
                }
            }
        } else {
            echo "<script>
                    alert('You haven\\'t booked this equipment yet.');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "No matching record found for the given email.";
    }
} else {
    echo "<script>
    alert('Login First!...👍');
    window.history.back();
    </script>";
}

// Close the database connection
$stmt->close();
$conn->close();
?>
