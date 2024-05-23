<?php
// Connection details
include('database-connection.php');

// Check if ResponseID is set
if(isset($_REQUEST['ResponseID'])) {
    $responseId = $_REQUEST['ResponseID'];
    
    $stmt = $connection->prepare("SELECT * FROM campaignresponses WHERE ResponseID=?");
    $stmt->bind_param("i", $responseId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $campaignId = $row['CampaignID'];
        $customerId = $row['CustomerID'];
        $responseType = $row['ResponseType'];
        $responseDate = $row['ResponseDate'];
    } else {
        echo "Response not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Campaign Responses</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Form of Campaign Responses -->
        <h2><u>Update Form of Campaign Responses</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
        
            <label for="campaignId">Campaign ID:</label>
            <input type="text" name="campaignId" value="<?php echo isset($campaignId) ? $campaignId : ''; ?>">
            <br><br>

            <label for="customerId">Customer ID:</label>
            <input type="text" name="customerId" value="<?php echo isset($customerId) ? $customerId : ''; ?>">
            <br><br>

            <label for="responseType">Response Type:</label>
            <input type="text" name="responseType" value="<?php echo isset($responseType) ? $responseType : ''; ?>">
            <br><br>

            <label for="responseDate">Response Date:</label>
            <input type="date" name="responseDate" value="<?php echo isset($responseDate) ? $responseDate : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        
        </form>
    </center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $campaignId = $_POST['campaignId'];
    $customerId = $_POST['customerId'];
    $responseType = $_POST['responseType'];
    $responseDate = $_POST['responseDate'];
    
    // Update the response in the database
    $stmt = $connection->prepare("UPDATE campaignresponses SET CampaignID=?, CustomerID=?, ResponseType=?, ResponseDate=? WHERE ResponseID=?");
    $stmt->bind_param("iissi", $campaignId, $customerId, $responseType, $responseDate, $responseId);
    $stmt->execute();
    
    // Redirect to some page (replace 'products.php' with appropriate page)
    header('Location: campaignresponses.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
