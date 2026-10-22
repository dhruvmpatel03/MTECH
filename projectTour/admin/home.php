<?php
include "authguard.php";
include "nav.php";
include "../shared/connection.php"; // Assuming this file connects to your database

// Fetch count for all bookings
$query_all_bookings = "SELECT COUNT(*) AS count FROM book";
$result_all_bookings = mysqli_query($conn, $query_all_bookings);
$row_all_bookings = mysqli_fetch_assoc($result_all_bookings);
$all_booking_count = $row_all_bookings['count'];

// Fetch count for approved bookings
$query_approved_bookings = "SELECT COUNT(*) AS count FROM book WHERE status = 'approved'";
$result_approved_bookings = mysqli_query($conn, $query_approved_bookings);
$row_approved_bookings = mysqli_fetch_assoc($result_approved_bookings);
$approved_booking_count = $row_approved_bookings['count'];

// Fetch count for cancelled bookings
$query_cancelled_bookings = "SELECT COUNT(*) AS count FROM book WHERE status = 'cancelled'";
$result_cancelled_bookings = mysqli_query($conn, $query_cancelled_bookings);
$row_cancelled_bookings = mysqli_fetch_assoc($result_cancelled_bookings);
$cancelled_booking_count = $row_cancelled_bookings['count'];

// Fetch count for registered users where usertype is 'customer'
$query_reg_users = "SELECT COUNT(*) AS count FROM user WHERE usertype = 'customer'";
$result_reg_users = mysqli_query($conn, $query_reg_users);
$row_reg_users = mysqli_fetch_assoc($result_reg_users);
$reg_users_count = $row_reg_users['count'];

// Maximum count for scaling the bars (you can adjust this)
$max_count = max($all_booking_count, $approved_booking_count, $cancelled_booking_count, $reg_users_count);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tours Dashboard</title>

   <!-- custom css file link --> 
   <link rel="stylesheet" href="../css/home.css">

   <style>
       .progress-bar {
           background-color: #e0e0e0;
           border-radius: 5px;
           overflow: hidden;
           height: 20px;
           margin: 10px 0;
       }

       .progress-bar-fill {
           height: 100%;
           background-color: #4caf50;
           text-align: right;
           padding-right: 10px;
           box-sizing: border-box;
           color: white;
           font-weight: bold;
       }
   </style>
</head>
<body>

<div class="dashboard">
    <div class="card new-booking">
        <h3>All Bookings</h3>
        <div class="count"><?php echo $all_booking_count; ?></div>
        <div class="progress-bar">
            <div class="progress-bar-fill" style="width: <?php echo ($all_booking_count / $max_count) * 100; ?>%;">
           
            </div>
        </div>
    </div>
    <div class="card approved-booking">
        <h3>Approved Bookings</h3>
        <div class="count"><?php echo $approved_booking_count; ?></div>
        <div class="progress-bar">
            <div class="progress-bar-fill" style="width: <?php echo ($approved_booking_count / $max_count) * 100; ?>%;">
                
            </div>
        </div>
    </div>
    <div class="card cancelled-booking">
        <h3>Cancelled Bookings</h3>
        <div class="count"><?php echo $cancelled_booking_count; ?></div>
        <div class="progress-bar">
            <div class="progress-bar-fill" style="width: <?php echo ($cancelled_booking_count / $max_count) * 100; ?>%;">
               
            </div>
        </div>
    </div>
    <div class="card reg-users">
        <h3>Registered Users</h3>
        <div class="count"><?php echo $reg_users_count; ?></div>
        <div class="progress-bar">
            <div class="progress-bar-fill" style="width: <?php echo ($reg_users_count / $max_count) * 100; ?>%;">
                
            </div>
        </div>
    </div>
</div>

<footer>
   Tours and Travel Management System
</footer>

</body>
</html>
