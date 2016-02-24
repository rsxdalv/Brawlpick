
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2016 at 03:15 PM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a8800507_bandb`
--

-- --------------------------------------------------------

--
-- Table structure for table `browserdata`
--

CREATE TABLE `browserdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `os` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `browsername` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `fullversion` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `ip` varchar(15) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;


