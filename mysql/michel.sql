-- phpMyAdmin SQL Dump
-- version 2.9.0.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 03. Februar 2010
-- Server Version: 4.1.22
-- PHP-Version: 5.2.6RC1-pl1-gentoo
-- 
-- Datenbank: `michel-wein`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `kategorie`
-- 

CREATE TABLE `kategorie` (
  `ka_id` int(10) unsigned NOT NULL auto_increment,
  `ka_kategorie` varchar(255) collate utf8_unicode_ci NOT NULL default '0',
  PRIMARY KEY  (`ka_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 AUTO_INCREMENT=8 ;

-- 
-- Daten für Tabelle `kategorie`
-- 

INSERT INTO `kategorie` VALUES (1, 'weisswein\r');
INSERT INTO `kategorie` VALUES (2, 'rotwein\r');
INSERT INTO `kategorie` VALUES (3, 'sonstiges\r');


-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `weine`
-- 

CREATE TABLE `weine` (
  `ka_id` int(11) NOT NULL auto_increment,
  `ka_wein` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`ka_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 AUTO_INCREMENT=20 ;

-- 
-- Daten für Tabelle `weine`
-- 

INSERT INTO `weine` VALUES (1, 'Winzerschoppe\r');
INSERT INTO `weine` VALUES (1, 'Michelangelo\r');
INSERT INTO `weine` VALUES (2, 'Merlot\r');
INSERT INTO `weine` VALUES (3, 'Sahnisch Quetsch\r');