-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- РЎС‚СЂСѓРєС‚СѓСЂР° С‚Р°Р±Р»РёС†С‹ `USERS`
--

CREATE TABLE `USERS` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `PASSWORD` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `AVATAR` varchar(10000) COLLATE utf8mb4_bin NOT NULL,
  `INVENTORY` longtext COLLATE utf8mb4_bin NOT NULL,
  `REGDATE` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `LEVEL` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `TICKET` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ROLEFLAGS` int(11) NOT NULL,
  `ISBANNED` int(11) NOT NULL DEFAULT 0,
  `MONEY` int(11) NOT NULL DEFAULT 100,
  `GOLD` int(11) NOT NULL DEFAULT 0,
  `MAGIC` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- РРЅРґРµРєСЃС‹ СЃРѕС…СЂР°РЅС‘РЅРЅС‹С… С‚Р°Р±Р»РёС†
--

--
-- РРЅРґРµРєСЃС‹ С‚Р°Р±Р»РёС†С‹ `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`),
  ADD KEY `ID_2` (`ID`);

--
-- AUTO_INCREMENT РґР»СЏ СЃРѕС…СЂР°РЅС‘РЅРЅС‹С… С‚Р°Р±Р»РёС†
--

--
-- AUTO_INCREMENT РґР»СЏ С‚Р°Р±Р»РёС†С‹ `USERS`
--
ALTER TABLE `USERS`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10000;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
