<?php
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $event_type = mysqli_real_escape_string($conn, $_POST['event_type']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $event_time = mysqli_real_escape_string($conn, $_POST['event_time']);
    $guest_count = mysqli_real_escape_string($conn, $_POST['guest_count']);
    $event_location = mysqli_real_escape_string($conn, $_POST['event_location']);
    $special_requests = mysqli_real_escape_string($conn, $_POST['special_requests']);
    $package_selected = mysqli_real_escape_string($conn, $_POST['package_selected']);
    $budget = mysqli_real_escape_string($conn, $_POST['budget']);

    // Insert customer details into 'customers' table
    $customer_query = "INSERT INTO customers (name, email, phone_number) VALUES ('$name', '$email', '$phone')";
    if ($conn->query($customer_query) === TRUE) {
        // Get the last inserted customer ID
        $customer_id = $conn->insert_id;

        // Insert event details into 'events' table
        $event_query = "INSERT INTO events (customer_id, event_type, event_date, event_time, guest_count, event_location, special_requests, package_selected, budget) 
                        VALUES ('$customer_id', '$event_type', '$event_date', '$event_time', '$guest_count', '$event_location', '$special_requests', '$package_selected', '$budget')";

        if ($conn->query($event_query) === TRUE) {
            // Successful insertion
            echo "Booking successful! Your event has been scheduled.";
        } else {
            // Error with event insertion
            echo "Error: " . $event_query . "<br>" . $conn->error;
        }
    } else {
        // Error with customer insertion
        echo "Error: " . $customer_query . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>