<?php
// Connection details
include('database-connection.php');

// Check if OpportunityID is set
if(isset($_REQUEST['OpportunityID'])) {
    $opportunityID = $_REQUEST['OpportunityID'];
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM opportunities WHERE OpportunityID=?");
    $stmt->bind_param("i", $opportunityID);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="opportunityID" value="<?php echo $opportunityID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.<br><br><a href='opportunities.php'>OK</a>";
            } else {
                echo "Error deleting data: " . $stmt->error;
            }
        }
        ?>
    </body>
    </html>
    <?php

    $stmt->close();
} else {
    echo "Opportunity ID is not set.";
}

$connection->close();
?>
