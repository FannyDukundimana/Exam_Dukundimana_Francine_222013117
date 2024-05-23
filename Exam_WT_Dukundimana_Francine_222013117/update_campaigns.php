<?php
// Connection details
include('database-connection.php');

// Check if CampaignID is set
if(isset($_REQUEST['CampaignID'])) {
    $campaignId = $_REQUEST['CampaignID'];
    
    $stmt = $connection->prepare("SELECT * FROM campaigns WHERE CampaignID=?");
    $stmt->bind_param("i", $campaignId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $campaignName = $row['CampaignName'];
        $startDate = $row['StartDate'];
        $endDate = $row['EndDate'];
        $budget = $row['Budget'];
    } else {
        echo "Campaign not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Campaigns</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Form of Campaigns -->
        <h2><u>Update Form of Campaigns</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
        
            <label for="campaignName">Campaign Name:</label>
            <input type="text" name="campaignName" value="<?php echo isset($campaignName) ? $campaignName : ''; ?>">
            <br><br>

            <label for="startDate">Start Date:</label>
            <input type="date" name="startDate" value="<?php echo isset($startDate) ? $startDate : ''; ?>">
            <br><br>

            <label for="endDate">End Date:</label>
            <input type="date" name="endDate" value="<?php echo isset($endDate) ? $endDate : ''; ?>">
            <br><br>

            <label for="budget">Budget:</label>
            <input type="number" name="budget" value="<?php echo isset($budget) ? $budget : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        
        </form>
    </center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $campaignName = $_POST['campaignName'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $budget = $_POST['budget'];
    
    // Update the campaign in the database
    $stmt = $connection->prepare("UPDATE campaigns SET CampaignName=?, StartDate=?, EndDate=?, Budget=? WHERE CampaignID=?");
    $stmt->bind_param("sssdi", $campaignName, $startDate, $endDate, $budget, $campaignId);
    $stmt->execute();
    
    // Redirect to campaigns.php or any other desired page
    header('Location: campaigns.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
