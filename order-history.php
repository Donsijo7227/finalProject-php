<?php
// Connection to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smoothie_orders";

$conn = new mysqli($servername, $username, $password, $dbname);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if a delete request is sent
if(isset($_POST['delete_order_id'])){
    $delete_order_id = $_POST['delete_order_id'];

    // SQL statement to delete the order
    $sql_delete = "DELETE FROM orders WHERE id = $delete_order_id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Order deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting order: " . $conn->error . "');</script>";
    }
}
// Retrieving order history
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

// Closing the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/main.css" rel="stylesheet" /> <!-- Link to external CSS file -->
    <script src="js/script.js" defer></script> <!-- Link to external JavaScript file -->
</head>
<body>
    <div class="top-bar"> <!-- Top bar section -->
        <h1>Order History</h1> <!-- Heading for the top bar -->
    </div>
    <main>
      <div class="left-side-nav"> <!-- Left side navigation section -->
          <div class="nav-elements">
            <a href="index.html">Home</a>
            <a href="order-history.php">Order History</a>
          </div>


      </div>

        <div class=" main-content-order-history"> <!-- Main content area -->
          <div class="order-histroy-area">
            <table>
                <thead>
                    <tr>
                        <th>Flavor</th>
                        <th>Size</th>
                        <th>Toppings</th>
                        <th>Special Instructions</th>
                        <th>Total Amount</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["flavor"] . "</td>";
                        echo "<td>" . $row["size"] . "</td>";
                        echo "<td>" . $row["toppings"] . "</td>";
                        echo "<td>" . $row["specialInstructions"] . "</td>";
                        echo "<td>$" . $row["total_amount"] . "</td>";
                        echo "<td><form method='post'><input type='hidden' name='delete_order_id' value='" . $row["id"] . "'><input type='submit' value='Delete'></form></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
          </div>
        </div><!--end of main-content-area-->
    </main>
    <footer>
        <small><p>Made by Don Sijo</p></small> <!-- Footer information -->
    </footer>
</body>
</html>
