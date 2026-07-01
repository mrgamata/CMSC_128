-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2022 at 12:42 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_ID` int(11) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_ID`, `user_email`, `username`, `password`) VALUES
(6, 'a@up.edu.ph', '12345', '$2y$10$oPikpL.5QpzjLIkWChQGeeyp3pHEshqAxcwYTG5hF6etTO343P6Pu'),
(5, 'gamata@up.edu.ph', 'admin1', '$2y$10$ysNSSylfLcwwhUeGZ8oyiOpbACgQATBtd2ykygk0JEPlebcka05ny'),
(4, 'mrgamata@up.edu.ph', 'SuperAdmin', '$2y$10$RmhcDIMVLIO3GuLsi30L7eoVe9fd0eKH1iDrBODIeBuvUTjGnYkb.');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `access_num` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `author_fname` varchar(20) NOT NULL,
  `author_mname` varchar(20) DEFAULT NULL,
  `author_lname` varchar(20) NOT NULL,
  `pub_place` varchar(128) NOT NULL,
  `publisher` varchar(128) NOT NULL,
  `copyright` year(4) DEFAULT NULL,
  `pages` int(11) NOT NULL,
  `volume` int(11) DEFAULT NULL,
  `remarks` varchar(128) DEFAULT NULL,
  `times_borrowed` int(11) DEFAULT 0,
  `avail` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`access_num`, `title`, `author_fname`, `author_mname`, `author_lname`, `pub_place`, `publisher`, `copyright`, `pages`, `volume`, `remarks`, `times_borrowed`, `avail`) VALUES
(1, 'Fashion History and Trends from the Roaring Twenties to the 1980s', 'Mariana', '', 'Georgacarkos', '', '', 2011, 175, 1, '', 2, 1),
(2, 'Environment Science for Environmental Management', 'Timothy', '', 'O Riodian', '', '', 2000, 100, NULL, NULL, 4, 1),
(3, 'Human Geography', 'Meredith', '', 'Marsha', 'Philippines', 'Scholastic', 2008, 200, 0, 'DEPED Issued', 4, 0),
(4, 'Carmlol Textbook Outlines', 'Wolf and Resnick', '', '', '', '', 2007, 302, NULL, NULL, 5, 0),
(5, 'Peter Chrisp', 'William', '', 'Shakespeare', '', '', 2003, 200, NULL, NULL, 11, 0),
(6, '20th Century Design 70s and 80s the High-Tech Age', 'Jackie', '', 'Gaff', '', '', 2000, 200, NULL, NULL, 3, 1),
(7, 'The Invincible Iron Man', 'Matt', '', 'Fraction', '', '', 2010, 234, NULL, NULL, 6, 0),
(8, 'Who was John F. Kennedy?', 'Yona Zeldis', '', 'Mc Donough', 'Philippines', 'Psicom', 2005, 233, 0, 'Donation', 3, 1),
(9, 'Who was Wolfgang Amadeus Mozart?', 'Yona Zeldis', '', 'Mc Donough', '', '', 2003, 113, 0, '', 3, 1),
(10, 'Working in Travel and Tourism', 'Margaret', '', 'Mc Alpine', '', '', 2004, 234, NULL, NULL, 7, 1),
(11, 'Captain Cooks Pacific Exploration', 'Jane', '', 'Bingham', '', '', 2008, 67, NULL, NULL, 2, 1),
(12, 'Earths Outer atmosphere', 'Gregory', 'L', 'Vogt', '', '', 2007, 121, NULL, NULL, 8, 0),
(13, 'The Mississippi River', 'Janner', 'R', 'Adil', '', '', 2004, 342, NULL, NULL, 10, 0),
(14, 'Land abuse and Soil Erosion', 'Janice', 'L', 'Redlin', '', '', 2002, 57, NULL, NULL, 2, 1),
(15, 'Winter Guard', 'Suzzane', '', 'McGahey', '', '', 2007, 102, NULL, NULL, 3, 0),
(16, 'Olympic Trak and Field', 'Biran', '', 'Belval', '', '', 2007, 245, NULL, NULL, 1, 1),
(17, 'Trophics', 'Isabel', 'L', 'Beck', '', '', 2007, 97, NULL, NULL, 5, 1),
(18, 'Research Scientist', 'Shirley', '', 'Brinkerhoff', '', '', 2003, 54, NULL, NULL, 22, 1),
(19, 'Marching Band Competition', 'Judy', '', 'Garty', '', '', 2003, 123, NULL, NULL, 1, 1),
(20, 'Treasures', 'Kathryn', '', 'Au', '', '', 2005, 135, NULL, NULL, 1, 1),
(21, 'The best-loved plays of Shakespeare', 'Frost and Mulherin', '', '', '', '', 2004, 165, NULL, NULL, 6, 0),
(22, 'Environmental Science Exam', '', '', '', '', '', 2014, 135, NULL, NULL, 1, 0),
(23, 'The Story of the World', 'Kathryn', '', 'Au', '', '', 2006, 96, NULL, NULL, 5, 0),
(24, 'Ancient Egypt', 'George', '', 'Hart', '', '', 2002, 100, NULL, NULL, 2, 1),
(25, 'The Skeleton and Muscle', 'Steve', '', 'Parker', '', '', 2004, 46, NULL, NULL, 0, 1),
(26, 'The Volcanoes in Action', 'Anita', '', 'Ganeri', '', '', 2009, 231, NULL, NULL, 7, 1),
(27, 'Animal Rights', 'Karen', '', 'Povey', '', '', 2009, 96, NULL, NULL, 2, 0),
(33, 'dfef', 'fdf', 'rg', 'sddfeweeew', 'wefe', 'rf', 0000, 345, 0, 'DEPED Issued', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `b_id` int(11) NOT NULL,
  `b_fname` varchar(20) NOT NULL,
  `b_mname` varchar(20) DEFAULT NULL,
  `b_lname` varchar(20) NOT NULL,
  `year_level` varchar(128) NOT NULL,
  `b_cnum` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`b_id`, `b_fname`, `b_mname`, `b_lname`, `year_level`, `b_cnum`) VALUES
