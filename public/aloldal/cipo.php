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
$link = $_GET['link'];
$brand = $_GET['marka'];
$sql = "SELECT * FROM cipo WHERE marka = '$brand' AND link = '$link' AND mennyiseg > 0";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KicksForYou</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!--Css-->
    <link rel="stylesheet" type="text/css" href="style/style.css">
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
<div id="cipovalasz">
    <div class="container">
        <div class="row">
            <div class="col-sm-6" id="cipokepcontainer">
                <?php
                    if ($result->num_rows > 0) {

                        $rows = array();

                        while ($row = $result->fetch_assoc()) {
                            $nev = $row['nev'];
                            $ar = $row['ar'];
                            $meret = $row['meret'];
                            $id = $row['id'];
                            $rows[] = $row;
                        }

                        $firstRow = $rows[0];
                        $image_url = $firstRow['mutatokep'];
                        $image_url_eger = $firstRow['egerkep'];
                        $meret = $firstRow['meret'];

                        echo "<img id='cipokep' src='$image_url' onmouseout=\"this.src='$image_url'\" onmouseover=\"this.src='$image_url_eger'\" alt='Cipo'>";
                    }
                ?>
            </div>
            <div class="col-sm-6" id="cipoadatok">

                    <?php


                    echo "<p class='text-center'>$nev</p>";
                    echo "<p class='text-center'>$ar Ft</p>";

                    echo '<form method="post" action="">';
                        echo'<div class="meret_dropdown">';
                            echo'<select name="selected_meret" id="meret">';
                                echo "<option class='text-center' value=''>Válassz méretet</option>";
                                if (!empty($rows)) {
                                    foreach ($rows as $row) {
                                        $meret = $row['meret'];
                                        echo "<option class='text-center' value='$meret'>$meret</option>";
                                    }
                                }
                            echo '</select>';
                            echo '<button id="kosar" type="submit" name="kosarba"><span>Kosárba</span></button>';
                        echo '</div>';
                    echo '</form>';

                    if (isset($_POST['kosarba'])) {
                        if (isset($_POST['selected_meret']) && !empty($_POST['selected_meret'])) {
                            $selectedMeret = $_POST['selected_meret'];
                            echo "<p class='text-center'> Kiválasztott méret: " . $selectedMeret. "</p>";
                            $_SESSION['kep1'] = $image_url;
                            $_SESSION['kep2'] = $image_url_eger;
                            header('Location: kosar_add.php?termek_id='.$id);
                        }
                    }
                    ?>



            </div>
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
        <div class="footer-bottom">
            <p>&copy; 2023 Your Company. All rights reserved.</p>
        </div>
    </div>
</footer>


<script src="scripts/cipomegjelen.js"></script>
<script src="../js/script.js"></script>
</body>
</html>
