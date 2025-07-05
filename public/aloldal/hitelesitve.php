<?php
session_start();

// kapcsolódás az adatbázishoz
$servername = "127.0.0.1";
$username = "cipobolt";
$password = "v1cckMDyBt7kZAb79GJB";
$dbname = "cipobolt";

$conn = new mysqli($servername, $username, $password, $dbname);

// ellenőrizzük a kapcsolatot
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
header("Location: login.php");


confirmEmail($_SESSION['email'], $_SESSION['token']);

// E-mail hitelesítése a kapott token alapján
function confirmEmail($email, $token) {
    global $conn;

    $stmt = $conn->prepare('UPDATE profilok SET email_hitelesitve = 1 WHERE email = ? AND token = ?');
    $stmt->bind_param('ss', $email, $token);
    $stmt->execute();
    $stmt->close();
}


?>
