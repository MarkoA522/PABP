-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 11:56 PM
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
-- Database: `login_register`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `naslov` varchar(255) NOT NULL,
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
  `naslovnaslika` varchar(255) DEFAULT NULL,
  `dodatnaslika` varchar(255) DEFAULT NULL,
  `dodatnaslika1` varchar(255) DEFAULT NULL,
  `dodatnaslika2` varchar(255) DEFAULT NULL,
  `dodatnaslika3` varchar(255) DEFAULT NULL,
  `dodatnaslika4` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `id_user`, `naslov`, `opis`, `lokacija`, `ulica`, `brojulice`, `povrsina`, `brojsoba`, `tipgrejanja`, `internet`, `telefonskalinija`, `kablovska`, `brojspratova`, `stanjenekretnine`, `cena`, `naslovnaslika`, `dodatnaslika`, `dodatnaslika1`, `dodatnaslika2`, `dodatnaslika3`, `dodatnaslika4`) VALUES
(6, 2, 'Porodicna kuca - Novi Sad', 'Lepa porodicna kuca u Novom Sadu koja moze komotno da udomi porodicu od 4 clana.\r\nMnogo kul, ja bih je kupio da mi treba.', 'Kraljevo', 'Heroja Maricica', '23', 60, 4, 'Struja', 'ima', 'ima', 'ima', 2, 'Novo', 20000, 'kuca.jpg', NULL, NULL, NULL, NULL, NULL);

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
(1, 'Stefan', 'Simijonovic', 'stefan.simi@gmail.com', 'Stefke', '$2y$10$G6scpIpKAhpoOwQSBZvOEunL8dhF3UvzbwXngCvmNseqNmGOVuEn.'),
(2, 'Andrija', 'Andrijanovic', 'andrija.andrija@gmail.com', 'Andro', '$2y$10$ypIWKNfK4GUk3DaZD9G.VOU5js09pCOYskBUyBN1Wx50Dorqh0aFS'),
(3, 'Marko', 'Antonijevic', 'mabe.antonijevic@gmail.com', 'MarkoA522', '$2y$10$dgCeAX2mgeVzroYSXMuhGusXtsKRVUolFKpfRT5UUZ1llqtmf/8bm');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
