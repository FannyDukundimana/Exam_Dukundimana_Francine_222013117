<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ACTIVITIES Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;

      background-color: greenyellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */

      padding: 8px;
     
    }
        header{
    background-color:violet;
    padding: 20px;
}
    footer{
    text-align: center;
    padding: 15px;
    background-color:violet;
}
  </style>
    <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  
<header>
   

</head>

<body bgcolor="greenyellow">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/log.jpg" width="90" height="60" alt="Logo">
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./HOME.html">HOME</a>
    <li style="display: inline; margin-right: 10px;"><a href="./ABOUT US.html">ABOUT US</a>
      <li style="display: inline; margin-right: 10px;"><a href="./CONTACT US.html">CONTACT US</a>
    <li style="display: inline; margin-right: 10px;"><a href="./activities.php">Activities</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./campaignresponses.php">Campaignresponses</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./campaigns.php">Campaigns</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contacts.php">Contacts</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./customers.php">Customers</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./interactions.php">Interactions</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./opportunities.php">Opportunities</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./orders.php">Orders</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./products.php">Products</a>
  </li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color:darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Change Acount</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
  </ul>

</header>
<section>
<h1>Activities Form</h1>


     <form method="post" onsubmit="return confirmInsert();">
        <label for="ActivityID">ActivityID:</label>
        <input type="number" id="Cus_Id" name="Cus_Id"><br><br>

        <label for="CustomerID">CustomerID:</label>
        <input type="text" id="Ft_Nm" name="Ft_Nm" required><br><br>

        <label for="Type">Type:</label>
        <input type="text" id="Lst_Nm" name="Lst_Nm" required><br><br>

        <label for="Date">Date:</label>
        <input type="date" id="eml" name="eml" required><br><br>
        
        <label for="Description">Description:</label>
        <input type="text" id="phn" name="phn" required><br><br>

        </select>
            <br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
   include('database-connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO activities (ActivityID,CustomerID, Type, Date, Description) VALUES (? ,?, ?, ?, ?)");
        $stmt->bind_param("issss", $ActivityID, $CustomerID, $Type, $Date, $Description);

        // Set parameters from POST data with validation (optional)
        $ActivityID = intval($_POST['Cus_Id']); // Ensure integer for ID
        $CustomerID = htmlspecialchars($_POST['Ft_Nm']); // Prevent XSS
        $Type = htmlspecialchars($_POST['Lst_Nm']); // Prevent XSS
        $Date = filter_var($_POST['eml']); 
        $Description = filter_var($_POST['phn'], FILTER_SANITIZE_NUMBER_INT); // Sanitize phone number
        // Execute prepared statement with error handling
        if ($stmt->execute()) {
            echo "New record has been added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $connection->close();
    ?>

<?php
include('database-connection.php');

// SQL query to fetch data from activities table
$sql = "SELECT * FROM activities";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of activities</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of Activities</h2></center>
    <table border="5">
        <tr>
            
            <th>ActivityID</th>
            <th>CustomerID</th>
            <th>Type</th>
            <th>Date</th>
            <th>Description</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
     include('database-connection.php');

        // Prepare SQL query to retrieve customer.
        $sql = "SELECT * FROM activities";
        $result = $connection->query($sql);

        // Check if there are any customers
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $cuid = $row['ActivityID']; // Fetch the Customer_Id
                echo "<tr>
                    <td>" . $row['ActivityID'] . "</td>
                    <td>" . $row['CustomerID'] . "</td>
                    <td>" . $row['Type'] . "</td>
                    <td>" . $row['Date'] . "</td>
                    <td>" . $row['Description'] . "</td>
                    <td><a style='padding:4px' href='delete_activities.php?ActivityID=$cuid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_activities.php?ActivityID=$cuid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
  </body>
    </section>

  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @ DUKUNDIMANA FRANCINE</h2></b>
  </center>
</footer>
</body>
</html>