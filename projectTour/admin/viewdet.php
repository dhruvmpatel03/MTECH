<?php
include "authguard.php";
include "nav.php";
include "../shared/connection.php"; // Including the connection file

// Check if booking ID is provided in the URL
if (isset($_GET['book_id'])) {
    $book_id = intval($_GET['book_id']);

    // Query to get the booking details along with the package details
    $sql = "SELECT b.name, b.email, b.phone, b.address, b.guests, b.arrivals, b.leaving, b.status, 
                   p.pack_name, p.pack_desc, p.pack_img 
            FROM book b 
            INNER JOIN package p ON b.location = p.pack_id 
            WHERE b.book_id = ?";

    // Prepare and bind the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if booking data is available
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Handle approval or cancellation
            if (isset($_POST['approve'])) {
                $update_sql = "UPDATE book SET status = 'Approved' WHERE book_id = ?";
                if ($update_stmt = $conn->prepare($update_sql)) {
                    $update_stmt->bind_param("i", $book_id);
                    $update_stmt->execute();
                    $update_stmt->close();
                    header("Location: approve.php"); // Redirect to approve page
                    exit();
                }
            } elseif (isset($_POST['cancel'])) {
                $update_sql = "UPDATE book SET status = 'Cancelled' WHERE book_id = ?";
                if ($update_stmt = $conn->prepare($update_sql)) {
                    $update_stmt->bind_param("i", $book_id);
                    $update_stmt->execute();
                    $update_stmt->close();
                    header("Location: cancel.php"); // Redirect to cancel page
                    exit();
                }
            }
            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>View Booking</title>
                <style>
                    .container {
                        max-width: 1200px;
                        margin: 20px auto;
                        padding: 20px;
                        background-color: white;
                        border: 1px solid #ddd;
                        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                    }

                    h2 {
                        background-color: #8e44ad;
                        color: white;
                        padding: 10px;
                        margin: 0 0 20px 0;
                        text-align: left;
                    }

                    .booking-header {
                        color: black;
                        font-weight: bold;
                        font-size: 18px;
                        margin-bottom: 20px;
                    }

                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 20px;
                    }

                    table th, table td {
                        padding: 12px 15px;
                        border: 1px solid #ddd;
                    }

                    table th {
                        background-color: #f5f5f5;
                        text-align: left;
                    }

                    .section-header {
                        font-weight: bold;
                        color: #0056b3;
                        text-align: left;
                        padding: 10px;
                        background-color: #f1f1f1;
                    }

                    .room-image {
                        max-width: 300px; /* Adjust the width as needed */
                        border-radius: 8px;
                        display: block;
                        margin: 0 auto;
                    }

                    .action-buttons {
                        text-align: center;
                        margin-top: 20px;
                    }

                    button {
                        background-color: #007bff;
                        color: #fff;
                        border: none;
                        padding: 8px 15px;
                        font-size: 16px;
                        border-radius: 5px;
                        cursor: pointer;
                        margin: 5px;
                    }

                    button:hover {
                        background-color: #0056b3;
                    }

                    .hidden {
                        display: none;
                    }
                </style>
            </head>
            <body>

            <div class="container">
                <h2>View Booking Details</h2>

                <p class="booking-header">Booking Number: <span><?php echo $book_id; ?></span></p>

                <table>
                    <tr>
                        <th colspan="2" class="section-header">Booking Detail:</th>
                    </tr>
                    <tr>
                        <th>Customer Name</th>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                    </tr>
                    <tr>
                        <th>Guests</th>
                        <td><?php echo htmlspecialchars($row['guests']); ?></td>
                    </tr>
                    <tr>
                        <th>Arrival Date</th>
                        <td><?php echo htmlspecialchars($row['arrivals']); ?></td>
                    </tr>
                    <tr>
                        <th>Leaving Date</th>
                        <td><?php echo htmlspecialchars($row['leaving']); ?></td>
                    </tr>

                    <tr>
                        <th colspan="2" class="section-header">Package Detail:</th>
                    </tr>
                    <tr>
                        <th>Package Name</th>
                        <td><?php echo htmlspecialchars($row['pack_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Package Description</th>
                        <td><?php echo htmlspecialchars($row['pack_desc']); ?></td>
                    </tr>
                    <tr>
                        <th>Package Image</th>
                        <td>
                            <img src="../images/<?php echo htmlspecialchars($row['pack_img']); ?>" alt="Package Image" class="room-image">
                        </td>
                    </tr>
                </table>

                <?php if ($row['status'] === 'Pending') { ?>
                    <div class="action-buttons">
                        <form method="post">
                            <button type="submit" name="approve">Approve</button>
                            <button type="submit" name="cancel">Cancel</button>
                        </form>
                    </div>
                <?php } ?>

            </div>

            </body>
            </html>

            <?php
        } else {
            echo "No booking found with this ID.";
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error in query preparation.";
    }

} else {
    echo "No booking ID provided.";
}

// Close the connection
$conn->close();
?>
