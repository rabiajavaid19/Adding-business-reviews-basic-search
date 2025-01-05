<form action="submit_review.php" method="POST">
    <input type="hidden" name="business_id" value="<business_id_here>">
    <label>Your Name:</label>
    <input type="text" name="user_name" required>
    <label>Your Review:</label>
    <textarea name="review" required></textarea>
    <label>Rating (1-5):</label>
    <input type="number" name="rating" min="1" max="5" required>
    <button type="submit">Submit Review</button>
</form>
<?php
require 'db_connection.php';

if (isset($_GET['query'])) {
    $query = $conn->real_escape_string($_GET['query']);
    $sql = "SELECT id, name, address, image_path FROM Businesses 
            WHERE name LIKE '%$query%' OR services LIKE '%$query%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>
                    <img src='{$row['image_path']}' alt='{$row['name']}' width='100'>
                    <h3>{$row['name']}</h3>
                    <p>{$row['address']}</p>
                  </div>";
        }
    } else {
        echo "No results found.";
    }

    $conn->close();
}
?>
