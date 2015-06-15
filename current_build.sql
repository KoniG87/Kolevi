-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Hoszt: 127.0.0.1
-- Létrehozás ideje: 2015. Jún 10. 07:37
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

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
(22, 'asf', 'basf@as.com', '', 2, '0000-00-00 00:00:00', 0, NULL, NULL),
(23, 'Lali', 'odtahtenoeromemit@mailinator.com', 'Maceszgombóc extra!', 2, '0000-00-00 00:00:00', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_cikkek`
--

CREATE TABLE IF NOT EXISTS `koleves_cikkek` (
  `ID` int(6) NOT NULL,
  `TEXT_HU` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `KISKEP` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `NAGYKEP` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `URL` varchar(256) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `SORREND` tinyint(3) DEFAULT NULL,
  `VISIBLE` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_cikkek`
--

INSERT INTO `koleves_cikkek` (`ID`, `TEXT_HU`, `TEXT_EN`, `KISKEP`, `NAGYKEP`, `URL`, `SORREND`, `VISIBLE`) VALUES
(0, 'Cikk neve', 'Article Name', 'assets/img/tmb-2.png', NULL, 'http://index.hu/kultur/2015/05/24/fozelekes_feri/', 1, 1),
(0, 'Cikk neve', 'Article Name', 'assets/img/tmb-2.png', NULL, 'http://index.hu/kultur/2015/05/24/fozelekes_feri/', 2, 1),
(0, 'Cikk neve', 'Article Name', 'assets/img/tmb-2.png', 'assets/uploads/kert.jpg', NULL, 3, 1),
(0, 'Cikk neve', 'Article Name', 'assets/img/tmb-2.png', NULL, 'http://index.hu/kultur/2015/05/24/fozelekes_feri/', 4, 1),
(0, 'Cikk neve', 'Article Name', 'assets/img/tmb-2.png', 'assets/uploads/kert.jpg', NULL, 5, 1),
(0, 'Cikk neve', 'Article Name', 'assets/img/tmb-2.png', 'assets/uploads/kert.jpg', NULL, 6, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_dolgozok`
--

CREATE TABLE IF NOT EXISTS `koleves_dolgozok` (
`ID` int(6) NOT NULL,
  `USERNAME` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `NEV` varchar(70) COLLATE utf8_hungarian_ci NOT NULL,
  `MEGJEGYZES` varchar(4096) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `SZULETES` date DEFAULT NULL,
  `NEME` char(1) COLLATE utf8_hungarian_ci NOT NULL DEFAULT 'f',
  `KEP` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `TELEFON` varchar(20) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `EMAIL` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `JELSZAV` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `FACEBOOK` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `JOGOSULTSAG_ID` int(2) DEFAULT '1',
  `RENDEZVENYFELELOS` tinyint(1) NOT NULL DEFAULT '0',
  `VENDEGLO` tinyint(1) DEFAULT '1',
  `ALLAPOT` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_dolgozok`
--

INSERT INTO `koleves_dolgozok` (`ID`, `USERNAME`, `NEV`, `MEGJEGYZES`, `SZULETES`, `NEME`, `KEP`, `TELEFON`, `EMAIL`, `JELSZAV`, `FACEBOOK`, `JOGOSULTSAG_ID`, `RENDEZVENYFELELOS`, `VENDEGLO`, `ALLAPOT`) VALUES
(1, 'janka', 'Mosolygós Janka', 'Janka egy mosolygós kedves lány, jól dolgozk.', NULL, 'f', 'assets/uploads/about-img.png', '+36 70 6383 996', 'janka@kolevesvendeglo.hu', '242f21c3e786eb437c665e833666f35304623e0cc1112ed5f0f3644b5f76cff5', 'mjanka', 9, 1, 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_etelek`
--

CREATE TABLE IF NOT EXISTS `koleves_etelek` (
`ID` int(6) NOT NULL,
  `ETTEREM_ID` tinyint(1) DEFAULT '1',
  `KATEGORIA_ID` int(2) DEFAULT NULL,
  `TEXT_HU` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `SORREND` int(2) DEFAULT '1',
  `TAGEK` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `AR` int(6) DEFAULT NULL,
  `VISIBLE` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_etelek`
--

INSERT INTO `koleves_etelek` (`ID`, `ETTEREM_ID`, `KATEGORIA_ID`, `TEXT_HU`, `TEXT_EN`, `SORREND`, `TAGEK`, `AR`, `VISIBLE`) VALUES
(2, 1, 1, 'Medvehagymás brokkolikrémleves füstölt fürjtojással', 'Broccolisoup with hot smokin eggs of delight', 2, '1,4,5,6,9', 890, 1),
(3, 1, 1, 'Palócgulyás borjúból', 'Palocgulyas with da beef', 3, '1,2,10,11', 1250, 1),
(4, 1, 2, 'Avokádósaláta, szárított paradicsom, mandarin, mandula, kéksajt', 'Macesz-ball soup', 1, '1,3,6', 1550, 1),
(5, 1, 2, 'Füstölt tokhal, tökmagolajos saláta', 'Broccolisoup with hot smokin eggs of delight', 2, '2,8', 1450, 1),
(6, 1, 2, 'Szarvasgerinc, vargányás polenta, barnamártás', 'Palocgulyas with da beef', 3, '8,12', 1890, 1),
(7, 1, 3, 'Körtés-tejszínes tagliatelle ginnel, gorgonzolával', 'Macesz-ball soup', 1, '7,8,10', 2150, 1),
(8, 1, 3, 'Muszaka adzuki babbal, fekete lencsével', 'Broccolisoup with hot smokin eggs of delight', 2, '2,4,5,10', 2050, 1),
(9, 1, 3, 'Grillezett brie sajt, sült alma, céklás vöröslencse saláta', 'Palocgulyas with da beef', 3, '1,3,6', 2350, 1),
(10, 1, 4, 'Maceszflódni', 'Macesz-ball soup', 1, '2,3,10', 950, 1),
(11, 1, 4, 'Pisztáciás tiramisu', 'Broccolisoup with hot smokin eggs of delight', 2, '5,6', 960, 1),
(12, 1, 4, 'New York sajttorta', 'Palocgulyas with da beef', 3, '5,6', 990, 1),
(13, 1, 1, 'Maceszgombócleves', 'Maceszballsoup', 1, '1,3,10', 890, 1),
(14, 1, 1, 'Skandináv rákleves', 'Scandinavian lobstersoup', 4, '4,9,13', 1180, 1),
(15, 1, 2, 'Tapas (füstölt libamell, bresaola, borjúsűlt, tárkonyos lazac, medvehagymás retek, kecskesajt, angol mustáros öntet)', 'Tapas (lots of variations)', 4, '5,6', 2400, 1),
(16, 1, 2, 'Vegetáriánus Tapas (taleggio sajt, chilis pecorino, olajbogyó, kecskesajttal töltött kápiapaprika, piros pesztó)', 'Vega-tapas (lots of variations)', 5, '7,8,10', 2100, 1),
(17, 1, 3, 'Gombás-spenótos rétes zöld pesztóval, sütőtökös salátával', 'Mushy-spinach strudel', 4, '7,8,10', 2450, 1),
(18, 1, 3, 'Wokban pirított zöldségek, kesudió és jázmin rizs', 'Wok veggies with rice', 5, '1,14', 2090, 1),
(19, 1, 3, 'Tanyasi csirkemell, avokádósaláta, szárított paradicsom, mandarin, kéksajt', 'Countryside chicken', 6, '4,9,13', 2980, 1),
(20, 1, 3, 'Vadas házinyúl, zsemlegombóc', 'Wildling rab''stew', 7, '5,6', 3150, 1),
(21, 1, 3, 'Magyar báránysült, laskagomba, prósza, kefires fejes saláta', 'Hungarian lambsteak', 8, '5,6', 4750, 1),
(22, 1, 3, 'Ribeye steak, tormás krumpli és céklás káposztasaláta', 'Ribeye steak', 9, '4,9,13', 4650, 1),
(23, 1, 3, 'Csodaszarvas steak, vargányás polenta, barnamártás', 'Wun-deer steak', 10, '5,6', 4250, 1),
(24, 1, 3, 'Egészben sült pisztráng, sült édeskömény, gratin krumpli', 'Trout in whole', 11, '4,9,13', 4350, 1),
(25, 1, 3, 'Konfitált libacomb, hagymás törtkrumpli és aszalt gyümölcsös párolt káposzta', 'Confiterage geeseleggings', 12, '2,8', 3280, 1),
(26, 1, 3, 'Sólet libacombbal vagy tojással (pénteken, szombaton, vasárnap)', 'Geesethighs became show', 13, '2,3,10', 3080, 1),
(27, 1, 3, 'Wokban pirított kacsamell, zöldségek, kesudió és jázmin rizs', 'Wok-peered ducktitties', 14, '2,3,10', 2980, 1),
(28, 1, 3, 'Roston kacsamell, chilis-datolyás sült zeller', 'Ducktats on the grill', 15, '2,3,10', 3280, 1),
(29, 1, 4, 'Csokoládés karobtorta, fagylalt', 'Carobcake chocolate chedarai', 4, '4,9,13', 980, 1),
(30, 2, 3, 'Tócsni fokhagymás tejföllel, sajttal', 'Potato Pancake with Garlic Sour Cream and Cheese', 1, '1,3,7', 620, 1),
(31, 2, 3, 'Tócsni fokhagymás tejföllel, sajttal és salátával', 'Potato Pancake with Garlic Sour Cream, Cheese and Salad', 2, '1,3,7', 780, 1),
(32, 2, 3, 'Saláta sáprgával és sült paprikával', 'Salad with Asparagus and Roast Pepper', 3, '7', 1520, 1),
(33, 2, 3, 'Spenótos-túrós lepény friss zöldséges salátával', 'Spinach-Cottage Cheese Pie with Fresh Salad', 4, '7,3', 1680, 1),
(34, 2, 3, 'Philadelphia steak szendvics', 'Philadelphia Steak Sandwich', 5, '1,3,7', 1450, 1),
(35, 2, 3, 'Barbecue marhasült coleslaw salátával', 'Barbecue Roast Beef with Coleslaw Salad', 6, '3,7,10', 2250, 1),
(36, 2, 3, 'Kebab mentás padlizsánsalátával', 'Kebab with Roasted Eggplant and Mint Salad', 7, '7', 1950, 1),
(37, 2, 3, 'Házi kacsakolbász újhagymás krumplisalátával', 'Home Made Duck Sausage with Scallion Potato Salad', 8, '10,3,7', 1850, 1),
(38, 2, 3, 'Kolbászos paprikás krumpli, házi kenyér', 'Paprika Potatoes with Sausages, Homemade Bread', 9, '1', 1350, 1),
(39, 2, 3, 'Roston sült gomolya friss zöldséges salátával', 'Grilled Soft Cheese, Fresh Vegetables Salad', 10, '7,11', 2150, 1),
(40, 2, 3, 'Roston sült csirkemell friss zöldséges salátával', 'Grilled Chicken Breast, Fresh Vegetable Salad', 11, '7,11', 1850, 1),
(41, 2, 3, 'Fűszeres sültkrumpli (házi paradicsomlekvár vagy újhagymás málnaecetes majonéz öntettel)', 'Spicy Chips with Sauce (Homemade Tomato Marmelade or Mayonnaise with Raspberry Vinegar)', 12, '10,1,3,7', 680, 1),
(44, 1, 4, 'ASD', '', 5, '2', 0, 1);

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
(1, 'KŐLEVESEK', 'STONE SOUPS', 1, 'etel-leves'),
(2, 'SALÁTÁK ÉS ELŐÉTELEK', 'SALADS AND APPETIZERS', 2, 'etel-salata'),
(3, 'FŐÉTELEK', 'MAIN COURSES', 3, 'etel-foetel'),
(4, 'DESSZERTEK', 'DESSERTS', 4, 'etel-desszert');

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
  `URL` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `ROGZITVE` datetime DEFAULT NULL,
  `SORREND` tinyint(2) DEFAULT '1',
  `ALLAPOT` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_hirsav`
--

INSERT INTO `koleves_hirsav` (`ID`, `TIPUS_ID`, `FK_ID`, `TEXT_HU`, `TEXT_EN`, `URL`, `ROGZITVE`, `SORREND`, `ALLAPOT`) VALUES
(1, 1, 1, 'Esküvő az emeleten', 'Wedding in the attic', NULL, '2015-04-20 16:20:06', 1, 1),
(2, 3, 0, 'Ma köménymagos cipó lesz!', NULL, NULL, '2015-04-20 16:59:32', 1, 1),
(3, 2, 0, 'Kerti nyitóprogram', NULL, NULL, '2015-04-22 03:40:45', 1, 1),
(4, 4, 0, 'Google', NULL, 'http://google.com', '2015-05-28 22:16:20', 1, 1);

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
  `ETTEREM_ID` tinyint(1) DEFAULT '1',
  `KATEGORIA_ID` int(2) DEFAULT NULL,
  `TEXT_HU` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `ALKATEGORIA` tinyint(1) DEFAULT '0',
  `SORREND` int(2) DEFAULT '1',
  `AR` int(6) DEFAULT NULL,
  `VISIBLE` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_italok`
--

INSERT INTO `koleves_italok` (`ID`, `ETTEREM_ID`, `KATEGORIA_ID`, `TEXT_HU`, `TEXT_EN`, `ALKATEGORIA`, `SORREND`, `AR`, `VISIBLE`) VALUES
(1, 1, 1, 'Capuchino', 'Some drink name', 0, 1, 550, 1),
(2, 1, 1, 'Ír kávé', 'Some drink name', 0, 2, 570, 1),
(3, 1, 1, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(4, 1, 1, 'Egy sor szöveg', 'Some drink name', 0, 4, 420, 1),
(5, 1, 1, 'Egy sor szöveg', 'Some drink name', 0, 5, 520, 1),
(6, 1, 1, 'Egy sor szöveg', 'Some drink name', 0, 6, 420, 1),
(7, 1, 1, 'Egy sor szöveg', 'Some drink name', 0, 7, 420, 1),
(8, 1, 1, 'Egy sor szöveg', 'Some drink name', 0, 8, 520, 1),
(9, 1, 1, 'Egy sor szöveg', 'Some drink name', 0, 9, 420, 1),
(10, 1, 2, 'Egy sor szöveg', 'Some drink name', 0, 1, 420, 1),
(11, 1, 2, 'Egy sor szöveg', 'Some drink name', 0, 2, 460, 1),
(12, 1, 2, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(13, 1, 2, 'Egy sor szöveg', 'Some drink name', 0, 4, 420, 1),
(14, 1, 2, 'Egy sor szöveg', 'Some drink name', 0, 5, 520, 1),
(15, 1, 2, 'Egy sor szöveg', 'Some drink name', 0, 6, 420, 1),
(16, 1, 3, 'Egy sor szöveg', 'Some drink name', 0, 1, 420, 1),
(17, 1, 3, 'Egy sor szöveg', 'Some drink name', 0, 2, 460, 1),
(18, 1, 3, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(19, 1, 4, 'Egy sor szöveg', 'Some drink name', 0, 1, 420, 1),
(20, 1, 4, 'Egy sor szöveg', 'Some drink name', 0, 2, 460, 1),
(21, 1, 4, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(22, 1, 4, 'Egy sor szöveg', 'Some drink name', 0, 4, 420, 1),
(23, 1, 4, 'Egy sor szöveg', 'Some drink name', 0, 5, 520, 1),
(24, 1, 5, 'Egy sor szöveg', 'Some drink name', 0, 1, 420, 1),
(25, 1, 5, 'Egy sor szöveg', 'Some drink name', 0, 2, 460, 1),
(26, 1, 5, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(27, 1, 5, 'Egy sor szöveg', 'Some drink name', 0, 4, 420, 1),
(28, 1, 5, 'Egy sor szöveg', 'Some drink name', 0, 5, 520, 1),
(29, 1, 5, 'Egy sor szöveg', 'Some drink name', 0, 6, 420, 1),
(30, 1, 5, 'Egy sor szöveg', 'Some drink name', 0, 7, 420, 1),
(31, 1, 5, 'Egy sor szöveg', 'Some drink name', 0, 8, 520, 1),
(32, 1, 5, 'Egy sor szöveg', 'Some drink name', 0, 9, 420, 1),
(33, 1, 5, 'Egy sor szöveg', 'Some drink name', 0, 10, 520, 1),
(34, 1, 5, 'Egy sor szöveg', 'Some drink name', 0, 11, 420, 1),
(35, 2, 1, 'Capuchino', 'Some drink name', 0, 1, 550, 1),
(36, 2, 1, 'Ír kávé', 'Some drink name', 0, 2, 570, 1),
(37, 2, 1, 'Kert presszó', 'Some drink name', 0, 3, 470, 1),
(38, 2, 1, 'Egy sor szöveg', 'Some drink name', 0, 4, 420, 1),
(39, 2, 1, 'Egy sor szöveg', 'Some drink name', 0, 5, 520, 1),
(40, 2, 1, 'Egy sor szöveg', 'Some drink name', 0, 6, 420, 1),
(41, 2, 1, 'Egy sor szöveg', 'Some drink name', 0, 7, 420, 1),
(42, 2, 1, 'Egy sor szöveg', 'Some drink name', 0, 8, 520, 1),
(43, 2, 1, 'Egy sor szöveg', 'Some drink name', 0, 9, 420, 1),
(44, 2, 2, 'Egy sor szöveg', 'Some drink name', 0, 1, 420, 1),
(45, 2, 2, 'Egy sor szöveg', 'Some drink name', 0, 2, 460, 1),
(46, 2, 2, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(47, 2, 2, 'Egy sor szöveg', 'Some drink name', 0, 4, 420, 1),
(48, 2, 2, 'Egy sor szöveg', 'Some drink name', 0, 5, 520, 1),
(49, 2, 2, 'Egy sor szöveg', 'Some drink name', 0, 6, 420, 1),
(50, 2, 3, 'Egy sor szöveg', 'Some drink name', 0, 1, 420, 1),
(51, 2, 3, 'Egy sor szöveg', 'Some drink name', 0, 2, 460, 1),
(52, 2, 3, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(53, 2, 4, 'Egy sor szöveg', 'Some drink name', 0, 1, 420, 1),
(54, 2, 4, 'Egy sor szöveg', 'Some drink name', 0, 2, 460, 1),
(55, 2, 4, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(56, 2, 4, 'Egy sor szöveg', 'Some drink name', 0, 4, 420, 1),
(57, 2, 4, 'Egy sor szöveg', 'Some drink name', 0, 5, 520, 1),
(58, 2, 5, 'Egy sor szöveg', 'Some drink name', 0, 1, 420, 1),
(59, 2, 5, 'Egy sor szöveg', 'Some drink name', 0, 2, 460, 1),
(60, 2, 5, 'Egy sor szöveg', 'Some drink name', 0, 3, 470, 1),
(61, 2, 5, 'Egy sor szöveg', 'Some drink name', 0, 4, 420, 1),
(62, 2, 5, 'Egy sor szöveg', 'Some drink name', 0, 5, 520, 1),
(63, 2, 5, 'Egy sor szöveg', 'Some drink name', 0, 6, 420, 1),
(64, 2, 5, 'Egy sor szöveg', 'Some drink name', 0, 7, 420, 1),
(65, 2, 5, 'Egy sor szöveg', 'Some drink name', 0, 8, 520, 1),
(66, 2, 5, 'Egy sor szöveg', 'Some drink name', 0, 9, 420, 1),
(67, 2, 5, 'Egy sor szöveg', 'Some drink name', 0, 10, 520, 1),
(68, 2, 5, 'Egy sor szöveg', 'Some drink name', 0, 11, 420, 1),
(71, 1, 1, 'Új és forró', '', 0, 21, 200, 1),
(72, 2, 1, 'asdasd', '', 0, 23, 250, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_kepek`
--

INSERT INTO `koleves_kepek` (`ID`, `FAJLNEV`, `LEIRAS_HU`, `GALLERY_TAG`, `SZEKCIO`) VALUES
(1, 'assets/uploads/renezvenyek_slide.jpg', NULL, 2, 2),
(4, 'assets/uploads/gallery01.jpg', NULL, 1, 2),
(5, 'assets/uploads/gallery02.jpg', NULL, NULL, 1),
(6, 'assets/uploads/gallery03.jpg', NULL, NULL, 1),
(7, 'assets/uploads/gallery04.jpg', NULL, NULL, NULL),
(8, 'assets/uploads/about-img.png', NULL, NULL, 3),
(9, 'assets/uploads/cat-tracks.jpg', NULL, NULL, NULL),
(10, 'assets/uploads/gslide-1.jpg', NULL, NULL, 4),
(11, 'assets/uploads/gslide-2.jpg', NULL, NULL, 4),
(12, 'assets/uploads/gslide-3.jpg', NULL, NULL, 4),
(13, 'assets/uploads/gslide-4.jpg', NULL, NULL, 4),
(14, 'assets/uploads/gslide-1.jpg', NULL, NULL, 4),
(15, 'assets/uploads/gslide-2.jpg', NULL, NULL, 4),
(16, 'assets/uploads/gslide-3.jpg', NULL, NULL, 4),
(17, 'assets/uploads/gslide-4.jpg', NULL, NULL, 4),
(18, 'assets/uploads/6771046-architecture-wallpaper.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_keptipusok`
--

CREATE TABLE IF NOT EXISTS `koleves_keptipusok` (
`ID` int(6) NOT NULL,
  `MEGNEVEZES` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `SZEKCIO` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `ALLAPOT` int(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_keptipusok`
--

INSERT INTO `koleves_keptipusok` (`ID`, `MEGNEVEZES`, `SZEKCIO`, `ALLAPOT`) VALUES
(1, 'Rendezvény', 'rendezvenyek', 1),
(2, 'Program', 'programok', 2),
(3, 'Hir', NULL, 3),
(4, 'Szoba', 'szoba', 4),
(5, 'Partner', 'partner', 5),
(6, 'Cikk', 'cikk', 6);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_kep_osszekotesek`
--

INSERT INTO `koleves_kep_osszekotesek` (`ID`, `TIPUS`, `FK_ID`, `KEP_ID`, `SORREND`) VALUES
(11, 1, 1, 6, 1),
(13, 1, 1, 5, 1),
(14, 4, 1, 10, 1),
(15, 4, 1, 11, 2),
(16, 4, 1, 12, 3),
(17, 4, 1, 13, 4),
(18, 4, 1, 14, 5),
(19, 4, 1, 15, 6),
(20, 4, 1, 16, 7),
(21, 4, 1, 17, 8);

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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

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
(58, 6, 2, 3, 'Uj csupacsokidesszert', '', 'V'),
(59, 7, 1, 1, 'Tedd oda', 'Pambam Soup', 'V'),
(60, 8, 1, 1, 'Something', '', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_napimenu_idoszakok`
--

CREATE TABLE IF NOT EXISTS `koleves_napimenu_idoszakok` (
`ID` int(6) NOT NULL,
  `EV` int(4) DEFAULT NULL,
  `HET` int(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_napimenu_idoszakok`
--

INSERT INTO `koleves_napimenu_idoszakok` (`ID`, `EV`, `HET`) VALUES
(1, 2015, 15),
(2, 2015, 16),
(5, 2015, 17),
(6, 2015, 18),
(7, 2015, 21),
(8, 2015, 22);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_partnerek`
--

CREATE TABLE IF NOT EXISTS `koleves_partnerek` (
`ID` int(6) NOT NULL,
  `TEXT_HU` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `LEIRAS_HU` varchar(1024) COLLATE utf8_hungarian_ci NOT NULL,
  `LEIRAS_EN` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `KEP` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `URL` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `VISIBLE` tinyint(1) NOT NULL DEFAULT '1',
  `SORREND` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `ROGZITVE` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_partnerek`
--

INSERT INTO `koleves_partnerek` (`ID`, `TEXT_HU`, `TEXT_EN`, `LEIRAS_HU`, `LEIRAS_EN`, `KEP`, `URL`, `VISIBLE`, `SORREND`, `ROGZITVE`) VALUES
(1, 'A cég neve', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores similique facilis non quia aliquam perspiciatis, eum consectetur quisquam quo! Optio totam ad quibusdam repellat cupiditate consequuntur, amet est, quidem perferendis.', NULL, 'assets/img/tmb-2.png', 'http://rcko.fm', 1, 1, NULL),
(2, 'A partner neve', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores similique facilis non quia aliquam perspiciatis, eum consectetur quisquam quo! Optio totam ad quibusdam repellat cupiditate consequuntur, amet est, quidem perferendis. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores similique facilis non quia aliquam perspiciatis, eum consectetur quisquam quo! Optio totam ad quibusdam repellat cupiditate consequuntur, amet est, quidem perferendis.', NULL, 'assets/img/tmb-2.png', 'http://rcko.fm', 1, 2, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_programok`
--

INSERT INTO `koleves_programok` (`ID`, `DATUM`, `TEXT_HU`, `TEXT_EN`, `LEIRAS_HU`, `LEIRAS_EN`, `KEP`, `FBLINK`, `ALLAPOT`) VALUES
(1, '2015-03-31', 'Kőleves Kert nyárbúcsuztató napok', 'Kőleves summer closing days', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'assets/img/gslide-1.png', NULL, 1),
(2, '2015-04-17', 'programnevea', 'nameofprogram', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', '', NULL, 1),
(3, '2015-04-18', 'Valami lesz ggsdfsgfdsgsfdgd ', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'assets/uploads/gallery02.jpg', 'https://www.facebook.com/events/1594402937444863/', 1),
(4, '2015-04-28', 'teszt progi', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'assets/uploads/gallery02.jpg', NULL, 1),
(5, '2015-05-31', 'Valami progi', NULL, 'Van ám olyan is, <br/>aminek rövid leírása <br/>van csak.', 'There''s this one with the rather short description, ye know.', 'assets/uploads/gallery02.jpg', '', 1),
(6, '2015-06-25', 'Letsdothis', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'assets/uploads/gallery02.jpg', NULL, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_rendezvenyek`
--

INSERT INTO `koleves_rendezvenyek` (`ID`, `TEXT_HU`, `LEIRAS_HU`, `TEXT_EN`, `LEIRAS_EN`, `SORREND`, `ALLAPOT`) VALUES
(1, 'Esküvő az emeleten', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi quaerat at, perspiciatis assumenda veritatis. Blanditiis natus facilis placeat aliquam.', 'Wedding UpStairs', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi quaerat at, perspiciatis assumenda veritatis. Blanditiis natus facilis placeat aliquam.', 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_statikus`
--

CREATE TABLE IF NOT EXISTS `koleves_statikus` (
`ID` int(6) NOT NULL,
  `LABEL` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_HU` varchar(2048) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `TEXT_EN` varchar(2048) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_statikus`
--

INSERT INTO `koleves_statikus` (`ID`, `LABEL`, `TEXT_HU`, `TEXT_EN`) VALUES
(1, 'CETLI1_1', 'Csirkepaprikás nokedlivel', 'Chickenpaprika stew with'),
(2, 'CETLI1_2', 'házi káposztasalátával', 'noodles and homemade cabbagesalad'),
(3, 'CETLI1_3', '1950', '1950'),
(4, 'DEARGUESTS', 'Kedves Vendégeink!', 'Dear Guests!'),
(5, 'NAPIMENU_TEXT', 'Vegetáriánus és húsos menünk van hétköznaponként 1.000 Ft és 1.250 Ft-os áron, ami mellé szörpöt is adunk. Siessetek, mert ½ 12-től van ebéd és 60-70 adagot készítünk, ezért van, hogy ½ 1-re elfogy.', 'We''ll be adding some further information here.'),
(6, 'NAPIMENU_LEGEND', 'GM = gluténmentes TM = tejtermék mentes V = vegetáriánus', 'GM = gluten-free TM = lactose-free V = vegetarian'),
(7, 'FOGLALAS_LEIRAS', '<p>Ezen a helyen csak a Kőleves Vendéglőbe tudsz asztalt foglalni maximum 7 főre,ha többen jönnétek, kérlek telefonáljatok.</p><p>Ha jó idő van, akkor talán a teraszon is ülhetsz, ha ott szeretnél asztalt, kérlek írd meg a megjegyzésbe. Foglalásod csak akkor érvényes, ha visszaigazoljuk e-mailben vagy telefonon.</p>&nbsp;<p>Ha nagyobb rendezvényt szeretnél, kérlek telefonálj nekünk. +3620 213 5999, +361 322 1011</p><p>A Kőleves Kert, ami egy különálló kocsma, külön grill konyhával, nem tévesztendő össze a vendéglővel, de ha oda szeretnél foglalni, próbáld meg a vendéglőt hívni. Oda csak 10 fő fölött és csak este 7-ig áll módunkban tartani az asztalt.</p><p>Késés esetén az asztalfoglalást 20 percig tartjuk, ha mégis lemondanád a foglalást, kérlek telefonálj nekünk.</p>', '<p>We''ll be adding some further information here.</p>'),
(8, 'RENDEZVENY', '<p>A földszinti vendégtérből nyílik az általunk "VIP" teremnek nevezett kisterem, ahol maximum 13 fő fér el. Zártkörű ebédekhez, vacsorákhoz vagy megbeszélésekhez ajánljuk.</p><p>Az épület hátsó részében található az "Elefántos" terem, ahol maximum 25 fő fér el ültetve, ha nem feltétlenül szeretne mindenki leülni, akkor 40 ember is befér. Ezt a termet zártkörű ebédekhez, vacsorákhoz, megbeszélésekhez, osztálytalálkozókhoz, tréningekhez, workshopokhoz, stb. ajánljuk. Ennek a teremnek van egy külön pultja is, projektora és néhány kényelmes fotelje is.</p><p>Az emeleti különterem a legnagyobb külön helyiségünk. Ültetve 70-75 ember fér el benne, állva 120-150-en is akár. Ehhez a teremhez tartozik egy külön bárpult és egy dohányzó terasz is. Amit biztosítani tudunk: erősítő, keverőpult, hangfalak, mikrofonok, projektor, vetítővászon, flipchart tábla. Mindenféle zártkörű rendezvényekhez ajánljuk, például ebédekhez, vacsorákhoz, esküvőkhöz, születésnapokhoz, előadások, tréningek, stb.</p><p>Ezen kívül a kertbe is felveszünk nagyobb foglalásokat és arra is van lehetőség, hogy az egész vendéglőt kivedd.</p>', 'We''ll be adding some further information here.</p>'),
(9, 'SZERVEZO', 'Szia!<br/>Amenyiben szeretnél rendezvényt hozni a Levesbe keress bátran!', 'Hi!For any info regarding events, just give me a ring!'),
(10, 'VENDEGLO', 'A Kőleves 10 éves vendéglő. Imola és Kápszi ültünk egy rémséges vasút-állomáson 1995 körül és elhatároztuk, hogy nyitunk egy vendéglőt. Azt hiszem ez kb. 10 évvel később, de megvalósult 2005-ben. Ez a tíz év beszélgetés a vendéglőről elég volt ahhoz, hogy pontosan tudjuk mit akarunk és lássuk, hogy ugyanazt, ez azóta is töretlenül működik köztünk. Persze nem magától ment minden, hanem sok kölcsön pénzből, amivel az elején nehéz volt küzdenünk. Először a Dob-Kazinczy sarkán nyitottuk meg a Kőlevest, ahol 8 évig üzemeltünk egyre sikeresebben. Itt sikerült egysmást tanulnunk erről a szakmáról, hiszen egyikünk sem volt vendéglátós azelőtt, mégpedig főleg azt, hogy ha magunkat adjuk és beletesszük az energiáinkat, őszinték vagyunk, és figyelünk, akkor ezt a közönségünk is megérzi, és elérjük a sikert. A Kazinczy 41-be három éve költöztünk, ami már egy ötször akkora hely és itt megvalósulhatott minden álmunk, amit egy konyháról képzeltünk. Kidobhattuk a micro sütőt és mindent magunk tudunk elkészíteni, ami lekvár, szósz, pesto, öntet, vagy bármi hozzávaló és eredeti ízt kíván. Útközben még megnyitottuk a Kőleves kertet 7 évvel ezelőtt, hogy nyáron is lehessen könnyű grill konyhával a szabadban enni-inni. Azután 4 éve elkészült a Mika Tivadar Mulató, majd egy évvel később, a hozzá tartozó kert is.', 'We''ll be providing further description here.'),
(11, 'ABOUT_US', 'Igazán fiatalos, modern arcok vagyunk - és mindemellett még finomkat is főzünk! Gyere be hozz, akár csak egy kávéra is, ha nem szeretnéd otthon egyedül meginni, hanem kedves társasággal szeretnéd megosztani a reggeli lendületet!', 'We''ll be providing further description here.'),
(12, 'KERT', 'A Kőleves Kert 8. szezonját éli. Amikor még a sarkon volt a vendéglőnk és egy elég brutális mellék-helység volt a kertben, akkor a szimpla kerten kívül senki más nem volt a környéken, nagyon vártuk, hogy végre ennyire nyüzsgő belváros legyünk.', 'We''ll be providing further description here.'),
(13, 'CETLI2_1', 'Valami más is', NULL),
(14, 'CETLI2_2', 'jó drágán, de finom', NULL),
(15, 'CETLI2_3', '5000', NULL),
(16, 'CETLI3_1', 'Is lesz', NULL),
(17, 'CETLI3_2', 'itt', NULL),
(18, 'CETLI3_3', '2300', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_szobak`
--

CREATE TABLE IF NOT EXISTS `koleves_szobak` (
`ID` int(6) NOT NULL,
  `TEXT_HU` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `LEIRAS_HU` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `LEIRAS_EN` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `KEZDOKEP` int(6) DEFAULT NULL,
  `VISIBLE` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_szobak`
--

INSERT INTO `koleves_szobak` (`ID`, `TEXT_HU`, `TEXT_EN`, `LEIRAS_HU`, `LEIRAS_EN`, `KEZDOKEP`, `VISIBLE`) VALUES
(1, 'Szoba11', 'Room 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto perspiciatis deserunt amet culpa commodi a praesentium fuga quod eligendi labore quidem asperiores sint accusamus aperiam similique id cupiditate dolorum omnis maiores enim quas tempora, ullam, perferendis officia accusantium. Quis, quasi.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto perspiciatis deserunt amet culpa commodi a praesentium fuga quod eligendi labore quidem asperiores sint accusamus aperiam similique id cupiditate dolorum omnis maiores enim quas tempora, ullam, perferendis officia accusantium. Quis, quasi.', 0, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `koleves_szoba_reviewek`
--

CREATE TABLE IF NOT EXISTS `koleves_szoba_reviewek` (
  `ID` int(6) NOT NULL,
  `SZOBA_ID` int(5) NOT NULL,
  `CIM` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
  `NEV` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `LEIRAS` varchar(512) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `KEP` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `RATING` int(6) DEFAULT NULL,
  `VISIBLE` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_szoba_reviewek`
--

INSERT INTO `koleves_szoba_reviewek` (`ID`, `SZOBA_ID`, `CIM`, `NEV`, `LEIRAS`, `KEP`, `RATING`, `VISIBLE`) VALUES
(0, 1, 'Nice try near Budapest', 'Példa Pál', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia quis quod neque? Beatae mollitia commodi blanditiis, accusamus temporibus molestiae dolor totam, quibusdam corporis nobis ex, ipsum recusandae! Eum dolorem nam minus culpa veniam, in. Pariatur voluptatem, officiis harum blanditiis mollitia.', 'assets/img/tmb-2.png', 4, 1);

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
-- Indexes for table `koleves_partnerek`
--
ALTER TABLE `koleves_partnerek`
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
-- Indexes for table `koleves_szobak`
--
ALTER TABLE `koleves_szobak`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `koleves_asztalfoglalasok`
--
ALTER TABLE `koleves_asztalfoglalasok`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `koleves_dolgozok`
--
ALTER TABLE `koleves_dolgozok`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `koleves_etelek`
--
ALTER TABLE `koleves_etelek`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `koleves_etelkategoriak`
--
ALTER TABLE `koleves_etelkategoriak`
MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `koleves_hirsav`
--
ALTER TABLE `koleves_hirsav`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `koleves_italkategoriak`
--
ALTER TABLE `koleves_italkategoriak`
MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `koleves_italok`
--
ALTER TABLE `koleves_italok`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `koleves_jogosultsagok`
--
ALTER TABLE `koleves_jogosultsagok`
MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `koleves_kepek`
--
ALTER TABLE `koleves_kepek`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `koleves_keptipusok`
--
ALTER TABLE `koleves_keptipusok`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `koleves_kep_osszekotesek`
--
ALTER TABLE `koleves_kep_osszekotesek`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `koleves_napimenuk`
--
ALTER TABLE `koleves_napimenuk`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `koleves_napimenu_idoszakok`
--
ALTER TABLE `koleves_napimenu_idoszakok`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `koleves_partnerek`
--
ALTER TABLE `koleves_partnerek`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `koleves_programok`
--
ALTER TABLE `koleves_programok`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `koleves_rendezvenyek`
--
ALTER TABLE `koleves_rendezvenyek`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `koleves_statikus`
--
ALTER TABLE `koleves_statikus`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `koleves_szobak`
--
ALTER TABLE `koleves_szobak`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;











DROP TABLE koleves_delicates_slider;
CREATE TABLE IF NOT EXISTS `koleves_delicates_slider` (
	ID int(6) AUTO_INCREMENT NOT NULL,
	`TEXT_HU` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
	`TEXT_EN` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`LEIRAS_HU` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`LEIRAS_EN` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`TAG_HU` varchar(256) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`TAG_EN` varchar(256) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`KEP` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`AR` int(6) DEFAULT NULL,
	SORREND int(3) DEFAULT 1,
	VISIBLE tinyint(1) DEFAULT 1,
	PRIMARY KEY(ID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

INSERT INTO koleves_delicates_slider (TEXT_HU, TEXT_EN, LEIRAS_HU, LEIRAS_EN, TAG_HU, TAG_EN, KEP, AR, SORREND) VALUES
	('Házi Libazsír', 'Geesegrease', 'Kóstold meg isteni finom hazai libánkat.', 'Godlike flavor Geesegrease', NULL, NULL, 'assets/uploads/gallery02.jpg', 1400, 1),
	('Házi Libazsír, de egy másik libából.', 'Yet another Geesegrease', 'Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.', 'Godlike indeed this Geesegrease is', 'lila <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> lila ', 'purple <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">purple</a> purple', 'assets/uploads/gallery02.jpg', 1400, 2),
	('Házi Libazsír, de egy másik libából.', 'Yet another Geesegrease', 'Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.', 'Godlike indeed this Geesegrease is', 'lila <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> lila ', 'purple <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">purple</a> purple', 'assets/uploads/gallery02.jpg', 1400, 3),
	('Házi Libazsír, de egy másik libából.', 'Yet another Geesegrease', 'Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.', 'Godlike indeed this Geesegrease is', 'lila <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> lila ', 'purple <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">purple</a> purple', 'assets/uploads/gallery02.jpg', 990, 4),
	('Házi Libazsír, de egy másik libából.', 'Yet another Geesegrease', 'Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.', 'Godlike indeed this Geesegrease is', 'lila <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> lila ', 'purple <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">purple</a> purple', 'assets/uploads/gallery02.jpg', 2000, 5),
	('Házi Libazsír, de egy másik libából.', 'Yet another Geesegrease', 'Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.', 'Godlike indeed this Geesegrease is', 'lila <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> lila ', 'purple <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">purple</a> purple', 'assets/uploads/gallery02.jpg', 1600, 6),
	('Házi Libazsír, de egy másik libából.', 'Yet another Geesegrease', 'Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.', 'Godlike indeed this Geesegrease is', NULL, NULL, 'assets/uploads/gallery02.jpg', 1500, 7);



CREATE TABLE IF NOT EXISTS `koleves_delicates_fokategoriak` (
	ID int(2) AUTO_INCREMENT NOT NULL,
	`TEXT_HU` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
	`TEXT_EN` varchar(64) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`ICON` varchar(32) COLLATE utf8_hungarian_ci DEFAULT NULL,
	SORREND int(2) DEFAULT 1,
	PRIMARY KEY(ID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

INSERT INTO koleves_delicates_fokategoriak (ICON, TEXT_HU, TEXT_EN, SORREND) VALUES
	('eheto', 'Ehető', 'Edibles', 1),
	('ihato', 'Iható', 'Drinkables', 2),
	('nemeheto', 'Nem ehető', 'Non-edibles', 3);

CREATE TABLE IF NOT EXISTS `koleves_delicates_alkategoriak` (
	ID int(3) AUTO_INCREMENT NOT NULL,
	FOKATEGORIA_ID int(2) NOT NULL,
	`TEXT_HU` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
	`TEXT_EN` varchar(64) COLLATE utf8_hungarian_ci DEFAULT NULL,
	SORREND int(3) DEFAULT 1,
	PRIMARY KEY(ID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

INSERT INTO koleves_delicates_alkategoriak (FOKATEGORIA_ID, TEXT_HU, TEXT_EN, SORREND) VALUES
	(1, 'Pesztó', 'Pesto', 1),
	(1, 'Csathni', 'Chutney', 2),
	(1, 'Lekvár', 'Jams', 3),
	(1, 'Kenyér', 'Breads', 4),
	(2, 'Borok', 'Wines', 1),
	(2, 'Szörpök', 'Sirups', 2),
	(2, 'Pálinkák', 'Palinka', 3),
	(3, 'Könyvek', 'Books', 1),
	(3, 'Étkészlet', 'Utensils', 2),
	(3, 'Ajándéktárgyak', 'Souvenirs', 3);
	
	
CREATE TABLE IF NOT EXISTS `koleves_delicates_termekek` (
	ID int(6) AUTO_INCREMENT NOT NULL,
	ALKATEGORIA_ID int(3) NOT NULL,
	`TEXT_HU` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
	`TEXT_EN` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`LEIRAS_HU` varchar(1024) COLLATE utf8_hungarian_ci NOT NULL,
	`LEIRAS_EN` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`KISKEP` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`NAGYKEP` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`TAG_HU` varchar(512) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`TAG_EN` varchar(512) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`AR` int(6) DEFAULT NULL,
	SORREND int(3) DEFAULT 1,
	PRIMARY KEY(ID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

INSERT INTO koleves_delicates_termekek (ALKATEGORIA_ID, TEXT_HU, LEIRAS_HU, TAG_HU, KISKEP, NAGYKEP, AR, SORREND) VALUES
	(1, 'Piszti Pesztó', 'Szuper pesztó', 'pesztó', "assets/uploads/th_gallery04.jpg", "assets/uploads/gallery04.jpg", 1400, 1),
	(1, 'Pasta Pesztó', 'Pasta de pesztó', 'pesztó', "assets/uploads/th_gallery01.jpg", "assets/uploads/gallery01.jpg", 1500, 2),
	(1, 'Rasta Pasta Pesztó', 'Rastafari delight', 'pesztó,rasta', "assets/uploads/th_gallery02.jpg", "assets/uploads/gallery02.jpg", 1700, 3),
	(2, 'Málnás csatni', 'Csatni, mégpedig málnás', 'csatni,málnás', "assets/uploads/th_gallery04.jpg", "assets/uploads/gallery04.jpg", 800, 1),
	(2, 'Epres csatni', 'Csatni, mégpedig epres', 'csatni,epres', "assets/uploads/th_gallery03.jpg", "assets/uploads/gallery03.jpg", 800, 2),
	(2, 'Fügés csatni', 'Csatni, mégpedig fügés', 'csatni,fügés', "assets/uploads/th_gallery02.jpg", "assets/uploads/gallery02.jpg", 1100, 3),
	(3, 'Málnás lekvár', 'Igazi lekvár, málnás', 'lekvár,málnás', "assets/uploads/th_gallery01.jpg", "assets/uploads/gallery01.jpg", 900, 1),
	(3, 'Epres lekvár', 'Igazi lekvár, epres', 'lekvár,epres', "assets/uploads/th_gallery04.jpg", "assets/uploads/gallery04.jpg", 900, 2),
	(3, 'Fügés lekvár', 'Igazi lekvár, fügés', 'lekvár,fügés', "assets/uploads/th_gallery02.jpg", "assets/uploads/gallery02.jpg", 1050, 3),
	(4, 'Kenyér', 'Még pedig kenyér a javából', 'kenyér', "assets/uploads/th_gallery04.jpg", "assets/uploads/gallery04.jpg", 550, 1),
	(5, 'Kabarné Szuvi Ilona', 'Cabernet a javából', 'bor', "assets/uploads/th_gallery02.jpg", "assets/uploads/gallery02.jpg", 2700, 1),
	(5, 'Kék Frank', 'Franker wien', 'bor', "assets/uploads/th_gallery01.jpg", "assets/uploads/gallery01.jpg", 2200, 2),
	(6, 'Málnás szörp', 'Szipidi-szörp, málnás', 'szörp,málnás', "assets/uploads/th_gallery01.jpg", "assets/uploads/gallery01.jpg", 1500, 1),
	(6, 'Epres szörp', 'Szipidi-szörp, epres', 'szörp,epres', "assets/uploads/th_gallery02.jpg", "assets/uploads/gallery02.jpg", 1420, 2),
	(6, 'Fügés szörp', 'Szipidi-szörp, fügés', 'szörp,fügés', "assets/uploads/th_gallery03.jpg", "assets/uploads/gallery03.jpg", 1680, 3),
	(7, 'Pál Inka', 'Inka pálesz', 'pálinka,inka', "assets/uploads/th_gallery03.jpg", "assets/uploads/gallery03.jpg", 3000, 1),
	(7, 'Pál Maya', 'Ez meg már maja, nem inka pálesz', 'pálinka,maja', "assets/uploads/th_gallery02.jpg", "assets/uploads/gallery02.jpg", 4500, 2),
	(8, '1001 lekvár recept', 'Innen aztán még kolbász lekvárt is megtanulsz főzni', 'könyv,recept,lekvár', "assets/uploads/th_gallery02.jpg", "assets/uploads/gallery02.jpg", 4000, 1),
	(8, '99 problems, but a lekvár aint one', 'Maga a Dzséjszi mester minden remek praktikája egy könyvben', 'könyv,recept,lekvár,swag', "assets/uploads/th_gallery03.jpg", "assets/uploads/gallery03.jpg", 4200, 2),
	(9, 'Díszes bornyitó', 'tl;dr kinyitja aZ bort, fafaragás', 'bornyitó', "assets/uploads/th_gallery01.jpg", "assets/uploads/gallery01.jpg", 780, 1),
	(9, 'Díszes sörnyító', 'tl;dr kinyitja aZ sört, fafaragás', 'sörnyitó', "assets/uploads/th_gallery02.jpg", "assets/uploads/gallery02.jpg", 780, 2),
	(10, 'Kőlevi hűtőmágnes', 'Rátapad, rá bizony', 'souvenir,mágnes', "assets/uploads/th_gallery01.jpg", "assets/uploads/gallery01.jpg", 850, 1);
	
	
	



<div class="bolt-grid-element">
					<a href="">
						<div class="bolt-grid-element-img">
							<img src="assets/uploads/th_gallery04.jpg" alt="">
						</div>
						<h4>Málnás Csatni</h4>
						<h5>1.400 Ft</h5>
					</a>
				</div>

CREATE TABLE IF NOT EXISTS `koleves_delicates_termekkepek` (
	ID  int(6) AUTO_INCREMENT NOT NULL,
	TERMEK_ID int(6) NOT NULL,
	KEP varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
	SORREND int(2) DEFAULT 1,
	PRIMARY KEY(ID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;






CREATE TABLE IF NOT EXISTS `koleves_delicates_hasonlotermekek` (
	ID int(6) NOT NULL,
	FOTERMEK_ID int(6) NOT NULL,
	HASONLOTERMEK
	FOKATEGORIA_ID int(2) NOT NULL,
	`TEXT_HU` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
	`TEXT_EN` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`LEIRAS_HU` varchar(1024) COLLATE utf8_hungarian_ci NOT NULL,
	`LEIRAS_EN` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`KISKEP` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`NAGYKEP` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
	`AR` int(6) DEFAULT NULL,
	SORREND int(3) DEFAULT 1,
	PRIMARY KEY(ID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;