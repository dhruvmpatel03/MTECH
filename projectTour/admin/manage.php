<?php
// Include authentication guard and navigation bar
include "authguard.php";
include "nav.php";

// Include the database connection file
include "../shared/connection.php"; 

// Fetch the packages data from the database
$query = "SELECT * FROM package ";
$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages</title>

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

        .action-buttons {
            text-align: center;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Packages</h1>
        <table>
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Package Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Creation Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sn = 1; // Serial number counter
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo htmlspecialchars($row['pack_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['pack_desc']); ?></td>
                        <td>
                            <div class="image-container">
                                <img src="../images/<?php echo htmlspecialchars($row['pack_img']); ?>" alt="Package Image">
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($row['created_date']); ?></td>
                        <td class="action-buttons">
                            <button onclick="window.location.href='edit.php?id=<?php echo $row['pack_id']; ?>'">Edit</button>
                            <button onclick="deletePackage(<?php echo $row['pack_id']; ?>)">Delete</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function deletePackage(id) {
            if (confirm("Are you sure you want to delete this package?")) {
                window.location.href = "delete.php?id=" + id;
            }
        }
    </script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
