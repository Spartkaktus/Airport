-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 01:12 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airport`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `airport_personel`
--

CREATE TABLE `airport_personel` (
  `Personel_id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Surname` varchar(30) NOT NULL,
  `Pesel` decimal(11,0) NOT NULL,
  `Occupation` varchar(40) NOT NULL,
  `Date_of_employment` date NOT NULL,
  `End_of_contract` date DEFAULT NULL,
  `Contract_type` enum('Full-time','Part-time') NOT NULL,
  `Salary` float NOT NULL,
  `Additional_information` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airport_personel`
--

INSERT INTO `airport_personel` (`Personel_id`, `Name`, `Surname`, `Pesel`, `Occupation`, `Date_of_employment`, `End_of_contract`, `Contract_type`, `Salary`, `Additional_information`) VALUES
(1, 'Adam', 'Nowak', 97011614548, 'Cashier', '2020-05-30', '2025-06-01', 'Full-time', 5520.5, 'Five year contract');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `flights`
--

CREATE TABLE `flights` (
  `Flight_id` int(11) NOT NULL,
  `Register_number` char(20) NOT NULL,
  `Destination` varchar(30) NOT NULL,
  `Date_of_departure` date NOT NULL,
  `Departure_time` time NOT NULL,
  `Departure_Gate` enum('1','2','3','4','5') NOT NULL,
  `Price` float NOT NULL,
  `Pilots_id` int(11) NOT NULL,
  `Plane_id` int(11) NOT NULL,
  `Flight_status` enum('finished','pending','delayed','cancelled','ongoing') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pilots`
--

CREATE TABLE `pilots` (
  `Pilots_id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Surname` varchar(30) NOT NULL,
  `Pesel` decimal(11,0) NOT NULL,
  `Plane_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `planes`
--

CREATE TABLE `planes` (
  `Plane_id` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Last_checkup_date` date NOT NULL,
  `Amount_of_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`Plane_id`, `Name`, `Last_checkup_date`, `Amount_of_seats`) VALUES
(0, 'Boeing', '2023-12-17', 123),
(1, 'ww', '2023-12-17', 3),
(2, 'qwe', '2023-12-17', 43);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `User_id` int(11) NOT NULL,
  `Login` varchar(30) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Level_of_access` enum('Admin','Employee','Customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_id`, `Login`, `Password`, `Level_of_access`) VALUES
(1, 'dawido', 'qweryy', 'Customer'),
(2, 'admin', 'admin', 'Admin'),
(3, 'test', 'test', 'Employee'),
(4, 'ak2', 'ak2', 'Customer'),
(5, 'usun', 'usun', 'Employee'),
(6, 'usun2', 'usun2', 'Employee');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `airport_personel`
--
ALTER TABLE `airport_personel`
  ADD PRIMARY KEY (`Personel_id`);

--
-- Indeksy dla tabeli `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`Flight_id`),
  ADD KEY `IX_Relationship3` (`Pilots_id`),
  ADD KEY `IX_Relationship4` (`Plane_id`);

--
-- Indeksy dla tabeli `pilots`
--
ALTER TABLE `pilots`
  ADD PRIMARY KEY (`Pilots_id`),
  ADD KEY `IX_Relationship5` (`Plane_id`);

--
-- Indeksy dla tabeli `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`Plane_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airport_personel`
--
ALTER TABLE `airport_personel`
  MODIFY `Personel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `Flight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pilots`
--
ALTER TABLE `pilots`
  MODIFY `Pilots_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `Pilots-Flights` FOREIGN KEY (`Pilots_id`) REFERENCES `pilots` (`Pilots_id`),
  ADD CONSTRAINT `Planes-Flights` FOREIGN KEY (`Plane_id`) REFERENCES `planes` (`Plane_id`);

--
-- Constraints for table `pilots`
--
ALTER TABLE `pilots`
  ADD CONSTRAINT `Planes-Pilots` FOREIGN KEY (`Plane_id`) REFERENCES `planes` (`Plane_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
