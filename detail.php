<form action="search.php" method="GET">
    <input type="text" name="query" placeholder="Search businesses..." required>
    <button type="submit">Search</button>
</form>
<?php
require 'db_connection.php';

$business_id = $_GET['id'];
$sql = "SELECT name, address, services, prices, image_path FROM Businesses WHERE id = $business_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $business = $result->fetch_assoc();
    echo "<h2>{$business['name']}</h2>
          <p>{$business['address']}</p>
          <p>Services: {$business['services']}</p>
          <p>Prices: {$business['prices']}</p>
          <img src='{$business['image_path']}' alt='{$business['name']}' width='200'>";

    // Fetch reviews
    $sql_reviews = "SELECT user_name, review, rating FROM Reviews WHERE business_id = $business_id";
    $reviews_result = $conn->query($sql_reviews);

    if ($reviews_result->num_rows > 0) {
        $ratings = [];
        while ($row = $reviews_result->fetch_assoc()) {
            $ratings[] = $row['rating'];
            echo "<p><strong>{$row['user_name']}</strong>: {$row['review']} (Rating: {$row['rating']})</p>";
        }
        $average_rating = array_sum($ratings) / count($ratings);
        echo "<h3>Average Rating: $average_rating / 5</h3>";
    } else {
        echo "<p>No reviews yet.</p>";
    }
}
$conn->close();
?>
