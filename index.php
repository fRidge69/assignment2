<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Showroom</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Mercedes-Benz Car Models</h1>
    <ul>
        <?php
        $sql = "SELECT id, model FROM cars";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li><a href='car_details.php?id=" . $row['id'] . "'>" . $row['model'] . "</a></li>";
            }
        } else {
            echo "No cars found.";
        }
        ?>
    </ul>
</body>
</html>
