-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 03:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `customerrelationshipmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `ActivityID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `Type` varchar(50) NOT NULL,
  `Date` date DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`ActivityID`, `CustomerID`, `Type`, `Date`, `Description`) VALUES
(2, 3, 'Call', '2024-04-05', 'Follow-up call regarding recent order'),
(3, 2, 'Meeting', '2024-04-10', 'Discussing new product features'),
(4, 1, 'Email', '2024-04-15', 'Sent quote for additional services'),
(5, 4, 'Call', '2024-04-20', 'Follow-up call for upcoming event'),
(6, 5, 'Meeting', '2024-04-25', 'Reviewing project progress'),
(7, 1, 'Email', '2024-04-30', 'Sending updates on campaign performance');

-- --------------------------------------------------------

--
-- Table structure for table `campaignresponses`
--

CREATE TABLE `campaignresponses` (
  `ResponseID` int(11) NOT NULL,
  `CampaignID` int(11) DEFAULT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `ResponseType` varchar(50) NOT NULL,
  `ResponseDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaignresponses`
--

INSERT INTO `campaignresponses` (`ResponseID`, `CampaignID`, `CustomerID`, `ResponseType`, `ResponseDate`) VALUES
(7, 4, 5, 'Click', '2024-03-05'),
(8, 1, 2, 'Conversion', '2024-03-10'),
(9, 2, 1, 'Click', '2024-06-05'),
(10, 4, 4, 'Conversion', '2024-06-10'),
(11, 3, 3, 'Click', '2024-09-05'),
(12, 3, 6, 'Conversion', '2024-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `CampaignID` int(11) NOT NULL,
  `CampaignName` varchar(100) NOT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Budget` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`CampaignID`, `CampaignName`, `StartDate`, `EndDate`, `Budget`) VALUES
(1, 'Spring Sale', '2024-03-01', '2024-03-31', 5000.00),
(2, 'Summer Promo', '2024-06-01', '2024-08-31', 8000.00),
(3, 'Fall Campaign', '2024-09-01', '2024-11-30', 6000.00),
(4, 'Winter Deals', '2024-12-01', '2025-02-28', 7000.00);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `ContactID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`ContactID`, `CustomerID`, `FirstName`, `LastName`, `Email`, `Phone`) VALUES
(1, 1, 'Mark', 'Davis', 'mark.davis@example.com', '0798884567'),
(2, 5, 'Mary', 'Taylor', 'mary.taylor@example.com', '07233316543'),
(3, 2, 'Robert', 'Brown', 'robert.brown@example.com', '0732342222'),
(4, 3, 'Jennifer', 'Martinez', 'jennifer.martinez@example.com', '07324456543'),
(5, 2, 'William', 'Clark', 'william.clark@example.com', '0798453212'),
(6, 4, 'Jessica', 'Garcia', 'jessica.garcia@example.com', '07855666644');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `FirstName`, `LastName`, `Email`, `Phone`, `Address`, `Country`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '1234567890', '123 Main St', 'USA'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '9876543210', '456 Elm St', 'Canada'),
(3, 'Michael', 'Johnson', 'michael.johnson@example.com', '5551234567', '789 Oak St', 'UK'),
(4, 'Emily', 'Williams', 'emily.williams@example.com', '4447891234', '101 Pine St', 'Australia'),
(5, 'David', 'Brown', 'david.brown@example.com', '2223334444', '202 Maple St', 'Germany'),
(6, 'Sarah', 'Miller', 'sarah.miller@example.com', '6667778888', '303 Birch St', 'France');

-- --------------------------------------------------------

--
-- Table structure for table `interactions`
--

