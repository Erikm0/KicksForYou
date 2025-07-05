<?php

session_start();

// kapcsolódás az adatbázishoz
$servername = "127.0.0.1";
$username = "cipobolt";
$password = "v1cckMDyBt7kZAb79GJB";
$dbname = "cipobolt";

$conn = new mysqli($servername, $username, $password, $dbname);

$termek_ID = $_GET['termek_id'];
$profile_ID = $_SESSION['profile_ID'];
$kosar_ID = 1;
$mennyiseg = 1;
$Payed = 0;

$select = $conn->prepare("SELECT * FROM kosar WHERE profil_id = ? AND cipo_id = ? AND fizetve = 0");
$select->bind_param("ii", $profile_ID, $termek_ID);
$select->execute();
$result = $select->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $mennyiseg = $row['mennyiseg'] + 1;
    $update = $conn->prepare("UPDATE kosar SET mennyiseg = ? WHERE profil_id = ? AND cipo_id = ? AND fizetve = 0");
    $update->bind_param("iii", $mennyiseg, $profile_ID, $termek_ID);
    $update->execute();
} else {
    $insert = $conn->prepare("INSERT INTO kosar (kosar_id, profil_id, cipo_id, mennyiseg, fizetve) VALUES (?, ?, ?, ?, ?)");
    $insert->bind_param("iiiii", $kosar_ID, $profile_ID, $termek_ID, $mennyiseg, $Payed);
    $insert->execute();
}

header("Location: kosar.php");
exit;
?>
