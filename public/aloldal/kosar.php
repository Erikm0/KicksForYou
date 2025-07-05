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
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kosarad</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>

<!-- Navbar -->
<header>
    <div class="header-container">
        <div class="hamburger kitoltes">&#9776;
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <h1 class="cim"><a href="../index.php">Kicks For You</a></h1>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            echo '<div class="login kitoltes">';
            echo '<div class="fiokhover"><p class="cim" id="fioknev">' . $_SESSION['username'] . '</p>';
            echo '<ul>';
            echo '<li><a href="kosar.php">Kosarad</a></li>';
            echo '<li><a href="kijelentkezes.php">Kijelentkezés</a></li>';
            echo '</ul> </div>';
            echo '</div>';

        }
        else {
            echo '<div class="login kitoltes"><a href="login.php"><i class="bi bi-person-circle" id="ikon"></i></a></div>';
        }
        ?>
    </div>
    <div class="navok">
        <nav>
            <ul class="nav-menu">
                <li class="nav-link"><a href="#">Link1</a></li>
                <li class="nav-link"><a href="#">Link2</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-item" id="navbardrop" aria-expanded="false">Márkák</a>
                    <ul class="dropdown-menu" id="dropdownMenu">
                        <li><a class="dropdown-item" href="nike.php">Nike</a></li>
                        <li><a class="dropdown-item" href="adidas.php">Adidas</a></li>
                        <li><a class="dropdown-item" href="jordan.php">Jordan</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</header>
<!--Animáció-->
<div id="background-wrap">
    <div class="bubble x1"></div>
    <div class="bubble x2"></div>
    <div class="bubble x3"></div>
    <div class="bubble x4"></div>
    <div class="bubble x5"></div>
    <div class="bubble x6"></div>
    <div class="bubble x7"></div>
    <div class="bubble x8"></div>
    <div class="bubble x9"></div>
    <div class="bubble x10"></div>
</div>
<main>
    <?php
    $profile_ID = $_SESSION['profile_ID'];
    $sql = "SELECT * FROM kosar WHERE profil_id = '$profile_ID'";
    $result = $conn->query($sql);

    // Ellenőrizze, hogy létezik-e a kosár munkamenet változó
    if ($result->num_rows > 0) {
        echo '<h2 id="kosarCim">Kosár tartalma</h2>';
        $teljesAr = 0;
        while ($kosar_row = $result->fetch_assoc()) {
            $termek_ID = $kosar_row["cipo_id"];
            $termek_mennyiseg = $kosar_row["mennyiseg"];
            $termek_sql = "SELECT * FROM cipo WHERE id = '$termek_ID'";
            $termek_result = $conn->query($termek_sql);

            while ($termek_row = $termek_result->fetch_assoc()) {
                echo '<ul id="termekek">';
                echo '<li>';
                echo "<img class='kosarCipo' src='{$termek_row['mutatokep']}' alt='{$termek_row['nev']}' onmouseover=\"this.src='{$termek_row['egerkep']}'\" onmouseout=\"this.src='{$termek_row['mutatokep']}'\">";
                echo '</li>';
                echo '<li><p id="termekekSzoveg">';
                $ar = $termek_row['ar'] * $termek_mennyiseg;
                echo $termek_row['nev'] . ' ' .$ar. ' Ft';
                echo '</p></li>';
                echo '<li>';
                echo '<br> <a class="kosarTorles" href="remove_from_cart.php?id=' . $termek_row['id'] . '">Törlés</a>';
                echo '</li>';
                echo '</ul>';

                $teljesAr += $ar;
            }
        }
        echo '<p id="kosarAra">Összesen:' . $teljesAr . ' Ft</p>';
    }
    else {
        echo '<h2 id="kosarCim">A kosár üres</h2>';
    }

    ?>
</main>

<!--Footer-->

<footer>
    <div class="container" id="footercontainer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="footer-section">
                <h3>Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: info@example.com</p>
                <p>Phone: 123-456-7890</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2023 Your Company. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS és Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
<script src="../js/script.js"></script>

</body>
</html>