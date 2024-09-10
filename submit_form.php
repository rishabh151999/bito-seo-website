<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {

    // Retrieve form data
    $name = $_POST['name'];
    $organization = $_POST['organization'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $country = $_POST['country'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'bito-seo-website');

    // Check connection
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO contact (name, organization, email, phone, city, country) VALUES (?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("ssssss", $name, $organization, $email, $phone, $city, $country);

        // Execute the statement
        if ($stmt->execute()) { 
            echo "<script>alert('Details Submitted Successfully');</script>";
            
            // Redirect to the index page after a short delay
            echo "<script>window.location.href = 'index.php';</script>";
            
            // Optionally clear the form data
            $_POST = array();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>
