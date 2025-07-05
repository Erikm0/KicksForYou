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

if (isset($_GET['reset'])) {
    $_GET = array();
}

if (isset($_POST['torles'])) {
    unset($_SESSION['selectedSzinek']);
    unset($_SESSION['selectedMeretek']);
    $selectedSzinText = "";
    $selectedMeretText = "";
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
    <!--GridSystem-->
    <div class="container-fluid">
        <div class="row">
            <!--Szűrőrész-->
            <div class="col-sm-2" id="szuro">
                <?php

                $sql = "SELECT * FROM cipo WHERE marka = 'adidas' GROUP BY nev ORDER BY id ASC";
                // Lekérdezés végrehajtása
                $result = $conn->query($sql);

                $selectedSzinText = "";
                $selectedMeretText = "";
                $meretektomb = [];
                $szinektomb = [];
                echo '<div id="opciok">';
                echo '<div id="szurok">';
                echo '<form method="post" action="">';

                // Színek opció
                if (isset($_SESSION['selectedSzinek'])) {
                    $szinektomb = $_SESSION['selectedSzinek'];
                    $selectedSzinText = implode(', ', $szinektomb);
                }
                if (isset($_POST['szin'])) {
                    $selectedSzin = $_POST['szin'];

                    if (!in_array($selectedSzin, $szinektomb)) {
                        $szinektomb[] = $selectedSzin;
                    }

                    $_SESSION['selectedSzinek'] = $szinektomb;

                    $selectedSzinText = implode(', ', $szinektomb);
                }

                // Méretek opció
                if (isset($_SESSION['selectedMeretek'])) {
                    $meretektomb = $_SESSION['selectedMeretek'];
                    $selectedMeretText = implode(', ', $meretektomb);
                }
                if (isset($_POST['meret'])) {
                    $selectedMeret = $_POST['meret'];

                    if (!in_array($selectedMeret, $meretektomb)) {
                        $meretektomb[] = $selectedMeret;
                    }

                    $_SESSION['selectedMeretek'] = $meretektomb;

                    $selectedMeretText = implode(', ', $meretektomb);
                }

                // Szín kezdet
                echo '<div id="szinek">';
                echo '<label for="szin">Szín:</label><br>';

                // Módosított szín lekérdezés a kiválasztott méretek alapján
                if (isset($_SESSION['selectedMeretek'])) {
                    $selectedMeretek = $_SESSION['selectedMeretek'];
                    $meretCondition = "meret IN ('" . implode("', '", $selectedMeretek) . "')";
                    $szinekQuery = "SELECT DISTINCT szin FROM cipo WHERE marka = 'adidas' AND $meretCondition ORDER BY szin ASC";
                } else {
                    $szinekQuery = "SELECT DISTINCT szin FROM cipo WHERE marka = 'adidas' ORDER BY szin ASC";
                }

                $szinekResult = $conn->query($szinekQuery);

                if ($szinekResult->num_rows > 0) {
                    while ($szinRow = $szinekResult->fetch_assoc()) {
                        $szinValue = $szinRow['szin'];
                        if (isset($_SESSION['selectedSzinek'])) {
                            $buttonClassSzin = in_array($szinValue, $szinektomb) ? 'gomb-active col-sm-6' : 'gomb-inactive szurok col-sm-6';
                            echo "<button type='submit' class='$buttonClassSzin' id='szin' name='szin' value='$szinValue'>$szinValue</button>";
                        }
                        else{
                            echo "<button type='submit' class='gomb szurok col-sm-6' id='szin' name='szin' value='$szinValue'>$szinValue</button>";
                        }
                    }
                }
                echo '</div>';
                // Szín vége

                // Méret kezdet
                echo '<div id="meretek">';
                echo '<label for "meret">Méret:</label><br>';

                // Módosított méret lekérdezés a kiválasztott színek alapján
                if (isset($_SESSION['selectedSzinek'])) {
                    $selectedSzinek = $_SESSION['selectedSzinek'];
                    $szinCondition = "szin IN ('" . implode("', '", $selectedSzinek) . "')";
                    $meretekQuery = "SELECT DISTINCT meret FROM cipo WHERE marka = 'adidas' AND $szinCondition ORDER BY meret ASC";
                } else {
                    $meretekQuery = "SELECT DISTINCT meret FROM cipo WHERE marka = 'adidas' ORDER BY meret ASC";
                }

                $meretekResult = $conn->query($meretekQuery);


                if ($meretekResult->num_rows > 0) {
                    while ($meretRow = $meretekResult->fetch_assoc()) {
                        $meretValue = $meretRow['meret'];
                        if(isset($_SESSION['selectedMeretek'])){
                            $buttonClassMeret = in_array($meretValue, $meretektomb) ? 'gomb-active col-sm-6' : 'gomb-inactive szurok col-sm-6';
                            echo "<button type='submit' class='$buttonClassMeret' id='meret' name='meret' value='$meretValue' >$meretValue</button>";
                        }
                        else{
                            echo "<button type='submit' class='gomb szurok col-sm-6' id='meret' name='meret' value='$meretValue' >$meretValue</button>";
                        }
                    }
                }
                echo '</div>';
                // Méret vége

                // Szűrés törlése
                echo "<form method='post'><button class='torles szurok col-sm-12' type='submit' name='torles' value='Szűrők törlése'>Szűrők törlése</button></form>";
                echo '</form>';
                echo '</div>';
                echo '</div>';

                // Módosított SQL lekérdezés a kiválasztott színekkel és méretekkel
                $sql = "SELECT * FROM cipo WHERE marka = 'adidas'";

                if (isset($_SESSION['selectedSzinek'])) {
                    $selectedSzinek = $_SESSION['selectedSzinek'];
                    $szinCondition = "szin IN ('" . implode("', '", $selectedSzinek) . "')";
                    $sql .= " AND " . $szinCondition;
                }

                if (isset($_SESSION['selectedMeretek'])) {
                    $selectedMeretek = $_SESSION['selectedMeretek'];
                    $meretCondition = "meret IN ('" . implode("', '", $selectedMeretek) . "')";
                    $sql .= " AND " . $meretCondition;
                }

                $sql .= " GROUP BY nev ORDER BY id ASC";

                // Lekérdezés végrehajtása
                $result = $conn->query($sql);
                ?>
            </div>

            <!--Cipőrész-->
            <div class="col-sm-10">
                <?php
                echo '<div class="container text-center" id="gridhatter">';
                echo '<div class="container text-center" id="gridkontener">';
                echo '<div class="row">';
                if ($result->num_rows > 0) {
                    echo '<div class="row">';
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $link = $row['link'];
                        $nev = $row['nev'];
                        $brand = $row['marka'];
                        $ar = $row['ar'];
                        $image_url = $row['mutatokep'];
                        $image_eger = $row['egerkep'];
                        echo '<div class="col-sm-4">';
                        echo "<div class='termek'> <a href='cipo.php?marka=$brand&link=$link'>";
                        echo "<div>";
                        echo "<div>";
                        echo "<img class='cipo' src='$image_url' alt='$nev' onmouseover=\"this.src='$image_eger'\" onmouseout=\"this.src='$image_url'\">";
                        echo "</div>";
                        echo "<p>$nev</p>";
                        echo "<p>$ar Ft</p>";
                        echo "</div>";
                        echo "</a> </div>";
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                // kapcsolat bezárása
                $conn->close();
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
        <div class="footer-bottom">
            <p></p>
        </div>
    </div>
</footer>


<!-- Bootstrap 5 JS és Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
<script src="../js/script.js"></script>

</body>
</html>
