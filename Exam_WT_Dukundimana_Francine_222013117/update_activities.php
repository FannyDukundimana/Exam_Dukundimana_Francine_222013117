<?php
// Connection details
include('database-connection.php');

// Check if ActivityID is set
if(isset($_REQUEST['ActivityID'])) {
    $activityId = $_REQUEST['ActivityID'];
    
    $stmt = $connection->prepare("SELECT * FROM activities WHERE ActivityID=?");
    $stmt->bind_param("i", $activityId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customerId = $row['CustomerID'];
        $type = $row['Type'];
        $date = $row['Date'];
        $description = $row['Description'];
    } else {
        echo "Activity not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Activities</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Form of Activities -->
        <h2><u>Update Form of Activities</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
        
            <label for="customerId">Customer ID:</label>
            <input type="text" name="customerId" value="<?php echo isset($customerId) ? $customerId : ''; ?>">
            <br><br>

            <label for="type">Type:</label>
            <input type="text" name="type" value="<?php echo isset($type) ? $type : ''; ?>">
            <br><br>

            <label for="date">Date:</label>
            <input type="date" name="date" value="<?php echo isset($date) ? $date : ''; ?>">
            <br><br>

            <label for="description">Description:</label>
            <input type="text" name="description" value="<?php echo isset($description) ? $description : ''; ?>">
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
    
    // Update the activity in the database
    $stmt = $connection->prepare("UPDATE activities SET CustomerID=?, Type=?, Date=?, Description=? WHERE ActivityID=?");
    $stmt->bind_param("isssi", $customerId, $type, $date, $description, $activityId);
    $stmt->execute();
    
    // Redirect to some page (replace 'products.php' with appropriate page)
    header('Location: activities.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
