<?php
// Connection details
include('database-connection.php');

// Check if InteractionID is set
if(isset($_REQUEST['InteractionID'])) {
    $interactionID = $_REQUEST['InteractionID'];
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM interactions WHERE InteractionID=?");
    $stmt->bind_param("i", $interactionID);
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
            <input type="hidden" name="interactionID" value="<?php echo $interactionID; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.<br><br><a href='interactions.php'>OK</a>";
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
    echo "Interaction ID is not set.";
}

$connection->close();
?>
