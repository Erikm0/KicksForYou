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
    <title>Bejelentkezés</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<!-- Navbar -->
<header>
    <div class="header-container">
        <div class="hamburger kitoltes" onclick="toggleNav()">&#9776;
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
    <div id="fiok_div">
        <h3 class="cim">Bejelentkezés</h3>
        <?php
        echo'<div id="fiok_hatter">';
            echo'<form action="" method="post">';
                echo'<p>E-mail: </p> <input type="email" name="email"/>';
                echo'<p>Jelszó: </p> <input type="password" name="pw"/><i class="bi bi-eye-slash" id="togglePassword"></i>';
                echo'<br><br>';
                echo'<input type="submit" name="Login" value="Bejelentkezés" id="submit_gomb">';
                echo'</form>';

            if (isset($_POST['Login'])) {
            $email = $_POST['email'];
            $pw = $_POST['pw'];

            try {
                $stmt = $conn->prepare("SELECT * FROM profilok WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if(isset($row['email_hitelesitve'])){
                    $hitelesitve = $row['email_hitelesitve'];
                }

                if(isset($row['username'])){
                    $fnev = $row['username'];
                }
                if ($result->num_rows > 0) {
                    if($hitelesitve == 0){
                        echo "<p class='hiba'>Nincs hitelesítve a fiók</p>";
                    }

                    else{
                        if ($email == $row['email']) {

                            if (password_verify($pw, $row['password'])) {
                                echo "<p class='siker'>Sikeres Bejelentkezés</p>";
                                $_SESSION['loggedin'] = true;
                                $_SESSION['username'] = $fnev;
                                $profile_ID = $row['id'];
                                $_SESSION['profile_ID'] = $profile_ID;
                                header('Refresh: 1; url=../index.php');
                            }
                            else {
                                echo "<p class='hiba'>Rossz email vagy jelszó</p>";
                            }
                        }
                        else {
                            echo "<p class='hiba'>Rossz email vagy jelszó</p>";
                        }
                    }


                }
                else {
                    echo "<p class='hiba'>Nincs ilyen fiók</p>";
                }
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
            echo'<p><a href="register.php">Ha még nincs fiókod <b>regisztrálj</b></a></p>';
        echo'</div>'
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
<script src="scripts/register.js"></script>
<script src="../js/script.js"></script>

</body>
</html>
