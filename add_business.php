<?php
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $services = $conn->real_escape_string($_POST['services']);
    $prices = $conn->real_escape_string($_POST['prices']);
    $image_path = '';

    // Handle image upload
    if (!empty($_FILES['business_image']['name'])) {
        $target_dir = "uploads/";
        $image_path = $target_dir . basename($_FILES['business_image']['name']);

        // Ensure the directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES['business_image']['tmp_name'], $image_path)) {
            echo "Image uploaded successfully.<br>";
        } else {
            echo "Image upload failed.<br>";
        }
    }

    // Insert into database
    $sql = "INSERT INTO Businesses (name, address, services, prices, image_path) 
            VALUES ('$name', '$address', '$services', '$prices', '$image_path')";

    if ($conn->query($sql)) {
        echo "Business added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
