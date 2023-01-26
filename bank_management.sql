-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2023 at 01:19 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank_management`
--
CREATE DATABASE IF NOT EXISTS `bank_management` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bank_management`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Branch_ID` varchar(255) NOT NULL,
  `Account_No` bigint(20) NOT NULL,
  `Account_Type` varchar(255) NOT NULL,
  `Balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Branch_ID`, `Account_No`, `Account_Type`, `Balance`) VALUES
('CGH002', 9999999, 'NRI', 123123),
('CGH002', 17777777, 'NRI', 12334),
('CGH002', 99999999, 'NRI', 1111111),
('MKM004', 12084829316, 'Savings', 9511),
('MKM002', 32332633974, 'Current', 34950),
('MKM004', 36051920027, 'Current', 37511),
('MKM005', 41593865530, 'NRI', 80264),
('MKM005', 53712420922, 'Current', 30040),
('MKM001', 56292217690, 'Savings', 48678),
('MKM003', 58036878265, 'Savings', 87241),
('MKM004', 66027400537, 'NRI', 22110),
('MKM002', 93146667296, 'Current', 95759);

--
-- Triggers `account`
--
DELIMITER $$
CREATE TRIGGER `insert_balance` BEFORE INSERT ON `account` FOR EACH ROW BEGIN
DECLARE msg varchar(50);
DECLARE val int;
set msg = ("Balance cannot be negative");
set val = new.balance;
IF val < 0 THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = msg;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `Name` varchar(255) NOT NULL,
  `Code` int(11) NOT NULL,
  `Password` varchar(255) NOT NULL DEFAULT '0',
  `HQ_Address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`Name`, `Code`, `Password`, `HQ_Address`) VALUES
('DEF', 1000, '0', 'Bangalore'),
('CGH', 6300, '0', 'Santiago'),
('MKM', 7000, '0', 'Miraflores');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `Code` int(11) NOT NULL,
  `Branch_ID` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`Code`, `Branch_ID`, `Name`, `Address`) VALUES
(6300, 'CGH001', 'Boston', 'P.O. Box 134, XY street'),
(6300, 'CGH002', 'Washington', 'AB street'),
(7000, 'MKM001', 'Miraflores', '261-5992 Curae Road'),
(7000, 'MKM002', 'Padang', 'P.O. Box 291, 2327 Etiam Street'),
(7000, 'MKM003', 'Soria', 'Ap #942-6147 Elit. St.'),
(7000, 'MKM004', 'Port Nolloth', 'P.O. Box 178, 8646 Risus Rd.'),
(7000, 'MKM005', 'ABC', 'ABC');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Cust_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Phone_no` bigint(20) NOT NULL,
  `Address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cust_ID`, `Name`, `Phone_no`, `Address`) VALUES
(123456, 'Kart ', 1234567890, 'BSK'),
(263621, 'Harley Rojas', 8523161646, ' Magna. Ave'),
(273962, 'Kareem Hodges', 6763469752, 'P.O. Box 369, 8123 Sem, St.'),
(371507, 'Abraham Lewis', 5986833682, '781-1123 Vitae, Av.'),
(513718, 'Talon Saunders', 7696774935, '563-1122 Sed Av.'),
(537048, 'Cora Francis', 5959824772, 'Ap #752-4922 Erat St.'),
(668125, 'Willa Glenn', 4642494891, 'Ap #409-4393 Dis Street'),
(832996, 'Lester Green', 5664583385, 'P.O. Box 351, 6307 Quis, St.'),
(845357, 'Mari Chang', 7967368869, '455-1788 Urna. Rd.'),
(875414, 'Adrian Warren', 4244163352, 'P.O. Box 667, 8135 Vitae Avenue'),
(974908, 'Brenda Diaz', 8623536436, 'Ap #449-3116 Lacus. Street');

-- --------------------------------------------------------

--
-- Table structure for table `held_by_acc_cust`
--

CREATE TABLE `held_by_acc_cust` (
  `Cust_ID` int(11) NOT NULL,
  `Account_No` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `held_by_acc_cust`
--

INSERT INTO `held_by_acc_cust` (`Cust_ID`, `Account_No`) VALUES
(537048, 41593865530),
(513718, 12084829316),
(371507, 53712420922),
(371507, 66027400537),
(845357, 36051920027),
(263621, 93146667296),
(974908, 56292217690),
(832996, 32332633974),
(832996, 58036878265),
(123456, 9999999),
(123456, 99999999);

-- --------------------------------------------------------

--
-- Table structure for table `interest_account`
--

CREATE TABLE `interest_account` (
  `Account_No` bigint(20) NOT NULL,
  `Balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interest_account`
--

INSERT INTO `interest_account` (`Account_No`, `Balance`) VALUES
(12084829316, 10462),
(32332633974, 38445),
(36051920027, 41262),
(41593865530, 88290),
(53712420922, 33044),
(56292217690, 53546),
(58036878265, 95965),
(66027400537, 24321),
(77877366714, 70628),
(93146667296, 105335),
(93146667296, 115869);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Account_No`),
  ADD KEY `fk_branchid` (`Branch_ID`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`Code`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`Branch_ID`),
  ADD KEY `fk_code` (`Code`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Cust_ID`);

--
-- Indexes for table `held_by_acc_cust`
--
ALTER TABLE `held_by_acc_cust`
  ADD KEY `fk_custid` (`Cust_ID`),
  ADD KEY `fk_accno` (`Account_No`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `fk_branchid` FOREIGN KEY (`Branch_ID`) REFERENCES `branch` (`Branch_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `fk_code` FOREIGN KEY (`Code`) REFERENCES `bank` (`Code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `held_by_acc_cust`
--
ALTER TABLE `held_by_acc_cust`
  ADD CONSTRAINT `fk_accno` FOREIGN KEY (`Account_No`) REFERENCES `account` (`Account_No`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_custid` FOREIGN KEY (`Cust_ID`) REFERENCES `customer` (`Cust_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
