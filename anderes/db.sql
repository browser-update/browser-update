-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 25. März 2009 um 08:15
-- Server Version: 5.0.45
-- PHP-Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `d0088740`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `updates`
--

CREATE TABLE IF NOT EXISTS `updates` (
  `referer` varchar(100) collate latin1_general_ci NOT NULL,
  `fromn` char(1) collate latin1_general_ci NOT NULL,
  `fromv` float NOT NULL,
  `ton` char(1) collate latin1_general_ci NOT NULL,
  `lang` varchar(5) collate latin1_general_ci NOT NULL,
  `ip` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  KEY `from` (`fromn`,`fromv`,`ton`,`ip`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `views`
--

CREATE TABLE IF NOT EXISTS `views` (
  `referer` varchar(100) collate latin1_general_ci NOT NULL,
  `fromn` char(1) collate latin1_general_ci NOT NULL,
  `fromv` float NOT NULL,
  `lang` varchar(5) collate latin1_general_ci NOT NULL,
  `ip` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  KEY `from` (`fromn`,`fromv`,`ip`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

