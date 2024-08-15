-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2024 at 11:20 PM
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
(6, 2, 'Porodicna kuca - Novi Sad', 'Prodaja', 'Lepa porodicna kuca u Novom Sadu koja moze komotno da udomi porodicu od 4 clana.\r\nMnogo kul, ja bih je kupio da mi treba.', 'Kraljevo', 'Heroja Maricica', '23', 60, 4, 'Struja', 'ima', 'ima', 'ima', 2, 'Novo', 20000, 'kuca.jpg'),
(7, 3, 'Markova kuca', 'Iznajmljivanje', 'Mnogo dobra', 'Mnogo jaka', 'Mnogo velika', '2003', 1000, 5, 'struja', 'ima', 'ima', 'ima', 9, 'Uobičajeno', 230, 'kuca2.jpg'),
(8, 5, 'Jovanina kuca', 'Prodaja', 'Lol', 'Zubin potok', 'Dragomira Despića', '26', 200, 3, 'ostalo', 'ima', 'nema', 'nema', 4, 'luksuzno', 250000, 'planinskakuca.jpg'),
(11, 5, 'Brda dobra kuca', 'Iznajmljivanje', 'Najiskrenije predobra kuca', 'Predobra lokacija', 'Najbolja ulica', '99', 5000, 10, 'struja', 'ima', 'ima', 'ima', 1, 'uobičajeno', 550, 'monta.jpg'),
(16, 8, 'Montažna kuća', 'Iznajmljivanje', 'Skoro renovirano. Priča se da ju je komšija preko puta nedavno demolirao.', 'Subotica', 'Dragomira Despića', '2', 450, 3, 'gas', 'ima', '0', '0', 1, 'renovirano', 200, 'montaznakucaa.jpg');

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
(3, 'Marko', 'Antonijevic', 'mabe.antonijevic@gmail.com', 'MarkoA522', '$2y$10$dgCeAX2mgeVzroYSXMuhGusXtsKRVUolFKpfRT5UUZ1llqtmf/8bm'),
(4, 'Marko', 'Antonijevic', 'marko@gmail.com', 'MarkoA521', '$2y$10$ObG7l2M88PZaMM0HO89szuh7YXRxmtsC2Zsjagk2/1eKpM/n1yhxe'),
(5, 'Jovana', 'Markovic', 'jovana@gmail.com', 'jovana', '$2y$10$sZ2N3JZyHmf2UV8mzunCTeD/oGZ3q6a5fiGAvs2zEs2zJlmFRUMOO'),
(6, 'Slavica', 'Jero', 'slavica@gmail.com', '2e21', '$2y$10$.ryScq4r3.Sg.pL5CgxesOmaXd3Xhw7ShZyA33eZZOz.BNeR.77Ji'),
(7, 'mdm', 'mdmm', 'mdm@gmail.com', 'mara', '$2y$10$G2q7zhT4lJWDdj2.uc42Gu6aJTNLU6XFyLQugsOkXAfnCFVQfm0ba'),
(8, 'Slobodan', 'Stašević', 'mare@gmail.com', 'marwa', '$2y$10$gThMk5JbNoICLChm/aLxY..ngexiWaRup/Xroe4593enkz8ew8LNO');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
