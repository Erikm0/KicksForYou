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
    <title>KicksForYou</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!--Css-->
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<!-- Navbar -->
<header>
    <div class="header-container">
        <div class="hamburger kitoltes">&#9776;
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <h1 class="cim"><a href="index.php">Kicks For You</a></h1>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            echo '<div class="login kitoltes">';
            echo '<div class="fiokhover"><p class="cim" id="fioknev">' . $_SESSION['username'] . '</p>';
            echo '<ul>';
            echo '<li><a href="aloldal/kosar.php">Kosarad</a></li>';
            echo '<li><a href="aloldal/kijelentkezes.php">Kijelentkezés</a></li>';
            echo '</ul> </div>';
            echo '</div>';

        }
        else {
            echo '<div class="login kitoltes"><a href="aloldal/login.php"><i class="bi bi-person-circle" id="ikon"></i></a></div>';
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
                        <li><a class="dropdown-item" href="aloldal/nike.php">Nike</a></li>
                        <li><a class="dropdown-item" href="aloldal/adidas.php">Adidas</a></li>
                        <li><a class="dropdown-item" href="aloldal/jordan.php">Jordan</a></li>
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
<!--Carousel-->
<div class="carousel-container">
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="images/jordan_1_car.png" class="d-block forgokep" alt="jordan_1_car">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="images/jordan_2_car.png" class="d-block forgokep" alt="jordan_2_car">
            </div>
            <div class="carousel-item" data-bs-interval="5000">
                <img src="images/jordan_3_car.png" class="d-block forgokep" alt="jordan_3_car">
            </div>
        </div>
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
    </div>
</div>

<h2>Nike</h2>

<!--GridSystem-->
<div class="container text-center" id="gridhatter">
    <div class="container text-center" id="gridkontener">
        <div class="row">
            <?php
            // adatok lekérdezése
            $sql = "SELECT * FROM cipo WHERE marka = 'nike' GROUP BY nev ORDER BY id ASC LIMIT 3";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {

                $id = $row['id'];
                $link = $row['link'];
                $nev = $row['nev'];
                $brand = $row['marka'];
                $ar = $row['ar'];
                $image_url = $row['mutatokep'];
                $image_eger = $row['egerkep'];



                echo '<div class="col-sm-4">';
                    echo "<div class='termek'> <a  href='../aloldal/cipo.php?marka=$brand&link=$link'>";
                        echo "<div>";
                            echo "<img class='cipo' src='$image_url' alt='$nev' onmouseover=\"this.src='$image_eger'\" onmouseout=\"this.src='$image_url'\">";
                            echo "<p>$nev</p>";
                            echo "<p>$ar Ft</p>";
                        echo "</div>";
                    echo "</a> </div>";
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

<!--GridSystem-->
<h2>Adidas</h2>
<div class="container text-center" id="gridhatter">
    <div class="container text-center" id="gridkontener">
        <div class="row">
            <?php

            // adatok lekérdezése
            $sql = "SELECT * FROM cipo WHERE marka = 'adidas' GROUP BY nev ORDER BY id ASC LIMIT 3";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {

                $id = $row['id'];
                $link = $row['link'];
                $nev = $row['nev'];
                $brand = $row['marka'];
                $ar = $row['ar'];
                $image_url = $row['mutatokep'];
                $image_eger = $row['egerkep'];



                echo '<div class="col-sm-4">';
                echo "<div class='termek'> <a  href='../aloldal/cipo.php?marka=$brand&link=$link'>";
                echo "<div>";
                echo "<img class='cipo' src='$image_url' alt='$nev' onmouseover=\"this.src='$image_eger'\" onmouseout=\"this.src='$image_url'\">";
                echo "<p>$nev</p>";
                echo "<p>$ar Ft</p>";
                echo "</div>";
                echo "</a> </div>";
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>
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
    </div>
</footer>


<!-- Bootstrap 5 JS és Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>

<script src="js/script.js"></script>
</body>
</html>