<?php
    // Connection details
     include('database-connection.php');
     
// Check if Response ID is set
if(isset($_REQUEST['ResponseID'])) {
    $respid = $_REQUEST['ResponseID'];
    //campaignresponses(ResponseID
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM campaignresponses WHERE ResponseID=?");
    $stmt->bind_param("i", $respid);
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
            <input type="hidden" name="respid" value="<?php echo $respid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>echo 
             <a href='campaignresponses.php'>OK</a>";
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
    echo "Response id is not set.";
}

$connection->close();
?>
