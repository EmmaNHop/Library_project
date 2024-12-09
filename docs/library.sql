-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 06:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_ID` int(48) NOT NULL,
  `f_name` varchar(48) NOT NULL,
  `l_name` varchar(48) NOT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_ID`, `f_name`, `l_name`, `bio`) VALUES
(1, 'Rick', 'Riordan', 'author of the percy jackson series'),
(2, 'Sarah', 'Maas', 'wrote throne of glass, a court of thorns and roses, and crescent city'),
(3, 'Emily', 'Henry', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `title` varchar(48) NOT NULL,
  `author` varchar(48) NOT NULL,
  `cover_url` varchar(100) NOT NULL,
  `publish_year` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `read_date` date DEFAULT NULL,
  `id` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`title`, `author`, `cover_url`, `publish_year`, `description`, `read_date`, `id`) VALUES
('A Court of Thorns and Roses', 'Sarah J. Maas', 'https://covers.openlibrary.org/b/id/8738585-L.jpg', '0000-00-00', 'No description available', NULL, '/works/OL17352669W'),
('The Lord of the Rings', 'J.R.R. Tolkien', 'https://covers.openlibrary.org/b/id/14625765-L.jpg', '0000-00-00', 'No description available', NULL, '/works/OL27448W'),
('Harry Potter and the Prisoner of Azkaban', 'J. K. Rowling', 'https://covers.openlibrary.org/b/id/10580435-L.jpg', '0000-00-00', 'No description available', NULL, '/works/OL82536W'),
('Harry Potter and the Order of the Phoenix', 'J. K. Rowling', 'https://covers.openlibrary.org/b/id/10523466-L.jpg', '0000-00-00', 'No description available', NULL, '/works/OL82548W'),
('Harry Potter and the Philosopher\'s Stone', 'J. K. Rowling', 'https://covers.openlibrary.org/b/id/10521270-L.jpg', '0000-00-00', 'No description available', NULL, '/works/OL82563W');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `pk` int(11) NOT NULL,
  `id` varchar(48) NOT NULL,
  `user_name` varchar(48) NOT NULL,
  `list` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`pk`, `id`, `user_name`, `list`) VALUES
(1, 'book value', 'emmmma', 'want_to_read');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_ID` int(48) NOT NULL,
  `rating` int(1) NOT NULL,
  `written_review` text DEFAULT NULL,
  `date_posted` date NOT NULL DEFAULT current_timestamp(),
  `user_name` varchar(48) DEFAULT NULL,
  `id` varchar(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_ID`, `rating`, `written_review`, `date_posted`, `user_name`, `id`) VALUES
(1, 5, NULL, '2024-11-18', NULL, ''),
(2, 5, 'aaaa', '2024-11-18', NULL, ''),
(3, 2, 'udkjfhgksjdh', '2024-11-18', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_name` varchar(48) NOT NULL,
  `email` varchar(48) NOT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `password` varchar(48) NOT NULL,
  `profile_picture` varchar(100) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `email`, `phone_number`, `password`, `profile_picture`, `bio`) VALUES
('bunny', 'bunny', NULL, 'bunny', 'https://www.shutterstock.com/image-photo/small-kitten-on-green-lawn-600nw-2322506225.jpg', NULL),
('Demoing', 'demo@e.c', '888888888', 'd', NULL, 'this is my bio!'),
('eeemaaa', 'hi@hello.howdy', NULL, '$2y$10$D5dvwe7CyA/VqBcgnIbyOujKkNb3h4pY6n/yCmEUQ', NULL, NULL),
('emma', 'test@domain.email', '8595257118', '$2y$10$S82AaKzoQQGKIJ81q8iiR.EEU6J1nDOlNZdn1IOeg', 'NULL', NULL),
('emmmma', 'e@mm.a', NULL, 'e', NULL, NULL),
('h', 'h@h.h', NULL, 'h', NULL, NULL),
('i', 'i@i.i', NULL, '$2y$10$BMPOWxiBj8aeEK.t2upEf.HNDC9bXEGbaJZgVotYF', NULL, NULL),
('o', 'o@o.o', NULL, '$2y$10$FL9piDRgWCW2YPWU7ZoO4Ot03K0wr5t65yHl/dhgP', NULL, NULL),
('p', 'p@p.p', NULL, '$2y$10$e4mPiuN.p9g2n3YPRECetexDsIm9RhEBDoMNmeuWm', NULL, NULL),
('r', 'r@r.r', NULL, 'r', NULL, NULL),
('root', 'root@domain.com', NULL, '$2y$10$Du34bIlFrTMQsllmi2TuzOFbtciv3z6fM8iHU8N4l', NULL, NULL),
('t', 't@email.com', NULL, '$2y$10$pEp2/AYBMaHYjCdlDQF7y.L6O05fPuvixGy3ohTlP', NULL, NULL),
('Testing', 't@t.com', NULL, 't', NULL, NULL),
('user', 'user@email.com', NULL, 'user', NULL, NULL),
('v', 'v@v.v', NULL, 'v', NULL, NULL),
('w', 'w@w.w', NULL, 'w', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_ID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`pk`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_ID` int(48) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_ID` int(48) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
