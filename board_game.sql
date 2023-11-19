-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 19 Νοε 2023 στις 18:29:33
-- Έκδοση διακομιστή: 10.4.28-MariaDB
-- Έκδοση PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `board_game`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `board`
--

CREATE TABLE `board` (
  `x` tinyint(1) NOT NULL,
  `y` tinyint(1) NOT NULL,
  `b_color` enum('P','R','Y','B','W') NOT NULL,
  `piece_color` enum('P','R','Y','B','W') DEFAULT NULL,
  `piece` enum('K1','K2','K3','K4') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Άδειασμα δεδομένων του πίνακα `board`
--

INSERT INTO `board` (`x`, `y`, `b_color`, `piece_color`, `piece`) VALUES
(1, 1, 'R', '', ''),
(1, 2, 'R', '', ''),
(1, 3, 'R', '', ''),
(1, 4, 'R', '', ''),
(1, 5, 'W', '', ''),
(1, 6, 'W', '', ''),
(1, 7, 'W', '', ''),
(1, 8, 'B', '', ''),
(1, 9, 'B', '', ''),
(1, 10, 'B', '', ''),
(1, 11, 'B', '', ''),
(2, 1, 'W', 'R', 'K3'),
(2, 2, 'W', '', ''),
(2, 3, 'W', 'R', 'K4'),
(2, 4, 'R', '', ''),
(2, 5, 'W', '', ''),
(2, 6, 'B', '', ''),
(2, 7, 'B', '', ''),
(2, 8, 'B', '', ''),
(2, 9, 'W', 'B', 'K1'),
(2, 10, 'W', '', ''),
(2, 11, 'W', 'B', 'K2'),
(3, 1, 'W', '', ''),
(3, 2, 'W', '', ''),
(3, 3, 'W', '', ''),
(3, 4, 'R', '', ''),
(3, 5, 'W', '', ''),
(3, 6, 'B', '', ''),
(3, 7, 'W', '', ''),
(3, 8, 'B', '', ''),
(3, 9, 'W', '', ''),
(3, 10, 'W', '', ''),
(3, 11, 'W', '', ''),
(4, 1, 'W', 'R', 'K1'),
(4, 2, 'W', '', ''),
(4, 3, 'W', 'R', 'K2'),
(4, 4, 'R', '', ''),
(4, 5, 'W', '', ''),
(4, 6, 'B', '', ''),
(4, 7, 'W', '', ''),
(4, 8, 'B', '', ''),
(4, 9, 'W', 'B', 'K3'),
(4, 10, 'W', '', ''),
(4, 11, 'W', 'B', 'K4'),
(5, 1, 'W', '', ''),
(5, 2, 'R', '', ''),
(5, 3, 'W', '', ''),
(5, 4, 'W', '', ''),
(5, 5, 'W', '', ''),
(5, 6, 'B', '', ''),
(5, 7, 'W', '', ''),
(5, 8, 'W', '', ''),
(5, 9, 'W', '', ''),
(5, 10, 'W', '', ''),
(5, 11, 'W', '', ''),
(6, 1, 'W', '', ''),
(6, 2, 'R', '', ''),
(6, 3, 'R', '', ''),
(6, 4, 'R', '', ''),
(6, 5, 'R', '', ''),
(6, 6, '', '', ''),
(6, 7, 'Y', '', ''),
(6, 8, 'Y', '', ''),
(6, 9, 'Y', '', ''),
(6, 10, 'Y', '', ''),
(6, 11, 'W', '', ''),
(7, 1, 'W', '', ''),
(7, 2, 'W', '', ''),
(7, 3, 'W', '', ''),
(7, 4, 'W', '', ''),
(7, 5, 'W', '', ''),
(7, 6, 'P', '', ''),
(7, 7, 'W', '', ''),
(7, 8, 'W', '', ''),
(7, 9, 'W', '', ''),
(7, 10, 'Y', '', ''),
(7, 11, 'W', '', ''),
(8, 1, 'W', 'P', 'K4'),
(8, 2, 'W', '', ''),
(8, 3, 'W', 'P', 'K3'),
(8, 4, 'P', '', ''),
(8, 5, 'W', '', ''),
(8, 6, 'P', '', ''),
(8, 7, 'W', '', ''),
(8, 8, 'Y', '', ''),
(8, 9, 'W', 'Y', 'K2'),
(8, 10, 'W', '', ''),
(8, 11, 'W', 'Y', 'K1'),
(9, 1, 'W', '', ''),
(9, 2, 'W', '', ''),
(9, 3, 'W', '', ''),
(9, 4, 'P', '', ''),
(9, 5, 'W', '', ''),
(9, 6, 'P', '', ''),
(9, 7, 'W', '', ''),
(9, 8, 'Y', '', ''),
(9, 9, 'W', '', ''),
(9, 10, 'W', '', ''),
(9, 11, 'W', '', ''),
(10, 1, 'W', 'P', 'K2'),
(10, 2, 'W', '', ''),
(10, 3, 'W', 'P', 'K1'),
(10, 4, 'P', '', ''),
(10, 5, 'P', '', ''),
(10, 6, 'P', '', ''),
(10, 7, 'W', '', ''),
(10, 8, 'Y', '', ''),
(10, 9, 'W', 'Y', 'K4'),
(10, 10, 'W', '', ''),
(10, 11, 'W', 'Y', 'K3'),
(11, 1, 'P', '', ''),
(11, 2, 'P', '', ''),
(11, 3, 'P', '', ''),
(11, 4, 'P', '', ''),
(11, 5, 'W', '', ''),
(11, 6, 'W', '', ''),
(11, 7, 'W', '', ''),
(11, 8, 'Y', '', ''),
(11, 9, 'Y', '', ''),
(11, 10, 'Y', '', ''),
(11, 11, 'Y', '', '');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`x`,`y`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
