-- phpMyAdmin SQL Dump
-- version 4.0.10.13
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas wygenerowania: 17 Lut 2016, 00:13
-- Wersja serwera: 5.5.47-0+deb8u1.cba-log
-- Wersja PHP: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `zychuu_cba_pl`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(32) NOT NULL,
  `blackguard` int(11) NOT NULL,
  `kings` int(11) NOT NULL,
  `mammoth` int(11) NOT NULL,
  `shipwreck` int(11) NOT NULL,
  `shithall` int(11) NOT NULL,
  `stadium` int(11) NOT NULL,
  `twillight` int(11) NOT NULL,
  `step` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `sessions`
--

INSERT INTO `sessions` (`id`, `blackguard`, `kings`, `mammoth`, `shipwreck`, `shithall`, `stadium`, `twillight`, `step`) VALUES
('7cccf909947a59dba8c27dbe8d938ba0', 1, 1, 1, 1, 1, 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
