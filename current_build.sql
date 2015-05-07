-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Hoszt: 127.0.0.1
-- Létrehozás ideje: 2015. Máj 07. 15:35
-- Szerver verzió: 5.6.21
-- PHP verzió: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Adatbázis: `kolevesvendeglo_hu`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_asztalfoglalasok`
--

CREATE TABLE IF NOT EXISTS `koleves_asztalfoglalasok` (
`ID` int(6) NOT NULL,
  `NEV` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `EMAIL` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `MEGJEGYZES` varchar(512) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `HANYFO` tinyint(2) DEFAULT NULL,
  `IDOPONT` datetime DEFAULT NULL,
  `JOVAHAGYVA` tinyint(1) DEFAULT '0',
  `JOVAHAGYTA` tinyint(6) DEFAULT NULL,
  `ROGZITVE` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_asztalfoglalasok`
--

INSERT INTO `koleves_asztalfoglalasok` (`ID`, `NEV`, `EMAIL`, `MEGJEGYZES`, `HANYFO`, `IDOPONT`, `JOVAHAGYVA`, `JOVAHAGYTA`, `ROGZITVE`) VALUES
(3, 'Aladár', 'aladar@vagyok.hu', 'jónapot', 2, '2015-04-23 19:00:00', 1, 1, NULL),
(4, 'Peti', 'gyula@peti.com', 'nsfdsf', 4, '2015-06-19 16:00:00', 0, NULL, NULL),
(5, 'Rikardo', 'rikardo@juarez.com', '', 7, '2015-04-29 18:00:00', 0, NULL, NULL),
(6, 'Rikardo', 'rikardo@asd.com', '', 7, '2015-04-29 18:00:00', 1, 1, NULL),
(7, 'Palesz', 'foglalt@asd.com', 'nics', 3, '2015-04-30 17:30:00', 0, NULL, '2015-04-20 15:38:46'),
(8, 'Gabesz', 'gabor.gv@gmail.com', ' ', 3, NULL, 0, NULL, NULL),
(9, 'Gabesz', 'gabor.gv@gmail.com', ' ', 3, NULL, 0, NULL, NULL),
(10, 'Gabesz', 'gabor.gv@gmail.com', ' ', 3, '2015-04-28 09:30:00', 0, NULL, NULL),
(11, 'Kápolnai Gábor', 'kapolnai.gabor@gmail.com', 'az ablakban szeretnék ülni kint', 5, '0000-00-00 00:00:00', 0, NULL, NULL),
(12, 'Konrád Gergely', 'koni@test.hu', '', 5, '0000-00-00 00:00:00', 0, NULL, NULL),
(13, 'Koni gilly G', 'gergely.konradg@gmail.com', '', 4, '0000-00-00 00:00:00', 0, NULL, NULL),
(14, '', '', '', 1, '0000-00-00 00:00:00', 0, NULL, NULL),
(15, '', '', '', 1, '0000-00-00 00:00:00', 0, NULL, NULL),
(16, '', '', '', 1, '0000-00-00 00:00:00', 0, NULL, NULL),
(17, '', '', '', 1, '0000-00-00 00:00:00', 0, NULL, NULL),
(18, '', '', '', 1, '0000-00-00 00:00:00', 0, NULL, NULL),
(19, '', '', '', 1, '0000-00-00 00:00:00', 0, NULL, NULL),
(20, '', '', '', 1, '0000-00-00 00:00:00', 0, NULL, NULL),
(21, '', '', '', 1, '0000-00-00 00:00:00', 0, NULL, NULL),
(22, 'asf', 'basf@as.com', '', 2, '0000-00-00 00:00:00', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_dolgozok`
--

CREATE TABLE IF NOT EXISTS `koleves_dolgozok` (
`ID` int(6) NOT NULL,
  `USERNAME` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `NEV` varchar(70) COLLATE utf8_hungarian_ci NOT NULL,
  `MEGJEGYZES` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `SZULETES` date DEFAULT NULL,
  `KEP` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `TELEFON` varchar(20) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `EMAIL` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `JELSZAV` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `FACEBOOK` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `JOGOSULTSAG_ID` int(2) DEFAULT '1',
  `RENDEZVENYFELELOS` tinyint(1) NOT NULL DEFAULT '0',
  `VENDEGLO` tinyint(1) DEFAULT '1',
  `ALLAPOT` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_dolgozok`
--

INSERT INTO `koleves_dolgozok` (`ID`, `USERNAME`, `NEV`, `MEGJEGYZES`, `SZULETES`, `KEP`, `TELEFON`, `EMAIL`, `JELSZAV`, `FACEBOOK`, `JOGOSULTSAG_ID`, `RENDEZVENYFELELOS`, `VENDEGLO`, `ALLAPOT`) VALUES
(1, 'janka', 'Mosolygós Janka', 'Janka egy mosolygós kedves lány, jól dolgozk.', NULL, 'assets/uploads/about-img.png', '+36 70 6383 996', 'janka@kolevesvendeglo.hu', '242f21c3e786eb437c665e833666f35304623e0cc1112ed5f0f3644b5f76cff5', 'mjanka', 9, 1, 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_etelek`
--

CREATE TABLE IF NOT EXISTS `koleves_etelek` (
`ID` int(6) NOT NULL,
  `KATEGORIA_ID` int(2) DEFAULT NULL,
  `TEXT_HU` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `SORREND` int(2) DEFAULT '1',
  `TAGEK` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `AR` int(6) DEFAULT NULL,
  `VISIBLE` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_etelek`
--

INSERT INTO `koleves_etelek` (`ID`, `KATEGORIA_ID`, `TEXT_HU`, `TEXT_EN`, `SORREND`, `TAGEK`, `AR`, `VISIBLE`) VALUES
(2, 1, 'Medvehagymás brokkolikrémleves füstölt fürjtojással', 'Broccolisoup with hot smokin eggs of delight', 2, 'GM, V', 890, 1),
(3, 1, 'Palócgulyás borjúból', 'Palocgulyas with da beef', 3, 'GM', 1180, 1),
(4, 2, 'Avokádósaláta, szárított paradicsom, mandarin, mandula, kéksajt', 'Macesz-ball soup', 1, 'GM, V', 1550, 1),
(5, 2, 'Füstölt tokhal, tökmagolajos saláta', 'Broccolisoup with hot smokin eggs of delight', 2, 'GM, TM', 1450, 1),
(6, 2, 'Szarvasgerinc, vargányás polenta, barnamártás', 'Palocgulyas with da beef', 3, ' ', 1890, 1),
(7, 3, 'Körtés-tejszínes tagliatelle ginnel, gorgonzolával', 'Macesz-ball soup', 1, 'V', 2150, 1),
(8, 3, 'Muszaka adzuki babbal, fekete lencsével', 'Broccolisoup with hot smokin eggs of delight', 2, 'V, TM', 2050, 1),
(9, 3, 'Grillezett brie sajt, sült alma, céklás vöröslencse saláta', 'Palocgulyas with da beef', 3, 'GM, V', 2350, 1),
(10, 4, 'Maceszflódni', 'Macesz-ball soup', 1, 'TM', 950, 1),
(11, 4, 'Pisztáciás tiramisu', 'Broccolisoup with hot smokin eggs of delight', 2, ' ', 960, 1),
(12, 4, 'New York sajttorta', 'Palocgulyas with da beef', 3, ' ', 990, 1),
(13, 1, 'Maceszgombócleves', '', 1, 'TM', 890, 1),
(14, 1, 'Skandináv rákleves', '', 4, 'GM', 1180, 1),
(15, 2, 'Tapas (füstölt libamell, bresaola, borjúsűlt, tárkonyos lazac, medvehagymás retek, kecskesajt, angol mustáros öntet)', '', 4, ' ', 2400, 1),
(16, 2, 'Vegetáriánus Tapas (taleggio sajt, chilis pecorino, olajbogyó, kecskesajttal töltött kápiapaprika, piros pesztó)', '', 5, 'V', 2100, 1),
(17, 3, 'Gombás-spenótos rétes zöld pesztóval, sütőtökös salátával', '', 4, 'V', 2450, 1),
(18, 3, 'Wokban pirított zöldségek, kesudió és jázmin rizs', '', 5, 'TM, V', 2090, 1),
(19, 3, 'Tanyasi csirkemell, avokádósaláta, szárított paradicsom, mandarin, kéksajt', '', 6, 'GM', 2980, 1),
(20, 3, 'Vadas házinyúl, zsemlegombóc', '', 7, ' ', 3150, 1),
(21, 3, 'Magyar báránysült, laskagomba, prósza, kefires fejes saláta', '', 8, ' ', 4750, 1),
(22, 3, 'Ribeye steak, tormás krumpli és céklás káposztasaláta', '', 9, 'GM', 4650, 1),
(23, 3, 'Csodaszarvas steak, vargányás polenta, barnamártás', '', 10, ' ', 4250, 1),
(24, 3, 'Egészben sült pisztráng, sült édeskömény, gratin krumpli', '', 11, 'GM', 4350, 1),
(25, 3, 'Konfitált libacomb, hagymás törtkrumpli és aszalt gyümölcsös párolt káposzta', '', 12, 'GM, TM', 3280, 1),
(26, 3, 'Sólet libacombbal vagy tojással (pénteken, szombaton, vasárnap)', '', 13, 'TM', 3080, 1),
(27, 3, 'Wokban pirított kacsamell, zöldségek, kesudió és jázmin rizs', '', 14, 'TM', 2980, 1),
(28, 3, 'Roston kacsamell, chilis-datolyás sült zeller', '', 15, 'TM', 3280, 1),
(29, 4, 'Csokoládés karobtorta, fagylalt', '', 4, 'GM', 980, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_etelkategoriak`
--

CREATE TABLE IF NOT EXISTS `koleves_etelkategoriak` (
`ID` int(2) NOT NULL,
  `TEXT_HU` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `SORREND` int(2) DEFAULT '1',
  `IKON` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_etelkategoriak`
--

INSERT INTO `koleves_etelkategoriak` (`ID`, `TEXT_HU`, `TEXT_EN`, `SORREND`, `IKON`) VALUES
(1, 'KŐLEVESEK', 'STONE SOUPS', 1, 'ital-kave'),
(2, 'SALÁTÁK ÉS ELŐÉTELEK', 'SALADS AND APPETIZERS', 2, 'ital-kave'),
(3, 'FŐÉTELEK', 'MAIN COURSES', 3, 'ital-kave'),
(4, 'DESSZERTEK', 'DESSERTS', 4, 'ital-kave');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_hirsav`
--

CREATE TABLE IF NOT EXISTS `koleves_hirsav` (
`ID` int(6) NOT NULL,
  `TIPUS_ID` int(2) NOT NULL,
  `FK_ID` int(4) NOT NULL,
  `TEXT_HU` varchar(80) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `TEXT_EN` varchar(80) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `ROGZITVE` datetime DEFAULT NULL,
  `SORREND` tinyint(2) DEFAULT '1',
  `ALLAPOT` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_hirsav`
--

INSERT INTO `koleves_hirsav` (`ID`, `TIPUS_ID`, `FK_ID`, `TEXT_HU`, `TEXT_EN`, `ROGZITVE`, `SORREND`, `ALLAPOT`) VALUES
(1, 1, 1, 'Esküvő az emeleten', 'Wedding in the attic', '2015-04-20 16:20:06', 1, 1),
(2, 3, 0, 'Ma köménymagos cipó lesz!', NULL, '2015-04-20 16:59:32', 1, 1),
(3, 2, 0, 'Kerti nyitóprogram', NULL, '2015-04-22 03:40:45', 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_italkategoriak`
--

CREATE TABLE IF NOT EXISTS `koleves_italkategoriak` (
`ID` int(2) NOT NULL,
  `TEXT_HU` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `SORREND` int(2) DEFAULT '1',
  `IKON` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_italkategoriak`
--

INSERT INTO `koleves_italkategoriak` (`ID`, `TEXT_HU`, `TEXT_EN`, `SORREND`, `IKON`) VALUES
(1, 'forró italok', 'hot drinks', 1, 'ital-kave'),
(2, 'üdítők', 'soft drinks', 2, 'ital-udito'),
(3, 'sörök', 'beers', 3, 'ital-sor'),
(4, 'borok', 'wines', 4, 'ital-bor'),
(5, 'rövid italok', 'shots', 5, 'ital-rovid');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_italok`
--

CREATE TABLE IF NOT EXISTS `koleves_italok` (
`ID` int(6) NOT NULL,
  `KATEGORIA_ID` int(2) DEFAULT NULL,
  `TEXT_HU` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `ALKATEGORIA` tinyint(1) DEFAULT '0',
  `SORREND` int(2) DEFAULT '1',
  `AR` int(6) DEFAULT NULL,
  `VISIBLE` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_italok`
--

INSERT INTO `koleves_italok` (`ID`, `KATEGORIA_ID`, `TEXT_HU`, `TEXT_EN`, `ALKATEGORIA`, `SORREND`, `AR`, `VISIBLE`) VALUES
(1, 1, 'Capuchino', 'Some drink name', 0, 1, 550, 1),
(2, 1, 'Ír kávé', 'Some drink name', 0, 2, 570, 1),
(3, 1, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(4, 1, 'Egy sor szöveg', 'Some drink name', 0, 4, 420, 1),
(5, 1, 'Egy sor szöveg', 'Some drink name', 0, 5, 520, 1),
(6, 1, 'Egy sor szöveg', 'Some drink name', 0, 6, 420, 1),
(7, 1, 'Egy sor szöveg', 'Some drink name', 0, 7, 420, 1),
(8, 1, 'Egy sor szöveg', 'Some drink name', 0, 8, 520, 1),
(9, 1, 'Egy sor szöveg', 'Some drink name', 0, 9, 420, 1),
(10, 2, 'Egy sor szöveg', 'Some drink name', 0, 1, 420, 1),
(11, 2, 'Egy sor szöveg', 'Some drink name', 0, 2, 460, 1),
(12, 2, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(13, 2, 'Egy sor szöveg', 'Some drink name', 0, 4, 420, 1),
(14, 2, 'Egy sor szöveg', 'Some drink name', 0, 5, 520, 1),
(15, 2, 'Egy sor szöveg', 'Some drink name', 0, 6, 420, 1),
(16, 3, 'Egy sor szöveg', 'Some drink name', 0, 1, 420, 1),
(17, 3, 'Egy sor szöveg', 'Some drink name', 0, 2, 460, 1),
(18, 3, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(19, 4, 'Egy sor szöveg', 'Some drink name', 0, 1, 420, 1),
(20, 4, 'Egy sor szöveg', 'Some drink name', 0, 2, 460, 1),
(21, 4, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(22, 4, 'Egy sor szöveg', 'Some drink name', 0, 4, 420, 1),
(23, 4, 'Egy sor szöveg', 'Some drink name', 0, 5, 520, 1),
(24, 5, 'Egy sor szöveg', 'Some drink name', 0, 1, 420, 1),
(25, 5, 'Egy sor szöveg', 'Some drink name', 0, 2, 460, 1),
(26, 5, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(27, 5, 'Egy sor szöveg', 'Some drink name', 0, 4, 420, 1),
(28, 5, 'Egy sor szöveg', 'Some drink name', 0, 5, 520, 1),
(29, 5, 'Egy sor szöveg', 'Some drink name', 0, 6, 420, 1),
(30, 5, 'Egy sor szöveg', 'Some drink name', 0, 7, 420, 1),
(31, 5, 'Egy sor szöveg', 'Some drink name', 0, 8, 520, 1),
(32, 5, 'Egy sor szöveg', 'Some drink name', 0, 9, 420, 1),
(33, 5, 'Egy sor szöveg', 'Some drink name', 0, 10, 520, 1),
(34, 5, 'Egy sor szöveg', 'Some drink name', 0, 11, 420, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_jogosultsagok`
--

CREATE TABLE IF NOT EXISTS `koleves_jogosultsagok` (
`ID` int(2) NOT NULL,
  `MEGNEVEZES_HU` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `MEGNEVEZES_EN` varchar(30) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_jogosultsagok`
--

INSERT INTO `koleves_jogosultsagok` (`ID`, `MEGNEVEZES_HU`, `MEGNEVEZES_EN`) VALUES
(1, 'Betekintő felhasználó', 'View User'),
(2, 'Általános felhasználó', 'General User'),
(9, 'Adminisztrátor', 'Admin');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_kepek`
--

CREATE TABLE IF NOT EXISTS `koleves_kepek` (
`ID` int(6) NOT NULL,
  `FAJLNEV` varchar(155) COLLATE utf8_hungarian_ci NOT NULL,
  `LEIRAS_HU` varchar(256) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `GALLERY_TAG` tinyint(1) DEFAULT NULL,
  `SZEKCIO` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_kepek`
--

INSERT INTO `koleves_kepek` (`ID`, `FAJLNEV`, `LEIRAS_HU`, `GALLERY_TAG`, `SZEKCIO`) VALUES
(1, 'assets/uploads/renezvenyek_slide.jpg', NULL, 2, 2),
(4, 'assets/uploads/gallery01.jpg', NULL, 1, 2),
(5, 'assets/uploads/gallery02.jpg', NULL, NULL, 1),
(6, 'assets/uploads/gallery03.jpg', NULL, NULL, 1),
(7, 'assets/uploads/gallery04.jpg', NULL, NULL, NULL),
(8, 'assets/uploads/about-img.png', NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_keptipusok`
--

CREATE TABLE IF NOT EXISTS `koleves_keptipusok` (
`ID` int(6) NOT NULL,
  `MEGNEVEZES` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `SZEKCIO` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `ALLAPOT` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_keptipusok`
--

INSERT INTO `koleves_keptipusok` (`ID`, `MEGNEVEZES`, `SZEKCIO`, `ALLAPOT`) VALUES
(1, 'Rendezvény', 'rendezvenyek', 1),
(2, 'Program', 'programok', 2),
(3, 'Hir', NULL, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_kep_osszekotesek`
--

CREATE TABLE IF NOT EXISTS `koleves_kep_osszekotesek` (
`ID` int(6) NOT NULL,
  `TIPUS` int(2) NOT NULL,
  `FK_ID` int(5) NOT NULL,
  `KEP_ID` int(6) NOT NULL,
  `SORREND` int(3) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_kep_osszekotesek`
--

INSERT INTO `koleves_kep_osszekotesek` (`ID`, `TIPUS`, `FK_ID`, `KEP_ID`, `SORREND`) VALUES
(11, 1, 1, 6, 1),
(13, 1, 1, 5, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_napimenuk`
--

CREATE TABLE IF NOT EXISTS `koleves_napimenuk` (
`ID` int(6) NOT NULL,
  `IDOSZAK_ID` int(6) DEFAULT NULL,
  `NAPAZON` int(1) DEFAULT NULL,
  `FOGASAZON` int(1) DEFAULT NULL,
  `TEXT_HU` varchar(150) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(150) COLLATE utf8_hungarian_ci NOT NULL,
  `TAGEK` varchar(15) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_napimenuk`
--

INSERT INTO `koleves_napimenuk` (`ID`, `IDOSZAK_ID`, `NAPAZON`, `FOGASAZON`, `TEXT_HU`, `TEXT_EN`, `TAGEK`) VALUES
(1, 1, 1, 1, 'Valami szuper leves', 'Some super-duper soup', NULL),
(2, 1, 1, 2, 'Valami még szuperebb második', 'Some dish even better than the last', NULL),
(3, 1, 1, 3, 'És valami remek desszert', 'And some delicious to top it off', NULL),
(4, 1, 2, 1, 'Valami szuper leves', 'Some super-duper soup', NULL),
(5, 1, 2, 2, 'Valami még szuperebb második', 'Some dish even better than the last', NULL),
(6, 1, 2, 3, 'És valami remek desszert', 'And some delicious to top it off', NULL),
(7, 1, 3, 1, 'Valami szuper leves', 'Some super-duper soup', NULL),
(8, 1, 3, 2, 'Valami még szuperebb második', 'Some dish even better than the last', NULL),
(9, 1, 3, 3, 'És valami remek desszert', 'And some delicious to top it off', NULL),
(10, 1, 4, 1, 'Valami szuper leves', 'Some super-duper soup', NULL),
(11, 1, 4, 2, 'Valami még szuperebb második', 'Some dish even better than the last', NULL),
(12, 1, 4, 3, 'És valami remek desszert', 'And some delicious to top it off', NULL),
(13, 1, 5, 1, 'Valami szuper leves', 'Some super-duper soup', NULL),
(14, 1, 5, 2, 'Valami még szuperebb második', 'Some dish even better than the last', NULL),
(15, 1, 5, 3, 'És valami remek desszert', 'And some delicious to top it off', NULL),
(16, 2, 1, 1, 'Csodaleves', 'Some super-duper soup', NULL),
(17, 2, 1, 2, 'Csodacsibe', 'Some dish even better than the last', NULL),
(18, 2, 1, 3, 'Csodacsoki', 'And some delicious to top it off', NULL),
(19, 2, 2, 1, 'Valami szuper leves', 'Some super-duper soup', NULL),
(20, 2, 2, 2, 'Valami még szuperebb második', 'Some dish even better than the last', NULL),
(21, 2, 2, 3, 'És valami remek desszert', 'And some delicious to top it off', NULL),
(22, 2, 3, 1, 'Szerdai Szúp', 'Some super-duper soup', NULL),
(23, 2, 3, 2, 'Szerdai Szaszidzs', 'Some dish even better than the last', NULL),
(24, 2, 3, 3, 'Szerda Szelet', 'And some delicious to top it off', NULL),
(25, 2, 4, 1, 'Csalilé', 'Some super-duper soup', NULL),
(26, 2, 4, 2, 'Csülök csütörtökmódra', 'Some dish even better than the last', NULL),
(27, 2, 4, 3, 'Péntekváró fánk', 'And some delicious to top it off', NULL),
(28, 2, 5, 1, 'Hétvégi erőleves', 'Some super-duper soup', NULL),
(29, 2, 5, 2, 'Hétbúcsúztató henkli', 'Some dish even better than the last', NULL),
(30, 2, 5, 3, 'Vásár napos kifli', 'And some delicious to top it off', NULL),
(36, 5, 1, 1, 'Leves', '', NULL),
(37, 5, 1, 2, 'Második', '', NULL),
(38, 5, 1, 3, 'Desszeret', '', NULL),
(39, 5, 2, 1, 'Vajaspogácsás hagymakrémleves          V', '', NULL),
(40, 5, 2, 2, 'Ananászpácban füstölt karaj               nem-V', '', NULL),
(41, 5, 2, 3, 'Palacsinta (3db, különböző ízekben)  GM', '', NULL),
(42, 5, 5, 1, 'Húsos: Sajttal és sonkával töltött csirkemell burgonyapürével', '', NULL),
(43, 5, 5, 2, 'Vega: Zöldséges tócsni fokhagymás tejföllel és salátával', '', NULL),
(44, 5, 5, 2, 'Mascarpone habos almás pite', '', NULL),
(45, 5, 5, 3, 'Mascarpone habos almás pite', '', NULL),
(46, 5, 3, 1, ' ', '', NULL),
(47, 5, 3, 2, ' ', '', NULL),
(48, 5, 3, 3, ' ', '', NULL),
(49, 5, 4, 1, ' ', '', NULL),
(50, 5, 4, 2, ' ', '', NULL),
(51, 5, 4, 3, ' ', '', NULL),
(52, 6, 1, 1, 'Céklaleves', '', 'TM,G'),
(53, 6, 1, 2, 'Szüzérme ropogósan', '', 'A'),
(55, 6, 1, 3, 'Rántott sajt áfonyalekvárral', '', 'V'),
(57, 6, 2, 1, 'Something soup', '', 'TM'),
(58, 6, 2, 3, 'Uj csupacsokidesszert', '', 'V');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_napimenu_idoszakok`
--

CREATE TABLE IF NOT EXISTS `koleves_napimenu_idoszakok` (
`ID` int(6) NOT NULL,
  `EV` int(4) DEFAULT NULL,
  `HET` int(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_napimenu_idoszakok`
--

INSERT INTO `koleves_napimenu_idoszakok` (`ID`, `EV`, `HET`) VALUES
(1, 2015, 15),
(2, 2015, 16),
(5, 2015, 17),
(6, 2015, 18);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_programok`
--

CREATE TABLE IF NOT EXISTS `koleves_programok` (
`ID` int(6) NOT NULL,
  `DATUM` date DEFAULT NULL,
  `TEXT_HU` varchar(75) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(75) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `LEIRAS_HU` varchar(1024) COLLATE utf8_hungarian_ci NOT NULL,
  `LEIRAS_EN` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `KEP` varchar(155) COLLATE utf8_hungarian_ci NOT NULL,
  `FBLINK` varchar(155) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `ALLAPOT` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_programok`
--

INSERT INTO `koleves_programok` (`ID`, `DATUM`, `TEXT_HU`, `TEXT_EN`, `LEIRAS_HU`, `LEIRAS_EN`, `KEP`, `FBLINK`, `ALLAPOT`) VALUES
(1, '2015-03-31', 'Kőleves Kert nyárbúcsuztató napok', 'Kőleves summer closing days', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.</p><p>Lorem ipsum dolor sit amet.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.</p><p>Lorem ipsum dolor sit amet.</p>', 'assets/img/gslide-1.png', NULL, 1),
(2, '2015-04-17', 'programnevea', 'nameofprogram', 'Lorem ipsum dolor sit amet, consectetur adipisicing \nLorem ipsum dolor sit amet, consectetur adipisicing \nLorem ipsum dolor sit amet, consectetur adipisicing \nLorem ipsum dolor sit amet, consectetur adipisicing ', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.</p><p>Lorem ipsum dolor sit amet.</p>', '', NULL, 1),
(3, '2015-04-18', 'Valami lesz ggsdfsgfdsgsfdgd ', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing eli dsfafd a daf adfas asdf asfda afdasfd asfd adfadfa fd asfdasfa faf afa fdsf asdf Lorem ipsum dolor sit amet, consectetur adipisicing eli dsfafd a daf adfas asdf asfda afdasfd asfd adfadfa fd asfdasfa faf afa fdsf asdf Lorem ipsum dolor sit amet, consectetur adipisicing eli dsfafd a daf adfas asdf asfda afdasfd asfd adfadfa fd asfdasfa faf afa fdsf asdf ', NULL, 'assets/uploads/gallery02.jpg', 'https://www.facebook.com/events/1594402937444863/', 1),
(4, '2015-04-28', 'teszt progi', NULL, '	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae obcaecati deserunt minus possimus, accusamus ipsam eaque doloribus ex dolore quidem velit similique quae nisi doloremque error reiciendis, modi provident! Facere aliquam veritatis odio, omnis doloremque quia molestias exercitationem impedit aliquid! Aut consequuntur minima, atque aperiam quod cupiditate, cum rerum quasi saepe iste explicabo nobis ab eaque asperiores expedita et magnam.', NULL, 'assets/uploads/gallery02.jpg', NULL, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_rendezvenyek`
--

CREATE TABLE IF NOT EXISTS `koleves_rendezvenyek` (
`ID` int(6) NOT NULL,
  `TEXT_HU` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `LEIRAS_HU` varchar(512) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `TEXT_EN` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `LEIRAS_EN` varchar(512) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `SORREND` int(2) NOT NULL DEFAULT '1',
  `ALLAPOT` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_rendezvenyek`
--

INSERT INTO `koleves_rendezvenyek` (`ID`, `TEXT_HU`, `LEIRAS_HU`, `TEXT_EN`, `LEIRAS_EN`, `SORREND`, `ALLAPOT`) VALUES
(1, 'Esküvő az emeleten', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi quaerat at, perspiciatis assumenda veritatis. Blanditiis natus facilis placeat aliquam.', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_statikus`
--

CREATE TABLE IF NOT EXISTS `koleves_statikus` (
`ID` int(6) NOT NULL,
  `LABEL` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_HU` varchar(2048) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(2048) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_statikus`
--

INSERT INTO `koleves_statikus` (`ID`, `LABEL`, `TEXT_HU`, `TEXT_EN`) VALUES
(1, 'CETLI1', 'Csirkepaprikás nokedlivel', 'English Lorem ipsum dolor.'),
(2, 'CETLI2', 'házi káposztasalátával', 'English Lorem ipsum dolor.'),
(3, 'CETLI3', '1950', 'English Lorem ipsum dolor.'),
(4, 'DEARGUESTS', 'Kedves Vendégeink!', 'Dear Guests!'),
(5, 'NAPIMENU_TEXT', 'Vegetáriánus és húsos menünk van hétköznaponként 1.000 Ft és 1.250 Ft-os áron, ami mellé szörpöt is adunk. Siessetek, mert ½ 12-től van ebéd és 60-70 adagot készítünk, ezért van, hogy ½ 1-re elfogy.', 'We''ll be adding some further information here.'),
(6, 'NAPIMENU_LEGEND', 'GM = gluténmentes TM = tejtermék mentes V = vegetáriánus', 'GM = gluten-free TM = lactose-free V = vegetarian'),
(7, 'FOGLALAS_LEIRAS', '<p>Ezen a helyen csak a Kőleves Vendéglőbe tudsz asztalt foglalni maximum 7 főre,ha többen jönnétek, kérlek telefonáljatok.</p><p>Ha jó idő van, akkor talán a teraszon is ülhetsz, ha ott szeretnél asztalt, kérlek írd meg a megjegyzésbe. Foglalásod csak akkor érvényes, ha visszaigazoljuk e-mailben vagy telefonon.</p>&nbsp;<p>Ha nagyobb rendezvényt szeretnél, kérlek telefonálj nekünk. +3620 213 5999, +361 322 1011</p><p>A Kőleves Kert, ami egy különálló kocsma, külön grill konyhával, nem tévesztendő össze a vendéglővel, de ha oda szeretnél foglalni, próbáld meg a vendéglőt hívni. Oda csak 10 fő fölött és csak este 7-ig áll módunkban tartani az asztalt.', 'We''ll be adding some further information here.</p>'),
(8, 'RENDEZVENY', '<p>A földszinti vendégtérből nyílik az általunk "VIP" teremnek nevezett kisterem, ahol maximum 13 fő fér el. Zártkörű ebédekhez, vacsorákhoz vagy megbeszélésekhez ajánljuk.</p><p>Az épület hátsó részében található az "Elefántos" terem, ahol maximum 25 fő fér el ültetve, ha nem feltétlenül szeretne mindenki leülni, akkor 40 ember is befér. Ezt a termet zártkörű ebédekhez, vacsorákhoz, megbeszélésekhez, osztálytalálkozókhoz, tréningekhez, workshopokhoz, stb. ajánljuk. Ennek a teremnek van egy külön pultja is, projektora és néhány kényelmes fotelje is.</p><p>Az emeleti különterem a legnagyobb külön helyiségünk. Ültetve 70-75 ember fér el benne, állva 120-150-en is akár. Ehhez a teremhez tartozik egy külön bárpult és egy dohányzó terasz is. Amit biztosítani tudunk: erősítő, keverőpult, hangfalak, mikrofonok, projektor, vetítővászon, flipchart tábla. Mindenféle zártkörű rendezvényekhez ajánljuk, például ebédekhez, vacsorákhoz, esküvőkhöz, születésnapokhoz, előadások, tréningek, stb.</p><p>Ezen kívül a kertbe is felveszünk nagyobb foglalásokat és arra is van lehetőség, hogy az egész vendéglőt kivedd.</p>', 'We''ll be adding some further information here.</p>'),
(9, 'SZERVEZO', 'Szia!<br/>Amenyiben szeretnél rendezvényt hozni a Levesbe keress bátran!', 'Hi!For any info regarding events, just give me a ring!'),
(10, 'VENDEGLO', 'A Kőleves 10 éves vendéglő. Imola és Kápszi ültünk egy rémséges vasút-állomáson 1995 körül és elhatároztuk, hogy nyitunk egy vendéglőt. Azt hiszem ez kb. 10 évvel később, de megvalósult 2005-ben. Ez a tíz év beszélgetés a vendéglőről elég volt ahhoz, hogy pontosan tudjuk mit akarunk és lássuk, hogy ugyanazt, ez azóta is töretlenül működik köztünk. Persze nem magától ment minden, hanem sok kölcsön pénzből, amivel az elején nehéz volt küzdenünk. Először a Dob-Kazinczy sarkán nyitottuk meg a Kőlevest, ahol 8 évig üzemeltünk egyre sikeresebben. Itt sikerült egysmást tanulnunk erről a szakmáról, hiszen egyikünk sem volt vendéglátós azelőtt, mégpedig főleg azt, hogy ha magunkat adjuk és beletesszük az energiáinkat, őszinték vagyunk, és figyelünk, akkor ezt a közönségünk is megérzi, és elérjük a sikert. A Kazinczy 41-be három éve költöztünk, ami már egy ötször akkora hely és itt megvalósulhatott minden álmunk, amit egy konyháról képzeltünk. Kidobhattuk a micro sütőt és mindent magunk tudunk elkészíteni, ami lekvár, szósz, pesto, öntet, vagy bármi hozzávaló és eredeti ízt kíván. Útközben még megnyitottuk a Kőleves kertet 7 évvel ezelőtt, hogy nyáron is lehessen könnyű grill konyhával a szabadban enni-inni. Azután 4 éve elkészült a Mika Tivadar Mulató, majd egy évvel később, a hozzá tartozó kert is.', 'We''ll be providing further description here.'),
(11, 'ABOUT_US', 'Igazán fiatalos, modern arcok vagyunk - és mindemellett még finomkat is főzünk! Gyere be hozz, akár csak egy kávéra is, ha nem szeretnéd otthon egyedül meginni, hanem kedves társasággal szeretnéd megosztani a reggeli lendületet!', 'We''ll be providing further description here.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `koleves_asztalfoglalasok`
--
ALTER TABLE `koleves_asztalfoglalasok`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_dolgozok`
--
ALTER TABLE `koleves_dolgozok`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_etelek`
--
ALTER TABLE `koleves_etelek`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_etelkategoriak`
--
ALTER TABLE `koleves_etelkategoriak`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_hirsav`
--
ALTER TABLE `koleves_hirsav`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_italkategoriak`
--
ALTER TABLE `koleves_italkategoriak`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_italok`
--
ALTER TABLE `koleves_italok`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_jogosultsagok`
--
ALTER TABLE `koleves_jogosultsagok`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_kepek`
--
ALTER TABLE `koleves_kepek`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_keptipusok`
--
ALTER TABLE `koleves_keptipusok`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_kep_osszekotesek`
--
ALTER TABLE `koleves_kep_osszekotesek`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_napimenuk`
--
ALTER TABLE `koleves_napimenuk`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_napimenu_idoszakok`
--
ALTER TABLE `koleves_napimenu_idoszakok`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_programok`
--
ALTER TABLE `koleves_programok`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_rendezvenyek`
--
ALTER TABLE `koleves_rendezvenyek`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `koleves_statikus`
--
ALTER TABLE `koleves_statikus`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `koleves_asztalfoglalasok`
--
ALTER TABLE `koleves_asztalfoglalasok`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `koleves_dolgozok`
--
ALTER TABLE `koleves_dolgozok`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `koleves_etelek`
--
ALTER TABLE `koleves_etelek`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `koleves_etelkategoriak`
--
ALTER TABLE `koleves_etelkategoriak`
MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `koleves_hirsav`
--
ALTER TABLE `koleves_hirsav`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `koleves_italkategoriak`
--
ALTER TABLE `koleves_italkategoriak`
MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `koleves_italok`
--
ALTER TABLE `koleves_italok`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `koleves_jogosultsagok`
--
ALTER TABLE `koleves_jogosultsagok`
MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `koleves_kepek`
--
ALTER TABLE `koleves_kepek`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `koleves_keptipusok`
--
ALTER TABLE `koleves_keptipusok`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `koleves_kep_osszekotesek`
--
ALTER TABLE `koleves_kep_osszekotesek`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `koleves_napimenuk`
--
ALTER TABLE `koleves_napimenuk`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `koleves_napimenu_idoszakok`
--
ALTER TABLE `koleves_napimenu_idoszakok`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `koleves_programok`
--
ALTER TABLE `koleves_programok`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `koleves_rendezvenyek`
--
ALTER TABLE `koleves_rendezvenyek`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `koleves_statikus`
--
ALTER TABLE `koleves_statikus`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
