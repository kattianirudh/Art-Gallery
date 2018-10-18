-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2018 at 07:43 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `art_gallery`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_count` (IN `custid` INT, IN `artid` INT, IN `newcount` INT)  MODIFIES SQL DATA
    COMMENT 'updates or inserts into the purchases '
BEGIN
    DECLARE oldcount INT DEFAULT 0;
    declare updatecount INT;
SELECT 
    purchases.count
INTO oldcount FROM
    purchases
WHERE
    purchases.id = custid
        AND purchases.art_id = artid; IF oldcount = 0 THEN
INSERT INTO purchases(id,art_id,count)
VALUES(custid, artid, newcount); ELSE
SET
    updatecount = newcount + oldcount;
UPDATE purchases 
SET 
    purchases.count = updatecount
WHERE
    purchases.id = custid
        AND purchases.art_id = artid;
END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `art`
--

CREATE TABLE `art` (
  `art_id` int(11) NOT NULL,
  `art_title` varchar(50) NOT NULL,
  `artist` varchar(50) NOT NULL,
  `art_type` varchar(30) NOT NULL,
  `art_price` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `art`
--

INSERT INTO `art` (`art_id`, `art_title`, `artist`, `art_type`, `art_price`, `seller_id`, `stock`) VALUES
(1, 'The Scream', 'Edvard Munch', 'painting', 1000, 4, 9),
(2, 'Starry Night', 'Vincent van Gogh', 'painting', 1200, 2, 10),
(3, 'Mona Lisa', 'Leonardo da Vinci', 'painting', 9900, 3, 10),
(4, 'The Persistence of Memory', 'Salvador Dali', 'painting', 7000, 1, 10),
(5, 'The Last Supper', 'Leonardo da Vinci', 'painting', 4400, 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `art_description`
--

CREATE TABLE `art_description` (
  `art_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `year` int(4) NOT NULL,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `art_description`
--

INSERT INTO `art_description` (`art_id`, `description`, `year`, `photo`) VALUES
(1, 'The Scream is the popular name given to each of four versions of a composition, created as both paintings and pastels, by Norwegian Expressionist artist Edvard Munch between 1893 and 1910. The German title Munch gave these works is Der Schrei der Natur (The Scream of Nature). The works show a figure with an agonized expression against a landscape with a tumultuous orange sky. Arthur Lubow has described The Scream as \"an icon of modern art, a Mona Lisa for our time.\"', 1893, 'scream_edvard_munch.jpg'),
(2, 'The Starry Night is an oil on canvas by the Dutch post-impressionist painter Vincent van Gogh. Painted in June 1889, it depicts the view from the east-facing window of his asylum room at Saint-Rémy-de-Provence, just before sunrise, with the addition of an idealized village. It has been in the permanent collection of the Museum of Modern Art in New York City since 1941, acquired through the Lillie P. Bliss Bequest. It is regarded as among Van Gogh\'s finest works  and is one of the most recognized paintings in the history of Western culture.', 1889, 'starrynight_van_gogh.jpg'),
(3, 'The Mona Lisa is a half-length portrait painting by the Italian Renaissance artist Leonardo da Vinci that has been described as \"the best known, the most visited, the most written about, the most sung about, the most parodied work of art in the world\".', 1503, 'monalisa_davinci_sq.jpg'),
(4, 'The Persistence of Memory is a 1931 painting by artist Salvador Dalí, and is one of his most recognizable works. First shown at the Julien Levy Gallery in 1932, since 1934 the painting has been in the collection of the Museum of Modern Art (MoMA) in New York City, which received it from an anonymous donor. It is widely recognized and frequently referenced in popular culture, and sometimes referred to by more descriptive titles, such as \'Melting Clocks\', \'The Soft Watches\', or \'The Melting Watches\'.', 1931, 'persistenceofmemory_salvadordali.jpg'),
(5, 'The Last Supper is a late 15th-century mural painting by Leonardo da Vinci housed by the refectory of the Convent of Santa Maria delle Grazie in Milan. It is one of the world\'s most recognizable paintings. The painting represents the scene of The Last Supper of Jesus with his apostles, as it is told in the Gospel of John, 13:21. Leonardo has depicted the consternation that occurred among the Twelve Disciples when Jesus announced that one of them would betray him.', 1497, 'lastsupper_davinci.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `username`, `password`, `name`, `phone`, `address`) VALUES
(3, 'pavan', '$2y$10$akWqD.Xz80fAxlVYCFd.reNQ7HjRn.8WkUlLJG/Kf/bnT0hvEKdLq', 'Pavan Rao', '8762557980', 'Bangalore'),
(4, 'shaky', '$2y$10$JOzyXV4ybcblEzRg.fDUFulLvszaynrtQxIhRSJ/gWQB8jDXnevk2', 'Pavan Shekar', '9731675767', 'Bangalore'),
(5, 'cena', '$2y$10$DzWXleSxzSBPG6DQ7B50JOLEZadsODaM5Eut6kHeZly9Eh.fdlnBG', 'John Cena', '1001001001', 'Vegas'),
(6, 'steve', '$2y$10$X.hCCeH2.DjW0V6JSrHCReC.CNg25kI7UE0VFgHtI8tRF4tNk8PlK', 'Steve', '9119911911', 'Washington'),
(7, 'kushal', '$2y$10$l31zP4RMTAW.mtffe9TZvus54hNbtCG0Tt6R7de98P.DdARga82qm', 'Steve Buscemi', '9871236789', 'Bangalore'),
(8, 'nischal', '$2y$10$glEtpakkUbtoD13dTWwEuue4NlbsC0fdvOh88eUo9EeZRp9RUTpdm', 'Nischal', '9876754561', 'Bangalore'),
(9, 'katti', '$2y$10$nsVWGwMk2Tyfc1MObuCBCuLoBpsNVgu5RX5WrAY0A96Vp8hpazp5.', 'Anirudh', '9738436861', 'las vegas'),
(10, 'nikhil', '$2y$10$EnZw3U8YEU1bKzTlqMaYZ.3dtGJw2tEnaBxFr5MleEiX6pfOunFFa', 'nikhil', '8762656471', 'Here'),
(11, 'basketboss', '$2y$10$Afbfu9EM5MyL307W/k37ROlQ9KChIuPHESXjHLvGxD3xZ6MuBPBqS', 'Skund', '9877923221', 'Charlotte');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `count` int(11) DEFAULT '1',
  `purchase_amt` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `art_id`, `count`, `purchase_amt`) VALUES
