<?php
// Connection details
include('database-connection.php');

// Check if InteractionID is set
if(isset($_REQUEST['InteractionID'])) {
    $interactionId = $_REQUEST['InteractionID'];
    
    $stmt = $connection->prepare("SELECT * FROM interactions WHERE InteractionID=?");
    $stmt->bind_param("i", $interactionId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['CustomerID'];
        $c = $row['Type'];
        $d = $row['Date'];
        $e = $row['Description'];
    } else {
        echo "Interaction not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Interactions</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Form of Interactions -->
        <h2><u>Update Form of Interactions</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
        
            <label for="customerId">Customer ID:</label>
            <input type="number" name="customerId" value="<?php echo isset($b) ? $b : ''; ?>">
            <br><br>

            <label for="type">Type:</label>
            <input type="text" name="type" value="<?php echo isset($c) ? $c : ''; ?>">
            <br><br>

            <label for="date">Date:</label>
            <input type="date" name="date" value="<?php echo isset($d) ? $d : ''; ?>">
            <br><br>

            <label for="description">Description:</label>
            <input type="text" name="description" value="<?php echo isset($e) ? $e : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        
        </form>
    </center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $customerId = $_POST['customerId'];
    $type = $_POST['type'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    
    // Update the interaction in the database
    $stmt = $connection->prepare("UPDATE interactions SET CustomerID=?, Type=?, Date=?, Description=? WHERE InteractionID=?");
    $stmt->bind_param("isssi", $customerId, $type, $date, $description, $interactionId);
    $stmt->execute();
    
    // Redirect to interactions.php
    header('Location: interactions.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