CREATE TABLE `interactions` (
  `InteractionID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `Type` varchar(50) NOT NULL,
  `Date` date DEFAULT NULL,
  `Description` varchar(666) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interactions`
--

INSERT INTO `interactions` (`InteractionID`, `CustomerID`, `Type`, `Date`, `Description`) VALUES
(1, 4, 'Call', '2024-04-10', 'Follow-up call regarding the new project'),
(2, 2, 'Meeting', '2024-04-12', 'Meeting to discuss renewal terms'),
(3, 5, 'Email', '2024-04-14', 'Sent proposal for expansion opportunity'),
(4, 4, 'Call', '2024-04-16', 'Follow-up call for upgrade opportunity'),
(5, 1, 'Meeting', '2024-04-18', 'Discussing requirements for new sale'),
(6, 6, 'Email', '2024-04-20', 'Follow-up email for cross-sell opportunity');

-- --------------------------------------------------------

--
-- Table structure for table `opportunities`
--

CREATE TABLE `opportunities` (
  `OpportunityID` int(11) NOT NULL,
  `OpportunityName` varchar(100) NOT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `CloseDate` date DEFAULT NULL,
  `Stage` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `opportunities`
--

INSERT INTO `opportunities` (`OpportunityID`, `OpportunityName`, `Amount`, `CloseDate`, `Stage`) VALUES
(1, 'New Project', 5000.00, '2024-06-15', 'Prospecting'),
(2, 'Renewal', 3500.00, '2024-07-20', 'Negotiation'),
(3, 'Expansion', 8000.00, '2024-08-10', 'Closed Won'),
(4, 'Upgrade', 2500.00, '2024-09-05', 'Closed Lost'),
(5, 'New Sale', 6000.00, '2024-10-15', 'Qualification'),
(6, 'Cross-sell', 4000.00, '2024-11-20', 'Proposal');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `OrderDate` date DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `OrderDate`, `TotalAmount`) VALUES
(1, 4, '2024-04-05', 1000.00),
(2, 6, '2024-04-10', 1500.00),
(3, 3, '2024-04-15', 2000.00),
(4, 1, '2024-04-20', 2500.00),
(5, 5, '2024-04-25', 3000.00),
(6, 2, '2024-04-30', 3500.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Description` varchar(700) DEFAULT NULL,
  `Price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductName`, `Description`, `Price`) VALUES
(1, 'Smartphone', 'High-end smartphone with advanced features', 799.99),
(2, 'Laptop', 'Powerful laptop for productivity and entertainment', 1299.99),
(3, 'Smartwatch', 'Fitness tracking smartwatch with heart rate monitoring', 199.99),
(4, 'Headphones', 'Noise-cancelling headphones with superior sound quality', 299.99),
(5, 'Tablet', 'Portable tablet for work and entertainment on the go', 499.99);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'FANNY', 'D', 'fanny06', 'dddd@gmail.com', '+250782437086', '$2y$10$KC2bXcA.ZOJyRj/.4N.68.rzPc2Srcq9tcd91KGmlITlaPhGgzCMK', '2024-05-10 23:18:15', '6', 0),
(2, 'iradukunda', 'nepom', 'iraduj', 'nepiradukundo@gmail.com', '07844387877', '$2y$10$aWMtdExiZ/C2YxkTULDrDuy.HLFVXM2U.e8A0daTKNWUZWNeKl932', '2024-05-10 14:22:37', '5544', 0),
(3, 'dukuzumuremyi ', 'liliane', 'dukuzumulily', 'lilydukuze@gmail.com', '078322911281', '$2y$10$W3irOwmbUTYMJ0DV6kPm7OezVu/ajcfgYyn71iAfC/uIWIvnrzCr2', '2024-05-12 10:14:02', '123456', 0),
(4, 'u', 't', 't5', 't@gmail.com', '078322911281', '$2y$10$A1CGjTYbqL4UzfU5Ea8vQe7pGjWtzOL4LwfefWzGawzKgAqtuTsxO', '2024-05-12 13:04:53', '123456', 0),
(5, 'IRENE', 'GWIZIMPUNDU', 'tr', 'IR@GMAIL.COM', '0782437086', '$2y$10$aFyTsp1pQvUudqMhdwedse2Ae7BAxGnsi.xPkfTV7kK94QyMvZY5C', '2024-05-12 13:10:02', '6', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`ActivityID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `campaignresponses`
--
ALTER TABLE `campaignresponses`
  ADD PRIMARY KEY (`ResponseID`),
  ADD KEY `CampaignID` (`CampaignID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`CampaignID`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`ContactID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `interactions`
--
ALTER TABLE `interactions`
  ADD PRIMARY KEY (`InteractionID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `opportunities`
--
ALTER TABLE `opportunities`
  ADD PRIMARY KEY (`OpportunityID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `ActivityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `campaignresponses`
--
ALTER TABLE `campaignresponses`
  MODIFY `ResponseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `CampaignID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `ContactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `interactions`
--
ALTER TABLE `interactions`
  MODIFY `InteractionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `opportunities`
--
ALTER TABLE `opportunities`
  MODIFY `OpportunityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);

--
-- Constraints for table `campaignresponses`
--
ALTER TABLE `campaignresponses`
  ADD CONSTRAINT `campaignresponses_ibfk_1` FOREIGN KEY (`CampaignID`) REFERENCES `campaigns` (`CampaignID`),
  ADD CONSTRAINT `campaignresponses_ibfk_2` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);

--
-- Constraints for table `interactions`
--
ALTER TABLE `interactions`
  ADD CONSTRAINT `interactions_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