(1, 'LYKA', 'C', 'LIM', 'Grade 12', 2147483647),
(2, 'Kobe', '', 'Gomez', 'Grade 8', 2147483647),
(3, 'Kobe', '', 'Gomez', 'Grade 11', 9998547),
(4, 'CLiff', '', 'oabel', 'Grade 11', 2147483647),
(5, 'Kobe', '', 'Gomez', 'Grade 8', 957841),
(6, 'Maria', '', 'DB', 'Grade 9', 2147483647),
(7, 'LYKA', 'CENDANA', 'LIM', 'Grade 11', 2147483647),
(8, 'Erwin', 'j', 'Bartolome', 'Grade 7', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `access_num` int(11) NOT NULL,
  `book_title` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`access_num`, `book_title`) VALUES
(1, 'Fashion History and Trends from the Roaring Twenties to the 1980s');

-- --------------------------------------------------------

--
-- Table structure for table `facts`
--

CREATE TABLE `facts` (
  `establish` int(11) NOT NULL,
  `jgrad` int(11) NOT NULL,
  `sgrad` int(11) NOT NULL,
  `staff` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facts`
--

INSERT INTO `facts` (`establish`, `jgrad`, `sgrad`, `staff`) VALUES
(1973, 1500, 1196, 80);

-- --------------------------------------------------------

--
-- Table structure for table `past_transaction`
--

CREATE TABLE `past_transaction` (
  `trans_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `access_num` int(11) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `past_transaction`
--

INSERT INTO `past_transaction` (`trans_id`, `b_id`, `access_num`, `borrow_date`, `return_date`) VALUES
(1, 1, 1, '2022-04-26', '2022-06-04'),
(2, 1, 3, '2022-04-26', '2022-04-26'),
(4, 1, 10, '2022-04-26', '2022-04-26'),
(5, 2, 7, '2022-04-27', '2022-04-27'),
(9, 4, 6, '2022-04-27', '2022-04-27'),
(11, 4, 2, '2022-06-04', '2022-06-04'),
(12, 5, 2, '2022-06-04', '2022-06-12'),
(13, 5, 6, '2022-06-04', '2022-06-12'),
(14, 4, 8, '2022-06-04', '2022-06-12'),
(16, 4, 10, '2022-06-05', '2022-06-05'),
(17, 4, 1, '2022-06-05', '2022-06-12'),
(18, 6, 10, '2022-06-11', '2022-06-11'),
(19, 7, 9, '2022-06-11', '2022-06-12'),
(20, 7, 10, '2022-06-11', '2022-06-12'),
(26, 4, 24, '2022-06-11', '2022-06-11'),
(27, 8, 24, '2022-06-11', '2022-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `tran_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `access_num` int(11) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`tran_id`, `b_id`, `access_num`, `borrow_date`, `return_date`) VALUES
(3, 1, 5, '2022-04-26', '2022-05-10'),
(6, 3, 3, '2022-04-27', '2022-05-11'),
(7, 3, 4, '2022-04-27', '2022-05-11'),
(8, 3, 21, '2022-04-27', '2022-05-11'),
(10, 4, 7, '2022-04-27', '2022-05-11'),
(21, 7, 22, '2022-06-11', '2022-06-18'),
(22, 4, 13, '2022-06-11', '2022-06-18'),
(23, 4, 23, '2022-06-11', '2022-06-18'),
(24, 4, 27, '2022-06-11', '2022-06-18'),
(25, 4, 12, '2022-06-11', '2022-06-18'),
(28, 8, 15, '2022-06-11', '2022-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `user_fName` varchar(256) NOT NULL,
  `user_mName` varchar(256) DEFAULT NULL,
  `user_lName` varchar(256) NOT NULL,
  `user_cNum` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `account_ID` (`account_ID`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`access_num`),
  ADD UNIQUE KEY `access_num` (`access_num`);

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`b_id`),
  ADD UNIQUE KEY `b_id` (`b_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD UNIQUE KEY `access_num` (`access_num`);

--
-- Indexes for table `past_transaction`
--
ALTER TABLE `past_transaction`
  ADD PRIMARY KEY (`trans_id`),
  ADD UNIQUE KEY `trans_id` (`trans_id`),
  ADD KEY `b_id` (`b_id`),
  ADD KEY `access_num` (`access_num`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`tran_id`),
  ADD UNIQUE KEY `tran_id` (`tran_id`),
  ADD KEY `b_id` (`b_id`),
  ADD KEY `access_num` (`access_num`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `user_ID` (`user_ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `borrower`
--
ALTER TABLE `borrower`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `tran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`access_num`) REFERENCES `books` (`access_num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `past_transaction`
--
ALTER TABLE `past_transaction`
  ADD CONSTRAINT `past_transaction_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `borrower` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `past_transaction_ibfk_2` FOREIGN KEY (`access_num`) REFERENCES `books` (`access_num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `borrower` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`access_num`) REFERENCES `books` (`access_num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
