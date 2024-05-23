    <?php
    // Connection details
    include('database-connection.php');
    
// Check if invoice_Id is set
if(isset($_REQUEST['ActivityID'])) {
    $actvid = $_REQUEST['ActivityID'];
    //activities(ActivityID
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM activities WHERE ActivityID=?");
    $stmt->bind_param("i", $actvid);
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
            <input type="hidden" name="activid" value="<?php echo $activid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='activities.php'>OK</a>";
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
    echo "invoice_Id is not set.";
}

$connection->close();
?>
