<?php
// Connection details
include('database-connection.php');

// Check if OpportunityID is set
if(isset($_REQUEST['OpportunityID'])) {
    $opportunityId = $_REQUEST['OpportunityID'];
    
    $stmt = $connection->prepare("SELECT * FROM opportunities WHERE OpportunityID=?");
    $stmt->bind_param("i", $opportunityId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['OpportunityName'];
        $c = $row['Amount'];
        $d = $row['CloseDate'];
        $e = $row['Stage'];
    } else {
        echo "Opportunity not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Opportunities</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Form of Opportunities -->
        <h2><u>Update Form of Opportunities</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
        
            <label for="opportunityName">Opportunity Name:</label>
            <input type="text" name="opportunityName" value="<?php echo isset($b) ? $b : ''; ?>">
            <br><br>

            <label for="amount">Amount:</label>
            <input type="number" name="amount" value="<?php echo isset($c) ? $c : ''; ?>">
            <br><br>

            <label for="closeDate">Close Date:</label>
            <input type="date" name="closeDate" value="<?php echo isset($d) ? $d : ''; ?>">
            <br><br>

            <label for="stage">Stage:</label>
            <input type="text" name="stage" value="<?php echo isset($e) ? $e : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        
        </form>
    </center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $opportunityName = $_POST['opportunityName'];
    $amount = $_POST['amount'];
    $closeDate = $_POST['closeDate'];
    $stage = $_POST['stage'];
    
    // Update the opportunity in the database
    $stmt = $connection->prepare("UPDATE opportunities SET OpportunityName=?, Amount=?, CloseDate=?, Stage=? WHERE OpportunityID=?");
    $stmt->bind_param("sdsii", $opportunityName, $amount, $closeDate, $stage, $opportunityId);
    $stmt->execute();
    
    // Redirect to opportunities.php
    header('Location: opportunities.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
