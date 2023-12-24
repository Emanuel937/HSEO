<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$dbHost = "localhost";
$dbName = "gct";
$dbUser = "root";
$dbPassword = "root";

try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    if ($action == "checkUserExists") {
        // Check if the user already exists
        $email = $_POST["email"];
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();

        echo ($stmt->rowCount() > 0) ? "exists" : "not_exists";
    } elseif ($action == "registerUser") {
        // Continue with user registration

        // Get user input
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $tel = $_POST["tel"];

        // Validate input (you can add more validation)
        if (empty($name) || empty($email) || empty($password) || empty($tel)) {
            echo "All fields are required.";
            exit();
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert into the database using prepared statements
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, tel) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $hashedPassword);
        $stmt->bindParam(4, $tel);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error during registration.";
        }
    }
}else{
    echo "access denied";
}

