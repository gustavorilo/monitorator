-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 45.40.164.98
-- Generation Time: May 27, 2018 at 04:55 PM
-- Server version: 5.5.51
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `monitorator`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `idClient` smallint(11) NOT NULL AUTO_INCREMENT,
  `client` varchar(255) NOT NULL,
  `state` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` VALUES(1, 'Frávega', 1);

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

CREATE TABLE `commands` (
  `idCommand` smallint(11) NOT NULL AUTO_INCREMENT,
  `idEntity` smallint(11) NOT NULL,
  `host` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `idCommandType` smallint(11) NOT NULL,
  `interval` smallint(1) NOT NULL,
  `lastExecutedCommand` datetime NOT NULL,
  `lastStatus` varchar(255) NOT NULL,
  PRIMARY KEY (`idCommand`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `commands`
--

INSERT INTO `commands` VALUES(2, 2, 'https://www.fravega.com/ofertas/avent', 'avent-coleccion-da.jpg', 6, 5, '2018-04-17 17:32:43', 'warning');
INSERT INTO `commands` VALUES(3, 3, 'https://www.fravega.com', '', 1, 5, '2018-04-17 17:32:44', 'ok');
INSERT INTO `commands` VALUES(4, 4, 'https://www.fravega.com', '', 2, 5, '2018-04-17 17:32:46', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `commands_types`
--

CREATE TABLE `commands_types` (
  `idCommandType` smallint(11) NOT NULL AUTO_INCREMENT,
  `command` varchar(255) NOT NULL,
  PRIMARY KEY (`idCommandType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `commands_types`
--

INSERT INTO `commands_types` VALUES(1, 'GET');
INSERT INTO `commands_types` VALUES(2, 'PING');
INSERT INTO `commands_types` VALUES(4, 'TELNET');
INSERT INTO `commands_types` VALUES(5, 'CURL');
INSERT INTO `commands_types` VALUES(6, 'TEXT ON PAGE');

-- --------------------------------------------------------

--
-- Table structure for table `entities`
--

CREATE TABLE `entities` (
  `idEntity` smallint(11) NOT NULL AUTO_INCREMENT,
  `idClient` smallint(11) NOT NULL,
  `entity` varchar(255) NOT NULL,
  `state` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idEntity`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `entities`
--

INSERT INTO `entities` VALUES(2, 1, 'Ofertas Avent - Landing', 1);
INSERT INTO `entities` VALUES(3, 1, 'Frávega Home', 1);
INSERT INTO `entities` VALUES(4, 1, 'Frávega Home (Ping)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `executed_commands`
--

CREATE TABLE `executed_commands` (
  `idExecuteCommand` smallint(11) NOT NULL AUTO_INCREMENT,
  `idCommand` smallint(11) NOT NULL,
  `date` datetime NOT NULL,
  `tried` smallint(1) NOT NULL,
  `response` text NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`idExecuteCommand`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `executed_commands`
--

INSERT INTO `executed_commands` VALUES(1, 4, '2018-04-15 22:06:35', 1, '55 ms', 'ok');
INSERT INTO `executed_commands` VALUES(2, 2, '2018-04-15 22:10:11', 1, 'String: avent-coleccion-d.jpg', 'ok');
INSERT INTO `executed_commands` VALUES(3, 3, '2018-04-15 22:10:15', 1, 'Array', 'ok');
INSERT INTO `executed_commands` VALUES(4, 4, '2018-04-15 22:12:47', 2, '82 ms', 'ok');
INSERT INTO `executed_commands` VALUES(5, 2, '2018-04-15 22:16:02', 2, 'String: avent-coleccion-d.jpg', 'ok');
INSERT INTO `executed_commands` VALUES(6, 3, '2018-04-15 22:16:15', 2, 'HTTP/1.1 200 OK', 'ok');
INSERT INTO `executed_commands` VALUES(7, 2, '2018-04-17 17:32:43', 3, 'String not found', 'warning');
INSERT INTO `executed_commands` VALUES(8, 3, '2018-04-17 17:32:44', 3, 'HTTP/1.1 200 OK', 'ok');
INSERT INTO `executed_commands` VALUES(9, 4, '2018-04-17 17:32:46', 3, '165 ms', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `idPermission` smallint(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(255) NOT NULL,
  PRIMARY KEY (`idPermission`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` VALUES(1, 'add_command');
INSERT INTO `permissions` VALUES(2, 'edit_command');
INSERT INTO `permissions` VALUES(3, 'stop_command');
INSERT INTO `permissions` VALUES(4, 'star_command');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` smallint(11) unsigned NOT NULL AUTO_INCREMENT,
  `idClient` smallint(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `state` int(1) DEFAULT '0',
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 1, 'Gustavo', 'Rilo', 'grilo', 'c409bae784447e55a615efb9f960552e', 1, 'gustavo.rilo@fravega.com.ar');

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `idUser` smallint(11) NOT NULL,
  `idPermission` smallint(11) NOT NULL,
  UNIQUE KEY `idUseridPermission` (`idUser`,`idPermission`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` VALUES(1, 1);
INSERT INTO `users_permissions` VALUES(1, 2);
INSERT INTO `users_permissions` VALUES(1, 3);
INSERT INTO `users_permissions` VALUES(1, 4);
