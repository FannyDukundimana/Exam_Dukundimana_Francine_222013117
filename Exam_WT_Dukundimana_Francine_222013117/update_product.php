<?php
// Connection details
include('database-connection.php');

// Check if ProductID is set
if(isset($_REQUEST['ProductID'])) {
    $productId = $_REQUEST['ProductID'];
    
    $stmt = $connection->prepare("SELECT * FROM products WHERE ProductID=?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['ProductName'];
        $c = $row['Description'];
        $d = $row['Price'];
    } else {
        echo "Product not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Products</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Form of Products -->
        <h2><u>Update Form of Products</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
        
            <label for="pname">Product Name:</label>
            <input type="text" name="pname" value="<?php echo isset($b) ? $b : ''; ?>">
            <br><br>

            <label for="desc">Description:</label>
            <input type="text" name="desc" value="<?php echo isset($c) ? $c : ''; ?>">
            <br><br>

            <label for="price">Price:</label>
            <input type="number" name="price" value="<?php echo isset($d) ? $d : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        
        </form>
    </center> 
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $productName = $_POST['pname'];
    $description = $_POST['desc'];
    $price = $_POST['price'];
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE products SET ProductName=?, Description=?, Price=? WHERE ProductID=?");
    $stmt->bind_param("ssdi", $productName, $description, $price, $productId);
    $stmt->execute();
    
    // Redirect to products.php
    header('Location: products.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
