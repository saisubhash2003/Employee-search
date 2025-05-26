<?php
// Dummy credentials
$valid_username = "employee1";
$valid_password = "secure123";

// Get form inputs
$username = $_POST['username'];
$password = $_POST['password'];

// Validate credentials
if ($username === $valid_username && $password === $valid_password) {
    // Redirect to employee search page
    header("Location: employee-add.php");
    exit();
} else {
    echo "<h3 style='color:red; text-align:center;'>Invalid login. Please try again.</h3>";
    echo "<p style='text-align:center;'><a href='index.html'>Back to Login</a></p>";
}
?>
