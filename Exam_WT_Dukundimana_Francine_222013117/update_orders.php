<?php
// Connection details
include('database-connection.php');

// Check if OrderID is set
if(isset($_REQUEST['OrderID'])) {
    $orderId = $_REQUEST['OrderID'];
    
    $stmt = $connection->prepare("SELECT * FROM orders WHERE OrderID=?");
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['CustomerID'];
        $c = $row['OrderDate'];
        $d = $row['TotalAmount'];
    } else {
        echo "Order not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Orders</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Form of Orders -->
        <h2><u>Update Form of Orders</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
        
            <label for="customerid">Customer ID:</label>
            <input type="text" name="customerid" value="<?php echo isset($b) ? $b : ''; ?>">
            <br><br>

            <label for="orderdate">Order Date:</label>
            <input type="text" name="orderdate" value="<?php echo isset($c) ? $c : ''; ?>">
            <br><br>

            <label for="totalamount">Total Amount:</label>
            <input type="number" name="totalamount" value="<?php echo isset($d) ? $d : ''; ?>">
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
    $orderDate = $_POST['orderdate'];
    $totalAmount = $_POST['totalamount'];
    
    // Update the order in the database
    $stmt = $connection->prepare("UPDATE orders SET CustomerID=?, OrderDate=?, TotalAmount=? WHERE OrderID=?");
    $stmt->bind_param("isdi", $customerId, $orderDate, $totalAmount, $orderId);
    $stmt->execute();
    
    // Redirect to orders.php
    header('Location: orders.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
