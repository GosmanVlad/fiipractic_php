-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mai 04, 2020 la 05:59 PM
-- Versiune server: 10.4.11-MariaDB
-- Versiune PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `rental`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `carid` int(11) NOT NULL,
  `data` varchar(255) NOT NULL,
  `data_predare` varchar(255) NOT NULL,
  `location` int(11) NOT NULL,
  `additions` text NOT NULL,
  `phone` int(30) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `carid`, `data`, `data_predare`, `location`, `additions`, `phone`, `approved`) VALUES
(11, 'Vlad', 1, '2/04/2020', '7/04/2020', 1, '', 321321, 0),
(13, 'Vlad', 1, '28/03/2020', '29/03/2020', 1, '', 0, 0),
(14, 'Vlad', 1, '8/04/2020', '20/04/2020', 1, 'test', 0, 1),
(15, 'Vlad', 1, '6/05/2020', '26/05/2020', 1, 'Test', 123231, 0);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `combustible` varchar(20) NOT NULL DEFAULT 'Benzina',
  `seats` int(11) NOT NULL DEFAULT 5,
  `consumption` int(11) NOT NULL DEFAULT 6,
  `engine_capacity` int(11) NOT NULL DEFAULT 1300,
  `facilities` text NOT NULL,
  `image` varchar(100) NOT NULL DEFAULT 'none.png',
  `transmission` varchar(25) NOT NULL DEFAULT 'Manuala',
  `price` int(11) NOT NULL DEFAULT 20,
  `power` int(11) NOT NULL DEFAULT 95
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `cars`
--

INSERT INTO `cars` (`id`, `name`, `category`, `combustible`, `seats`, `consumption`, `engine_capacity`, `facilities`, `image`, `transmission`, `price`, `power`) VALUES
(1, 'Renault Zoe', 1, 'Electric', 5, 6, 1200, 'Geamuri electrice<br>\r\nIncalzire in scaune<br>\r\nIncalzire volan<br>\r\nScaun bebelus<br>', 'zoe.jpg', 'Manuala', 30, 95),
(2, 'Dacia Logan', 2, 'Benzina', 5, 4, 1200, '', 'logan.png', 'Manuala', 12, 95),
(3, 'Opel Astra G', 2, 'Benzina', 5, 7, 1400, 'Test1<br>\r\nTest2<br>\r\nTest3', 'astra_g.jpg', 'Manuala', 20, 93);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `cars_category`
--

CREATE TABLE `cars_category` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `cars_category`
--

INSERT INTO `cars_category` (`id`, `name`) VALUES
(1, 'Micro'),
(2, 'Sedan'),
(3, 'SUV'),
(4, 'Hatchback'),
(5, 'Pickup'),
(6, 'Break');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `car_feedback`
--

CREATE TABLE `car_feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `carid` int(11) NOT NULL,
  `feedback` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `car_feedback`
--

INSERT INTO `car_feedback` (`id`, `name`, `email`, `carid`, `feedback`) VALUES
(4, 'Vlad', 'test@yahoo.com', 0, 'test'),
(5, 'Vlad', 'test@yahoo.com', 2, 'test'),
(6, 'Vlad', 'test@yahoo.com', 1, 'test'),
(7, 'Vlad', 'test@yahoo.com', 1, 'sal'),
(8, 'Vlad', 'test@yahoo.com', 1, 'test');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `locations`
--

INSERT INTO `locations` (`id`, `location`) VALUES
(1, 'Aeroport - Iasi'),
(2, 'Aeroport - Bucuresti'),
(3, 'Iasi - Valea Adanca');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `oldPrice` int(11) NOT NULL,
  `newPrice` int(11) NOT NULL DEFAULT 10,
  `until` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `promotions`
--

INSERT INTO `promotions` (`id`, `car_id`, `oldPrice`, `newPrice`, `until`) VALUES
(1, 1, 40, 30, '4/04/2021');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `feedback`, `email`) VALUES
(1, 'Vlad', 'Servicii de calitate, masini foarte bine intretinute!', 'test email'),
(7, 'Vlad', 'Servicii de calitate, masini foarte bine intretinute!', 'test email'),
(8, 'Vlad', 'Servicii de calitate, masini foarte bine intretinute!', 'test email'),
(9, 'Test', 'test', 'test'),
(10, 'ttt', 'tttt', 'ttt');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0,
  `premium` int(11) NOT NULL DEFAULT 0,
  `employee` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `admin`, `premium`, `employee`) VALUES
(6, 'Vlad', 'c8837b23ff8aaa8a2dde915473ce0991', 'test@yahoo.com', 1, 0, 0);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `cars_category`
--
ALTER TABLE `cars_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `car_feedback`
--
ALTER TABLE `car_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pentru tabele `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pentru tabele `cars_category`
--
ALTER TABLE `cars_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pentru tabele `car_feedback`
--
ALTER TABLE `car_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pentru tabele `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pentru tabele `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pentru tabele `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
