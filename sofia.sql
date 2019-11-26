-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2019 at 08:00 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sofia`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `TITLE` varchar(30) NOT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `IMAGETOSHOW` varchar(120) NOT NULL,
  `BLOGID` int(11) NOT NULL,
  `BLOGTEXT` text NOT NULL,
  `CLAPS` int(11) DEFAULT '0',
  `TIMETOREAD` int(11) DEFAULT NULL,
  `DATEPUBLISHED` date NOT NULL,
  `GENRE` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`TITLE`, `EMAIL`, `IMAGETOSHOW`, `BLOGID`, `BLOGTEXT`, `CLAPS`, `TIMETOREAD`, `DATEPUBLISHED`, `GENRE`) VALUES
('For You are the Creator', 'mishraaman2210@gmail.com', 'https://www.positivityblog.com/_images/080220_confidence.jpg', 1, '<h1>The best way to set and achieve goals?</h1>Do it your way rest will happen automatically.', 12, 3, '2019-10-01', 'scifi'),
('Halo Reach : the depth of unkn', 'mishraaman2210@gmail.com', 'https://images-na.ssl-images-amazon.com/images/I/81Z-GNaPsjL.jpg', 12, 'ASDF<br>SDFASDF', 7, 3, '2019-11-23', 'scifi'),
('jsjsdjhf', 'mishraaman2210@gmail.com', 'ajkdfhkjahdskfjh.com', 17, '\n    <div contenteditable=\"false\" placeholder=\"Start here...\" class=\"blogContent\"><blockquote>hjghjghjgkj</blockquote></div>\n\n\n', 0, 3, '2019-11-26', 'scifi');

-- --------------------------------------------------------

--
-- Stand-in structure for view `blog_view`
-- (See below for the actual view)
--
CREATE TABLE `blog_view` (
`firstname` varchar(30)
,`lastname` varchar(30)
,`TITLE` varchar(30)
,`EMAIL` varchar(40)
,`IMAGETOSHOW` varchar(120)
,`BLOGID` int(11)
,`BLOGTEXT` text
,`CLAPS` int(11)
,`TIMETOREAD` int(11)
,`DATEPUBLISHED` date
,`GENRE` varchar(30)
);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `cid` int(11) NOT NULL,
  `content` text NOT NULL,
  `blogid` int(11) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`cid`, `content`, `blogid`, `email`, `date_time`) VALUES
(1, 'Nice anwer', 1, 'mishraaman2210@gmail.com', '2019-11-25 18:25:38'),
(2, 'No its wrong', 1, 'mishraaman2210@gmail.com', '2019-11-25 18:45:30'),
(7, 'Please write something meaningful', 12, 'mishraaman2210@gmail.com', '2019-11-25 19:24:31'),
(9, 'asdsa', 12, 'mishraaman2210@gmail.com', '2019-11-26 10:27:06'),
(10, 'Try better', 1, 'mishraaman2210@gmail.com', '2019-11-26 14:30:32'),
(11, 'jgjhgjh', 1, 'mishraaman2210@gmail.com', '2019-11-26 14:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `psw` varchar(128) NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `token` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`firstname`, `lastname`, `email`, `psw`, `enable`, `token`) VALUES
('Agman         ', 'Mishra', 'mishraaman2210@gmail.com', '95a6080a7a999364880885c180d92bb5', 1, NULL);

-- --------------------------------------------------------

--
-- Structure for view `blog_view`
--
DROP TABLE IF EXISTS `blog_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `blog_view`  AS  select `user`.`firstname` AS `firstname`,`user`.`lastname` AS `lastname`,`blog`.`TITLE` AS `TITLE`,`blog`.`EMAIL` AS `EMAIL`,`blog`.`IMAGETOSHOW` AS `IMAGETOSHOW`,`blog`.`BLOGID` AS `BLOGID`,`blog`.`BLOGTEXT` AS `BLOGTEXT`,`blog`.`CLAPS` AS `CLAPS`,`blog`.`TIMETOREAD` AS `TIMETOREAD`,`blog`.`DATEPUBLISHED` AS `DATEPUBLISHED`,`blog`.`GENRE` AS `GENRE` from (`user` join `blog` on((`blog`.`EMAIL` = `user`.`email`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`BLOGID`),
  ADD KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `blogid` (`blogid`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `BLOGID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`EMAIL`) REFERENCES `user` (`email`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`blogid`) REFERENCES `blog` (`BLOGID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`email`) REFERENCES `user` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
