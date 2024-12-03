<?php
// Database credentials
$host = 'localhost';
$dbname = 'newsletter';
$username = 'CGT141'; // Replace with your database username
$password = 'final'; // Replace with your database password

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subscribe = isset($_POST['subscribe']) ? 1 : 0;

        // Prepare SQL query to insert data
        $sql = "INSERT INTO subscribers (name, email, subscribe) VALUES (:name, :email, :subscribe)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subscribe', $subscribe);

        // Execute the query
        $stmt->execute();

        echo "<h3>Thank you for subscribing to our newsletter!</h3>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$pdo = null;
?>