(3, 5, 3, 13200),
(5, 4, 48, 336000),
(9, 1, 3, 3000),
(9, 2, 3, 3600),
(9, 4, 2, 14000),
(10, 1, 1, 100000),
(10, 2, 3, 360000),
(11, 3, 100, 99000000);

--
-- Triggers `purchases`
--
DELIMITER $$
CREATE TRIGGER `calc_amt_insert_trig` BEFORE INSERT ON `purchases` FOR EACH ROW BEGIN
DECLARE price1 INT DEFAULT 0;
SELECT
    art.art_price
INTO price1
FROM
    art
WHERE
    art.art_id = new.art_id;
set new.purchase_amt = new.count * price1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calc_amt_update_trig` BEFORE UPDATE ON `purchases` FOR EACH ROW BEGIN
DECLARE price1 INT DEFAULT 0;
SELECT
    art.art_price
INTO price1
FROM
    art
WHERE
    art.art_id = new.art_id;
set new.purchase_amt = new.count * price1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `seller_id` int(11) NOT NULL,
  `seller_name` varchar(30) NOT NULL,
  `seller_phone` varchar(10) NOT NULL,
  `seller_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`seller_id`, `seller_name`, `seller_phone`, `seller_address`) VALUES
(1, 'Gurunandan', '9980866966', 'RR Nagar'),
(2, 'Krishna', '9986490130', 'Girinagar'),
(3, 'Karty', '8105940141', 'Hosakerehalli'),
(4, 'Anirudh', '9738436861', 'Jayanagar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `art`
--
ALTER TABLE `art`
  ADD PRIMARY KEY (`art_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `art_description`
--
ALTER TABLE `art_description`
  ADD UNIQUE KEY `art_id` (`art_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cust_phone` (`phone`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`,`art_id`) USING BTREE,
  ADD KEY `art_id` (`art_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`seller_id`),
  ADD UNIQUE KEY `seller_phone` (`seller_phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `art`
--
ALTER TABLE `art`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `art`
--
ALTER TABLE `art`
  ADD CONSTRAINT `art_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`seller_id`) ON UPDATE CASCADE;

--
-- Constraints for table `art_description`
--
ALTER TABLE `art_description`
  ADD CONSTRAINT `art_id` FOREIGN KEY (`art_id`) REFERENCES `art` (`art_id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`art_id`) REFERENCES `art` (`art_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
