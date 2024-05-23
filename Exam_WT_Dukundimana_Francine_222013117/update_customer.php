<?php
// Connection details
include('database-connection.php');

// Check if CustomerID is set
if(isset($_REQUEST['CustomerID'])) {
    $customerId = $_REQUEST['CustomerID'];
    
    $stmt = $connection->prepare("SELECT * FROM customers WHERE CustomerID=?");
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];
        $email = $row['Email'];
        $phone = $row['Phone'];
        $address = $row['Address'];
        $country = $row['Country'];
    } else {
        echo "Customer not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Customers</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Form of Customers -->
        <h2><u>Update Form of Customers</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
        
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" value="<?php echo isset($firstName) ? $firstName : ''; ?>">
            <br><br>

            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" value="<?php echo isset($lastName) ? $lastName : ''; ?>">
            <br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
            <br><br>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
            <br><br>

            <label for="address">Address:</label>
            <input type="text" name="address" value="<?php echo isset($address) ? $address : ''; ?>">
            <br><br>

            <label for="country">Country:</label>
            <input type="text" name="country" value="<?php echo isset($country) ? $country : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        
        </form>
    </center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    
    // Update the customer in the database
    $stmt = $connection->prepare("UPDATE customers SET FirstName=?, LastName=?, Email=?, Phone=?, Address=?, Country=? WHERE CustomerID=?");
    $stmt->bind_param("ssssssi", $firstName, $lastName, $email, $phone, $address, $country, $customerId);
    $stmt->execute();
    
    // Redirect to customers.php or any other desired page
    header('Location: customers.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
