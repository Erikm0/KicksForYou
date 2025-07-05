<?php
session_start();

// Kijelentkeztetés
$_SESSION['loggedin'] = false;
header("Location: ../index.php");
exit;
?>
