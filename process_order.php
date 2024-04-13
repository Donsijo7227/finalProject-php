<?php
// Initialize variables to avoid undefined variable warnings
$result = null;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $flavor = $_POST['flavor'];
    $size = $_POST['size'];
    $toppings = $_POST['toppings'];
    $specialInstructions = $_POST['specialInstructions'];
    $totalAmount = $_POST['totalAmount'];

    // Defined prices for flavors, sizes, and toppings
    $flavorPrices = array(
        "strawberry" => 4.99,
        "chocolate" => 5.99,
        "banana" => 3.50,
        "mango" => 4.99,
        "blueberry" => 4.29
    );

    $sizePrices = array(
        "small" => 0,
        "medium" => 1.50,
        "large" => 2.50
    );

    $toppingPrices = array(
        "none" => 0,
        "granola" => 0.50,
        "slicedAlmonds" => 0.80,
        "chocolateChips" => 0.50,
        "pumpkinSeeds" => 0.20
    );

    // Calculate total amount based on selected options
    $totalAmount = $flavorPrices[$flavor] + $sizePrices[$size] + $toppingPrices[$toppings];

    // cleaning the data
    $flavor = trim($flavor);
    $size = trim($size);
    $toppings = trim($toppings);
    $specialInstructions = trim($specialInstructions);

    // Connecting database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smoothie_orders";

    // Creating connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checking connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //SQL statement
    $stmt = $conn->prepare("INSERT INTO orders (flavor, size, toppings, specialInstructions, total_amount) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $flavor, $size, $toppings, $specialInstructions, $totalAmount);


    if ($stmt->execute()) {
        echo "<p style='color:green;'>Order placed successfully.</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }

    // Close the statement
    $stmt->close();
} else {
    // Connection to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smoothie_orders";

    // Creating connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checking connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve order history
    $sql = "SELECT * FROM orders";
    $result = $conn->query($sql);


    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link href="css/main.css" rel="stylesheet" /> <!-- Link to external CSS file -->
    <script src="js/script.js" defer></script> <!-- Link to external JavaScript file -->
    <style>
      .main-content-area{
        background-color: white;
      }
      .main-content-area h1{
        padding: 30px;
        margin-left: 50px;
      }
    </style>
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
        <div class="main-content-area"> <!-- Main content area -->
            <h1>Order Placed Successfully</h1>
            </div>
        </div><!--end of main-content-area-->
    </main>
    <footer>
        <small><p>Made by Don Sijo</p></small> <!-- Footer information -->
    </footer>
</body>
</html>
