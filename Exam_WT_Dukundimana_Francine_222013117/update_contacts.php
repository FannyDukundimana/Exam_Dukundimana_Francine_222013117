<?php
// Connection details
include('database-connection.php');

// Check if ContactID is set
if(isset($_REQUEST['ContactID'])) {
    $contactId = $_REQUEST['ContactID'];
    
    $stmt = $connection->prepare("SELECT * FROM contacts WHERE ContactID=?");
    $stmt->bind_param("i", $contactId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['CustomerID'];
        $c = $row['FirstName'];
        $d = $row['LastName'];
        $e = $row['Email'];
        $f = $row['Phone'];
    } else {
        echo "Contact not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Contacts</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Form of Contacts -->
        <h2><u>Update Form of Contacts</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
        
            <label for="customerid">Customer ID:</label>
            <input type="text" name="customerid" value="<?php echo isset($b) ? $b : ''; ?>">
            <br><br>

            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" value="<?php echo isset($c) ? $c : ''; ?>">
            <br><br>

            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" value="<?php echo isset($d) ? $d : ''; ?>">
            <br><br>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo isset($e) ? $e : ''; ?>">
            <br><br>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" value="<?php echo isset($f) ? $f : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        
        </form>
    </center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $customerId = $_POST['customerid'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // Update the contact in the database
    $stmt = $connection->prepare("UPDATE contacts SET CustomerID=?, FirstName=?, LastName=?, Email=?, Phone=? WHERE ContactID=?");
    $stmt->bind_param("issssi", $customerId, $firstName, $lastName, $email, $phone, $contactId);
    $stmt->execute();
    
    // Redirect to contacts.php
    header('Location: contacts.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
