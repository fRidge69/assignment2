<?php
include 'db.php'; // Make sure to include your database connection file

// Initialize $car to prevent undefined variable warning
$car = null;

// Get car ID from URL (for example, ?id=1)
if (isset($_GET['id'])) {
    $car_id = (int)$_GET['id']; // Cast to integer for safety

    // Prepare and execute the SQL statement
    $sql = "SELECT model, price, image_url FROM cars WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $car = $result->fetch_assoc(); // Fetch the associative array
    } else {
        echo "No car found.";
        exit; // Stop the script if no car is found
    }
} else {
    echo "Invalid car ID.";
    exit; // Stop the script if no ID is provided
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- Link to the CSS file -->
    <title>Car Details</title>
</head>
<body>
    <div class="container">
        <div class="car-details">
            <h1><?php echo isset($car['model']) ? htmlspecialchars($car['model']) : 'Car not found'; ?></h1>
            <div class="image-container">
                <img src="<?php echo isset($car['image_url']) ? htmlspecialchars($car['image_url']) : 'placeholder.jpg'; ?>" alt="<?php echo isset($car['model']) ? htmlspecialchars($car['model']) : 'Image not available'; ?>">
            </div>
            <p class="price">Price: $<?php echo isset($car['price']) ? htmlspecialchars($car['price']) : 'Price not available'; ?></p>
        </div>
        <a class="back-button" href="index.php">Back to Car List</a>
    </div>
</body>
</html>

