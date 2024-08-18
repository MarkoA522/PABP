-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2024 at 03:12 PM
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
-- Database: `nekretnine`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `naslov` varchar(255) NOT NULL,
  `tip` varchar(20) NOT NULL,
  `opis` varchar(255) DEFAULT NULL,
  `lokacija` varchar(255) NOT NULL,
  `ulica` varchar(255) NOT NULL,
  `brojulice` varchar(255) NOT NULL,
  `povrsina` int(11) NOT NULL,
  `brojsoba` int(11) NOT NULL,
  `tipgrejanja` varchar(255) NOT NULL,
  `internet` varchar(255) NOT NULL,
  `telefonskalinija` varchar(255) NOT NULL,
  `kablovska` varchar(255) NOT NULL,
  `brojspratova` int(11) NOT NULL,
  `stanjenekretnine` varchar(255) NOT NULL,
  `cena` int(11) NOT NULL,
  `naslovnaslika` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `naslov`, `tip`, `opis`, `lokacija`, `ulica`, `brojulice`, `povrsina`, `brojsoba`, `tipgrejanja`, `internet`, `telefonskalinija`, `kablovska`, `brojspratova`, `stanjenekretnine`, `cena`, `naslovnaslika`) VALUES
(43, 8, 'Montažna kuća', 'Prodaja', 'Dobar komšiluk, domaćinstvo sređeno', 'Novi Sad', 'Saše Kovačevića', '23', 550, 4, 'Ostalo', 'Nema', 'Nema', 'Nema', 15, 'Luksuzno', 500000, 'montaznakucaa.jpg'),
(47, 9, 'Sasukeova kuca', 'Iznajmljivanje', 'Najbolja kuca u selu', 'Najbolja', 'Najveca', '24', 340, 4, 'Gas', 'Ima', 'Ima', 'Ima', 1, 'U izgradnji', 220, 'monta.jpg'),
(48, 10, 'Ackova Kuca', 'Prodaja', 'Komšiluk vrhunski, sem par kuća', 'Subotica', 'Dragomira Despića', '22', 230, 7, 'Gas', 'Ima', 'Ima', 'Ima', 1, 'Uobičajeno', 230000, 'kuca2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `korisnicko_ime` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ime`, `prezime`, `email`, `korisnicko_ime`, `password`) VALUES
(8, 'Slobodan', 'Stašević', 'mare@gmail.com', 'marwa', '$2y$10$gThMk5JbNoICLChm/aLxY..ngexiWaRup/Xroe4593enkz8ew8LNO'),
(9, 'Sava', 'Savic', 's@gmail.com', 'Sasuke', '$2y$10$attesKg4OAamjZweCr/xzO3GNBIlvT8PUPmgBtHbUrXzGiN4ZoZoW'),
(10, 'aca', 'acic', 'a@gmail.com', 'Acko', '$2y$10$huN8ZzVXaRrQ0x7zLD/k8u8k/tHAIQT2XTkCJ2T2sa9/Wj.9lmkWe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userpost_FK` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `userpost_FK` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
