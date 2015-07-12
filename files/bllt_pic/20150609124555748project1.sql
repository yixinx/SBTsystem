-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-06-06 02:52:43
-- 服务器版本： 5.6.24
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project1`
--

-- --------------------------------------------------------

--
-- 表的结构 `course_book`
--

CREATE TABLE IF NOT EXISTS `course_book` (
  `Student_ID` bigint(200) NOT NULL,
  `Course_ID` char(200) NOT NULL,
  `Book_Name` char(200) NOT NULL,
  `Author` char(200) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Price` int(200) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `course_book`
--

INSERT INTO `course_book` (`Student_ID`, `Course_ID`, `Book_Name`, `Author`, `Quantity`, `Price`, `Status`, `Comments`) VALUES
(5113709188, 'VE320', '半导体物理与器件 第四版', 'Donald A. Neamen', 1, 40, 0, '九成新'),
(5113709188, 'VE489', '计算机网络 第四版', 'AndrewS. Tanenbaum', 1, 30, 0, ''),
(5113709188, 'VE401', 'Introduction to Probability and Statistics', 'Milton Arnold', 1, 30, 0, ''),
(5113709188, 'VG101', 'C程序设计语言 第二版', 'Brian W.Kernighan', 1, 15, 0, ''),
(5113709202, 'VG101', 'operating system', 'mother fucker', 1, 58, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `course_info`
--

CREATE TABLE IF NOT EXISTS `course_info` (
  `Course_ID` char(100) NOT NULL,
  `Course_Title` char(100) NOT NULL,
  `Course_Number` int(100) NOT NULL,
  `Term` char(10) NOT NULL,
  `Professor` char(50) NOT NULL,
  PRIMARY KEY (`Course_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `extra_book`
--

CREATE TABLE IF NOT EXISTS `extra_book` (
  `Student_ID` bigint(200) NOT NULL,
  `Type_Name` char(200) NOT NULL,
  `Book_Name` char(200) NOT NULL,
  `Author` char(200) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `Price` int(200) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Student_ID` bigint(10) NOT NULL,
  `Student_Name` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Privilege` tinyint(1) NOT NULL,
  `QQ` bigint(200) NOT NULL,
  `Phone` bigint(200) NOT NULL,
  `Email` char(200) NOT NULL,
  PRIMARY KEY (`Student_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`Student_ID`, `Student_Name`, `Password`, `Privilege`, `QQ`, `Phone`, `Email`) VALUES
(5113709188, '薛亦歆', '8cb2237d0679ca88db6464eac60da96345513964', 0, 519144023, 18817560319, 'xueyx921118@sjtu.edu.cn'),
(5113709202, 'Yi_Wan', 'a673b2a582fe4e6fafa72931614392d9ac40f2f0', 0, 0, 18817555360, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
