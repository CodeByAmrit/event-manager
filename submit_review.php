<?php
include 'db_connection.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $rating = intval($_POST['rating']);
    $review = $conn->real_escape_string($_POST['review']);

    // SQL query to insert form data into the database
    $sql = "INSERT INTO reviews (name, email, rating, review) VALUES ('$name', '$email', $rating, '$review')";

    if ($conn->query($sql) === TRUE) {
       echo "<script>alert('Thank you for your review!'); window.location.href = 'dashboard.php';</script>";
    } else {
        echo "<h3>Error: " . $sql . "<br>" . $conn->error . "</h3>";
    }
}

// Close connection
$conn->close();
?>
