-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Hoszt: localhost
-- Létrehozás ideje: 2015. júl. 26. 19:02
-- Szerver verzió: 5.5.37
-- PHP verzió: 5.4.4-14+deb7u9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Tábla szerkezet: `koleves_asztalfoglalasok`
--

CREATE TABLE IF NOT EXISTS `koleves_asztalfoglalasok` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `NEV` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `EMAIL` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `TELEFONSZAM` varchar(40) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `MEGJEGYZES` varchar(512) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `HANYFO` tinyint(2) DEFAULT NULL,
  `IDOPONT` datetime DEFAULT NULL,
  `JOVAHAGYVA` tinyint(1) DEFAULT '0',
  `JOVAHAGYTA` tinyint(6) DEFAULT NULL,
  `JOVAHAGYAS` datetime DEFAULT NULL,
  `ROGZITVE` datetime DEFAULT NULL,
  `VISIBLE` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=50 ;

--
-- A tábla adatainak kiíratása `koleves_asztalfoglalasok`
--

INSERT INTO `koleves_asztalfoglalasok` (`ID`, `NEV`, `EMAIL`, `TELEFONSZAM`, `MEGJEGYZES`, `HANYFO`, `IDOPONT`, `JOVAHAGYVA`, `JOVAHAGYTA`, `JOVAHAGYAS`, `ROGZITVE`, `VISIBLE`) VALUES
(1, 'aaaa', 'aaa@aaa.com', NULL, 'aaaaaa', 2, '2015-06-13 22:00:00', 0, NULL, NULL, NULL, 1),
(2, 'asd vasd', 'asd@asd.com', NULL, '', 2, '2015-06-10 21:30:00', 1, 1, NULL, NULL, 1),
(3, 'asd vasd', 'asd@asd.comv', NULL, '', 4, '2015-06-11 18:30:00', 0, NULL, NULL, NULL, 1),
(4, 'asd vasd', 'asd@asd.comv', NULL, '', 4, '2015-06-11 18:30:00', 0, NULL, NULL, NULL, 1),
(5, 'asd vasd', 'asd@asd.comv', NULL, 'most van kommentem is', 7, '2015-06-03 11:00:00', 0, NULL, NULL, NULL, 1),
(6, 'asd vasd', 'asd@asd.comv', NULL, 'most van kommentem is', 4, '2015-06-11 22:00:00', 0, NULL, NULL, NULL, 1),
(7, 'Kis Elemér ', 'kiselemer@gmail.com', NULL, 'tesztelem az asztalfoglalást', 1, '2015-06-16 18:30:00', 0, NULL, NULL, NULL, 1),
(8, 'Gipsz Jakab', 'gipszjakab@gmail.com', '0036204256326', 'tesztelem az asztalfoglalást', 4, '2015-06-18 18:00:00', 1, 1, NULL, NULL, 1),
(9, 'teszt Imre', 'gipszjakab@gmail.com', '+36204528978', 'tesztelem az asztalfoglalást', 4, '2015-06-18 21:00:00', 0, NULL, NULL, NULL, 1),
(10, 'teszt feri', 'tesztferi@gmail.com', '+36306528984', 'Szeretem az epret!', 7, '2015-06-26 20:00:00', 0, NULL, NULL, NULL, 1),
(11, 'teszt feri2', 'tesztferi@gmail.com', '+36306528984', 'Szeretem az epret!', 4, '2015-06-30 21:00:00', 0, NULL, NULL, NULL, 1),
(12, 'Koni Gergely', 'gergely.konradg@gmail.com', '+36 30 53 63 997', 'A megjegyzés is ki van töltve', 3, '2015-06-18 20:30:00', 0, NULL, NULL, NULL, 1),
(13, 'Uccsó Teszt', 'koni@gmail.com', '06305363997', 'teszt teszt the megjegyzés', 4, '2015-06-25 21:30:00', 0, NULL, NULL, NULL, 1),
(14, 'teszt jakab', 'tesztjakab@gmail.com', '+36305632323', 'szeretem az epret', 1, '2015-06-23 21:00:00', 0, NULL, NULL, NULL, 1),
(15, 'Dyssou Bona', 'bona.dyssou@gmail.com', '06209437666', '', 3, '2015-06-23 21:30:00', 0, NULL, NULL, NULL, 1),
(16, 'koni', 'konui@gamil.com', '06301234567', '', 3, '2020-08-24 22:00:00', 0, NULL, NULL, NULL, 1),
(17, 'Tóth Józsika', 'bona.dyssou@gmail.com', '06209437666', '', 1, '2015-09-08 21:00:00', 0, NULL, NULL, NULL, 1),
(18, 'Kápolnai Gábor', 'kapolnai.gabor@gmail.com', '06209807621', 'jó lenne, ha az a kiskutya nem enne bele a kajámba, mert multkor felugrott az asztalra és úgy nyalta ki a tányérom.', 6, '2015-07-17 23:30:00', 0, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_cikkek`
--

CREATE TABLE IF NOT EXISTS `koleves_cikkek` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `TEXT_HU` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `KISKEP` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `NAGYKEP` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `URL` varchar(256) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `SORREND` tinyint(3) DEFAULT NULL,
  `VISIBLE` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=8 ;

--
-- A tábla adatainak kiíratása `koleves_cikkek`
--

INSERT INTO `koleves_cikkek` (`ID`, `TEXT_HU`, `TEXT_EN`, `KISKEP`, `NAGYKEP`, `URL`, `SORREND`, `VISIBLE`) VALUES
(3, 'Cikk neveC', 'Article Name', 'assets/img/tmb-2.png', 'assets/uploads/kert.jpg', NULL, 3, 1),
(4, 'Cikk neveD', 'Article Name', 'assets/uploads/timesmag.jpg', 'assets/uploads/timesmag.jpg', 'http://index.hu/kultur/2015/05/24/fozelekes_feri/', 4, 1),
(5, 'Cikk neveE', 'Article Name', 'assets/img/tmb-2.png', 'assets/uploads/kert.jpg', NULL, 5, 1),
(7, 'UjCikk', NULL, 'assets/uploads/timesmag.jpg', 'assets/uploads/timesmag.jpg', 'http://google.com', NULL, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_delicates_alkategoriak`
--

CREATE TABLE IF NOT EXISTS `koleves_delicates_alkategoriak` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `FOKATEGORIA_ID` int(2) NOT NULL,
  `TEXT_HU` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(64) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `SORREND` int(3) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=11 ;

--
-- A tábla adatainak kiíratása `koleves_delicates_alkategoriak`
--

INSERT INTO `koleves_delicates_alkategoriak` (`ID`, `FOKATEGORIA_ID`, `TEXT_HU`, `TEXT_EN`, `SORREND`) VALUES
(1, 1, 'Pesztó', 'Pesto', 1),
(2, 1, 'Csathni', 'Chutney', 2),
(3, 1, 'Lekvár', 'Jams', 3),
(4, 1, 'Kenyér', 'Breads', 4),
(5, 2, 'Borok', 'Wines', 1),
(6, 2, 'Szörpök', 'Sirups', 2),
(7, 2, 'Pálinkák', 'Palinka', 3),
(8, 3, 'Könyvek', 'Books', 1),
(9, 3, 'Étkészlet', 'Utensils', 2),
(10, 3, 'Ajándéktárgyak', 'Souvenirs', 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_delicates_fokategoriak`
--

CREATE TABLE IF NOT EXISTS `koleves_delicates_fokategoriak` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `TEXT_HU` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(64) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `ICON` varchar(32) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `SORREND` int(2) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=4 ;

--
-- A tábla adatainak kiíratása `koleves_delicates_fokategoriak`
--

INSERT INTO `koleves_delicates_fokategoriak` (`ID`, `TEXT_HU`, `TEXT_EN`, `ICON`, `SORREND`) VALUES
(1, 'Ehető', 'Edibles', 'eheto', 1),
(2, 'Iható', 'Drinkables', 'ihato', 2),
(3, 'Nem ehető', 'Non-edibles', 'nemeheto', 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_delicates_megrendelesek`
--

CREATE TABLE IF NOT EXISTS `koleves_delicates_megrendelesek` (
  `ID` int(6) NOT NULL,
  `TAG` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
  `NEV` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `EMAIL` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `MEGJEGYZES` varchar(2048) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `VISIBLE` tinyint(2) DEFAULT '1',
  `JOVAHAGYVA` datetime DEFAULT NULL,
  `JOVAHAGYTA` int(6) DEFAULT NULL,
  `ROGZITVE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_delicates_megrendelesek`
--

INSERT INTO `koleves_delicates_megrendelesek` (`ID`, `TAG`, `NEV`, `EMAIL`, `MEGJEGYZES`, `VISIBLE`, `JOVAHAGYVA`, `JOVAHAGYTA`, `ROGZITVE`) VALUES
(1, '4f81c637ba40240b1376fc0dfa9a8ad9940b31c5cce46c55d6e9a4ab083f68fd', 'Almás Józsi', 'jozsi@almafarm.hu', 'Jövőhét keddig szeretném átvenni, köszi.', 0, NULL, NULL, '2015-05-17 11:18:55'),
(2, '3da2d4a10be34bfcdf4aaa5bd589833bf8efee0ee39631e0b0b0ce9035efc1ed', 'Almás Józsi', 'jozsi@almafarm.hu', 'Jövőhét keddig szeretném átvenni, köszi.', 1, NULL, NULL, '2015-06-17 14:14:25'),
(3, '0ba839bb755a771b4b02e5929977335faefde01fa77a9d1fdccf3ab679713d64', 'Barackos Levi', 'levi@barackfarm.hu', 'A szokásos csomag.', 1, NULL, NULL, '2015-06-22 15:14:25'),
(4, '83ee9d34e200c7caf8424328f5fa037c4c2019cc8ff730b910f551fbe6e896d7', 'Körtés Karesz', 'karesz@korteland.hu', '', 1, NULL, NULL, '2015-06-15 16:44:07');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_delicates_megrendelt_termekek`
--

CREATE TABLE IF NOT EXISTS `koleves_delicates_megrendelt_termekek` (
  `ID` int(6) NOT NULL,
  `MEGRENDELES_ID` int(6) DEFAULT NULL,
  `TERMEK_ID` int(6) DEFAULT NULL,
  `EGYSEG` int(5) NOT NULL,
  `EGYSEGAR` varchar(2048) COLLATE utf8_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `koleves_delicates_megrendelt_termekek`
--

INSERT INTO `koleves_delicates_megrendelt_termekek` (`ID`, `MEGRENDELES_ID`, `TERMEK_ID`, `EGYSEG`, `EGYSEGAR`) VALUES
(1, 1, 1, 10, '1400'),
(2, 1, 3, 15, '1700'),
(3, 2, 1, 5, '1400'),
(4, 2, 2, 2, '1500'),
(5, 2, 3, 22, '1700'),
(6, 3, 1, 22, '1450'),
(7, 4, 1, 30, '1400'),
(8, 4, 6, 2, '1000');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_delicates_slider`
--

CREATE TABLE IF NOT EXISTS `koleves_delicates_slider` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `TEXT_HU` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `LEIRAS_HU` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `LEIRAS_EN` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `TAG_HU` varchar(256) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `TAG_EN` varchar(256) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `KEP` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `AR` int(6) DEFAULT NULL,
  `SORREND` int(3) DEFAULT '1',
  `VISIBLE` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=8 ;

--
-- A tábla adatainak kiíratása `koleves_delicates_slider`
--

INSERT INTO `koleves_delicates_slider` (`ID`, `TEXT_HU`, `TEXT_EN`, `LEIRAS_HU`, `LEIRAS_EN`, `TAG_HU`, `TAG_EN`, `KEP`, `AR`, `SORREND`, `VISIBLE`) VALUES
(1, 'Házi Libazsír', 'Geesegrease', 'Kóstold meg isteni finom hazai libánkat.', 'Godlike flavor Geesegrease', NULL, NULL, 'assets/uploads/slider_03.jpg', 1400, 1, 1),
(2, 'Házi Libazsír, de egy másik libából.', 'Yet another Geesegrease', 'Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.', 'Godlike indeed this Geesegrease is', 'lila <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> lila ', 'purple <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">purple</a> purple', 'assets/uploads/slider_01.jpg', 1400, 2, 1),
(4, 'Házi Libazsír, de egy másik libából.', 'Yet another Geesegrease', 'Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.', 'Godlike indeed this Geesegrease is', 'lila <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> lila ', 'purple <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">purple</a> purple', 'assets/uploads/slider_03.jpg', 990, 4, 1),
(5, 'Házi Libazsír, de egy másik libából.', 'Yet another Geesegrease', 'Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.', 'Godlike indeed this Geesegrease is', 'lila <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> lila ', 'purple <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">purple</a> purple', 'assets/uploads/slider_04.jpg', 2000, 5, 1),
(6, 'Házi Libazsír, de egy másik libából.', 'Yet another Geesegrease', 'Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.', 'Godlike indeed this Geesegrease is', 'lila <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">lila</a> lila ', 'purple <a href="https://www.youtube.com/watch?v=-e0gcjgnxXw">purple</a> purple', 'assets/uploads/slider_01.jpg', 1600, 6, 1),
(7, 'Házi Libazsír, de egy másik libából.', 'Yet another Geesegrease', 'Kóstold meg isteni finom hazai libánkat. Kóstold meg isteni finom hazai libánkat.', 'Godlike indeed this Geesegrease is', NULL, NULL, 'assets/uploads/slider_02.jpg', 1500, 7, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_delicates_termekek`
--

CREATE TABLE IF NOT EXISTS `koleves_delicates_termekek` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `ALKATEGORIA_ID` int(3) NOT NULL,
  `TEXT_HU` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `LEIRAS_HU` varchar(1024) COLLATE utf8_hungarian_ci NOT NULL,
  `LEIRAS_EN` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `KISKEP` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `NAGYKEP` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `TAG_HU` varchar(512) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `TAG_EN` varchar(512) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `AR` int(6) DEFAULT NULL,
  `SORREND` int(3) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=23 ;

--
-- A tábla adatainak kiíratása `koleves_delicates_termekek`
--

INSERT INTO `koleves_delicates_termekek` (`ID`, `ALKATEGORIA_ID`, `TEXT_HU`, `TEXT_EN`, `LEIRAS_HU`, `LEIRAS_EN`, `KISKEP`, `NAGYKEP`, `TAG_HU`, `TAG_EN`, `AR`, `SORREND`) VALUES
(1, 1, 'Piszti Pesztó', NULL, 'Szuper pesztó Mauris in velit in leo pharetra accumsan.', NULL, 'assets/uploads/th_greenpesto_01.jpg', 'assets/uploads/gallery04.jpg', 'pesztó', NULL, 1400, 1),
(2, 1, 'Pasta Pesztó', NULL, 'Pasta de pesztó Mauris in velit in leo pharetra accumsan.', NULL, 'assets/uploads/th_greenpesto_02.jpg', 'assets/uploads/gallery01.jpg', 'pesztó', NULL, 1500, 2),
(3, 1, 'Rasta Pasta Pesztó', NULL, 'Rastafari delight Mauris in velit in leo pharetra accumsan.', NULL, 'assets/uploads/th_redpesto_01.jpg', 'assets/uploads/gallery02.jpg', 'pesztó,rasta', NULL, 1700, 3),
(4, 2, 'Málnás csatni', NULL, 'Csatni, mégpedig málnás Mauris in velit in leo pharetra accumsan.', NULL, 'assets/uploads/th_raspberry-jam-01.jpg', 'assets/uploads/gallery04.jpg', 'csatni,málnás', NULL, 800, 1),
(5, 2, 'Epres csatni', NULL, 'Csatni, mégpedig epres Mauris in velit in leo pharetra accumsan.', NULL, 'assets/uploads/th_strawberry-jam-01.jpg', 'assets/uploads/gallery03.jpg', 'csatni,epres', NULL, 800, 2),
(6, 2, 'Fügés csatni', NULL, 'Csatni, mégpedig fügés Mauris in velit in leo pharetra accumsan.', NULL, 'assets/uploads/th_fig-jam-01.jpg', 'assets/uploads/gallery02.jpg', 'csatni,fügés', NULL, 1100, 3),
(7, 3, 'Málnás lekvár', NULL, 'Igazi lekvár, málnás Mauris in velit in leo pharetra accumsan.', NULL, 'assets/uploads/th_raspberry-jam-01.jpg', 'assets/uploads/gallery01.jpg', 'lekvár,málnás', NULL, 900, 1),
(8, 3, 'Epres lekvár', NULL, 'Igazi lekvár, epres Mauris in velit in leo pharetra accumsan.', NULL, 'assets/uploads/th_strawberry-jam-01.jpg', 'assets/uploads/gallery04.jpg', 'lekvár,epres', NULL, 900, 2),
(9, 3, 'Fügés lekvár', NULL, 'Igazi lekvár, fügés Mauris in velit in leo pharetra accumsan.', NULL, 'assets/uploads/th_fig-jam-01.jpg', 'assets/uploads/gallery02.jpg', 'lekvár,fügés', NULL, 1050, 3),
(10, 4, 'Kenyér', NULL, 'Még pedig kenyér a javából Mauris in velit in leo pharetra accumsan.', NULL, 'assets/uploads/th_bread_01.jpg', 'assets/uploads/gallery04.jpg', 'kenyér', NULL, 550, 1),
(11, 5, 'Kabarné Szuvi Ilona', NULL, 'Cabernet a javából Morbi ullamcorper, metus nec pharetra tristique', NULL, 'assets/uploads/th_strawberry-jam-01.jpg', 'assets/uploads/gallery02.jpg', 'bor', NULL, 2700, 1),
(12, 5, 'Kék Frank', NULL, 'Franker wien Morbi ullamcorper, metus nec pharetra tristique', NULL, 'assets/uploads/th_strawberry-jam-01.jpg', 'assets/uploads/gallery01.jpg', 'bor', NULL, 2200, 2),
(13, 6, 'Málnás szörp', NULL, 'Szipidi-szörp, málnás Morbi ullamcorper, metus nec pharetra tristique', NULL, 'assets/uploads/th_raspberry-jam-01.jpg', 'assets/uploads/gallery01.jpg', 'szörp,málnás', NULL, 1500, 1),
(14, 6, 'Epres szörp', NULL, 'Szipidi-szörp, epres Morbi ullamcorper, metus nec pharetra tristique', NULL, 'assets/uploads/th_strawberry-jam-01.jpg', 'assets/uploads/gallery02.jpg', 'szörp,epres', NULL, 1420, 2),
(15, 6, 'Fügés szörp', NULL, 'Szipidi-szörp, fügés Morbi ullamcorper, metus nec pharetra tristique', NULL, 'assets/uploads/th_fig-jam-01.jpg', 'assets/uploads/gallery03.jpg', 'szörp,fügés', NULL, 1680, 3),
(16, 7, 'Pál Inka', NULL, 'Inka pálesz Morbi ullamcorper, metus nec pharetra tristique', NULL, 'assets/uploads/th_strawberry-jam-01.jpg', 'assets/uploads/gallery03.jpg', 'pálinka,inka', NULL, 3000, 1),
(17, 7, 'Pál Maya', NULL, 'Ez meg már maja, nem inka pálesz', NULL, 'assets/uploads/th_strawberry-jam-01.jpg', 'assets/uploads/gallery02.jpg', 'pálinka,maja', NULL, 4500, 2),
(18, 8, '1001 lekvár recept', NULL, 'Innen aztán még kolbász lekvárt is megtanulsz főzni', NULL, 'assets/uploads/th_book_01.jpg', 'assets/uploads/gallery02.jpg', 'könyv,recept,lekvár', NULL, 4000, 1),
(19, 8, '99 problems, but a lekvár aint one', NULL, 'Maga a Dzséjszi mester minden remek praktikája egy könyvben', NULL, 'assets/uploads/th_book_02.jpg', 'assets/uploads/gallery03.jpg', 'könyv,recept,lekvár,swag', NULL, 4200, 2),
(20, 9, 'Díszes bornyitó', NULL, 'tl;dr kinyitja aZ bort, fafaragás', NULL, 'assets/uploads/th_strawberry-jam-01.jpg', 'assets/uploads/gallery01.jpg', 'bornyitó', NULL, 780, 1),
(21, 9, 'Díszes sörnyító', NULL, 'tl;dr kinyitja aZ sört, fafaragás', NULL, 'assets/uploads/th_strawberry-jam-01.jpg', 'assets/uploads/gallery02.jpg', 'sörnyitó', NULL, 780, 2),
(22, 10, 'Kőlevi hűtőmágnes', NULL, 'Rátapad, rá bizony', NULL, 'assets/uploads/th_strawberry-jam-01.jpg', 'assets/uploads/gallery01.jpg', 'souvenir,mágnes', NULL, 850, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_delicates_termekkepek`
--

CREATE TABLE IF NOT EXISTS `koleves_delicates_termekkepek` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `TERMEK_ID` int(6) NOT NULL,
  `KEP` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `SORREND` int(2) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=86 ;

--
-- A tábla adatainak kiíratása `koleves_delicates_termekkepek`
--

INSERT INTO `koleves_delicates_termekkepek` (`ID`, `TERMEK_ID`, `KEP`, `SORREND`) VALUES
(1, 1, 'assets/uploads/greenpesto_01.jpg', 1),
(2, 1, 'assets/uploads/greenpesto_02.jpg', 2),
(3, 1, 'assets/uploads/greenpesto_03.jpg', 3),
(4, 2, 'assets/uploads/greenpesto_02.jpg', 1),
(5, 2, 'assets/uploads/greenpesto_01.jpg', 2),
(6, 2, 'assets/uploads/greenpesto_03.jpg', 3),
(7, 3, 'assets/uploads/redpesto_01.jpg', 1),
(8, 3, 'assets/uploads/redpesto_02.jpg', 2),
(9, 3, 'assets/uploads/redpesto_03.jpg', 3),
(10, 4, 'assets/uploads/raspberry-jam-01.jpg', 1),
(11, 4, 'assets/uploads/raspberry-jam-02.jpg', 2),
(12, 4, 'assets/uploads/raspberry-jam-03.jpg', 3),
(13, 4, 'assets/uploads/raspberry-jam-04.jpg', 4),
(14, 5, 'assets/uploads/strawberry-jam-01.jpg', 1),
(15, 5, 'assets/uploads/strawberry-jam-02.jpg', 2),
(16, 5, 'assets/uploads/strawberry-jam-03.jpg', 3),
(17, 5, 'assets/uploads/strawberry-jam-04.jpg', 4),
(18, 5, 'assets/uploads/strawberry-jam-05.jpg', 5),
(19, 6, 'assets/uploads/fig-jam-01.jpg', 1),
(20, 6, 'assets/uploads/fig-jam-02.jpg', 2),
(21, 6, 'assets/uploads/fig-jam-03.jpg', 3),
(22, 6, 'assets/uploads/fig-jam-04.jpg', 4),
(23, 6, 'assets/uploads/fig-jam-05.jpg', 5),
(24, 7, 'assets/uploads/raspberry-jam-01.jpg', 1),
(25, 7, 'assets/uploads/raspberry-jam-02.jpg', 2),
(26, 7, 'assets/uploads/raspberry-jam-03.jpg', 3),
(27, 7, 'assets/uploads/raspberry-jam-04.jpg', 4),
(28, 8, 'assets/uploads/strawberry-jam-01.jpg', 1),
(29, 8, 'assets/uploads/strawberry-jam-02.jpg', 2),
(30, 8, 'assets/uploads/strawberry-jam-03.jpg', 3),
(31, 8, 'assets/uploads/strawberry-jam-04.jpg', 4),
(32, 8, 'assets/uploads/strawberry-jam-05.jpg', 5),
(33, 9, 'assets/uploads/fig-jam-01.jpg', 1),
(34, 9, 'assets/uploads/fig-jam-02.jpg', 2),
(35, 9, 'assets/uploads/fig-jam-03.jpg', 3),
(36, 9, 'assets/uploads/fig-jam-04.jpg', 4),
(37, 9, 'assets/uploads/fig-jam-05.jpg', 5),
(38, 10, 'assets/uploads/bread_01.jpg', 1),
(39, 10, 'assets/uploads/bread_02.jpg', 2),
(40, 10, 'assets/uploads/bread_03.jpg', 3),
(41, 11, 'assets/uploads/strawberry-jam-01.jpg', 1),
(42, 11, 'assets/uploads/strawberry-jam-02.jpg', 2),
(43, 11, 'assets/uploads/strawberry-jam-03.jpg', 3),
(44, 11, 'assets/uploads/strawberry-jam-04.jpg', 4),
(45, 11, 'assets/uploads/strawberry-jam-05.jpg', 5),
(46, 12, 'assets/uploads/strawberry-jam-01.jpg', 1),
(47, 12, 'assets/uploads/strawberry-jam-02.jpg', 2),
(48, 12, 'assets/uploads/strawberry-jam-03.jpg', 3),
(49, 12, 'assets/uploads/strawberry-jam-04.jpg', 4),
(50, 12, 'assets/uploads/strawberry-jam-05.jpg', 5),
(51, 13, 'assets/uploads/fig-jam-01.jpg', 1),
(52, 13, 'assets/uploads/fig-jam-02.jpg', 2),
(53, 13, 'assets/uploads/fig-jam-03.jpg', 3),
(54, 13, 'assets/uploads/fig-jam-04.jpg', 4),
(55, 13, 'assets/uploads/fig-jam-05.jpg', 5),
(56, 14, 'assets/uploads/raspberry-jam-01.jpg', 1),
(57, 14, 'assets/uploads/raspberry-jam-02.jpg', 2),
(58, 14, 'assets/uploads/raspberry-jam-03.jpg', 3),
(59, 14, 'assets/uploads/raspberry-jam-04.jpg', 4),
(60, 15, 'assets/uploads/strawberry-jam-01.jpg', 1),
(61, 15, 'assets/uploads/strawberry-jam-02.jpg', 2),
(62, 15, 'assets/uploads/strawberry-jam-03.jpg', 3),
(63, 15, 'assets/uploads/strawberry-jam-04.jpg', 4),
(64, 15, 'assets/uploads/strawberry-jam-05.jpg', 5),
(65, 16, 'assets/uploads/strawberry-jam-01.jpg', 1),
(66, 16, 'assets/uploads/strawberry-jam-02.jpg', 2),
(67, 16, 'assets/uploads/strawberry-jam-03.jpg', 3),
(68, 16, 'assets/uploads/strawberry-jam-04.jpg', 4),
(69, 16, 'assets/uploads/strawberry-jam-05.jpg', 5),
(70, 17, 'assets/uploads/strawberry-jam-01.jpg', 1),
(71, 17, 'assets/uploads/strawberry-jam-02.jpg', 2),
(72, 17, 'assets/uploads/strawberry-jam-03.jpg', 3),
(73, 17, 'assets/uploads/strawberry-jam-04.jpg', 4),
(74, 17, 'assets/uploads/strawberry-jam-05.jpg', 5),
(75, 18, 'assets/uploads/book_01.jpg', 1),
(76, 18, 'assets/uploads/book_02.jpg', 2),
(77, 18, 'assets/uploads/book_03.jpg', 3),
(78, 18, 'assets/uploads/book_04.jpg', 4),
(79, 19, 'assets/uploads/book_03.jpg', 1),
(80, 19, 'assets/uploads/book_02.jpg', 2),
(81, 19, 'assets/uploads/book_01.jpg', 3),
(82, 19, 'assets/uploads/book_04.jpg', 4),
(83, 20, 'assets/uploads/strawberry-jam-01.jpg', 1),
(84, 21, 'assets/uploads/strawberry-jam-01.jpg', 1),
(85, 22, 'assets/uploads/strawberry-jam-01.jpg', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_dolgozok`
--

CREATE TABLE IF NOT EXISTS `koleves_dolgozok` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
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
  `ALLAPOT` int(1) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=7 ;

--
-- A tábla adatainak kiíratása `koleves_dolgozok`
--

INSERT INTO `koleves_dolgozok` (`ID`, `USERNAME`, `NEV`, `MEGJEGYZES`, `SZULETES`, `NEME`, `KEP`, `TELEFON`, `EMAIL`, `JELSZAV`, `FACEBOOK`, `JOGOSULTSAG_ID`, `RENDEZVENYFELELOS`, `VENDEGLO`, `ALLAPOT`) VALUES
(1, 'Janka', 'Vámos Janka', 'Nélküle más lenne a Kőleves, ha Ő ott van, mindig történik valami. Egy igazán szerethető, magát mindig vállaló, néha kicsit túlzóan is, de csodalény, az biztos.', NULL, 'f', 'assets/uploads/janka.jpg', '+36 70 6383 996', 'janka@kolevesvendeglo.hu', '242f21c3e786eb437c665e833666f35304623e0cc1112ed5f0f3644b5f76cff5', 'mjanka', 9, 0, 1, 1),
(2, 'teszt jakab', 'dr. teszt jakab andras', 'teszt jakab vagyok ez egy nagyon szep nev', NULL, 'f', 'assets/uploads/guy3.jpeg', '0036204223311', 'tesztjakab@gmail.com', '8ad3617c8eb6433b3ba081d6ada8c861c167609ecc6cb3ba6827fa73e5a46238', 'https://www.facebook.com/csilla.gyori.790', 1, 0, 1, 1),
(3, 'Gordon', 'gordon', 'Szeretem a mintás sálakat', NULL, 'f', 'assets/uploads/guy2.jpg', '+36205289663', 'tesztferi@gmail.com', '3cafe92aa46b1a85170c26dd2ef4c4de57446b5c801f7950fde628d8f7f0d10f', 'https://www.facebook.com/gonnok.vontilos?fref=ufi&pnref=story', 1, 0, 1, 1),
(4, 'Kápszi', 'Kápolnai Gábor Zebulon', 'Orra görbe, szája tátva, kiskifli az uzsonnája, piszka derék, egy-szál fehér szekér egér, egyszerű legényke.', NULL, 'f', 'assets/uploads/kapszi.jpg', '06209807621', 'kapolnai.gabor@gmail.com', '5a6b2cf568255e9f0872403564d41283ebe66a955e8fe9cda824dba29d0d5547', 'facebook.com/Kapszi', 9, 1, 1, 1),
(5, 'asztronauta laci', 'laszlo zsembes', 'szeba körülötttem forog az univerzum', NULL, 'f', 'assets/uploads/guy1.jpg', '062098564400', 'laci@gmail.com', '5b4ef2f5df8ebb209b89b70df6fd335d6fb2f45cb6d3febccbb7f5bc266cab3b', 'https://www.facebook.com/peter.batory', 1, 0, 1, 1),
(6, 'Mező', 'Mezősi László', 'Én vagyok az az ember, akihez órát lehet igazítani. 1/2 12-kor ott termek az ebédnél és valamilyen fejlámpával, vagy különös felszerelés segítségével, de eszem egy jót, mert a menü a Kőlevesben az jó! Egyébként engem kérnek, ha valami elromlik, le kell szedni, fel kell mászni, le kell honi, fel kell hozni és MEG KELL CSINÁLNI. Belém rúgnak, de tudom, hogy szeretnek.', NULL, 'f', 'assets/uploads/guy1.jpg', 'sajnos nem lehet', 'kolevesgondnok@gmail.com', 'a872f02ecaeb59d037ca24f18dce4aaa56d2002bcb85260c21b8551cc2603bca', 'facebook.com/Mezo', 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_etelek`
--

CREATE TABLE IF NOT EXISTS `koleves_etelek` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `ETTEREM_ID` tinyint(1) DEFAULT '1',
  `KATEGORIA_ID` int(2) DEFAULT NULL,
  `TEXT_HU` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `SORREND` int(2) DEFAULT '1',
  `TAGEK` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `AR` int(6) DEFAULT NULL,
  `VISIBLE` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=64 ;

--
-- A tábla adatainak kiíratása `koleves_etelek`
--

INSERT INTO `koleves_etelek` (`ID`, `ETTEREM_ID`, `KATEGORIA_ID`, `TEXT_HU`, `TEXT_EN`, `SORREND`, `TAGEK`, `AR`, `VISIBLE`) VALUES
(3, 1, 1, 'Palócgulyás borjúból', 'Palocgulyas with da beef', 3, '1,11', 1250, 1),
(4, 1, 2, 'Avokádósaláta, szárított paradicsom, mandarin, mandula, kéksajt', 'Macesz-ball soup', 1, '1,3,6', 1550, 1),
(5, 1, 2, 'Füstölt tokhal, tökmagolajos saláta', 'Broccolisoup with hot smokin eggs of delight', 2, '2,8', 1450, 1),
(6, 1, 2, 'Szarvasgerinc, vargányás polenta, barnamártás', 'Palocgulyas with da beef', 3, '8,12', 1890, 1),
(7, 1, 3, 'Körtés-tejszínes tagliatelle ginnel, gorgonzolával', 'Macesz-ball soup', 1, '7,8,10', 2150, 1),
(8, 1, 3, 'Muszaka adzuki babbal, fekete lencsével', 'Broccolisoup with hot smokin eggs of delight', 2, '2,4,5,10', 2050, 1),
(9, 1, 3, 'Grillezett brie sajt, sült alma, céklás vöröslencse saláta', 'Palocgulyas with da beef', 3, '1,3,6', 2350, 1),
(10, 1, 4, 'Maceszflódni', 'Macesz-ball soup', 1, '2,3,10', 950, 1),
(11, 1, 4, 'Pisztáciás tiramisu', 'Broccolisoup with hot smokin eggs of delight', 2, '5,6', 960, 1),
(12, 1, 4, 'New York sajttorta', 'Palocgulyas with da beef', 3, '5,6', 990, 1),
(13, 1, 1, 'Maceszgombócleves tesztelése', 'Maceszballsoup', 5, '1,3,6,10,13', 1890, 1),
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
(40, 2, 3, 'Roston sült csirkemell friss zöldséges salátával', 'Grilled Chicken Breast, Fresh Vegetable Salad', 11, '7,11', 1850, 1),
(41, 2, 3, 'Fűszeres sültkrumpli (házi paradicsomlekvár vagy újhagymás málnaecetes majonéz öntettel)', 'Spicy Chips with Sauce (Homemade Tomato Marmelade or Mayonnaise with Raspberry Vinegar)', 12, '1', 750, 1),
(47, 2, 1, 'teszt kert leves2', '', 2, '5,6', 3000, 1),
(50, 2, 2, 'Saláta tál', '', 3, '6,9,12', 250, 1),
(51, 2, 4, 'Gyümölcs', '', 1, '12,1', 890, 1),
(53, 1, 1, 'Almaleves', '', 7, '9', 1350, 1),
(55, 2, 4, 'Alma', '', 13, '1,12', 550, 1),
(56, 2, 3, 'Mátrai borzamas', '', 1, '3,5,7,9,10', 1900, 1),
(57, 2, 2, 'keksz saláta', '', 1, '', 3, 1),
(58, 2, 1, 'finomleves', '', 3, '1,2,4', 2000, 1),
(59, 2, 4, 'habostorta', '', 2, '2,10', 900, 1),
(60, 1, 3, 'Koni kedvence', '', 7, '6,9,12', 5600, 1),
(61, 1, 1, 'Mandarinleves újraszerkesztve', '', 2, '4', 12500, 1),
(62, 1, 4, 'SÜTI', '', 30, '5,12', 123456, 1),
(63, 1, 1, 'levidi leves', '', 6, '2,3,5', 3000, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_etelkategoriak`
--

CREATE TABLE IF NOT EXISTS `koleves_etelkategoriak` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `TEXT_HU` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `SORREND` int(2) DEFAULT '1',
  `IKON` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=5 ;

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
-- Tábla szerkezet: `koleves_hirsav`
--

CREATE TABLE IF NOT EXISTS `koleves_hirsav` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `TIPUS_ID` int(2) NOT NULL,
  `FK_ID` int(4) NOT NULL,
  `TEXT_HU` varchar(80) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `TEXT_EN` varchar(80) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `URL` varchar(250) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `ROGZITVE` datetime DEFAULT NULL,
  `SORREND` tinyint(2) DEFAULT '1',
  `ALLAPOT` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=17 ;

--
-- A tábla adatainak kiíratása `koleves_hirsav`
--

INSERT INTO `koleves_hirsav` (`ID`, `TIPUS_ID`, `FK_ID`, `TEXT_HU`, `TEXT_EN`, `URL`, `ROGZITVE`, `SORREND`, `ALLAPOT`) VALUES
(3, 2, 0, 'Kerti nyitóprogram', NULL, NULL, '2015-04-22 03:40:45', 1, 1),
(15, 2, 0, 'Judafest az egész utcában!', NULL, '', '2015-07-08 16:06:55', 1, 1),
(16, 4, 0, 'Tesztelés', NULL, '', '2015-07-21 15:52:34', 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_italkategoriak`
--

CREATE TABLE IF NOT EXISTS `koleves_italkategoriak` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `TEXT_HU` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `SORREND` int(2) DEFAULT '1',
  `IKON` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=6 ;

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
-- Tábla szerkezet: `koleves_italok`
--

CREATE TABLE IF NOT EXISTS `koleves_italok` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `ETTEREM_ID` tinyint(1) DEFAULT '1',
  `KATEGORIA_ID` int(2) DEFAULT NULL,
  `TEXT_HU` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `ALKATEGORIA` tinyint(1) DEFAULT '0',
  `SORREND` int(2) DEFAULT '1',
  `AR` int(6) DEFAULT NULL,
  `VISIBLE` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=81 ;

--
-- A tábla adatainak kiíratása `koleves_italok`
--

INSERT INTO `koleves_italok` (`ID`, `ETTEREM_ID`, `KATEGORIA_ID`, `TEXT_HU`, `TEXT_EN`, `ALKATEGORIA`, `SORREND`, `AR`, `VISIBLE`) VALUES
(1, 1, 1, 'Capuchino', 'Some drink name', 0, 1, 550, 1),
(2, 1, 1, 'Ír kávé', 'Some drink name', 0, 2, 570, 1),
(3, 1, 1, 'KÁVÉÉÉÉÉÉÉÉÉ', 'Some drink name', 0, 3, 5000, 1),
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
(15, 1, 2, 'BAMBI', 'Some drink name', 0, 40, 420, 1),
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
(37, 2, 1, 'Kert presszó', 'Some drink name', 0, 3, 470, 1),
(38, 2, 1, 'tea macsakafű', 'Some drink name', 0, 4, 420, 1),
(39, 2, 1, 'forró puncs', 'Some drink name', 0, 4, 520, 1),
(40, 2, 1, 'Egy sor szöveg', 'Some drink name', 0, 6, 420, 1),
(41, 2, 1, 'Egy sor szöveg', 'Some drink name', 0, 7, 420, 1),
(42, 2, 1, 'Egy sor szöveg', 'Some drink name', 0, 8, 520, 1),
(43, 2, 1, 'Egy sor szöveg', 'Some drink name', 0, 9, 420, 1),
(44, 2, 2, 'Papa féle szörp', 'Some drink name', 0, 2, 420, 1),
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
(71, 1, 1, 'Új és HOT!', '', 0, 10, 200, 1),
(72, 2, 1, 'asdasd', '', 0, 23, 250, 1),
(73, 1, 1, 'Új forró ital', '', 0, 1, 520, 1),
(74, 1, 2, 'Új üdítő', '', 0, 3, 420, 1),
(75, 1, 3, 'Új sör', '', 0, 3, 620, 1),
(76, 1, 4, 'Új bor', '', 0, 4, 630, 1),
(78, 1, 5, 'rövid ita', '', 0, 1, 120, 1),
(79, 2, 2, 'nagyi féle házi szörp', '', 0, 1, 900, 1),
(80, 2, 2, 'zöldcitromos üccsike', '', 0, 3, 700, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_jogosultsagok`
--

CREATE TABLE IF NOT EXISTS `koleves_jogosultsagok` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `MEGNEVEZES_HU` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `MEGNEVEZES_EN` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=10 ;

--
-- A tábla adatainak kiíratása `koleves_jogosultsagok`
--

INSERT INTO `koleves_jogosultsagok` (`ID`, `MEGNEVEZES_HU`, `MEGNEVEZES_EN`) VALUES
(1, 'Betekintő felhasználó', 'View User'),
(2, 'Általános felhasználó', 'General User'),
(9, 'Adminisztrátor', 'Admin');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_kepek`
--

CREATE TABLE IF NOT EXISTS `koleves_kepek` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `FAJLNEV` varchar(155) COLLATE utf8_hungarian_ci NOT NULL,
  `LEIRAS_HU` varchar(256) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `GALLERY_TAG` tinyint(1) DEFAULT NULL,
  `SZEKCIO` varchar(20) COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=96 ;

--
-- A tábla adatainak kiíratása `koleves_kepek`
--

INSERT INTO `koleves_kepek` (`ID`, `FAJLNEV`, `LEIRAS_HU`, `GALLERY_TAG`, `SZEKCIO`) VALUES
(1, 'assets/uploads/renezvenyek_slide.jpg', NULL, 1, '2'),
(4, 'assets/uploads/gallery01.jpg', NULL, 1, '2'),
(5, 'assets/uploads/gallery02.jpg', NULL, 1, '2'),
(6, 'assets/uploads/gallery03.jpg', NULL, NULL, '1'),
(7, 'assets/uploads/gallery04.jpg', NULL, NULL, '1'),
(8, 'assets/uploads/about-img.png', NULL, NULL, '8'),
(9, 'assets/uploads/cat-tracks.jpg', NULL, NULL, '1'),
(10, 'assets/uploads/gslide-1.jpg', NULL, NULL, '4'),
(11, 'assets/uploads/gslide-2.jpg', NULL, NULL, '4'),
(12, 'assets/uploads/gslide-3.jpg', NULL, NULL, '4'),
(13, 'assets/uploads/gslide-4.jpg', NULL, NULL, '4'),
(14, 'assets/uploads/gslide-1.jpg', NULL, NULL, '4'),
(15, 'assets/uploads/gslide-2.jpg', NULL, NULL, '4'),
(16, 'assets/uploads/gslide-3.jpg', NULL, NULL, '2'),
(17, 'assets/uploads/gslide-4.jpg', NULL, NULL, '4'),
(18, 'assets/uploads/6771046-architecture-wallpaper.jpg', NULL, NULL, '5'),
(19, 'assets/uploads/timesmag.jpg', NULL, NULL, '6'),
(20, 'assets/uploads/strawberry-jam-01.jpg', NULL, NULL, '9'),
(21, 'assets/uploads/strawberry-jam-02.jpg', NULL, NULL, '9'),
(22, 'assets/uploads/strawberry-jam-03.jpg', NULL, NULL, '9'),
(23, 'assets/uploads/strawberry-jam-04.jpg', NULL, NULL, '9'),
(24, 'assets/uploads/strawberry-jam-05.jpg', NULL, NULL, '9'),
(25, 'assets/uploads/fig-jam-01.jpg', NULL, NULL, '9'),
(26, 'assets/uploads/fig-jam-02.jpg', NULL, NULL, '9'),
(27, 'assets/uploads/fig-jam-03.jpg', NULL, NULL, '9'),
(28, 'assets/uploads/fig-jam-04.jpg', NULL, NULL, '9'),
(29, 'assets/uploads/fig-jam-05.jpg', NULL, NULL, '9'),
(30, 'assets/uploads/raspberry-jam-01.jpg', NULL, NULL, '9'),
(31, 'assets/uploads/raspberry-jam-02.jpg', NULL, NULL, '9'),
(32, 'assets/uploads/raspberry-jam-03.jpg', NULL, NULL, '9'),
(33, 'assets/uploads/raspberry-jam-04.jpg', NULL, NULL, '9'),
(34, 'assets/uploads/book_01.jpg', NULL, NULL, '9'),
(35, 'assets/uploads/book_02.jpg', NULL, NULL, '9'),
(36, 'assets/uploads/book_03.jpg', NULL, NULL, '9'),
(37, 'assets/uploads/book_04.jpg', NULL, NULL, '9'),
(38, 'assets/uploads/bread_01.jpg', NULL, NULL, '9'),
(39, 'assets/uploads/bread_02.jpg', NULL, NULL, '9'),
(40, 'assets/uploads/bread_03.jpg', NULL, NULL, '9'),
(41, 'assets/uploads/greenpesto_01.jpg', NULL, NULL, '9'),
(42, 'assets/uploads/greenpesto_02.jpg', NULL, NULL, '9'),
(43, 'assets/uploads/greenpesto_03.jpg', NULL, NULL, '9'),
(44, 'assets/uploads/redpesto_01.jpg', NULL, NULL, '9'),
(45, 'assets/uploads/redpesto_02.jpg', NULL, NULL, '9'),
(46, 'assets/uploads/redpesto_03.jpg', NULL, NULL, '9'),
(47, 'assets/uploads/slider_01.jpg', NULL, NULL, '7'),
(48, 'assets/uploads/slider_02.jpg', NULL, NULL, '7'),
(49, 'assets/uploads/slider_03.jpg', NULL, NULL, '7'),
(50, 'assets/uploads/slider_04.jpg', NULL, NULL, '2'),
(51, 'assets/uploads/837f7194f03dcbbc28278e602dc01b08.jpg', NULL, 1, '6'),
(52, 'assets/uploads/logo_chameleonsport.png', NULL, 1, '5'),
(53, 'assets/uploads/Stickman.jpg', NULL, NULL, '8'),
(54, 'assets/uploads/1392642_10201850149231026_1424827801_n.jpg', NULL, 1, '8'),
(55, 'assets/uploads/1374766_178355269025466_673799831_n.jpg', NULL, 0, '0'),
(56, 'assets/uploads/mango-chutney.jpg', NULL, 0, '4'),
(57, 'assets/uploads/33699013-idea-bulb-icon.jpg', NULL, 1, '6'),
(58, 'assets/uploads/url7.jpg', NULL, NULL, NULL),
(59, 'assets/uploads/images (1).jpg', NULL, 1, '2'),
(60, 'assets/uploads/cipos_pomeraniai.jpg', NULL, 1, '2'),
(61, 'assets/uploads/BAYER_thumb@2x.jpg', NULL, 0, '2'),
(62, 'assets/uploads/KAff.jpg', NULL, 0, '2'),
(63, 'assets/uploads/gardenpartyatnight.jpg', NULL, 2, '2'),
(64, 'assets/uploads/party_landing_template8_garden.jpg', NULL, 2, '2'),
(65, 'assets/uploads/gp2.jpg', NULL, 2, '2'),
(66, 'assets/uploads/girl1.jpg', NULL, 0, '8'),
(67, 'assets/uploads/girl2.jpg', NULL, NULL, '8'),
(68, 'assets/uploads/girl3.jpg', NULL, NULL, '8'),
(69, 'assets/uploads/guy2.jpg', NULL, NULL, '8'),
(70, 'assets/uploads/guy3.jpeg', NULL, NULL, '8'),
(71, 'assets/uploads/guy1.jpg', NULL, NULL, '8'),
(72, 'assets/uploads/10423707_10152783371093230_9192893403200174205_n.jpg', NULL, NULL, NULL),
(73, 'assets/uploads/kapszi.jpg', NULL, NULL, '8'),
(74, 'assets/uploads/janka.jpg', NULL, 1, '8'),
(75, 'assets/uploads/nari3.jpg', NULL, 4, '4'),
(76, 'assets/uploads/zold 2.jpg', NULL, 4, '4'),
(77, 'assets/uploads/zold 3.jpg', NULL, 4, '4'),
(78, 'assets/uploads/zold 4.jpg', NULL, 4, '4'),
(79, 'assets/uploads/kek alaprajz.jpg', NULL, 4, '4'),
(80, 'assets/uploads/zold1.jpg', NULL, 4, '4'),
(81, 'assets/uploads/kek1.jpg', NULL, 4, '4'),
(82, 'assets/uploads/kek2.jpg', NULL, 4, '4'),
(83, 'assets/uploads/kek3.jpg', NULL, 4, '4'),
(84, 'assets/uploads/narai2.jpg', NULL, 4, '4'),
(85, 'assets/uploads/narancs alaprajz.jpg', NULL, 4, '4'),
(86, 'assets/uploads/narancsa 1.jpg', NULL, 4, '4'),
(87, 'assets/uploads/zold alaprajz.jpg', NULL, 4, '4'),
(88, 'assets/uploads/zold2.jpg', NULL, 4, '4'),
(89, 'assets/uploads/zold4.jpg', NULL, 4, '4'),
(90, 'assets/uploads/zoldalaprajz.jpg', NULL, 4, '4'),
(91, 'assets/uploads/logo.jpg', NULL, 1, '2'),
(92, 'assets/uploads/party3.jpg', NULL, 1, '2'),
(93, 'assets/uploads/barkas-001.jpg', NULL, NULL, '2'),
(94, 'assets/uploads/calendar-design12.jpg', NULL, NULL, '2'),
(95, 'assets/uploads/barkas1.jpg', NULL, NULL, '2');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_keptipusok`
--

CREATE TABLE IF NOT EXISTS `koleves_keptipusok` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `MEGNEVEZES` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `SZEKCIO` varchar(50) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `ALLAPOT` int(1) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=10 ;

--
-- A tábla adatainak kiíratása `koleves_keptipusok`
--

INSERT INTO `koleves_keptipusok` (`ID`, `MEGNEVEZES`, `SZEKCIO`, `ALLAPOT`) VALUES
(1, 'Rendezvény', 'rendezvenyek', 1),
(2, 'Program', 'programok', 2),
(3, 'Hir', 'hirek', 3),
(4, 'Szoba', 'szoba', 4),
(5, 'Partner', 'partner', 5),
(6, 'Cikk', 'cikk', 6),
(7, 'Slide', 'slide', 7),
(8, 'Dolgozók', 'dolgozok', 8),
(9, 'Termékek', 'termekek', 9);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_kep_osszekotesek`
--

CREATE TABLE IF NOT EXISTS `koleves_kep_osszekotesek` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `TIPUS` int(2) NOT NULL,
  `FK_ID` int(5) NOT NULL,
  `KEP_ID` int(6) NOT NULL,
  `SORREND` int(3) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=59 ;

--
-- A tábla adatainak kiíratása `koleves_kep_osszekotesek`
--

INSERT INTO `koleves_kep_osszekotesek` (`ID`, `TIPUS`, `FK_ID`, `KEP_ID`, `SORREND`) VALUES
(18, 4, 1, 14, 5),
(19, 4, 1, 15, 6),
(20, 4, 1, 16, 7),
(21, 4, 1, 17, 8),
(22, 1, 0, 51, 1),
(23, 1, 0, 5, 1),
(24, 4, 0, 12, 1),
(25, 1, 0, 6, 1),
(27, 1, 5, 6, 1),
(29, 4, 1, 61, 1),
(30, 4, 1, 56, 1),
(31, 4, 0, 62, 1),
(32, 1, 6, 6, 1),
(35, 4, 2, 62, 1),
(36, 4, 1, 62, 1),
(37, 4, 1, 79, 1),
(39, 4, 1, 79, 1),
(40, 4, 1, 81, 1),
(41, 4, 1, 82, 1),
(42, 4, 0, 85, 1),
(43, 4, 0, 75, 1),
(45, 4, 0, 76, 1),
(47, 4, 0, 90, 1),
(48, 4, 0, 87, 1),
(49, 4, 2, 75, 1),
(50, 4, 2, 84, 1),
(52, 1, 0, 6, 1),
(53, 1, 0, 6, 1),
(54, 1, 8, 6, 1),
(55, 1, 8, 9, 1),
(56, 1, 8, 7, 1),
(57, 4, 2, 13, 1),
(58, 4, 2, 85, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_napimenuk`
--

CREATE TABLE IF NOT EXISTS `koleves_napimenuk` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `IDOSZAK_ID` int(6) DEFAULT NULL,
  `NAPAZON` int(1) DEFAULT NULL,
  `FOGASAZON` int(1) DEFAULT NULL,
  `TEXT_HU` varchar(150) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(150) COLLATE utf8_hungarian_ci NOT NULL,
  `TAGEK` varchar(15) COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=120 ;

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
(60, 8, 1, 1, 'Something', '', ''),
(61, 9, 1, 1, 'Teszt Napi Menu 111', '', 'teszt1, teszt22'),
(62, 9, 1, 2, 'Teszt Napi Menu 1', '', 'teszt1, teszt2'),
(63, 9, 1, 3, 'Teszt Napi Menu 1', '', 'teszt1, teszt2'),
(64, 9, 2, 1, 'Teszt Napi Menu 2', '', 'teszt1, teszt2'),
(65, 9, 2, 2, 'Teszt Napi Menu 2', '', 'teszt1, teszt2'),
(66, 9, 2, 3, 'Teszt Napi Menu 2', '', 'teszt1, teszt2'),
(67, 9, 3, 1, 'Teszt Napi Menu 3', '', 'teszt1, teszt2'),
(68, 9, 3, 2, 'Teszt Napi Menu 3', '', 'teszt1, teszt2'),
(69, 9, 3, 3, 'Teszt Napi Menu 3', '', 'teszt1, teszt2'),
(70, 9, 4, 1, 'Teszt Napi Menu 4', '', 'teszt1, teszt2'),
(71, 9, 4, 2, 'Teszt Napi Menu 4', '', 'teszt1, teszt2'),
(72, 9, 4, 3, 'Teszt Napi Menu 4', '', 'teszt1, teszt2'),
(73, 9, 5, 1, 'Teszt Napi Menu 5', '', 'teszt1, teszt2'),
(74, 9, 5, 2, 'Teszt Napi Menu 5', '', 'teszt1, teszt2'),
(75, 9, 5, 3, 'Teszt Napi Menu 5', '', 'teszt1, teszt2'),
(76, 10, 1, 1, 'Pikáns gazpacho', '', 'GM TM'),
(77, 10, 1, 2, 'Francia csirkemell krumplipürével', '', 'GM'),
(78, 10, 1, 3, 'Wokban pirított zöldséges rizs', '', 'TM'),
(79, 10, 2, 1, 'Fahéjas almaleves', '', 'GM'),
(80, 10, 2, 2, 'Gombás-sonkás csirkeragu krumplifánkkal', '', ''),
(81, 10, 2, 3, 'Kapros cukkinifasirt friss salátával', '', ''),
(82, 10, 3, 1, 'Húsleves maceszgombóccal / Mandulás brokkolileves', '', 'TM / GM'),
(83, 10, 3, 2, 'Cézár saláta csirkével', '', 'GM'),
(84, 10, 3, 3, 'Cézár saláta zöldségekkel és kaprigyümölccsel', '', ''),
(85, 10, 4, 1, 'Hideg mentás zöldborsó krémleves', '', 'GM'),
(86, 10, 4, 2, 'Lecsós pecsenye kacsamáj törtkrumplival', '', 'GM TM'),
(87, 10, 4, 3, 'Szezámmagos sült zöldségek gratin krumplival', '', 'GM'),
(88, 10, 5, 1, 'Sajtbundában sült csirkemell rizi-bizivel', '', ''),
(89, 10, 5, 2, 'Rántott gombafejek rizi-bizivel és tartárral', '', ''),
(90, 10, 5, 3, 'Rizsfelfújt málnaöntettel', '', ''),
(91, 11, 1, 1, 'Hideg mentás cukkinikrémleves mandulával', '', '4,6,8,9'),
(92, 11, 1, 2, 'Lecsós csirkemell steak krumplival', '', ''),
(93, 11, 1, 3, 'Lilakáposzta fasirt mentás padlizsánsalátával', '', ''),
(94, 11, 2, 1, 'Húsleves daragaluskával / Currys karfiolleves', '', 'TM / GM'),
(95, 11, 2, 2, 'Csirkés fusilli bazsalikommal és sült koktélparadicsommal', '', ''),
(96, 11, 2, 3, 'Fusilli sült koktélparadicsommal, olivabogyóval és füstölt sajttal', '', ''),
(97, 11, 3, 1, 'Hideg bazsalikomos paradicsomleves', '', ''),
(98, 11, 3, 2, 'Sült csirkecomb kolbászos gombaraguval és galuskával', '', ''),
(99, 11, 3, 3, 'Gombapaprikás galuskával', '', ''),
(100, 11, 4, 1, 'Erdei gyümölcsleves', '', 'GM'),
(101, 11, 4, 2, 'Gyros tál pitával', '', ''),
(102, 11, 4, 3, 'Falafelgolyók paradicsomlekvárral és kevert salátával', '', 'TM'),
(103, 11, 5, 1, 'Sárgabarackleves', '', ''),
(104, 11, 5, 2, 'Füstölt sajtos bundában sült csirkemell krumplipürével', '', ''),
(105, 12, 1, 1, 'Finomság 1', '', ''),
(106, 12, 1, 2, 'Finomság 2', '', ''),
(107, 12, 1, 3, 'Finomság 3', '', ''),
(108, 12, 2, 1, 'Finomság 4', '', ''),
(109, 12, 2, 2, 'Finomság 5', '', ''),
(110, 12, 2, 3, 'Finomság 6', '', ''),
(111, 12, 3, 1, 'Finomság 7', '', ''),
(112, 12, 3, 2, 'Finomság  8', '', ''),
(113, 12, 3, 3, 'Finomság 9', '', ''),
(114, 12, 4, 1, 'Finomság 10', '', ''),
(115, 12, 4, 2, 'Finomság 11', '', ''),
(116, 12, 4, 3, 'Finomság 12', '', ''),
(117, 12, 5, 1, 'Finomság 13', '', ''),
(118, 12, 5, 2, 'Finomság 14', '', ''),
(119, 12, 5, 3, 'Finomság 15', '', '');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_napimenu_idoszakok`
--

CREATE TABLE IF NOT EXISTS `koleves_napimenu_idoszakok` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `EV` int(4) DEFAULT NULL,
  `HET` int(2) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=13 ;

--
-- A tábla adatainak kiíratása `koleves_napimenu_idoszakok`
--

INSERT INTO `koleves_napimenu_idoszakok` (`ID`, `EV`, `HET`) VALUES
(1, 2015, 15),
(2, 2015, 16),
(5, 2015, 17),
(6, 2015, 18),
(7, 2015, 21),
(8, 2015, 22),
(9, 2015, 25),
(10, 2015, 28),
(11, 2015, 30),
(12, 2015, 31);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_partnerek`
--

CREATE TABLE IF NOT EXISTS `koleves_partnerek` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `TEXT_HU` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `LEIRAS_HU` varchar(1024) COLLATE utf8_hungarian_ci NOT NULL,
  `LEIRAS_EN` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `KEP` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `URL` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `VISIBLE` tinyint(1) NOT NULL DEFAULT '1',
  `SORREND` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `ROGZITVE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=7 ;

--
-- A tábla adatainak kiíratása `koleves_partnerek`
--

INSERT INTO `koleves_partnerek` (`ID`, `TEXT_HU`, `TEXT_EN`, `LEIRAS_HU`, `LEIRAS_EN`, `KEP`, `URL`, `VISIBLE`, `SORREND`, `ROGZITVE`) VALUES
(1, 'Jackfall bormanufaktúra', NULL, 'A Jackfall Kisjakabfalván működik pár kilóméterre Villánytól', NULL, 'assets/uploads/logo_chameleonsport.png', 'http://jackfall.com', 1, 1, NULL),
(2, 'A partner neve', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores similique facilis non quia aliquam perspiciatis, eum consectetur quisquam quo! Optio totam ad quibusdam repellat cupiditate consequuntur, amet est, quidem perferendis. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores similique facilis non quia aliquam perspiciatis, eum consectetur quisquam quo! Optio totam ad quibusdam repellat cupiditate consequuntur, amet est, quidem perferendis.', NULL, 'assets/img/tmb-2.png', 'http://rcko.fm', 1, 2, NULL),
(3, 'Google Inc', NULL, 'gogogogogooggo', NULL, 'assets/uploads/6771046-architecture-wallpaper.jpg', 'http://google.com', 1, 1, NULL),
(4, 'fasdsad', NULL, 'asdasd', NULL, 'assets/uploads/6771046-architecture-wallpaper.jpg', 'asdasd', 1, 1, NULL),
(5, 'Chameleon', NULL, 'sport', NULL, 'assets/uploads/logo_chameleonsport.png', 'http://port.hu/balaton/pls/w/geogroup_event.index2', 1, 1, NULL),
(6, 'Teszt húsbeszállító Kft', NULL, 'Tőle hozzuk a húst', NULL, 'assets/uploads/images (1).jpg', 'https://www.facebook.com/huswebaruhaz', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_programok`
--

CREATE TABLE IF NOT EXISTS `koleves_programok` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `DATUM` date DEFAULT NULL,
  `TEXT_HU` varchar(75) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(75) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `LEIRAS_HU` varchar(1024) COLLATE utf8_hungarian_ci NOT NULL,
  `LEIRAS_EN` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `KEP` varchar(155) COLLATE utf8_hungarian_ci NOT NULL,
  `FBLINK` varchar(155) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `SORREND` int(5) DEFAULT '1',
  `ALLAPOT` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=10 ;

--
-- A tábla adatainak kiíratása `koleves_programok`
--

INSERT INTO `koleves_programok` (`ID`, `DATUM`, `TEXT_HU`, `TEXT_EN`, `LEIRAS_HU`, `LEIRAS_EN`, `KEP`, `FBLINK`, `SORREND`, `ALLAPOT`) VALUES
(1, '2015-03-31', 'Kőleves Kert nyárbúcsuztató napok', 'Kőleves summer closing days', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'assets/img/gslide-1.png', NULL, 1, 1),
(2, '2015-04-17', 'programnevea', 'nameofprogram', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', '', NULL, 1, 1),
(4, '2015-04-28', 'teszt progi', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'assets/uploads/gallery02.jpg', NULL, 1, 1),
(6, '2015-06-25', 'Letsdothis', NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus dignissimos eveniet labore, atque fuga sequi adipisci. Rerum pariatur quisquam a cupiditate quis nihil ipsam similique earum magni numquam consectetur, vitae!<br/>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, quidem.<br/>Lorem ipsum dolor sit amet.', 'assets/uploads/gallery02.jpg', NULL, 1, 1),
(8, '2015-06-30', 'teszt program', NULL, 'A bemelegítő gyakorlatok biztosításáról két kivételes zenekar fog gondoskodni. ', NULL, 'assets/uploads/gallery02.jpg', '', 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_rendezvenyek`
--

CREATE TABLE IF NOT EXISTS `koleves_rendezvenyek` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `TEXT_HU` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `LEIRAS_HU` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `TEXT_EN` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `LEIRAS_EN` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `SORREND` int(2) NOT NULL DEFAULT '1',
  `ALLAPOT` int(1) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=9 ;

--
-- A tábla adatainak kiíratása `koleves_rendezvenyek`
--

INSERT INTO `koleves_rendezvenyek` (`ID`, `TEXT_HU`, `LEIRAS_HU`, `TEXT_EN`, `LEIRAS_EN`, `SORREND`, `ALLAPOT`) VALUES
(5, 'Teszt rendezvény', 'Teszt rendezvény lesz!', NULL, NULL, 1, 1),
(6, 'Judafest 2.', 'Utcai árusok, mulatság a Kazinczyban', NULL, NULL, 1, 1),
(8, 'Vidák Zsolt kiállítás', 'Vidák Zsolt 2008-ban diplomázott Budapesten a Moholy-Nagy Művészeti Egyetemen legjobb diploma díjjal. \n\nSzámos önálló és csoportos kiállítása volt Magyarországon, Hollandiában és a Dél-Afrikai Köztársaságban. 2014-ben Budapesten a Karton galériában, majd 2015-ben Oslóban rendezett önálló kiállítást.\n\nIllusztrációi és képregényei spanyol, brazil, amerikai, német, lett, lengyel, horvát, szerb, román magazinokban, kiadványokban jelentek meg.\n\nSzívesen dolgozik együtt underground magazinokkal, mint például Komi', NULL, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_statikus`
--

CREATE TABLE IF NOT EXISTS `koleves_statikus` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `LABEL` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_HU` varchar(2048) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `TEXT_EN` varchar(2048) COLLATE utf8_hungarian_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=20 ;

--
-- A tábla adatainak kiíratása `koleves_statikus`
--

INSERT INTO `koleves_statikus` (`ID`, `LABEL`, `TEXT_HU`, `TEXT_EN`) VALUES
(1, 'CETLI1_1', 'Még mindig kell egy cetli.', 'Chickenpaprika stew with'),
(2, 'CETLI1_2', NULL, 'noodles and homemade cabbagesalad'),
(3, 'CETLI1_3', NULL, '1950'),
(4, 'DEARGUESTS', 'Kedves Vendégeink!', 'Dear Guests!'),
(5, 'NAPIMENU_TEXT', 'Vegetáriánus és húsos menünk van hétköznaponként 1.000 Ft és 1.250 Ft-os áron, ami mellé szörpöt is adunk. Siessetek, mert ½ 12-től van ebéd és 60-70 adagot készítünk, ezért van, hogy ½ 1-re elfogy.', 'We''ll be adding some further information here.'),
(6, 'NAPIMENU_LEGEND', 'GM = gluténmentes TM = tejtermék mentes V = vegetáriánus', 'GM = gluten-free TM = lactose-free V = vegetarian'),
(7, 'FOGLALAS_LEIRAS', '<p>Ezen a helyen csak a Kőleves Vendéglőbe tudsz asztalt foglalni maximum 7 főre,ha többen jönnétek, kérlek telefonáljatok.</p><p>Ha jó idő van, akkor talán a teraszon is ülhetsz, ha ott szeretnél asztalt, kérlek írd meg a megjegyzésbe. Foglalásod csak akkor érvényes, ha visszaigazoljuk e-mailben vagy telefonon.</p>&nbsp;<p>Ha nagyobb rendezvényt szeretnél, kérlek telefonálj nekünk. +3620 213 5999, +361 322 1011</p><p>A Kőleves Kert, ami egy különálló kocsma, külön grill konyhával, nem tévesztendő össze a vendéglővel, de ha oda szeretnél foglalni, próbáld meg a vendéglőt hívni. Oda csak 10 fő fölött és csak este 7-ig áll módunkban tartani az asztalt.</p><p>Késés esetén az asztalfoglalást 20 percig tartjuk, ha mégis lemondanád a foglalást, kérlek telefonálj nekünk.</p>', '<p>We''ll be adding some further information here.</p>'),
(8, 'RENDEZVENY', '<p>A földszinti vendégtérből nyílik az általunk "VIP" teremnek nevezett kisterem, ahol maximum 13 fő fér el. Zártkörű ebédekhez, vacsorákhoz vagy megbeszélésekhez ajánljuk.</p><p>Az épület hátsó részében található az "Elefántos" terem, ahol maximum 25 fő fér el ültetve, ha nem feltétlenül szeretne mindenki leülni, akkor 40 ember is befér. Ezt a termet zártkörű ebédekhez, vacsorákhoz, megbeszélésekhez, osztálytalálkozókhoz, tréningekhez, workshopokhoz, stb. ajánljuk. Ennek a teremnek van egy külön pultja is, projektora és néhány kényelmes fotelje is.</p><p>Az emeleti különterem a legnagyobb külön helyiségünk. Ültetve 70-75 ember fér el benne, állva 120-150-en is akár. Ehhez a teremhez tartozik egy külön bárpult és egy dohányzó terasz is. Amit biztosítani tudunk: erősítő, keverőpult, hangfalak, mikrofonok, projektor, vetítővászon, flipchart tábla. Mindenféle zártkörű rendezvényekhez ajánljuk, például ebédekhez, vacsorákhoz, esküvőkhöz, születésnapokhoz, előadások, tréningek, stb.</p><p>Ezen kívül a kertbe is felveszünk nagyobb foglalásokat és arra is van lehetőség, hogy az egész vendéglőt kivedd.</p>', 'We''ll be adding some further information here.</p>'),
(9, 'SZERVEZO', 'Szia!<br/>Amenyiben szeretnél rendezvényt hozni a Levesbe keress bátran!', 'Hi!For any info regarding events, just give me a ring!'),
(10, 'VENDEGLO', 'A Kőleves 10 éves vendéglő. Imola és Kápszi ültünk egy rémséges vasút-állomáson 1995 körül és elhatároztuk, hogy nyitunk egy vendéglőt. Azt hiszem ez kb. 10 évvel később, de megvalósult 2005-ben. Ez a tíz év beszélgetés a vendéglőről elég volt ahhoz, hogy pontosan tudjuk mit akarunk és lássuk, hogy ugyanazt, ez azóta is töretlenül működik köztünk. Persze nem magától ment minden, hanem sok kölcsön pénzből, amivel az elején nehéz volt küzdenünk. Először a Dob-Kazinczy sarkán nyitottuk meg a Kőlevest, ahol 8 évig üzemeltünk egyre sikeresebben. Itt sikerült egysmást tanulnunk erről a szakmáról, hiszen egyikünk sem volt vendéglátós azelőtt, mégpedig főleg azt, hogy ha magunkat adjuk és beletesszük az energiáinkat, őszinték vagyunk, és figyelünk, akkor ezt a közönségünk is megérzi, és elérjük a sikert. A Kazinczy 41-be három éve költöztünk, ami már egy ötször akkora hely és itt megvalósulhatott minden álmunk, amit egy konyháról képzeltünk. Kidobhattuk a micro sütőt és mindent magunk tudunk elkészíteni, ami lekvár, szósz, pesto, öntet, vagy bármi hozzávaló és eredeti ízt kíván. Útközben még megnyitottuk a Kőleves kertet 7 évvel ezelőtt, hogy nyáron is lehessen könnyű grill konyhával a szabadban enni-inni. Azután 4 éve elkészült a Mika Tivadar Mulató, majd egy évvel később, a hozzá tartozó kert is.', 'We''ll be providing further description here.'),
(11, 'ABOUT_US', 'Igazán fiatalos, modern arcok vagyunk - és mindemellett még finomkat is főzünk! Gyere be hozz, akár csak egy kávéra is, ha nem szeretnéd otthon egyedül meginni, hanem kedves társasággal szeretnéd megosztani a reggeli lendületet!', 'We''ll be providing further description here.'),
(12, 'KERT', 'A Kőleves Kert 8. szezonját éli. Amikor még a sarkon volt a vendéglőnk és egy elég brutális mellék-helység volt a kertben, akkor a szimpla kerten kívül senki más nem volt a környéken, nagyon vártuk, hogy végre ennyire nyüzsgő belváros legyünk.', 'We''ll be providing further description here.'),
(13, 'CETLI2_1', NULL, NULL),
(14, 'CETLI2_2', NULL, NULL),
(15, 'CETLI2_3', NULL, NULL),
(16, 'CETLI3_1', NULL, NULL),
(17, 'CETLI3_2', NULL, NULL),
(18, 'CETLI3_3', NULL, NULL),
(19, 'DELICATES', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, qui, ex? Temporibus natus at ad ducimus fuga sunt, odit quo fugiat recusandae cum cumque provident, deleniti, perspiciatis et incidunt vero placeat quia qui! Voluptatibus, nostrum nam repudiandae dicta, harum voluptatum.', 'ENG Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, qui, ex? Temporibus natus at ad ducimus fuga sunt, odit quo fugiat recusandae cum cumque provident, deleniti, perspiciatis et incidunt vero placeat quia qui! Voluptatibus, nostrum nam repudiandae dicta, harum voluptatum.');

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_szobak`
--

CREATE TABLE IF NOT EXISTS `koleves_szobak` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `TEXT_HU` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `TEXT_EN` varchar(80) COLLATE utf8_hungarian_ci NOT NULL,
  `LEIRAS_HU` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `LEIRAS_EN` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `KEZDOKEP` varchar(100) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `SORREND` int(3) NOT NULL DEFAULT '1',
  `VISIBLE` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=5 ;

--
-- A tábla adatainak kiíratása `koleves_szobak`
--

INSERT INTO `koleves_szobak` (`ID`, `TEXT_HU`, `TEXT_EN`, `LEIRAS_HU`, `LEIRAS_EN`, `KEZDOKEP`, `SORREND`, `VISIBLE`) VALUES
(1, '1-es kék szoba', 'Room 1', 'Ebben a szobában van egy kis konyha, és egy kis fürdőszoba. Egy francia ágy és egy kihúzható kanapé, ami két embernek szintén kényelmes. Egy asztal és székek, poharak kések villák,  microhullámú sütő és egy kis-televízió is van. Egy hűtő-fűtő klíma is be van építve. Az ablaka a Kőleves kertre néz, ahol hétvégén éjjel 1-ig tart a mulatság, de olyan jól szigetelnek az ajtók és ablakok, hogy ez igazán nem zavaró.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto perspiciatis deserunt amet culpa commodi a praesentium fuga quod eligendi labore quidem asperiores sint accusamus aperiam similique id cupiditate dolorum omnis maiores enim quas tempora, ullam, perferendis officia accusantium. Quis, quasi.', 'assets/img/gslide-1.jpg', 1, 1),
(2, 'teszt szoba', '', 'teszt szoba', NULL, 'assets/img/gslide-1.jpg', 1, 1),
(3, 'narancs szoba', '', 'ebben a szobában minden narancssárga!!!', NULL, 'assets/img/gslide-1.jpg', 1, 1),
(4, 'zöld szoba', '', 'ez egy zöld szoba', NULL, 'assets/img/gslide-1.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet: `koleves_szoba_reviewek`
--

CREATE TABLE IF NOT EXISTS `koleves_szoba_reviewek` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `SZOBA_ID` int(5) NOT NULL,
  `CIM` varchar(128) COLLATE utf8_hungarian_ci NOT NULL,
  `NEV` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `LEIRAS` varchar(1024) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `KEP` varchar(128) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `RATING` int(6) DEFAULT NULL,
  `SORREND` int(3) NOT NULL DEFAULT '1',
  `VISIBLE` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=2 ;

--
-- A tábla adatainak kiíratása `koleves_szoba_reviewek`
--

INSERT INTO `koleves_szoba_reviewek` (`ID`, `SZOBA_ID`, `CIM`, `NEV`, `LEIRAS`, `KEP`, `RATING`, `SORREND`, `VISIBLE`) VALUES
(1, 1, 'Nice try near Budapest', 'Példa Pál', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia quis quod neque? Beatae mollitia commodi blanditiis, accusamus temporibus molestiae dolor totam, quibusdam corporis nobis ex, ipsum recusandae! Eum dolorem nam minus culpa veniam, in. Pariatur voluptatem, officiis harum blanditiis mollitia.', 'assets/img/tmb-2.png', 4, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
