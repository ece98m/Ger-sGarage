-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Ağu 2023, 09:38:42
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `gersgarage`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'ger1234', '1234'),
(2, 'ger1234', '$2y$10$yXfIoOne8BJ.AT4C5EO3MuU6TZRsKuW/FhpKdckRF9vs2d9SXvEYW'),
(3, 'ger1234', '$2y$10$Bu7XpYngJq2hagjNGBDrUeYXeJsCjdkXjxshJ03w682o5o7LmqAbG'),
(4, 'ger1234', '$2y$10$2bwrvp1ke9d8/5qnhj2JvOjR.ZkksWRd48iAfClhtjBIwmglk2d/S'),
(5, 'ger1234', '$2y$10$jFHZYydIJzR2fMBitnSuT.UECKUWawckyCY.yuxpaXpzEVA609wla'),
(6, 'ger1234', '$2y$10$G2leUs6d5HM72tUt/BsNcupL.kOL1vSpRDfh0/LzF5CO.NJP/mg5e'),
(7, 'ger1234', '$2y$10$cIvSUAMLD.bN0vhUTYu7q.BXImg4Zhh/uaaBBhYst3kqd1MP1Edny');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `idbookings` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `invoice_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bookings`
--

CREATE TABLE `bookings` (
  `idbookings` int(11) NOT NULL,
  `idcustomers` int(11) NOT NULL,
  `idvehicles` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `service_id` int(11) NOT NULL,
  `customer_note` varchar(255) DEFAULT NULL,
  `id_mechanics` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `bookings`
--

INSERT INTO `bookings` (`idbookings`, `idcustomers`, `idvehicles`, `booking_date`, `service_id`, `customer_note`, `id_mechanics`, `status`) VALUES
(108, 1, 2, '2023-08-12', 1, 'test for tracking', 1, 2),
(109, 1, 44, '2023-08-12', 2, 'test2 for tracking status', 1, 1),
(110, 4, 45, '2023-08-12', 2, 'testttt', 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `booking_statuses`
--

CREATE TABLE `booking_statuses` (
  `Status_ID` int(11) NOT NULL,
  `Status_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `booking_statuses`
--

INSERT INTO `booking_statuses` (`Status_ID`, `Status_Name`) VALUES
(1, 'Booked'),
(2, 'In Service'),
(3, 'Fixed/Completed'),
(4, 'Collected'),
(5, 'Unrepairable/Scrapped');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customers`
--

CREATE TABLE `customers` (
  `idcustomers` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `mobile_phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `customers`
--

INSERT INTO `customers` (`idcustomers`, `firstname`, `surname`, `mobile_phone`, `email`, `password`) VALUES
(1, 'FATMA', 'Caliskan', '0860346695', 'gulcef.ece@gmail.com', '123'),
(2, 'FATMA', 'Caliskan', '0860346695', 'e@gmail.com', '123'),
(3, 'stone', 's', '086034669', 'stone@gmail.com', '2345'),
(4, 'suhail', 'asdd', '232434', 'suhail@gmail.com', 'abcd'),
(5, 'test', '1', 'a@t.com', 'test1@gmail.com', '12345'),
(6, 'a', 'c', '1233', 'a@gmail.com', '3456'),
(7, 'tlg', 's', '55666', 'tolg@gmail.com', '56789');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mechanics`
--

CREATE TABLE `mechanics` (
  `id_mechanics` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `mechanics`
--

INSERT INTO `mechanics` (`id_mechanics`, `firstname`, `surname`) VALUES
(1, 'Ahmet', 'Yılmaz'),
(2, 'Burak', 'Demir'),
(3, 'Cem', 'Kaya'),
(4, 'Deniz', 'Güneş');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `parts`
--

CREATE TABLE `parts` (
  `part_id` int(11) NOT NULL,
  `part_name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `parts`
--

INSERT INTO `parts` (`part_id`, `part_name`, `price`) VALUES
(1, 'Spark Plugs', 12.99),
(2, 'Oil Filter', 8.50),
(3, 'Air Filter', 49.99),
(4, 'Brake Pads', 45.75),
(6, 'Engine Oil', 35.99),
(7, 'Radiator', 95.50),
(8, 'Alternator', 120.00),
(9, 'Starter Motor', 85.75),
(10, 'Timing Belt', 25.50),
(11, 'Water Pump', 40.25),
(12, 'Fuel Pump', 55.80),
(13, 'Ignition Coil', 28.00),
(14, 'Shock Absorber', 75.00),
(15, 'Power Steering Pump', 90.00),
(16, 'Wheel Bearing', 22.50),
(17, 'Battery', 70.25),
(18, 'Fuel Injector', 38.50),
(19, 'Oxygen Sensor', 65.50),
(20, 'Throttle Body', 95.75);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `part_cost`
--

CREATE TABLE `part_cost` (
  `idPartCost` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `fixed_price` decimal(10,2) NOT NULL,
  `credit` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `fixed_price`, `credit`) VALUES
(1, 'Annual Service', 100.00, 1),
(2, 'Major Service', 200.00, 2),
(3, 'Repair / Fault', 75.00, 1),
(4, 'Major Repair', 300.00, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vehicles`
--

CREATE TABLE `vehicles` (
  `idvehicles` int(11) NOT NULL,
  `idcustomers` int(11) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `make` varchar(50) NOT NULL,
  `license` varchar(50) NOT NULL,
  `engine_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `vehicles`
--

INSERT INTO `vehicles` (`idvehicles`, `idcustomers`, `vehicle_type`, `make`, `license`, `engine_type`) VALUES
(2, 1, 'motorbike', 'audi', '45588', 'diesel'),
(43, 7, 'motorbike', 'audi', '65656', 'diesel'),
(44, 1, 'car', 'audi', '1234567', 'diesel'),
(45, 4, 'motorbike', 'bmw', '999999', 'diesel');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `idbookings` (`idbookings`);

--
-- Tablo için indeksler `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`idbookings`),
  ADD KEY `idcustomers` (`idcustomers`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `id_mechanics` (`id_mechanics`),
  ADD KEY `fk_bookings_status` (`status`),
  ADD KEY `bookings_ibfk_2` (`idvehicles`);

--
-- Tablo için indeksler `booking_statuses`
--
ALTER TABLE `booking_statuses`
  ADD PRIMARY KEY (`Status_ID`);

--
-- Tablo için indeksler `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`idcustomers`);

--
-- Tablo için indeksler `mechanics`
--
ALTER TABLE `mechanics`
  ADD PRIMARY KEY (`id_mechanics`);

--
-- Tablo için indeksler `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`part_id`);

--
-- Tablo için indeksler `part_cost`
--
ALTER TABLE `part_cost`
  ADD PRIMARY KEY (`idPartCost`),
  ADD KEY `part_id` (`part_id`),
  ADD KEY `part_cost_ibfk_2` (`bill_id`);

--
-- Tablo için indeksler `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Tablo için indeksler `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`idvehicles`),
  ADD KEY `idcustomers` (`idcustomers`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `bookings`
--
ALTER TABLE `bookings`
  MODIFY `idbookings` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- Tablo için AUTO_INCREMENT değeri `booking_statuses`
--
ALTER TABLE `booking_statuses`
  MODIFY `Status_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `customers`
--
ALTER TABLE `customers`
  MODIFY `idcustomers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `mechanics`
--
ALTER TABLE `mechanics`
  MODIFY `id_mechanics` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `parts`
--
ALTER TABLE `parts`
  MODIFY `part_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Tablo için AUTO_INCREMENT değeri `part_cost`
--
ALTER TABLE `part_cost`
  MODIFY `idPartCost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Tablo için AUTO_INCREMENT değeri `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `idvehicles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`idbookings`) REFERENCES `bookings` (`idbookings`);

--
-- Tablo kısıtlamaları `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`idcustomers`) REFERENCES `customers` (`idcustomers`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`idvehicles`) REFERENCES `vehicles` (`idvehicles`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `bookings_ibfk_4` FOREIGN KEY (`id_mechanics`) REFERENCES `mechanics` (`id_mechanics`),
  ADD CONSTRAINT `fk_bookings_status` FOREIGN KEY (`status`) REFERENCES `booking_statuses` (`Status_ID`);

--
-- Tablo kısıtlamaları `part_cost`
--
ALTER TABLE `part_cost`
  ADD CONSTRAINT `part_cost_ibfk_1` FOREIGN KEY (`part_id`) REFERENCES `parts` (`part_id`),
  ADD CONSTRAINT `part_cost_ibfk_2` FOREIGN KEY (`bill_id`) REFERENCES `bookings` (`idbookings`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`idcustomers`) REFERENCES `customers` (`idcustomers`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
