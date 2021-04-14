-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 12, 2021 at 02:47 AM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_estate_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `Email` varchar(50) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Agent_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`Email`, `First_Name`, `Last_Name`, `Password`, `Agent_ID`) VALUES
('testb', 'testf', 'testl', 'buyer', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buyer_searches_listing`
--

CREATE TABLE `buyer_searches_listing` (
  `Email` varchar(50) NOT NULL,
  `Listing_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `commercial_property`
--

CREATE TABLE `commercial_property` (
  `Property_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `commercial_property`
--

INSERT INTO `commercial_property` (`Property_ID`) VALUES
(3);

-- --------------------------------------------------------

--
-- Table structure for table `house_listing`
--

CREATE TABLE `house_listing` (
  `Listing_ID` int(11) NOT NULL,
  `Description` varchar(250) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Neighbourhood` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Zip_Code` varchar(32) NOT NULL,
  `Seller_Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Price` int(11) NOT NULL,
  `Num_Beds` int(11) NOT NULL,
  `Num_Baths` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `house_listing`
--

INSERT INTO `house_listing` (`Listing_ID`, `Description`, `Address`, `Neighbourhood`, `City`, `Zip_Code`, `Seller_Name`, `Price`, `Num_Beds`, `Num_Baths`) VALUES
(1, '', '220 Hawkwood Boulevard NW', 'Hawkwood', 'Calgary', 'T3G3E8', 'Debora', 445000, 3, 3),
(2, '', '23 Applecrest Court SE', 'Applewood Park', 'Calgary', 'T2A7N8', 'Alex', 349900, 2, 1),
(3, '', '5, 1922 9 Avenue SE', 'Inglewood', 'Calgary', 'T2G0V2', 'Brian', 715000, 0, 2),
(4, '', '101 Woodglen Place', 'Woodglen', 'Okotoks', 'T1S1L2', 'Justin', 410000, 3, 3),
(5, '', '411 Panatella Square NW', 'Panorama Hills', 'Calgary', 'T3K0T7', 'Janet', 739900, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `online_meeting`
--

CREATE TABLE `online_meeting` (
  `Meeting_ID` int(11) NOT NULL,
  `Agent_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `B_Email` varchar(50) NOT NULL,
  `Message` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `online_meeting_has_tour`
--

CREATE TABLE `online_meeting_has_tour` (
  `Tour_ID` int(11) NOT NULL,
  `Meeting_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `Property_ID` int(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Neighbourhood` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Zip_Code` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `Estimated_Value` int(11) NOT NULL,
  `Square_Footage` int(11) NOT NULL,
  `Num_Beds` int(11) NOT NULL,
  `Num_Baths` int(11) NOT NULL,
  `B_Email` varchar(50) NOT NULL,
  `S_Email` varchar(50) NOT NULL,
  `Agent_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`Property_ID`, `Address`, `Neighbourhood`, `City`, `Zip_Code`, `Status`, `Estimated_Value`, `Square_Footage`, `Num_Beds`, `Num_Baths`, `B_Email`, `S_Email`, `Agent_ID`) VALUES
(1, '220 Hawkwood Boulevard NW', 'Hawkwood', 'Calgary', 'T3G3E8', 1, 445000, 7250, 3, 3, 'testb', 'tests', 2),
(2, '23 Applecrest Court SE', 'Applewood Park', 'Calgary', 'T2A7N8', 1, 349900, 4050, 2, 1, 'testb', 'tests', 2),
(3, '5, 1922 9 Avenue SE', 'Inglewood', 'Calgary', 'T2G0V2', 1, 715000, 0, 0, 2, 'testb', 'tests', 2),
(4, '101 Woodglen Place', 'Woodglen', 'Okotoks', 'T1S1L2', 1, 410000, 7250, 3, 3, 'testb', 'tests', 2),
(5, '411 Panatella Square NW', 'Panorama Hills', 'Calgary', 'T3K0T7', 1, 739900, 7250, 4, 4, 'testb', 'tests', 2);

-- --------------------------------------------------------

--
-- Table structure for table `property_image`
--

CREATE TABLE `property_image` (
  `Image_ID` int(11) NOT NULL,
  `Property_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `real_estate_agent`
--

CREATE TABLE `real_estate_agent` (
  `Agent_ID` int(11) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Contact_No` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Association` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `real_estate_agent`
--

INSERT INTO `real_estate_agent` (`Agent_ID`, `First_Name`, `Last_Name`, `Contact_No`, `Email`, `Password`, `Association`) VALUES
(1, 'AgentF', 'AgentL', '1111111111', 'agent@agent.com', 'agent', 'Agent Association'),
(2, 'testf', 'testl', '8888888888', 'testa', 'agent', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `residential_property`
--

CREATE TABLE `residential_property` (
  `Property_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `residential_property`
--

INSERT INTO `residential_property` (`Property_ID`) VALUES
(1),
(2),
(4),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `Email` varchar(50) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Agent_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`Email`, `First_Name`, `Last_Name`, `Password`, `Agent_ID`) VALUES
('tests', 'testf', 'testl', 'seller', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `structure_type`
--

CREATE TABLE `structure_type` (
  `Listing_ID` int(11) NOT NULL,
  `Type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `structure_type`
--

INSERT INTO `structure_type` (`Listing_ID`, `Type`) VALUES
(1, 'House'),
(2, 'Townhouse'),
(3, 'House');

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `Tour_ID` int(11) NOT NULL,
  `Property_ID` int(11) NOT NULL,
  `Agent_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`Email`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `Buyer_Agent_ID_FK` (`Agent_ID`);

--
-- Indexes for table `buyer_searches_listing`
--
ALTER TABLE `buyer_searches_listing`
  ADD PRIMARY KEY (`Email`,`Listing_ID`),
  ADD UNIQUE KEY `Email` (`Email`,`Listing_ID`),
  ADD KEY `B_Search_L_Listing_ID_FK` (`Listing_ID`);

--
-- Indexes for table `commercial_property`
--
ALTER TABLE `commercial_property`
  ADD PRIMARY KEY (`Property_ID`),
  ADD UNIQUE KEY `Property_ID` (`Property_ID`);

--
-- Indexes for table `house_listing`
--
ALTER TABLE `house_listing`
  ADD PRIMARY KEY (`Listing_ID`),
  ADD UNIQUE KEY `Listing_ID` (`Listing_ID`);

--
-- Indexes for table `online_meeting`
--
ALTER TABLE `online_meeting`
  ADD PRIMARY KEY (`Meeting_ID`),
  ADD UNIQUE KEY `Meeting_ID` (`Meeting_ID`),
  ADD KEY `Online_Meeting_B_Email_FK` (`B_Email`),
  ADD KEY `Online_Meeting_Agent_ID_FK` (`Agent_ID`);

--
-- Indexes for table `online_meeting_has_tour`
--
ALTER TABLE `online_meeting_has_tour`
  ADD PRIMARY KEY (`Tour_ID`),
  ADD UNIQUE KEY `Tour_ID` (`Tour_ID`),
  ADD KEY `Online_Meeting_Has_Tour_Meeting_ID_FK` (`Meeting_ID`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`Property_ID`),
  ADD UNIQUE KEY `Property_ID` (`Property_ID`),
  ADD KEY `Property_B_Email_FK` (`B_Email`),
  ADD KEY `Property_S_Email_FK` (`S_Email`),
  ADD KEY `Property_Agent_ID_FK` (`Agent_ID`);

--
-- Indexes for table `property_image`
--
ALTER TABLE `property_image`
  ADD PRIMARY KEY (`Image_ID`,`Property_ID`),
  ADD UNIQUE KEY `Image_ID` (`Image_ID`,`Property_ID`),
  ADD KEY `Property_Image_Property_ID_FK` (`Property_ID`);

--
-- Indexes for table `real_estate_agent`
--
ALTER TABLE `real_estate_agent`
  ADD PRIMARY KEY (`Agent_ID`),
  ADD UNIQUE KEY `Agent_ID` (`Agent_ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `residential_property`
--
ALTER TABLE `residential_property`
  ADD PRIMARY KEY (`Property_ID`),
  ADD UNIQUE KEY `Property_ID` (`Property_ID`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`Email`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `Seller_Agent_ID_FK` (`Agent_ID`);

--
-- Indexes for table `structure_type`
--
ALTER TABLE `structure_type`
  ADD PRIMARY KEY (`Listing_ID`,`Type`),
  ADD UNIQUE KEY `Listing_ID` (`Listing_ID`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`Tour_ID`),
  ADD UNIQUE KEY `Tour_ID` (`Tour_ID`),
  ADD KEY `Tour_Agent_ID_FK` (`Agent_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commercial_property`
--
ALTER TABLE `commercial_property`
  MODIFY `Property_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `house_listing`
--
ALTER TABLE `house_listing`
  MODIFY `Listing_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `online_meeting`
--
ALTER TABLE `online_meeting`
  MODIFY `Meeting_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `Property_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `property_image`
--
ALTER TABLE `property_image`
  MODIFY `Image_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `real_estate_agent`
--
ALTER TABLE `real_estate_agent`
  MODIFY `Agent_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `residential_property`
--
ALTER TABLE `residential_property`
  MODIFY `Property_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tour`
--
ALTER TABLE `tour`
  MODIFY `Tour_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buyer`
--
ALTER TABLE `buyer`
  ADD CONSTRAINT `Buyer_Agent_ID_FK` FOREIGN KEY (`Agent_ID`) REFERENCES `real_estate_agent` (`Agent_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `buyer_searches_listing`
--
ALTER TABLE `buyer_searches_listing`
  ADD CONSTRAINT `B_Search_L_Email_FK` FOREIGN KEY (`Email`) REFERENCES `buyer` (`Email`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `B_Search_L_Listing_ID_FK` FOREIGN KEY (`Listing_ID`) REFERENCES `house_listing` (`Listing_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `commercial_property`
--
ALTER TABLE `commercial_property`
  ADD CONSTRAINT `Commerc_Property_Property_ID_FK` FOREIGN KEY (`Property_ID`) REFERENCES `property` (`Property_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `online_meeting`
--
ALTER TABLE `online_meeting`
  ADD CONSTRAINT `Online_Meeting_Agent_ID_FK` FOREIGN KEY (`Agent_ID`) REFERENCES `real_estate_agent` (`Agent_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Online_Meeting_B_Email_FK` FOREIGN KEY (`B_Email`) REFERENCES `buyer` (`Email`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `online_meeting_has_tour`
--
ALTER TABLE `online_meeting_has_tour`
  ADD CONSTRAINT `Online_Meeting_Has_Tour_Meeting_ID_FK` FOREIGN KEY (`Meeting_ID`) REFERENCES `online_meeting` (`Meeting_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Online_Meeting_Has_Tour_Tour_ID_FK` FOREIGN KEY (`Tour_ID`) REFERENCES `tour` (`Tour_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `Property_Agent_ID_FK` FOREIGN KEY (`Agent_ID`) REFERENCES `real_estate_agent` (`Agent_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Property_B_Email_FK` FOREIGN KEY (`B_Email`) REFERENCES `buyer` (`Email`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Property_S_Email_FK` FOREIGN KEY (`S_Email`) REFERENCES `seller` (`Email`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `property_image`
--
ALTER TABLE `property_image`
  ADD CONSTRAINT `Property_Image_Property_ID_FK` FOREIGN KEY (`Property_ID`) REFERENCES `property` (`Property_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `residential_property`
--
ALTER TABLE `residential_property`
  ADD CONSTRAINT `Residential_Property_Property_ID_FK` FOREIGN KEY (`Property_ID`) REFERENCES `property` (`Property_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `Seller_Agent_ID_FK` FOREIGN KEY (`Agent_ID`) REFERENCES `real_estate_agent` (`Agent_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `structure_type`
--
ALTER TABLE `structure_type`
  ADD CONSTRAINT `Structure_Type_Listing_ID_FK` FOREIGN KEY (`Listing_ID`) REFERENCES `house_listing` (`Listing_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tour`
--
ALTER TABLE `tour`
  ADD CONSTRAINT `Tour_Agent_ID_FK` FOREIGN KEY (`Agent_ID`) REFERENCES `real_estate_agent` (`Agent_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
