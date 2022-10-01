-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2022 at 08:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_sell`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow_book`
--

CREATE TABLE `borrow_book` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `author_name` varchar(50) NOT NULL,
  `book_version` varchar(20) NOT NULL,
  `book_publication` varchar(50) NOT NULL,
  `borrow_time` int(11) NOT NULL,
  `borrow_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrow_book`
--

INSERT INTO `borrow_book` (`id`, `owner_id`, `book_name`, `author_name`, `book_version`, `book_publication`, `borrow_time`, `borrow_status`) VALUES
(1, 1, 'dawd', 'dad', 'dada', 'dad', 5, 0),
(2, 2, 'dad', 'fafa', 'faf', 'affa', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `donate_book`
--

CREATE TABLE `donate_book` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `author_name` varchar(50) NOT NULL,
  `book_version` varchar(20) NOT NULL,
  `book_publication` varchar(50) NOT NULL,
  `donate_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donate_book`
--

INSERT INTO `donate_book` (`id`, `owner_id`, `book_name`, `author_name`, `book_version`, `book_publication`, `donate_status`) VALUES
(1, 2, 'fada', 'adad', 'adad', 'adad', 0),
(2, 1, 'dawd', 'dada', 'dad', 'dada', 0),
(3, 1, 'dada', 'dada', 'dadad', 'ada', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sell_book`
--

CREATE TABLE `sell_book` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `book_name` varchar(50) NOT NULL,
  `author_name` varchar(50) NOT NULL,
  `book_version` varchar(20) NOT NULL,
  `book_publication` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `sold_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sell_book`
--

INSERT INTO `sell_book` (`id`, `seller_id`, `book_name`, `author_name`, `book_version`, `book_publication`, `amount`, `sold_status`) VALUES
(1, 1, 'gg', 'gg', 'gg', 'gg', 25, 0),
(2, 1, 'faf', 'afa', 'fafa', 'affa', 15, 0),
(3, 2, 'rawfa', 'afaf', 'afaf', 'afaf', 50, 0),
(4, 1, 'dwadaw', 'adawd', 'adad', 'dawdawda', 55, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `password` varchar(500) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `number`, `password`, `approved`) VALUES
(1, 'fahim', 'Fahim', 'fahim@gmail.com', '01794798101', 'b94c5dbc799331f0ee036db0c145b5438b9a39dc6984ca5fa1260ca0170df32b', 1),
(2, 'hasib', 'Hasib Ar Rafiul Fahim', 'fahad.com66.fk@gmail.com', '01794798101', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 1),
(3, 'admin', 'Admin', 'admin@mail.com', '01794798101', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrow_book`
--
ALTER TABLE `borrow_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donate_book`
--
ALTER TABLE `donate_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_book`
--
ALTER TABLE `sell_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrow_book`
--
ALTER TABLE `borrow_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donate_book`
--
ALTER TABLE `donate_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sell_book`
--
ALTER TABLE `sell_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
