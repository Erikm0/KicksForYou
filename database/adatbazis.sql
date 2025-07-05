-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Aug 19. 23:35
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `v1cckMDyBt7kZAb79GJB`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cipo`
--

CREATE TABLE `cipo` (
  `id` int(11) NOT NULL,
  `link` varchar(50) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `marka` varchar(50) NOT NULL,
  `fajta` varchar(50) NOT NULL,
  `mennyiseg` int(10) NOT NULL,
  `meret` float NOT NULL,
  `szin` varchar(50) NOT NULL,
  `tipus` varchar(10) NOT NULL,
  `ar` int(50) NOT NULL,
  `mutatokep` varchar(255) NOT NULL,
  `egerkep` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `cipo`
--

INSERT INTO `cipo` (`id`, `link`, `nev`, `marka`, `fajta`, `mennyiseg`, `meret`, `szin`, `tipus`, `ar`, `mutatokep`, `egerkep`) VALUES
(1, 'Nike_Dunk_Low_Panda', 'Nike Dunk Low Panda', 'Nike', 'dunk_low_panda', 10, 36, 'fekete', 'gs', 55000, '../images/nike/nike_dunk_low_panda.jpg', '../images/nike/nike_dunk_low_panda_eger.jpg'),
(2, 'Nike_Dunk_Low_Panda', 'Nike Dunk Low Panda', 'Nike', 'dunk_low_panda', 10, 44, 'fekete', 'M', 55000, '../images/nike/nike_dunk_low_panda.jpg', '../images/nike/nike_dunk_low_panda_eger.jpg'),
(3, 'Nike_Dunk_Low_Panda', 'Nike Dunk Low Panda', 'Nike', 'dunk_low_panda', 10, 45, 'fekete', 'M', 55000, '../images/nike/nike_dunk_low_panda.jpg', '../images/nike/nike_dunk_low_panda_eger.jpg'),
(4, 'Nike_Dunk_Low_Whisper_Rose', 'Nike Dunk Low Whisper Rose', 'Nike', 'dunk_low_whisper_rose', 10, 38.5, 'rózsaszín', 'M', 50000, '../images/nike/nike_dunk_low_whisper_rose.jpg', '../images/nike/nike_dunk_low_whisper_rose_eger.jpg'),
(5, 'Nike_Dunk_Low_Whisper_Rose', 'Nike Dunk Low Whisper Rose', 'Nike', 'dunk_low_whisper_rose', 10, 39, 'rózsaszín', 'M', 50000, '../images/nike/nike_dunk_low_whisper_rose.jpg', '../images/nike/nike_dunk_low_whisper_rose_eger.jpg'),
(6, 'Nike_Dunk_Low_Whisper_Rose', 'Nike Dunk Low Whisper Rose', 'Nike', 'dunk_low_whisper_rose', 10, 40, 'rózsaszín', 'M', 50000, '../images/nike/nike_dunk_low_whisper_rose.jpg', '../images/nike/nike_dunk_low_whisper_rose_eger.jpg'),
(7, 'Nike_Dunk_Low_Retro_Red_Swoosh_Panda', 'Nike Dunk Low Retro Red Swoosh Panda', 'Nike', 'dunk_low_retro_red_swoosh_panda', 10, 42, 'piros', 'M', 45000, '../images/nike/nike_dunk_low_retro_red_swoosh_panda.jpg', '../images/nike/nike_dunk_low_retro_red_swoosh_panda_eger.jpg'),
(8, 'Nike_Dunk_Low_Retro_Red_Swoosh_Panda', 'Nike Dunk Low Retro Red Swoosh Panda', 'Nike', 'dunk_low_retro_red_swoosh_panda', 10, 45.5, 'piros', 'M', 45000, '../images/nike/nike_dunk_low_retro_red_swoosh_panda.jpg', '../images/nike/nike_dunk_low_retro_red_swoosh_panda_eger.jpg'),
(9, 'Nike_Dunk_Low_Midnight_Navy', 'Nike Dunk Low \"Midnight Navy\"', 'Nike', 'dunk_low _\"midnight_navy\"', 10, 39, 'fekete', 'gs', 50000, '../images/nike/nike_dunk_low_midnight_navy.jpg', '../images/nike/nike_dunk_low_midnight_navy_eger.jpg'),
(10, 'Nike_Dunk_Low_Fruity', 'Nike Dunk Low Fruity', 'Nike', 'dunk_low_fruity', 10, 40.5, 'piros', 'M', 55000, '../images/nike/nike_dunk_low_fruity.jpg ', '../images/nike/nike_dunk_low_fruity_eger.jpg '),
(11, 'Nike_Dunk_Low_Mint', 'Nike Dunk Low Mint', 'Nike', 'dunk_low_mint', 10, 38, 'menta', 'M', 50000, '../images/nike/nike_dunk_low_mint.jpg', '../images/nike/nike_dunk_low_mint_eger.jpg'),
(12, 'Nike_Dunk_Low_Mint', 'Nike Dunk Low Mint', 'Nike', 'dunk_low_mint', 10, 39, 'menta', 'M', 50000, '../images/nike/nike_dunk_low_mint.jpg', '../images/nike/nike_dunk_low_mint_eger.jpg'),
(13, 'Nike_Dunk_Low_Mint', 'Nike Dunk Low Mint', 'Nike', 'dunk_low_mint', 10, 40.5, 'menta', 'M', 50000, '../images/nike/nike_dunk_low_mint.jpg', '../images/nike/nike_dunk_low_mint_eger.jpg'),
(14, 'Nike_Dunk_Low_Peach_Cream', 'Nike Dunk Low Peach Cream', 'Nike', 'dunk_low_peach_cream', 10, 37.5, 'barack', 'M', 53000, '../images/nike/nike_dunk_low_peach_cream.jpg', '../images/nike/nike_dunk_low_peach_cream_eger.jpg'),
(15, 'Nike_Dunk_Low_Grey_Panda_Volt', 'Nike Dunk Low Grey Panda Volt', 'Nike', 'dunk_low_grey_panda_volt', 10, 45, 'szürke', 'M', 53000, '../images/nike/nike_dunk_low_grey_panda_volt.jpg', '../images/nike/nike_dunk_low_grey_panda_volt_eger.jpg'),
(16, 'Nike_Dunk_Low_UCLA', 'Nike Dunk Low UCLA', 'Nike', 'dunk_low_UCLA', 10, 44, 'kék', 'M', 50000, '../images/nike/nike_dunk_low_ucla.jpg', '../images/nike/nike_dunk_low_ucla_eger.jpg'),
(17, 'adidas_nmd_human_race_scarlet', 'Adidas NMD Human Race Scarlet', 'adidas', 'nmd_human_race_scarlet', 10, 41, 'piros', 'M', 45000, '../images/adidas/adidas_nmd_human_race_scarlet.jpg', '../images/adidas/adidas_nmd_human_race_scarlet_eger.jpg'),
(18, 'yeezy_boost_350_antlia', 'Yeezy Boost 350 Antlia', 'adidas', 'yeezy_boost_350', 27, 42, 'neonzöld', 'M', 55000, '../images/adidas/yeezy_boost_350_ antlia.jpg', '../images/adidas/yeezy_boost_350_ antlia_eger.jpg'),
(19, 'adidas_4D_Coral', 'Adidas 4D Coral', 'adidas', '4D_coral', 32, 42, 'rózsaszín', 'M', 30000, '../images/adidas/adidas_4D_coral.jpg', '../images/adidas/adidas_4D_coral_eger.jpg'),
(20, 'adidas_nmd_r1_red', 'Adidas nmd r1 red', 'adidas', 'nmd_r1_red', 40, 42, 'piros', 'M', 30000, '../images/adidas/adidas_nmd_r1_red.jpg', '../images/adidas/adidas_nmd_r1_red_eger.jpg'),
(21, 'jordan_1_low_travis_olive', 'Jordan 1 Low x Travis Olive', 'Jordan', 'jordan_1_low_travis_olive', 24, 38, 'oliva', 'M', 175000, '../images/jordan/jordan_1_low_travis_olive.jpg', '../images/jordan/jordan_1_low_travis_olive_eger.jpg'),
(22, 'jordan_12_cherry', 'Jordan 12 \"Cherry\"', 'Jordan', 'jordan_12_cherry', 2, 39, 'bordó', 'W', 35000, '../images/jordan/jordan_12_cherry.jpg', '../images/jordan/jordan_12_cherry_eger.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `profilok`
--

CREATE TABLE `profilok` (
  `id` int(11) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `teljesnev` varchar(100) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  `token` varchar(32) NOT NULL,
  `email_hitelesitve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `profilok`
--

INSERT INTO `profilok` (`id`, `email`, `teljesnev`, `username`, `password`, `token`, `email_hitelesitve`) VALUES
(1, 'probafiok2341@gmail.com', 'probafiok', 'probafiok', '$2y$10$fRmL5QkjJWiXRAlTOAX4hecadhnE0X2HzdD2O1E2MnO9Gvdn56H46', 'xdET6uHA5omshvviOlse9vXUOIxRlAvp', 1),
(2, 'kiserik05@t-online.hu', 'probafiok2', 'probafiok2', '$2y$10$JsOkf5dTeNE51s.ZeNZuH.G8jCMI4Z6ZFXVw5z0daHp04Dj.vvBxS', '2Hg0YXJacBFYewaVK9f0KgmT66CFela2', 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cipo`
--
ALTER TABLE `cipo`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `profilok`
--
ALTER TABLE `profilok`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `cipo`
--
ALTER TABLE `cipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT a táblához `profilok`
--
ALTER TABLE `profilok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
