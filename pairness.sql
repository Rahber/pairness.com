-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 15, 2013 at 06:35 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pairness`
--
CREATE DATABASE IF NOT EXISTS `pairness` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pairness`;

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE IF NOT EXISTS `candidate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parientid` int(10) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `userpassword` varchar(20) NOT NULL,
  `dateofregistration` datetime NOT NULL,
  `dateofvarification` datetime NOT NULL,
  `picture` varchar(250) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `lastpage` varchar(10) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `parientid`, `ip`, `email`, `username`, `userpassword`, `dateofregistration`, `dateofvarification`, `picture`, `lastlogin`, `lastpage`) VALUES
(1, 0, '127.0.0.1', 'abcze7', 'sdgfjsdgf', 'gjhgsd', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'default.png', '0000-00-00 00:00:00', ''),
(2, 0, '127.0.0.1', 'abcxyz', 'rfytfff', 'tsafhgv6', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'default.png', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE IF NOT EXISTS `family` (
  `ip` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `userpassword` varchar(20) NOT NULL,
  `dateofregistration` datetime NOT NULL,
  `dateofverfication` datetime NOT NULL,
  `picture` varchar(250) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `lastpage` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`ip`, `email`, `username`, `userpassword`, `dateofregistration`, `dateofverfication`, `picture`, `lastlogin`, `lastpage`) VALUES
('0', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'default.png', '0000-00-00 00:00:00', ''),
('0', 'hjkh', 'jkhkl;hkl;h', 'kgdg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'default.png', '0000-00-00 00:00:00', ''),
('0', 'jgjkgj', 'hjkhjkhjklhj', 'gfghdgh', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'default.png', '0000-00-00 00:00:00', ''),
('0', 'xczxcz', 'gjhghh', 'jhkh', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'default.png', '0000-00-00 00:00:00', ''),
('1270', 'dfsdfdfg', 'sagfgjh', 'dftyg54y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'default.png', '0000-00-00 00:00:00', ''),
('127', 'dfsdfdfg', 'sagfgjh', 'dftyg54y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'default.png', '0000-00-00 00:00:00', ''),
('127.0.0.1', 'dfsdfdfg', 'sagfgjh', 'dftyg54y', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'default.png', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--


-- --------------------------------------------------------

--
-- Table structure for table `pairness_family`
--

CREATE TABLE IF NOT EXISTS `pairness_family` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) NOT NULL,
  `familyid` int(10) NOT NULL,
  `familyfullname` varchar(100) NOT NULL,
  `familyemailaddress` varchar(200) NOT NULL,
  `familypassword` varchar(20) NOT NULL,
  `familygender` varchar(10) NOT NULL,
  `familyseekinggender` varchar(10) NOT NULL,
  `familydateofbirth` date NOT NULL,
  `familycountry` varchar(50) NOT NULL,
  `familystate` varchar(100) NOT NULL,
  `familycity` varchar(100) NOT NULL,
  `familyterms` varchar(255) NOT NULL,
  `familyfirstname` varchar(50) NOT NULL,
  `familylastname` varchar(50) NOT NULL,
  `familyphone` int(20) NOT NULL,
  `familycell` int(20) NOT NULL,
  `familyprofileimage` varchar(255) NOT NULL,
  `familyprofiledate` datetime NOT NULL,
  `familyprofiletime` time NOT NULL,
  `familyhaircolor` int(10) NOT NULL,
  `familyhairtype` int(10) NOT NULL,
  `familyeyecolor` int(10) NOT NULL,
  `familyeyewear` int(10) NOT NULL,
  `familyheight` int(10) NOT NULL,
  `familyweight` int(10) NOT NULL,
  `familybodytype` int(10) NOT NULL,
  `familyappearance` int(10) NOT NULL,
  `familyfacialhair` int(10) NOT NULL,
  `familyphysicalstatus` int(10) NOT NULL,
  `familymaritalstatus` int(10) NOT NULL,
  `familyhavechildrens` int(10) NOT NULL,
  `familyvalues` int(10) NOT NULL,
  `familylivingsituation` int(10) NOT NULL,
  `familylikes` varchar(255) NOT NULL,
  `familydislikes` varchar(255) NOT NULL,
  `familyzodiachormony` varchar(30) NOT NULL,
  `familyfoodhabits` int(10) NOT NULL,
  `familyeducation` int(10) NOT NULL,
  `familyoccupation` int(10) NOT NULL,
  `familyrelocate` int(10) NOT NULL,
  `familyreligion` int(10) NOT NULL,
  `familybornreverted` int(10) NOT NULL,
  `familyreligiousvalues` int(10) NOT NULL,
  `familyattendreligiousservices` int(10) NOT NULL,
  `familymothertongue` int(10) NOT NULL,
  `familyethnicity` int(10) NOT NULL,
  `familycast` varchar(50) NOT NULL,
  `familynationality` int(10) NOT NULL,
  `familyplaceofbirth` int(10) NOT NULL,
  `familylanguagesspoken` int(10) NOT NULL,
  `familyambition` varchar(255) NOT NULL,
  `familyhobbies` varchar(255) NOT NULL,
  `familydreams` varchar(255) NOT NULL,
  `familygetmarried` int(10) NOT NULL,
  `familywantmorechildrens` int(10) NOT NULL,
  `familydowry` int(10) NOT NULL,
  `familycnicnumber` int(20) NOT NULL,
  `familycnicimage` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `pairness_family`
--

INSERT INTO `pairness_family` (`id`, `ip`, `familyid`, `familyfullname`, `familyemailaddress`, `familypassword`, `familygender`, `familyseekinggender`, `familydateofbirth`, `familycountry`, `familystate`, `familycity`, `familyterms`, `familyfirstname`, `familylastname`, `familyphone`, `familycell`, `familyprofileimage`, `familyprofiledate`, `familyprofiletime`, `familyhaircolor`, `familyhairtype`, `familyeyecolor`, `familyeyewear`, `familyheight`, `familyweight`, `familybodytype`, `familyappearance`, `familyfacialhair`, `familyphysicalstatus`, `familymaritalstatus`, `familyhavechildrens`, `familyvalues`, `familylivingsituation`, `familylikes`, `familydislikes`, `familyzodiachormony`, `familyfoodhabits`, `familyeducation`, `familyoccupation`, `familyrelocate`, `familyreligion`, `familybornreverted`, `familyreligiousvalues`, `familyattendreligiousservices`, `familymothertongue`, `familyethnicity`, `familycast`, `familynationality`, `familyplaceofbirth`, `familylanguagesspoken`, `familyambition`, `familyhobbies`, `familydreams`, `familygetmarried`, `familywantmorechildrens`, `familydowry`, `familycnicnumber`, `familycnicimage`) VALUES
(1, '127.0.0.1', 0, 'hdfgsdfg', 'dfgjksdgq', 'kjhkhgdfg', '', '', '0000-00-00', '', '', '', '', '', '', 0, 0, 'default.png', '0000-00-00 00:00:00', '00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', '', '', 0, 0, 0, 0, ''),
(2, '127.0.0.1', 0, 'jkgjkgjkg', 'gfjsg', 'kjgkh', '', '', '0000-00-00', '', '', '', '', '', '', 0, 0, 'default.png', '0000-00-00 00:00:00', '00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', '', '', 0, 0, 0, 0, ''),
(3, '127.0.0.1', 0, 'jkhjklh', 'tyjhgh', 'jkhjkhkj', '', '', '0000-00-00', '', '', '', '', '', '', 0, 0, 'default.png', '0000-00-00 00:00:00', '00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', '', '', 0, 0, 0, 0, ''),
(4, '127.0.0.1', 0, 'ozil11', 'gmailozil', 'hghjkgh', '', '', '0000-00-00', '', '', '', '', '', '', 0, 0, 'default.png', '0000-00-00 00:00:00', '00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', '', '', 0, 0, 0, 0, ''),
(5, '127.0.0.1', 0, 'ghjhgjhg', 'fgsdjg', 'hjgjhgj', '', '', '0000-00-00', '', '', '', '', '', '', 0, 0, 'default.png', '0000-00-00 00:00:00', '00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', '', '', 0, 0, 0, 0, ''),
(10, '127.0.0.1', 0, 'hgjhg', 'dgcd', 'jhg', '', '', '0000-00-00', '', '', '', '', '', '', 0, 0, 'default.png', '0000-00-00 00:00:00', '00:00:00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, '', '', '', 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `sessionid` varchar(255) COLLATE utf8_bin NOT NULL,
  `uid` int(11) NOT NULL,
  `t` int(11) NOT NULL,
  `ip` varchar(255) COLLATE utf8_bin NOT NULL,
  `ip2` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
