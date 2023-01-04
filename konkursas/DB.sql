-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 10:05 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projektas`
--

-- --------------------------------------------------------

--
-- Table structure for table `kompetencijos`
--

CREATE TABLE `kompetencijos` (
  `id` int(5) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kompetencijos`
--

INSERT INTO `kompetencijos` (`id`, `name`) VALUES
(1, 'spalvos'),
(2, 'kompozicija'),
(3, 'tema'),
(4, 'orginalumas'),
(5, 'technika');

-- --------------------------------------------------------

--
-- Table structure for table `konkursas`
--

CREATE TABLE `konkursas` (
  `id` int(5) NOT NULL,
  `pavadinimas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konkursas`
--

INSERT INTO `konkursas` (`id`, `pavadinimas`) VALUES
(8, 'gamta'),
(9, 'Buitis');

-- --------------------------------------------------------

--
-- Table structure for table `konkurso_vertintojai`
--

CREATE TABLE `konkurso_vertintojai` (
  `konkursas` int(5) NOT NULL,
  `vertina` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konkurso_vertintojai`
--

INSERT INTO `konkurso_vertintojai` (`konkursas`, `vertina`) VALUES
(8, 1),
(8, 3),
(8, 10),
(8, 13),
(8, 15),
(9, 1),
(9, 4),
(9, 7),
(9, 11),
(9, 13);

-- --------------------------------------------------------

--
-- Table structure for table `piesiniai`
--

CREATE TABLE `piesiniai` (
  `id` int(5) NOT NULL,
  `pavadinimas` varchar(60) NOT NULL,
  `komentaras` text NOT NULL,
  `autorius` int(5) NOT NULL,
  `balas` float DEFAULT NULL,
  `konkursas` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `piesiniai`
--

INSERT INTO `piesiniai` (`id`, `pavadinimas`, `komentaras`, `autorius`, `balas`, `konkursas`) VALUES
(19, 'uploads/gamta/638483b0df43c1.32527743.jpg', 'Piešinio pavadinimas \"Džiunglės\". Jos atspindi mano dvasinę ramybę.', 1, 8.6, 8),
(20, 'uploads/gamta/638483ff5fc2f7.36441984.jpg', 'Piešiau mišką ir jo ramų gyvenimą. ', 1, 8.2, 8),
(21, 'uploads/gamta/63848f5aae6ee4.86596613.jpg', 'Piešiau egzotiką. Pavadinimas - \"Raudona\".', 29, 6.4, 8),
(22, 'uploads/gamta/63848f8bd32454.66761997.jpg', 'Piešinio pavadinimas - \"Kruvinas Ruduo\"', 29, 7.8, 8),
(23, 'uploads/gamta/6384901766fa60.88451933.jpg', 'Saulėlydis', 3, 9.4, 8),
(24, 'uploads/gamta/638490328f1465.24694971.jpg', 'Tolyn', 3, 7.6, 8),
(25, 'uploads/gamta/6384904680cec2.34075406.jpg', 'Vingiuotas kelias', 3, 7.6, 8),
(26, 'uploads/gamta/63849066752335.41627287.jpg', 'Debesuotas kalnas', 3, 9, 8),
(27, 'uploads/gamta/6384907bba9e45.74675510.jpg', 'Susijungimas su Gamta', 3, 7.6, 8),
(28, 'uploads/gamta/638490d1088354.58035760.jpg', 'Jungas', 3, 8.6, 8),
(29, 'uploads/gamta/6384913b890de2.60046204.jpg', 'Piešinio pavadinimas - \"Laisvė gamtai\"', 30, 9.4, 8),
(30, 'uploads/gamta/6384914e3b7603.95748700.jpg', 'Piešinio pavadinimas - \"Diena ir naktis\"', 30, 8.2, 8),
(31, 'uploads/gamta/6384916318e343.28575830.jpg', 'Piešinio pavadinimas - \"Gamtos Veidas\"', 30, 8.8, 8),
(32, 'uploads/gamta/6384c756e132a4.35226820.jpg', 'Piešinys - Raudonas kelias', 1, NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `privilegijos`
--

CREATE TABLE `privilegijos` (
  `id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `privilegijos`
--

INSERT INTO `privilegijos` (`id`, `name`) VALUES
(1, 'dalyvis'),
(5, 'vertintojas'),
(9, 'administratorius');

-- --------------------------------------------------------

--
-- Table structure for table `vartotojai`
--

CREATE TABLE `vartotojai` (
  `id` int(5) NOT NULL,
  `email` varchar(40) NOT NULL,
  `psw` varchar(60) NOT NULL,
  `name` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `privilegijos` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vartotojai`
--

INSERT INTO `vartotojai` (`id`, `email`, `psw`, `name`, `lastname`, `date`, `privilegijos`) VALUES
(1, 'i.grazulis@ktu.edu', '$2y$10$GyfV./tanmDs9SgitpApUOcI897r49DnxIB0JJVxwk9RDmWHLfdd2', 'Ignas', 'Gražulis', '2001-10-17', 1),
(3, 'stud@ktu.edu', '$2y$10$SKOz8H/7ouaL6qZBlx/eYe2OaDVN5tZ6iBGoEqpCHYGkTcQ82iCum', 'Stud', 'Stud', '2022-11-09', 1),
(4, 'stud@ktu.lt', '$2y$10$Y0XQnFr3E.Nq52h2rutbS.I/Qu2x4hjx.O7nf52SwR.wAep.ICJPG', 'Stud', 'Stud', '2022-11-10', 1),
(5, 'stud1@ktu.lt', '$2y$10$1tKB.D7INIric4nDeq71s.Ynd.loxYYdVy2ZcnBvUORocF.GJJj92', 'Stud1', 'stud1', '2022-11-17', 1),
(6, 'admin@ktu.lt', '$2y$10$Gl3Ut9U9tT8qz94tfGc76.wi.152/3rZIKYV5ZSW6vmlRb2poq6hm', 'admin', 'admin', '2022-11-01', 9),
(7, 'vert@ktu.lt', '$2y$10$CpgIeDnfKpH.IsA/OXiKAOL3bjONmvdV8tsQH9t6O33Rdlq3z2KVi', 'Vertintojas', 'Vert', '2022-11-14', 5),
(8, 'vert2@ktu.lt', '$2y$10$GWo0xdUwCyZoICtoJNfySOn5pjgcwoGViUEDTwe5NwQa5HkHgryGK', 'Vertintojas2', 'Vert', '2022-11-15', 5),
(9, 'vert3@ktu.lt', '$2y$10$I.4uhj6wGlrl2DAs5HzyBeVxIJfhL7jcBBMeUYS1WHpvnCkDvrePC', 'Vertintojas3', 'Vert', '2022-11-27', 5),
(10, 'vert4@ktu.lt', '$2y$10$f5R.qlKBYmD57uXKZxU7d.v8Bi9udPcpBZG.b24bzutpkBFC9Ig.K', 'Vertintojas4', 'Vert', '2022-11-27', 5),
(11, 'vert5@ktu.lt', '$2y$10$HLsHMm.udPC/iNkqv/9lL.qFiV3loAf.p2edB9M3MPAJkjnWVeFYy', 'Vertintojas5', 'Vert', '2022-11-27', 5),
(12, 'vert6@ktu.lt', '$2y$10$BWFngtMUvv0IZw.UPKEHx.fMIR4sagQeGLkGlHrpH4/U4CQ6RNlIa', 'Vertintojas6', 'Vert', '2022-11-27', 5),
(28, 'vert7@ktu.lt', '$2y$10$mS1A2tDWhJHRC6tGV.7vS.RFGub66ZZWWC2zv.Hiawsy53AVKsYma', 'Vertintojas7', 'Vert', '2022-11-27', 5),
(29, 'stud2@ktu.edu', '$2y$10$iSWDxwpxpcgze4CaxSi8Q.WI0haVqemGVlBAlr5XF6COFW5nyXWoy', 'Stud2', 'Stud', '2012-10-03', 1),
(30, 'stud3@ktu.edu', '$2y$10$DFM9shezS0PlmQe4lEl5Q.53YpD1fGGI/EazJPr9AiwAch/5kbzQG', 'Stud3', 'Stud', '2006-05-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vertinimai`
--

CREATE TABLE `vertinimai` (
  `piesinys` int(5) NOT NULL,
  `vertintojas` int(5) NOT NULL,
  `balas` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vertinimai`
--

INSERT INTO `vertinimai` (`piesinys`, `vertintojas`, `balas`) VALUES
(19, 1, 8),
(19, 3, 9),
(19, 10, 10),
(19, 13, 8),
(19, 15, 8),
(20, 1, 10),
(20, 3, 7),
(20, 10, 10),
(20, 13, 9),
(20, 15, 5),
(21, 1, 8),
(21, 3, 6),
(21, 10, 8),
(21, 13, 6),
(21, 15, 4),
(22, 1, 9),
(22, 3, 8),
(22, 10, 9),
(22, 13, 8),
(22, 15, 5),
(23, 1, 10),
(23, 3, 9),
(23, 10, 10),
(23, 13, 10),
(23, 15, 8),
(24, 1, 8),
(24, 3, 6),
(24, 10, 10),
(24, 13, 7),
(24, 15, 7),
(25, 1, 7),
(25, 3, 8),
(25, 10, 9),
(25, 13, 8),
(25, 15, 6),
(26, 1, 9),
(26, 3, 9),
(26, 10, 10),
(26, 13, 9),
(26, 15, 8),
(27, 1, 9),
(27, 3, 8),
(27, 10, 8),
(27, 13, 7),
(27, 15, 6),
(28, 1, 9),
(28, 3, 10),
(28, 10, 8),
(28, 13, 8),
(28, 15, 8),
(29, 1, 10),
(29, 3, 10),
(29, 10, 7),
(29, 13, 10),
(29, 15, 10),
(30, 1, 9),
(30, 3, 8),
(30, 10, 8),
(30, 13, 7),
(30, 15, 9),
(31, 1, 9),
(31, 3, 9),
(31, 10, 8),
(31, 13, 9),
(31, 15, 9);

-- --------------------------------------------------------

--
-- Table structure for table `vertintoju_kompetencijos`
--

CREATE TABLE `vertintoju_kompetencijos` (
  `id` int(5) NOT NULL,
  `vertintojas` int(5) NOT NULL,
  `kompetencijos` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vertintoju_kompetencijos`
--

INSERT INTO `vertintoju_kompetencijos` (`id`, `vertintojas`, `kompetencijos`) VALUES
(1, 7, 1),
(2, 7, 2),
(3, 8, 2),
(4, 8, 3),
(6, 9, 1),
(7, 9, 2),
(8, 28, 4),
(9, 28, 5),
(10, 10, 3),
(11, 10, 4),
(12, 11, 1),
(13, 11, 5),
(14, 12, 3),
(15, 12, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kompetencijos`
--
ALTER TABLE `kompetencijos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konkursas`
--
ALTER TABLE `konkursas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konkurso_vertintojai`
--
ALTER TABLE `konkurso_vertintojai`
  ADD PRIMARY KEY (`konkursas`,`vertina`),
  ADD KEY `vertina` (`vertina`);

--
-- Indexes for table `piesiniai`
--
ALTER TABLE `piesiniai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pavadinimas` (`pavadinimas`),
  ADD KEY `autorius` (`autorius`),
  ADD KEY `konkursas` (`konkursas`);

--
-- Indexes for table `privilegijos`
--
ALTER TABLE `privilegijos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vartotojai`
--
ALTER TABLE `vartotojai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id` (`id`),
  ADD KEY `privilegijos` (`privilegijos`);

--
-- Indexes for table `vertinimai`
--
ALTER TABLE `vertinimai`
  ADD PRIMARY KEY (`piesinys`,`vertintojas`),
  ADD KEY `vertintojas` (`vertintojas`);

--
-- Indexes for table `vertintoju_kompetencijos`
--
ALTER TABLE `vertintoju_kompetencijos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kompetencijos` (`kompetencijos`),
  ADD KEY `vertintojas` (`vertintojas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kompetencijos`
--
ALTER TABLE `kompetencijos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `konkursas`
--
ALTER TABLE `konkursas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `piesiniai`
--
ALTER TABLE `piesiniai`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `vartotojai`
--
ALTER TABLE `vartotojai`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vertintoju_kompetencijos`
--
ALTER TABLE `vertintoju_kompetencijos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `konkurso_vertintojai`
--
ALTER TABLE `konkurso_vertintojai`
  ADD CONSTRAINT `konkurso_vertintojai_ibfk_1` FOREIGN KEY (`konkursas`) REFERENCES `konkursas` (`id`),
  ADD CONSTRAINT `konkurso_vertintojai_ibfk_2` FOREIGN KEY (`vertina`) REFERENCES `vertintoju_kompetencijos` (`id`);

--
-- Constraints for table `piesiniai`
--
ALTER TABLE `piesiniai`
  ADD CONSTRAINT `piesiniai_ibfk_1` FOREIGN KEY (`autorius`) REFERENCES `vartotojai` (`id`),
  ADD CONSTRAINT `piesiniai_ibfk_2` FOREIGN KEY (`konkursas`) REFERENCES `konkursas` (`id`);

--
-- Constraints for table `vartotojai`
--
ALTER TABLE `vartotojai`
  ADD CONSTRAINT `vartotojai_ibfk_1` FOREIGN KEY (`privilegijos`) REFERENCES `privilegijos` (`id`);

--
-- Constraints for table `vertinimai`
--
ALTER TABLE `vertinimai`
  ADD CONSTRAINT `vertinimai_ibfk_1` FOREIGN KEY (`piesinys`) REFERENCES `piesiniai` (`id`),
  ADD CONSTRAINT `vertinimai_ibfk_2` FOREIGN KEY (`vertintojas`) REFERENCES `konkurso_vertintojai` (`vertina`);

--
-- Constraints for table `vertintoju_kompetencijos`
--
ALTER TABLE `vertintoju_kompetencijos`
  ADD CONSTRAINT `vertintoju_kompetencijos_ibfk_1` FOREIGN KEY (`kompetencijos`) REFERENCES `kompetencijos` (`id`),
  ADD CONSTRAINT `vertintoju_kompetencijos_ibfk_2` FOREIGN KEY (`vertintojas`) REFERENCES `vartotojai` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
