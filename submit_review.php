<form action="add_business.php" method="POST" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="name" required>
    <label>Address:</label>
    <textarea name="address" required></textarea>
    <label>Services:</label>
    <textarea name="services" required></textarea>
    <label>Prices:</label>
    <textarea name="prices" required></textarea>
    <label>Business Image:</label>
    <input type="file" name="business_image" accept="image/*">
    <button type="submit">Add Business</button>
</form>
<?php
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $business_id = (int) $_POST['business_id'];
    $user_name = $conn->real_escape_string($_POST['user_name']);
    $review = $conn->real_escape_string($_POST['review']);
    $rating = (int) $_POST['rating'];

    $sql = "INSERT INTO Reviews (business_id, user_name, review, rating) 
            VALUES ($business_id, '$user_name', '$review', $rating)";

    if ($conn->query($sql)) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
