<?php
session_start(); // Start the session

// Database credentials
 include('database-connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection and check password
    $sql = "SELECT UserID, password FROM users WHERE email=?"; 
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($UserID, $hashed_password);
        $stmt->fetch();
        // Verify the hashed password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['UserID'] = $UserID;
            header("Location: home.html");
            exit();
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "User not found";
    }
}

$connection->close();
?>
