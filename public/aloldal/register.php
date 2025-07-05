<?php
session_start();

// kapcsolódás az adatbázishoz
$servername = "127.0.0.1";
$username = "cipobolt";
$password = "v1cckMDyBt7kZAb79GJB";
$dbname = "cipobolt";

$conn = new mysqli($servername, $username, $password, $dbname);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

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
    <title>Regisztráció</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<!-- Navbar -->
<header>
    <div class="header-container">
        <div class="hamburger kitoltes"">&#9776;
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
        <h3 class="cim">Regisztráció</h3>
        <?php
        echo '<div id="fiok_hatter">';
        echo '<form action="" method="post">';
        echo '<p class="adatmegadas">E-mail: </p> <input type="email" name="email"/>';
        echo '<p class="adatmegadas">Teljesnév: </p> <input type="text" name="tnev"/>';
        echo '<p class="adatmegadas">Felhasználónév: </p> <input type="text" name="fnev"/>';
        echo '<p class="adatmegadas">Jelszó: </p> <input type="password" name="pw"/><i class="bi bi-eye-slash" id="togglePassword"></i>';
        echo '<p class="adatmegadas">Jelszó megerősítés: </p><input type="password" name="pwConfirm"/><i class="bi bi-eye-slash" id="togglePasswordConfirm"></i>';
        echo '<br><br>';
        echo '<input type="submit" name="Register" value="Regisztráció" id="submit_gomb">';
        echo '</form>';

        function generateUniqueToken()
        {
            $length = 32;

            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $token = '';

            for ($i = 0; $i < $length; $i++) {
                $token .= $characters[rand(0, strlen($characters) - 1)];
            }

            return $token;
        }

        if (isset($_POST['Register'])) {
            $email = $_POST['email'];
            $teljesnev = $_POST['tnev'];
            $fnev = $_POST['fnev'];
            $pw = $_POST['pw'];
            $pwconfirm = $_POST['pwConfirm'];
            $token = generateUniqueToken();
            $email_hitelesitve = 0;

            if (empty($email) || empty($teljesnev) || empty($fnev) || empty($pw) || empty($pwconfirm)) {
                echo "<p class='hiba'>Kérlek tölts ki minden mezőt!</p>";
            }
            else {
                $hashedpw = password_hash($pw, PASSWORD_DEFAULT);

                try {
                    $stmtEmail = $conn->prepare("SELECT email FROM profilok WHERE email = ?");
                    $stmtEmail->bind_param("s", $email);
                    $stmtEmail->execute();
                    $resultEmail = $stmtEmail->get_result();
                    $rowEmail = $resultEmail->fetch_assoc();

                    if (!empty($rowEmail['email'])) {
                        echo "<p class='hiba'>Ez az email már foglalt!</p>";
                    } else {
                        $stmtUsername = $conn->prepare("SELECT username FROM profilok WHERE username = ?");
                        $stmtUsername->bind_param("s", $fnev);
                        $stmtUsername->execute();
                        $resultUsername = $stmtUsername->get_result();
                        $rowUsername = $resultUsername->fetch_assoc();

                        if (!empty($rowUsername['username'])) {
                            echo "<p class='hiba'>Ez a felhasználónév már foglalt!</p>";
                        } elseif ($pw !== $pwconfirm) {
                            echo "<p class='hiba'>A jelszó és a megerősítés nem egyezik!</p>";
                        } else {

                            $insert = $conn->prepare("INSERT INTO profilok(email, teljesnev, username, password, token, email_hitelesitve) VALUES(?, ?, ?, ?, ?, ?)");
                            $insert->bind_param("sssssi", $email, $teljesnev, $fnev, $hashedpw, $token, $email_hitelesitve);
                            if ($insert->execute()) {
                                echo "<p class='siker'>Sikeres regisztráció</p>";
                                header('Refresh: 1; url=login.php');

                                // Egyedi token generálása

                                // Hitelesítő link generálása
                                function generateConfirmationLink($email, $token)
                                {
                                    $baseURL = 'https://cipobolt.lemp228.test/aloldal';
                                    $link = $baseURL . '/hitelesitve.php?email=' . urlencode($email) . '&token=' . urlencode($token);
                                    return $link;
                                }

                                // Hitelesítő link elküldése e-mailben
                                function sendConfirmationEmail($email, $token)
                                {

                                    $subject = 'E-mail megerősítés';
                                    $message = '<html lang="hu">
                                                <head>
                                                    <title>megerosites</title>
                                                    <meta charset="UTF-8">
                                                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
                                                </head>
                                                <body style="text-align: center; color:black;">
                                                    <h1>Kérjük, erősítse meg az e-mail címét</h1>
                                                    <p>Kérjük, erősítse meg az e-mail címét, hogy tag legyen a következő linkre kattintva:</p>
                                                    <a style="font-size:25px; background-color:#49ffb5; border-radius: 25px; text-decoration: none; display: inline-block; padding: 10px 20px;" href="' . generateConfirmationLink($email, $token) . '">Megerősítés</a>
                                                </body>
                                            </html>';

                                    // E-mail küldése
                                    $mail = new PHPMailer;
                                    $mail->isSMTP();
                                    $mail->CharSet = 'UTF-8';
                                    $mail->Host = '';
                                    $mail->SMTPSecure = 'tls';
                                    $mail->Port = "";
                                    $mail->SMTPAuth = true;
                                    $mail->Username = '';
                                    $mail->Password = '';
                                    $mail->setFrom('kiserik05@t-online.hu', 'Erik');
                                    $mail->addAddress("$email");
                                    $mail->isHTML(true);
                                    $mail->Subject = $subject;
                                    $mail->Body = $message;

                                    $mail->send();
                                }


                                $_SESSION['email'] = $email;
                                $_SESSION['token'] = $token;

                                sendConfirmationEmail($email, $token);

                            }
                        }
                    }
                }
                catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }

        // Displaying a link to the login page
        echo '<p><a href="login.php">Ha már van fiókod <b>jelentkezz be</b></a></p>';
        echo '</div>';
        ?>

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


<!-- Bootstrap 5 JS és Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="https://unpkg.com/@popperjs/core@2.10.1/dist/umd/popper.min.js"></script>
<script src="scripts/register.js"></script>
<script src="../js/script.js"></script>

</body>
</html>
