<?php
include "authguard.php";
include "nav.php";
include "../shared/connection.php"; // Including the connection file

// Query to get cancelled bookings
$sql = "SELECT b.book_id, b.name, b.email, b.phone, b.address, b.guests, b.arrivals, b.leaving, b.status, 
               p.pack_name, p.pack_img 
        FROM book b 
        INNER JOIN package p ON b.location = p.pack_id 
        WHERE b.status = 'Cancelled'";

if ($result = $conn->query($sql)) {
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cancelled Bookings</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }

            .container {
                width: 90%;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            h1 {
                text-align: center;
                margin-bottom: 20px;
                color: #333;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }

            th {
                background-color: #f0f0f0;
            }

            .image-container {
                width: 100px;
                height: 100px;
                overflow: hidden;
            }

            img {
                width: 100%;
                height: auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Cancelled Bookings</h1>
            <table>
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Booking Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Booking Date</th>
                        <th>Package Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sno = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $sno++; ?></td>
                            <td><?php echo htmlspecialchars($row['book_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['arrivals']); ?> to <?php echo htmlspecialchars($row['leaving']); ?></td>
                            <td class="image-container">
                                <img src="../images/<?php echo htmlspecialchars($row['pack_img']); ?>" alt="Package Image">
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
    </html>

    <?php
} else {
    echo "Error fetching data.";
}

// Close the connection
$conn->close();
?>
