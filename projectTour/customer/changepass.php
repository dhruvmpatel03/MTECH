<?php
// Include authentication and connection setup
include "authguard.php"; // Ensures the user is authenticated
include "nav.php";       // Navigation bar (if applicable)
include "../shared/connection.php"; // Include the database connection

// Fetch the admin's userid from the session
$userid = $_SESSION['userid']; // Assuming 'userid' is stored in session after login

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch form inputs
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Hash the current password using MD5
    $hashed_current_password = md5($current_password);

    // Step 1: Check if the current password matches the one in the database
    $query = "SELECT password FROM user WHERE userid = '$userid'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $db_password = $user_data['password']; // Fetch current MD5-hashed password from the database

        // Verify if the current password matches the one in the database
        if ($hashed_current_password === $db_password) {

            // Step 2: Check if the new password and confirm password match
            if ($new_password === $confirm_password) {

                // Step 3: Hash the new password using MD5
                $hashed_new_password = md5($new_password);

                // Step 4: Update the password in the database
                $update_query = "UPDATE user SET password = '$hashed_new_password' WHERE userid = '$userid'";

                if (mysqli_query($conn, $update_query)) {
                    echo "<script>alert('Password changed successfully.'); window.location.href = 'home.php';</script>";
                } else {
                    echo "<script>alert('Error updating password.'); window.location.href = 'changepass.php';</script>";
                }
            } else {
                // If new password and confirm password do not match
                echo "<script>alert('New password and confirm password do not match.'); window.location.href = 'changepass.php';</script>";
            }
        } else {
            // If current password does not match
            echo "<script>alert('Current password is incorrect.'); window.location.href = 'changepass.php';</script>";
        }
    } else {
        // If no user found in the database
        echo "<script>alert('User not found.'); window.location.href = 'login.php';</script>";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
       
        /* Adding to your existing style.css */

/* Container for the change password form */
.changepass {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: var(--light-bg);
    padding: 2rem;
}

.changepass .container {
    width: 100%;
    max-width: 50rem;
    padding: 3rem;
    background: var(--white);
    box-shadow: var(--box-shadow);
    border-radius: 1rem;
    text-align: center;
}

.changepass .container h2 {
    font-size: 2.5rem;
    color: var(--main-color);
    margin-bottom: 2rem;
}

.changepass form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.changepass form label {
    font-size: 1.6rem;
    color: var(--black);
}

.changepass form input[type="password"] {
    padding: 1.2rem;
    font-size: 1.6rem;
    border: var(--border);
    border-radius: .5rem;
    color: var(--black);
    background: var(--light-white);
}

.changepass form input[type="password"]:focus {
    background: var(--black);
    color: var(--white);
}

.changepass form button {
    padding: 1.2rem;
    background: var(--main-color);
    color: var(--white);
    border: none;
    border-radius: .5rem;
    font-size: 1.6rem;
    cursor: pointer;
    transition: background .3s ease;
}

.changepass form button:hover {
    background: var(--black);
}

    </style>
</head>
<body>
<div class="changepass">
<div class="container">
    <h2>Change Password</h2>
    <form action="changepass.php" method="post">
        <label for="current_password">Current Password:</label>
        <input type="password" name="current_password" id="current_password" required>

        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" id="new_password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>

        <button type="submit">Change Password</button>
    </form>
</div>
   </div>
   <!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<!-- custom js file link  -->
<script src="../js/script.js"></script>
</body>
</html>
