-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 04, 2019 at 06:33 PM
-- Server version: 5.6.41
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `centerac_center_activities`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`cat_id`, `cat_name`) VALUES
(1, 'Kayak/Canoe'),
(2, 'Backpacking/Camping'),
(3, 'Personal Gear'),
(4, 'Surf'),
(5, 'Snow');

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `cust_id` int(11) NOT NULL,
  `f_name` varchar(25) NOT NULL,
  `l_name` varchar(25) NOT NULL,
  `c_stu_id` varchar(10) NOT NULL,
  `c_addr` varchar(100) NOT NULL,
  `c_phone` varchar(12) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `is_student` varchar(5) NOT NULL,
  `is_employee` varchar(5) NOT NULL,
  `emerg_contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`cust_id`, `f_name`, `l_name`, `c_stu_id`, `c_addr`, `c_phone`, `c_email`, `is_student`, `is_employee`, `emerg_contact`) VALUES
(26, 'Lam', 'Ngo', '1234567899', '12321 5th street', '123456789451', '12315hi@gmail.com', 'Yes', 'Yes', 'Dang Ngo 123115161651'),
(27, 'Dang', 'Ngo', '03/20/1995', '12321 5th street', '123456789451', '12315hi@gmail.com', 'No', 'No', 'Dang Ngo 123115161651'),
(29, 'Eric', 'Misner', '10/01/1994', 'asdasdasd', 'asdasd', 'asdasd', 'No', 'No', 'asd2'),
(33, 'Bridget', 'Hand', '03/20/1995', '1231 Woodbury Rd Apt#A4', '707-826-3357', 'testing123@gmail.com', 'yes', 'yes', 'Old Test 123-123-1234'),
(34, 'Josh', 'Steward', 'asdfasdf', 'asdfasd', '123132156565', 'asdfadsf', 'yes', 'no', 'asdfasdfadsa asdfasd asdfasdf'),
(39, 'John', 'Smith', '', '1111 High Street', '7078886262', 'JohnSmith123@gmail.com', 'Yes', 'No', 'Sue Smith');

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `empl_id` int(11) NOT NULL,
  `empl_fname` varchar(20) NOT NULL,
  `empl_lname` varchar(20) NOT NULL,
  `phone_num` varchar(12) NOT NULL,
  `title` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`empl_id`, `empl_fname`, `empl_lname`, `phone_num`, `title`) VALUES
(1, 'Lam', 'Ngo', '123456789', 'Front Desk');

-- --------------------------------------------------------

--
-- Table structure for table `Inventory`
--

CREATE TABLE `Inventory` (
  `inv_id` int(11) NOT NULL,
  `inv_name` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `stu_day_price` int(11) DEFAULT NULL,
  `day_price` int(11) DEFAULT NULL,
  `stu_weekend_price` int(11) DEFAULT NULL,
  `weekend_price` int(11) DEFAULT NULL,
  `stu_week_price` int(11) DEFAULT NULL,
  `week_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Inventory`
--

INSERT INTO `Inventory` (`inv_id`, `inv_name`, `cat_id`, `stu_day_price`, `day_price`, `stu_weekend_price`, `weekend_price`, `stu_week_price`, `week_price`) VALUES
(1, 'Hammock', 2, 4, 7, 10, 13, 13, 16),
(2, 'Tent', 2, 20, 26, 25, 35, 32, 40),
(3, 'Plastic Tarp', 2, 4, 7, 4, 7, 4, 7),
(4, 'Sleeping Bag', 2, 10, 13, 20, 26, 25, 35),
(5, 'Sleeping Pad Foam', 2, 4, 7, 10, 13, 13, 16),
(6, 'Sleeping Pad Inflatable', 2, 7, 10, 13, 16, 20, 26),
(7, 'Solar Lantern', 2, 3, 4, 4, 7, 10, 13),
(8, 'External Frame Backpack', 2, 4, 7, 10, 13, 13, 16),
(9, 'Internal Frame Backpack', 2, 10, 13, 20, 26, 25, 25),
(10, 'Backpacking Stove', 2, 4, 7, 10, 13, 13, 16),
(11, 'Two-Burner Stove/Car Stove', 2, 10, 13, 13, 16, 20, 26),
(12, 'Backcountry Water Filter', 2, 4, 7, 10, 13, 13, 16),
(13, 'Bear Canister', 2, 4, 7, 10, 13, 13, 16),
(14, 'Ice Chest/Cooler', 2, 4, 7, 10, 13, 13, 16),
(15, 'Drink Cooler', 2, 4, 7, 10, 13, 13, 16),
(16, 'SnowBoard(boots not provided)', 5, 4, 7, 10, 13, 13, 16),
(20, 'Gloves/Mitts', 3, 4, 7, 10, 13, 13, 16),
(21, 'Snow Shoes', 5, 10, 13, 13, 16, 20, 26),
(22, 'Rock Climbing Shoes', 3, 4, 7, 10, 13, 13, 16),
(23, 'Volleyball Court and Ball', 2, 20, 26, 25, 35, 32, 40),
(24, 'Helmet', 1, 4, 7, 10, 13, 13, 16),
(25, 'PFD/Life Jacket', 3, 4, 7, 10, 13, 13, 16),
(26, 'Spray Skirt', 1, 4, 7, 10, 13, 13, 16),
(27, 'Farmer John Wetsuits', 3, 10, 13, 20, 26, 25, 35),
(28, 'Wetsuit', 4, 10, 13, 20, 26, 25, 35),
(29, 'Splash Top', 3, 10, 13, 20, 26, 25, 35),
(30, 'Booties', 4, 4, 7, 10, 13, 13, 16),
(31, 'Whitewater Kayak Paddle', 1, 4, 7, 10, 13, 13, 16),
(32, 'Foam Vehicle Roof Rack', 3, 4, 7, 10, 13, 13, 16),
(33, 'Boogie Board', 4, 10, 13, 20, 26, 25, 35),
(34, 'Surfboard', 4, 10, 13, 20, 26, 25, 35),
(35, 'Surfboard Leash', 4, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'Canoe', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'River/Whitewater Kayak', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'Single Inflatable Kayak', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'Double Inflatable Kayak', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Kayak Float Bags', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Pump', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'Single Sea Kayak', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'Double Sea Kayak', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'Bilgepump', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'Paddlefloat', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'Dry Bags', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'Large Camp Tables', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'Roll-up Tables(small)', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'Sleeping Bag Liners', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'Lay Bag', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'Pants', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'Jacket', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'Splash Top', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'Outdoor Nation Sleeping Bag', 2, 5, NULL, 5, NULL, 5, NULL),
(55, 'Outdoor Nation Tent', 2, 8, NULL, 8, NULL, 8, NULL),
(56, 'Outdoor Nation Backpack', 2, 4, NULL, 4, NULL, 4, NULL),
(57, 'Canoe Paddle', 1, 4, 7, 10, 13, 13, 16),
(58, 'Sea Kayak Paddle', 1, 4, 7, 10, 13, 13, 16),
(59, 'Inflatable Kayak Paddle', 1, 4, 7, 10, 13, 13, 16),
(60, 'Soft Car Racks', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'Tent', 2, 25, 35, 32, 40, 45, 55);

-- --------------------------------------------------------

--
-- Table structure for table `InvPack`
--

CREATE TABLE `InvPack` (
  `invpack_id` int(11) NOT NULL,
  `pack_id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `InvPack`
--

INSERT INTO `InvPack` (`invpack_id`, `pack_id`, `inv_id`) VALUES
(1, 1, 36),
(2, 1, 57),
(3, 1, 25),
(4, 4, 39),
(5, 4, 41),
(6, 4, 31),
(7, 4, 24),
(8, 4, 25),
(9, 6, 43),
(10, 6, 31),
(11, 6, 25),
(12, 2, 37),
(13, 2, 31),
(14, 2, 26),
(15, 2, 24),
(16, 2, 25),
(17, 3, 38),
(18, 3, 31),
(19, 3, 41),
(20, 3, 24),
(21, 3, 25),
(22, 5, 42),
(23, 5, 31),
(24, 5, 45),
(25, 5, 25),
(26, 7, 34),
(27, 7, 28),
(28, 7, 30),
(29, 7, 35);

-- --------------------------------------------------------

--
-- Table structure for table `Item`
--

CREATE TABLE `Item` (
  `item_Backid` int(11) NOT NULL,
  `item_Frontid` varchar(20) NOT NULL,
  `item_modeltype` varchar(20) DEFAULT NULL,
  `item_size` varchar(20) DEFAULT NULL,
  `inv_id` int(20) NOT NULL,
  `stat_id` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `pur_price` int(11) NOT NULL,
  `ven_id` int(11) NOT NULL,
  `dbw_own` tinyint(1) NOT NULL,
  `pur_date` date NOT NULL,
  `vin_num` int(11) DEFAULT NULL,
  `public` tinyint(1) NOT NULL,
  `notes` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Item`
--

INSERT INTO `Item` (`item_Backid`, `item_Frontid`, `item_modeltype`, `item_size`, `inv_id`, `stat_id`, `location`, `pur_price`, `ven_id`, `dbw_own`, `pur_date`, `vin_num`, `public`, `notes`) VALUES
(1, 'Orange/Black', 'Pyranha H2', NULL, 37, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(2, 'Red/Black', 'Pyranha H2', NULL, 37, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(3, '6', '', 'Tall', 37, 1, 'Center Activities', 1, 0, 1, '2018-07-01', 0, 1, 'kjasndfksdn'),
(4, 'Green', 'Jackson Super Hero', NULL, 37, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(5, 'Orange', 'Jackson Little Hero', NULL, 37, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(6, 'Orange', 'Jackson Hero', NULL, 37, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(7, 'Green', 'Jackson Fun Runner', NULL, 37, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(8, 'Red', 'Jackson Fun Runner', NULL, 37, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(9, 'Pink', 'Jackson Hero', NULL, 37, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(10, 'Pink', 'Jackson Super Hero', NULL, 37, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(11, 'Red', 'Jackson Hero', NULL, 37, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(12, 'Red', 'Jackson Hero', NULL, 37, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(13, 'Red/Blue', 'Jackson Hero', NULL, 37, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(14, 'Zen/Red', 'Jackson', NULL, 37, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(15, '3', 'Seals', 'Small/Medium', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(16, '3', 'NRS', 'Medium', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(17, '4', 'NRS', 'Medium', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(18, '5', 'Seals', 'Medium', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(19, '6', 'Seals', 'Medium', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(20, '1', 'Seals', 'Medium', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(21, '2', 'Seals', 'Medium', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(22, '3', 'Seals', 'Medium', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(23, '2', 'NRS', 'Large', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(24, '4', 'Seals', 'Large', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(25, '1', 'Rafting', 'Small', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:White'),
(26, '1', 'Rafting', 'Medium', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(27, 'IN16-05', 'Rafting', 'Medium', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(28, 'F14-05', 'Rafting', 'Medium', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(29, 'F14-06', 'Rafting', 'Medium', 24, 1, 'Center Activities', 1, 0, 1, '2018-07-01', 0, 1, 'Color:Red'),
(30, 'F14-08', 'Rafting', 'Medium', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(31, 'F14-09', 'Rafting', 'Medium', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(32, 'IN16-01', 'Rafting', 'Large', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(33, 'F14-10', 'Rafting', 'Large', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', 0, 1, 'Color:Blue'),
(34, 'F14-14', 'Rafting', 'Large', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(35, 'IN16-06', 'Rafting', 'Large/XL', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:White'),
(36, 'IN16-03', 'Rafting', 'Large/XL', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(37, 'IN16-04', 'Rafting', 'Large/XL', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(38, 'IN16-01', 'Rafting', 'Large/XL', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:White'),
(39, '101', 'Rafting', 'Universal', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(40, '2', 'Rafting', 'Universal', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(41, 'S18-01', 'Rafting', 'Universal', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(42, 'S18-02', 'Rafting', 'Universal', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(43, 'S18-03', 'Rafting', 'Universal', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(44, 'S18-04', 'Rafting', 'Universal', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(45, 'S18-05', 'Rafting', 'Universal', 24, 3, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(46, 'S18-06', 'Rafting', 'Universal', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(47, 'S18-07', 'Rafting', 'Universal', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(48, 'S18-08', 'Rafting', 'Universal', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(49, 'S18-09', 'Rafting', 'Universal', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(50, 'S18-10', 'Rafting', 'Universal', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(51, 'S18-11', 'Rafting', 'Universal', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(52, 'S18-12', 'Rafting', 'Universal', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(53, 'S16-01', 'Kayaking', 'Medium/Large', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(54, 'S16-02', 'Kayaking', 'Medium/Large', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(55, 'S16-03', 'Kayaking', 'Medium/Large', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(56, 'S16-05', 'Kayaking', 'Small/Medium', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(57, 'S16-06', 'Kayaking', 'Small/Medium', 24, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(58, 'S13-01', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(59, 'S13-03', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(60, 'S13-04', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(61, 'S13-05', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(62, 'S13-06', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(63, 'S13-08', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(64, 'S13-10', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(65, 'S13-11', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(66, 'S13-12', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(67, 'S13-13', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(68, 'S13-14', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(69, 'S13-17', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(70, 'S13-20', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(71, 'S13-22', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(72, 'S13-23', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(73, '1', NULL, NULL, 40, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(74, '12', 'Werner', '185', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(75, '20', 'Werner', '185', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(76, '31', 'Werner', '185', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(77, '15', 'Werner', '190', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(78, '22', 'Werner', '190', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(79, '32', 'Werner', '190', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(80, '16', 'Werner', '195', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(81, '21', 'Werner', '195', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(82, '33', 'Werner', '195', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(83, '41', 'Werner', '195', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(84, '5', 'Werner', '195', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(85, '6', 'Werner', '195', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(86, '7', 'Werner', '195', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(87, '8', 'Werner', '195', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(88, '14', 'Werner', '200', 31, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(89, 'F1', NULL, NULL, 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(90, 'F2', NULL, NULL, 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(91, 'F3', NULL, NULL, 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(92, 'F4', NULL, NULL, 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(93, 'F5', NULL, NULL, 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(94, 'F6', NULL, NULL, 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(95, 'F7', NULL, NULL, 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(96, 'F7', NULL, NULL, 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(97, 'F8', NULL, NULL, 39, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(98, 'F9', NULL, NULL, 39, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(99, 'F10', NULL, NULL, 39, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(100, 'F14-01', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(101, 'F14-02', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(102, 'F14-03', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(103, 'F14-04', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(104, 'F14-05', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(105, 'F14-06', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(106, 'F14-07', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(107, 'F14-08', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(108, 'F14-09', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(109, 'F14-10', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(110, 'F14-11', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(111, 'F14-12', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(112, 'F14-13', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(113, 'F14-14', 'Inflatable', NULL, 59, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow/Blue'),
(114, '1', 'SnowBoard Shoes', NULL, 16, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(115, '1', 'K', 'Small', 41, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(116, '3', 'Carlson Barrel', 'Small', 41, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(117, 'S18-02', 'Carlson Barrel', 'Small', 41, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(118, '1', 'Carlson Barrel', 'Big', 41, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(119, '2', 'Carlson Barrel', 'Big', 41, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(120, 'S18-01', 'Carlson Barrel', 'Big', 41, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(121, 'Yellow', 'Necky-Manitou', 'Sit-In', 42, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(122, 'Yellow', 'Necky-Eskia', 'Sit-In', 42, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(123, 'A7', 'Malibu Two', 'Sit-On Top', 43, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(124, 'A34', 'Frenzy', 'Sit-On Top', 42, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(125, 'A31', 'Frenzy', 'Sit-On Top', 42, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(126, '2', 'Sea', '230', 58, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(127, '30', 'Sea', '230', 58, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(128, '40', 'Sea', '230', 58, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(129, '13', 'Sea', '205', 58, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(130, '3', 'Sea', '235', 58, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(131, '11', 'Sea', '260', 58, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(132, '1', 'Kokatat', 'Universal', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(133, '2', 'Kokatat', 'Universal', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(134, '3', 'Kokatat', 'Universal', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(135, '3', 'Harmony', 'Universal', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(136, '1', 'Seals', 'Universal', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(137, '2', 'Seals', 'Universal', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(138, '2', 'Kokatat', 'Large/XL', 26, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(139, '11', 'Dagger Legend', NULL, 36, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(140, '1', 'Canoe, Carlisle', 'Long', 57, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(141, '2', 'Canoe, Carlisle', 'Long', 57, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(142, '3', 'Canoe, Carlisle', 'Short', 57, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(143, '5', 'Canoe, Carlisle', 'Short', 57, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(144, '6', 'Canoe, Mohawk', 'Short', 57, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(145, '1', NULL, NULL, 44, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(146, '2', NULL, NULL, 44, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(147, '1', NULL, NULL, 45, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(148, '2', NULL, NULL, 45, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(149, '3', NULL, NULL, 45, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(150, '4', NULL, NULL, 45, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(151, 'S13-01', NULL, 'Small', 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Green'),
(152, 'S13-02', NULL, 'Small', 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Green'),
(153, 'S13-03', NULL, 'Small', 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Green'),
(154, 'S13-01', NULL, 'Medium', 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(156, 'S13-02', NULL, 'Medium', 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(157, 'S13-03', NULL, 'Medium', 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(158, 'S13-04', NULL, 'Medium', 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(159, 'S13-01', NULL, 'Large', 38, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Green'),
(160, 'S13-02', NULL, 'Large', 39, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Green'),
(161, 'Sp17-03', 'Eureka', '1 Person', 2, 3, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(162, 'Sp17-04', 'Eureka', '1 Person', 2, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(163, 'Sp18-01', 'North Face', '2 Person', 2, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(164, '1', 'Limelight', '3 Person', 2, 3, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(165, '2', 'Limelight', '3 Person', 2, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(166, '3', 'Limelight', '3 Person', 2, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(167, 'S17-01', 'Eureka', '3 Person', 2, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(168, 'S17-02', 'Eureka', '3 Person', 2, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(169, 'S18-01', 'Coleman Dark Room', '6 Person', 2, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(170, '5', 'Tetragon-Eureka', NULL, 2, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(171, '1', 'Tetragon-Eureka', '8 Person', 2, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(172, 'ONSP17-05', 'ON North Face', '2 Person', 55, 1, 'Center Activities', 1, 0, 1, '2018-07-01', 0, 1, ''),
(173, 'ONSP17-06', 'ON North Face', '2 Person', 55, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(174, 'ONSP17-07', 'ON North Face', '2 Person', 55, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(175, 'ONSP17-08', 'ON North Face', '2 Person', 55, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(176, 'ONSP17-09', 'ON North Face', '2 Person', 55, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(177, 'ONSP17-10', 'ON North Face', '2 Person', 55, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(178, 'ONSP17-11', 'ON North Face', '2 Person', 55, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(179, 'ONSP17-12', 'ON North Face', '2 Person', 55, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(180, 'ONSP17-01', 'ON North Face', '3 Person', 55, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(181, 'ONSP17-02', 'ON North Face', '3 Person', 55, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(182, 'ONSP17-03', 'ON North Face', '3 Person', 55, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(184, 'ONSP17-04', 'ON North Face', '3 Person', 55, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(185, '11', 'Blue Wing Noah', NULL, 3, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(186, 'S18-01', NULL, '5x7', 3, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(187, 'S14-02', NULL, '5x7', 3, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Brown'),
(188, 'S14-03', NULL, '5x7', 3, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Brown'),
(189, 'S14-06', NULL, '10x12', 3, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Brown'),
(190, 'IN-2', NULL, '10x12', 3, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Green'),
(191, 'FA16-01', NULL, '12x16', 3, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue/Brown'),
(192, 'IO-1', NULL, '12x16', 3, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(193, 'F14-01', NULL, NULL, 1, 4, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(194, 'F14-02', NULL, NULL, 1, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(195, 'F14-03', NULL, NULL, 1, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(196, 'F14-04', NULL, NULL, 1, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(197, 'F16-01', NULL, NULL, 50, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(198, 'F16-02', NULL, NULL, 50, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(199, 'F16-03', NULL, NULL, 50, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(200, '1', '0 Degree Bag', 'Regular', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(201, 'SP13-001', '0 Degree Bag', 'Regular', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(202, '2', '0 Degree Bag', 'Long', 4, 3, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(203, 'SP13-008', '15 Degree Bag', 'Long', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(204, '1', '15 Degree Bag', 'Regular', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(205, '1', '20 Degree Bag', 'Regular', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(206, '4', '20 Degree Bag', 'Long', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(207, '8', '20 Degree Bag', 'Long', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(208, '9', '20 Degree Bag', 'Long', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(209, '10', '20 Degree Bag', 'Regular', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(210, '11', '20 Degree Bag', 'Regular', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(211, 'SP13-002', '20 Degree Bag', 'Regular', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(212, 'SP13-003', '20 Degree Bag', 'Regular', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(213, 'SP13-004', '20 Degree Bag', 'Regular', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 0, NULL),
(214, 'SP13-005', '20 Degree Bag', 'Long', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(215, 'SP13-006', '20 Degree Bag', 'Long', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(216, 'SP13-007', '20 Degree Bag', 'Regular', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(217, '2', '20 Degree Bag', 'Long', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(218, 'S18-01', '20 Degree Bag', 'Regular', 4, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(219, 'ONSP17-01', 'ON 20 Degree Bag', 'Regular', 54, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(220, 'ONSP17-02', 'ON 20 Degree Bag', 'Regular', 54, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(221, 'ONSP17-03', 'ON 20 Degree Bag', 'Regular', 54, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(222, 'ONSP17-04', 'ON 20 Degree Bag', 'Regular', 54, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(223, 'ONSP17-05', 'ON 20 Degree Bag', 'Regular', 54, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(224, 'ONSP17-06', 'ON 20 Degree Bag', 'Regular', 54, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(225, 'ONSP17-07', 'ON 20 Degree Bag', 'Regular', 54, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(226, 'ONSP17-08', 'ON 20 Degree Bag', 'Regular', 54, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(227, 'S13-04', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(228, 'S13-01', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(229, 'S13-03', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(230, 'S13-04', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(231, 'S13-05', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(232, 'S13-04', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(233, 'S13-05', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(234, 'S16-02', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(235, 'S16-03', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(236, 'S16-04', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(237, 'S16-05', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(238, 'S16-06', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(239, 'S16-07', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(240, 'S16-08', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(241, 'S16-09', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(242, 'S16-10', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(243, 'SP17-01', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(244, 'SP17-02', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(245, 'SP17-03', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(246, 'SP17-04', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(247, 'SP17-05', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(248, 'SP17-06', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(249, 'SP17-07', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(250, 'SP17-08', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(251, 'SP17-09', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(252, 'SP17-10', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(253, 'SP17-11', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(254, 'SP17-13', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(255, 'SP17-14', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(256, 'SP17-15', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(257, 'IN-1', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Teal'),
(258, 'IN-2', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(259, 'IN16-04', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(260, 'S18-01', NULL, NULL, 49, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Navy'),
(261, '2', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(262, '3', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(263, '4', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(264, '5', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(265, 'S13-002', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(266, 'S13-003', '', '', 5, 1, 'Center Activities', 1, 0, 1, '2018-07-01', 0, 1, ''),
(267, 'S13-005', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(268, 'S13-006', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(269, 'F14-07', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(270, 'SP16-01', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(271, 'SP16-03', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(272, 'F18-01', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(273, 'F18-02', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(274, 'F18-04', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(275, 'F18-05', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(276, 'F18-06', NULL, NULL, 5, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(277, 'S17-06', NULL, NULL, 6, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(278, 'S17-07', NULL, NULL, 6, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(279, 'S17-08', NULL, NULL, 6, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(280, 'S17-09', NULL, NULL, 6, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(281, 'S17-10', NULL, NULL, 6, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Yellow'),
(282, 'S17-01', NULL, NULL, 6, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(283, 'S17-02', NULL, NULL, 6, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(284, 'S17-03', NULL, NULL, 6, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(285, 'S17-04', NULL, NULL, 6, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(286, 'S17-05', NULL, NULL, 6, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Red'),
(287, 'F13-01', NULL, 'Youth', 9, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(288, 'F13-02', NULL, 'Small/Medium', 9, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(289, 'F13-03', NULL, 'Small/Medium', 9, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(290, 'F13-04', NULL, 'Small/Medium', 9, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(291, 'F13-09', NULL, 'Small/Medium', 9, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(292, 'IO-1', NULL, 'Large/XL', 9, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(293, '4', NULL, 'Large/XL', 9, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(294, 'F13-06', NULL, 'Large/XL', 9, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(295, 'F13-07', NULL, 'Large/XL', 9, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(296, 'F13-08', NULL, 'Large/XL', 9, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(297, 'ONSP17-01', NULL, 'Large/XL', 56, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(298, 'ONSP17-02', NULL, 'Large/XL', 56, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(299, 'ONSP17-03', NULL, 'Large/XL', 56, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(300, 'ONSP17-04', NULL, 'Large/XL', 56, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(301, 'ONSP17-05', NULL, 'Large/XL', 56, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(302, 'ONSP17-06', NULL, 'Large/XL', 56, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(303, 'ONSP17-07', NULL, 'Large/XL', 56, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(304, 'ONSP17-08', NULL, 'Large/XL', 56, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(305, 'ONSP17-09', NULL, 'Large/XL', 56, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(306, '1', 'Primus', NULL, 11, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(307, '3', 'Primus', NULL, 11, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(308, 'SP16-001', NULL, NULL, 11, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(309, 'SP16-003', NULL, NULL, 11, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(310, 'S17-01', 'Luci Inflatable Sola', NULL, 7, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(311, 'S17-02', 'Luci Inflatable Sola', NULL, 7, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(312, 'S17-03', 'Luci Inflatable Sola', NULL, 7, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(313, 'S17-04', 'Luci Inflatable Sola', NULL, 7, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(314, '1', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(315, '2', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(316, '3', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(317, '4', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(318, '5', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(319, '6', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(320, '7', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(321, '8', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(322, '9', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(323, '10', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(324, '12', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(325, '12', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(326, '13', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(327, '14', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(328, '15', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(329, '16', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(330, '17', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(331, '18', NULL, 'Tall', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Black'),
(332, 'SP13-001', NULL, 'Short', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(333, 'SP13-002', NULL, 'Short', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(334, 'SP13-003', NULL, 'Short', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(335, 'SP13-004', NULL, 'Short', 13, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(336, '2', 'Rubbermaid', '80 Qt', 14, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(337, 'IN-1', 'Rubbermaid', '80 Qt', 14, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(338, 'IN-2', 'Yeti', '125 Qt', 14, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(339, 'IN-3', 'Yeti', '125 Qt', 14, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(340, 'IN-4', 'Yeti', '95 Qt', 14, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(341, 'IN-1', 'Igloo', NULL, 15, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(342, 'IN-2', 'Igloo', NULL, 15, 3, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(343, 'IN-3', 'Igloo', NULL, 15, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(344, 'IN-5', 'Igloo', NULL, 15, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(345, 'IN-4', 'Rubbermaid', NULL, 15, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(346, 'IN-1', 'Katadyn Hiker', NULL, 12, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(347, 'F14-04', 'Katadyn Hiker', NULL, 12, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(348, 'SP13-001', 'MSR', NULL, 12, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(349, '1', NULL, NULL, 47, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(350, '2', NULL, NULL, 47, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(351, '1', NULL, NULL, 48, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(352, '2', NULL, NULL, 48, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(353, '3', NULL, NULL, 48, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(354, '1', 'Net, Ball, 4 Wodden ', NULL, 23, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(355, '1', NULL, 'XXSmall', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(356, '1', NULL, 'XSmall', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(357, 'SP15-18', NULL, 'XSmall', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(358, 'SP15-04', NULL, 'Small', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(359, '4', NULL, 'Medium', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(360, 'S18-01', NULL, 'Medium', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(361, 'S18-02', NULL, 'Medium', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(362, 'S18-03', NULL, 'Medium', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(363, 'S18-04', NULL, 'Medium', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(364, 'S18-05', NULL, 'Large', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(365, 'S18-06', NULL, 'Large', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(366, 'S18-07', NULL, 'Large', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(367, 'S18-08', NULL, 'Large', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(368, 'S18-09', NULL, 'Large', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(369, 'S18-10', NULL, 'XL', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(370, 'S18-11', NULL, 'XL', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(371, 'S18-12', NULL, 'XL', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(372, 'S18-13', NULL, 'XL', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(374, 'S18-14', NULL, 'XL', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(375, '1', NULL, 'XXL', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(376, 'S18-15', NULL, 'XXL', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(377, 'S18-16', NULL, 'XXXL', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(378, 'SP15-01', NULL, 'XXXL', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(379, 'SP15-02', NULL, 'XXXL', 27, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(380, 'SP16-01', NULL, 'Small', 53, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(381, '1', NULL, 'Large', 53, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(382, '2', NULL, 'Large', 53, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(383, '2', NULL, 'Large', 53, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(384, '1', NULL, 'XL', 53, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(385, 'SP16-04', NULL, 'XL', 53, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(386, 'SP16-05', NULL, 'Medium', 53, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(387, '3', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(388, '5', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(389, '7', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(390, '15', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(391, 'IN16-02', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(392, 'IN16-03', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(393, 'IN16-04', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(394, 'IN16-05', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(395, 'IN16-06', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(396, 'IN16-07', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(397, 'S18-01', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(398, 'S18-02', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(399, 'S18-03', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(400, 'S18-04', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(401, 'S18-05', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(402, 'S18-06', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(403, 'S18-07', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(404, 'S18-08', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(405, 'S18-09', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(406, 'S18-10', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(407, 'S18-11', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(408, 'S18-12', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(409, 'S18-13', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(410, 'S18-14', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(411, 'S18-15', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(412, 'S18-16', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(413, 'S18-17', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(414, 'S18-18', 'Sea and Whitewater', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(415, '15', 'Sea and Whitewater', 'Youth', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(416, 'IN16-01', 'Sea and Whitewater', 'Youth', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(417, 'IN16-02', 'Sea and Whitewater', 'Youth', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(418, 'IN-1', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(419, 'IN16-2', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(420, 'IN16-3', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(421, 'IN16-4', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(422, 'IN16-5', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(423, 'F14-01', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(424, 'F14-02', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(425, 'F14-03', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(426, 'F14-04', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(427, 'F14-05', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(428, 'F14-06', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(429, 'F14-07', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(430, 'F14-08', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(431, 'F14-09', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(432, 'F14-10', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(433, 'F14-11', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(434, 'F14-12', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(435, 'F14-13', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(436, 'F14-14', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(437, 'F14-15', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(438, 'F14-16', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(439, 'F14-17', 'Inflatable', 'Adult', 25, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(440, '3', NULL, NULL, 60, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(441, '12', NULL, NULL, 60, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(442, '2', 'Blue Shell', NULL, 52, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(443, '1', 'Purple Parka', NULL, 52, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(444, '1', 'Snow', 'Medium', 51, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(445, '2', 'Snow', 'Medium', 51, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(446, '5', 'Snow', 'Medium', 51, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(447, '3', 'Rain', 'Woman Medium', 51, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(448, '4', 'Rain', 'Large', 51, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(449, '6', 'Rain', 'XL', 51, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(450, '1', NULL, 'Medium', 20, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(451, '3', NULL, 'Medium/Large', 20, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(452, 'IN-5', NULL, 'Medium', 20, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(453, '1', NULL, 'Large', 20, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(454, '2', NULL, 'Large', 20, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(455, 'IN-1', NULL, 'Large', 20, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(456, 'IN-2', NULL, 'Large', 20, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(457, 'IN-3', NULL, 'Large', 20, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(458, 'IN-4', NULL, 'Large', 20, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(459, 'IN-1', NULL, '5', 22, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(460, 'IN-2', NULL, '5', 22, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(461, 'IN-3', NULL, '6', 22, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(462, 'IN-4', NULL, '6', 22, 3, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(463, 'IN-9', NULL, '8', 22, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(464, 'IN-5', NULL, '9', 22, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(465, 'IN-6', NULL, '9', 22, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(466, 'IN-7', NULL, '10', 22, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(467, 'IN-8', NULL, '11', 22, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(468, '1', 'Youth', '8', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(469, 'SP15-02', 'Youth', '8', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(470, 'SP15-03', 'Youth', '8', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(471, 'SP15-01', 'Youth', '10', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(472, 'SP15-04', 'Youth', '10', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(473, 'SP15-05', 'Youth', '10', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(474, '4', 'Youth', '12', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(475, 'SP15-06', 'Youth', '12', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(476, 'SP15-07B', 'Youth', '12', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(477, 'SP15-11', 'Youth', '16', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(478, 'SP15-12', 'Youth', '16', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(479, 'S17-06', 'Youth', '16', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(480, '1', 'Men', 'Small/Medium', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(481, '12', 'Men', 'Small/Medium', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(482, 'S17-03', 'Men', 'Small/Medium', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(483, 'S15-13', 'Men', 'Medium', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(484, 'S17-04', 'Men', 'Medium', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(485, '1', 'Men', 'Medium', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(486, '3', 'Men', 'Large', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(487, 'S15-15', 'Men', 'Large', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(488, 'S17-05', 'Men', 'Large', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(489, '2', 'Men', 'XL', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(490, 'SP15-07', 'Woman', '4', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(491, 'SP15-17', 'Woman', '4', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(492, 'S17-01', 'Woman', '6', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(493, 'S15-09', 'Woman', '8', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(494, 'S15-08', 'Woman', '8', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(495, 'SP15-10', 'Woman', '10', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(496, 'S15-16', 'Woman', '10', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(497, '1', 'Woman', '10', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(498, '1', 'Woman', '12', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL);
INSERT INTO `Item` (`item_Backid`, `item_Frontid`, `item_modeltype`, `item_size`, `inv_id`, `stat_id`, `location`, `pur_price`, `ven_id`, `dbw_own`, `pur_date`, `vin_num`, `public`, `notes`) VALUES
(499, '2', 'Woman', '12', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(500, '3', 'Woman', '12', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(501, 'S13-1', 'Woman', '14', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(502, 'S13-2', 'Woman', '14', 28, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(503, '3.1', NULL, '3', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(504, '3.2', NULL, '3', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(505, '3.3', NULL, '3', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(506, '3.4', NULL, '3', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(507, '4.1', NULL, '4', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(508, '4.2', NULL, '4', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(509, 'IN16-3', NULL, '4', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(510, '5.1', NULL, '5', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(511, '5.3', NULL, '5', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(512, '5.5', NULL, '5', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(513, '6.1', NULL, '6', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(514, '6.12', NULL, '6', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(515, '6.2', NULL, '6', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(516, '6.3', NULL, '6', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(517, '6.4', NULL, '6', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(518, '7.1', NULL, '7', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(519, '7.2', NULL, '7', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(520, '7.3', NULL, '7', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(521, '7.41', NULL, '7', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(522, '4', NULL, '7', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(523, '7.8', NULL, '7', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(524, '8.1', NULL, '8', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(525, '8.2', NULL, '8', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(526, '8.3', NULL, '8', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(527, '8.4', NULL, '8', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(528, '8.5', NULL, '8', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(529, '8.6', NULL, '8', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(530, '8.7', NULL, '8', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(531, '8.8', NULL, '8', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(532, '9.1', NULL, '9', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(533, '9.2', NULL, '9', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(534, '9.3', NULL, '9', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(535, '9.31', NULL, '9', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(536, '9.5', NULL, '9', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(537, '9.6', NULL, '9', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(538, '10.1', NULL, '10', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(539, '10.3', NULL, '10', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(540, '10.2', NULL, '10', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(541, 'IN16-04', NULL, '10', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(542, '11.1', NULL, '11', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(543, '11.2', NULL, '11', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(544, '11.24', NULL, '11', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(545, '11.3', NULL, '11', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(546, '11.31', NULL, '11', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(547, '11.4', NULL, '11', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(548, '11.6', NULL, '11', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(549, '11.7', NULL, '11', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(550, '11.8', NULL, '11', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(551, '12.2', NULL, '12', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(552, '12.3', NULL, '12', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(553, '12.4', NULL, '12', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(554, '13.1', NULL, '13', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(555, '13.12', NULL, '13', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(556, '13.2', NULL, '13', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(557, '13.23', NULL, '13', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(558, '13.3', NULL, '13', 30, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(559, '1', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Green'),
(560, '2', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(561, '3', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(562, '4', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(563, '5', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Camo Top'),
(564, '9', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(565, '10', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Camo Top'),
(566, '12', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(567, '13', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(568, '14', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(569, '15', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(570, '16', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Camo Top'),
(571, '17', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(572, '18', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Blue'),
(573, '19', NULL, NULL, 34, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, 'Color:Camo Top'),
(574, '2', 'Hotline', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(575, '3', 'Hotline', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(576, '4', 'Hotline', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(577, '5', 'Hotline', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(578, '6', 'Hotline', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(579, '7', 'Ocean and Earth', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(580, '9', 'Surf More USA', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(581, '10', 'Surf More USA', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(582, '11', 'Black Surf', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(583, '13', 'Creature', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(584, '14', 'PowerClip XM', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(585, '15', 'PowerClip XM', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(586, '91', 'Creature', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(587, '101', 'PowerClip XM', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(588, '17', 'BlackSurf', NULL, 35, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(589, '4', NULL, NULL, 33, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(590, '5', NULL, NULL, 33, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(677, '1', 'KS', '146', 16, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(678, '2', 'OD', '154', 16, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(679, '4', 'Burton', '161', 16, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(680, 'IN-1', 'Yakima', 'XSmall', 21, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(681, '2', 'Yakima', 'Small/Medium', 21, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(682, 'F13-01', 'Elekra', 'Medium', 21, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(683, 'F13-02', 'Atlas', 'Medium/Large', 21, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(684, 'F13-03', 'Atlas', 'Medium/Large', 21, 1, 'Center Activities', 1, 1, 1, '2018-07-01', NULL, 1, NULL),
(685, 'F13-01', 'Red Feather', 'XL', 21, 1, 'Center Activities', 1, 0, 0, '2008-01-10', 0, 1, ''),
(702, 'test', 'test', 'test', 35, 1, 'test', 1, 0, 0, '2018-08-08', 2, 0, '0'),
(703, 'F18-01', 'norther', '11 feet', 34, 1, 'center activites', 150, 2, 0, '2018-09-10', 89876, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `ItemReserve`
--

CREATE TABLE `ItemReserve` (
  `itemreserve_id` int(11) NOT NULL,
  `item_Backid` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ItemReserve`
--

INSERT INTO `ItemReserve` (`itemreserve_id`, `item_Backid`, `rental_id`) VALUES
(240, 161, 59),
(241, 164, 60),
(242, 202, 61);

-- --------------------------------------------------------

--
-- Table structure for table `ItemTran`
--

CREATE TABLE `ItemTran` (
  `itemtran_id` int(11) NOT NULL,
  `item_Backid` int(11) NOT NULL,
  `tran_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ItemTran`
--

INSERT INTO `ItemTran` (`itemtran_id`, `item_Backid`, `tran_id`) VALUES
(563, 342, 28),
(564, 462, 28),
(565, 45, 28),
(566, 193, 29),
(567, 193, 225),
(568, 161, 226),
(569, 161, 227),
(570, 164, 228),
(571, 164, 229),
(572, 164, 230),
(573, 193, 231),
(574, 202, 232);

-- --------------------------------------------------------

--
-- Table structure for table `Packages`
--

CREATE TABLE `Packages` (
  `pack_id` int(11) NOT NULL,
  `pack_name` varchar(50) NOT NULL,
  `stu_day_price` int(11) DEFAULT NULL,
  `day_price` int(11) DEFAULT NULL,
  `stu_weekend_price` int(11) DEFAULT NULL,
  `weekend_price` int(11) DEFAULT NULL,
  `stu_week_price` int(11) DEFAULT NULL,
  `week_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Packages`
--

INSERT INTO `Packages` (`pack_id`, `pack_name`, `stu_day_price`, `day_price`, `stu_weekend_price`, `weekend_price`, `stu_week_price`, `week_price`) VALUES
(1, 'Canoe Package', 25, 35, 38, 55, 50, 60),
(2, 'River Kayak Package', 20, 26, 32, 45, 45, 60),
(3, 'Single Inflatable Kayak Package', 20, 26, 32, 45, 45, 60),
(4, 'Double Inflatable Kayak Package', 25, 35, 38, 55, 50, 65),
(5, 'Single Sea Kayak Package', 20, 26, 32, 45, 45, 60),
(6, 'Double Sea Kayak Package', 25, 35, 38, 55, 50, 65),
(7, 'Surf Package', 20, 26, 32, 40, 45, 60),
(8, 'Inflatable Stand Up Paddleboard', 20, 26, 32, 45, 45, 60);

-- --------------------------------------------------------

--
-- Table structure for table `Repair`
--

CREATE TABLE `Repair` (
  `repair_id` int(11) NOT NULL,
  `item_Backid` int(11) NOT NULL,
  `empl_id` int(11) NOT NULL,
  `repair_date` date NOT NULL,
  `repair_comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Reserve`
--

CREATE TABLE `Reserve` (
  `rental_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `due_date` date NOT NULL,
  `pick_up_date` date DEFAULT NULL,
  `cust_id` int(11) NOT NULL,
  `rh_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Reserve`
--

INSERT INTO `Reserve` (`rental_id`, `request_date`, `due_date`, `pick_up_date`, `cust_id`, `rh_id`) VALUES
(59, '2019-01-29', '2019-01-30', '2019-01-28', 29, 31),
(60, '2019-01-30', '2019-01-31', '2019-01-28', 26, 32),
(61, '2019-01-28', '2019-01-30', '2019-01-28', 34, 33);

-- --------------------------------------------------------

--
-- Table structure for table `ReserveHis`
--

CREATE TABLE `ReserveHis` (
  `rh_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `due_date` date NOT NULL,
  `pick_up_date` date DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL,
  `cust_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ReserveHis`
--

INSERT INTO `ReserveHis` (`rh_id`, `request_date`, `return_date`, `due_date`, `pick_up_date`, `total_cost`, `cust_id`) VALUES
(28, '2019-01-28', NULL, '2019-01-30', '2019-01-28', 24, 33),
(29, '2019-01-28', NULL, '2019-01-29', '2019-01-28', 4, 33),
(30, '2019-01-28', '2019-01-28', '2019-01-29', '2019-01-28', 4, 33),
(31, '2019-01-29', NULL, '2019-01-30', '2019-01-28', 26, 29),
(32, '2019-01-30', NULL, '2019-01-31', '2019-01-28', 26, 26),
(33, '2019-01-28', NULL, '2019-01-30', '2019-01-28', 20, 34);

-- --------------------------------------------------------

--
-- Table structure for table `Status`
--

CREATE TABLE `Status` (
  `stat_id` int(11) NOT NULL,
  `stat_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Status`
--

INSERT INTO `Status` (`stat_id`, `stat_name`) VALUES
(1, 'Ready'),
(2, 'Repair'),
(3, 'Check-out'),
(4, 'Check-in'),
(5, 'Missing'),
(6, 'Retire'),
(7, 'Reserved');

-- --------------------------------------------------------

--
-- Table structure for table `Transaction`
--

CREATE TABLE `Transaction` (
  `trans_id` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cust_id` int(11) NOT NULL,
  `trans_type` varchar(10) NOT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `rh_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Transaction`
--

INSERT INTO `Transaction` (`trans_id`, `time_stamp`, `cust_id`, `trans_type`, `comments`, `rh_id`) VALUES
(225, '2019-01-28 10:45:30', 33, 'pick-up', NULL, 30),
(226, '2019-01-28 10:47:33', 29, 'reserve', NULL, 31),
(227, '2019-01-28 00:00:00', 29, 'pick-up', 'Everything looks good', 31),
(228, '2019-01-28 10:50:07', 26, 'reserve', NULL, 32),
(229, '2019-01-28 00:00:00', 26, 'pick-up', 'GOOD', 32),
(230, '2019-01-28 10:54:48', 26, 'pick-up', 'GOOD', 32),
(231, '2019-01-28 10:55:59', 33, 'return', 'Looks good', 30),
(232, '2019-01-28 11:46:32', 34, 'pick-up', NULL, 33);

-- --------------------------------------------------------

--
-- Table structure for table `Vendor`
--

CREATE TABLE `Vendor` (
  `ven_id` int(11) NOT NULL,
  `ven_name` varchar(30) NOT NULL,
  `ven_phone` varchar(20) NOT NULL,
  `ven_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Vendor`
--

INSERT INTO `Vendor` (`ven_id`, `ven_name`, `ven_phone`, `ven_address`) VALUES
(2, 'Center Activities', '(707) 826-3357', '1 Harpst St, Arcata, CA 95521'),
(3, 'Humboldt Bay Aquatic Center', '911', '921 Waterfront Dr, Eureka, CA 95501');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`empl_id`);

--
-- Indexes for table `Inventory`
--
ALTER TABLE `Inventory`
  ADD PRIMARY KEY (`inv_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `InvPack`
--
ALTER TABLE `InvPack`
  ADD PRIMARY KEY (`invpack_id`),
  ADD KEY `inv_id` (`inv_id`),
  ADD KEY `InvPack_ibfk_2` (`pack_id`);

--
-- Indexes for table `Item`
--
ALTER TABLE `Item`
  ADD PRIMARY KEY (`item_Backid`),
  ADD KEY `inv_id` (`inv_id`),
  ADD KEY `stat_id` (`stat_id`) USING BTREE;

--
-- Indexes for table `ItemReserve`
--
ALTER TABLE `ItemReserve`
  ADD PRIMARY KEY (`itemreserve_id`),
  ADD KEY `ItemReserve_ibfk_1` (`item_Backid`),
  ADD KEY `ItemReserve_ibfk_2` (`rental_id`);

--
-- Indexes for table `ItemTran`
--
ALTER TABLE `ItemTran`
  ADD PRIMARY KEY (`itemtran_id`),
  ADD KEY `ItemTran_ibfk_1` (`item_Backid`),
  ADD KEY `ItemTran_ibfk_2` (`tran_id`);

--
-- Indexes for table `Packages`
--
ALTER TABLE `Packages`
  ADD PRIMARY KEY (`pack_id`);

--
-- Indexes for table `Repair`
--
ALTER TABLE `Repair`
  ADD PRIMARY KEY (`repair_id`),
  ADD KEY `empl_id` (`empl_id`),
  ADD KEY `item_Backid` (`item_Backid`);

--
-- Indexes for table `Reserve`
--
ALTER TABLE `Reserve`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `Reserve_ibfk_1` (`cust_id`),
  ADD KEY `rh_id` (`rh_id`);

--
-- Indexes for table `ReserveHis`
--
ALTER TABLE `ReserveHis`
  ADD PRIMARY KEY (`rh_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `Status`
--
ALTER TABLE `Status`
  ADD PRIMARY KEY (`stat_id`);

--
-- Indexes for table `Transaction`
--
ALTER TABLE `Transaction`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `Transaction_ibfk_1` (`cust_id`),
  ADD KEY `rh_id` (`rh_id`);

--
-- Indexes for table `Vendor`
--
ALTER TABLE `Vendor`
  ADD PRIMARY KEY (`ven_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `Employee`
--
ALTER TABLE `Employee`
  MODIFY `empl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Inventory`
--
ALTER TABLE `Inventory`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `InvPack`
--
ALTER TABLE `InvPack`
  MODIFY `invpack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `Item`
--
ALTER TABLE `Item`
  MODIFY `item_Backid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=704;

--
-- AUTO_INCREMENT for table `ItemReserve`
--
ALTER TABLE `ItemReserve`
  MODIFY `itemreserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `ItemTran`
--
ALTER TABLE `ItemTran`
  MODIFY `itemtran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=575;

--
-- AUTO_INCREMENT for table `Packages`
--
ALTER TABLE `Packages`
  MODIFY `pack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Repair`
--
ALTER TABLE `Repair`
  MODIFY `repair_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Reserve`
--
ALTER TABLE `Reserve`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `ReserveHis`
--
ALTER TABLE `ReserveHis`
  MODIFY `rh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `Status`
--
ALTER TABLE `Status`
  MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Transaction`
--
ALTER TABLE `Transaction`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT for table `Vendor`
--
ALTER TABLE `Vendor`
  MODIFY `ven_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Inventory`
--
ALTER TABLE `Inventory`
  ADD CONSTRAINT `Inventory_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `Category` (`cat_id`) ON UPDATE CASCADE;

--
-- Constraints for table `InvPack`
--
ALTER TABLE `InvPack`
  ADD CONSTRAINT `InvPack_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `Inventory` (`inv_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `InvPack_ibfk_2` FOREIGN KEY (`pack_id`) REFERENCES `Packages` (`pack_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Item`
--
ALTER TABLE `Item`
  ADD CONSTRAINT `Item_ibfk_1` FOREIGN KEY (`stat_id`) REFERENCES `Status` (`stat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Item_ibfk_2` FOREIGN KEY (`inv_id`) REFERENCES `Inventory` (`inv_id`) ON UPDATE CASCADE;

--
-- Constraints for table `ItemReserve`
--
ALTER TABLE `ItemReserve`
  ADD CONSTRAINT `ItemReserve_ibfk_1` FOREIGN KEY (`item_Backid`) REFERENCES `Item` (`item_Backid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ItemReserve_ibfk_2` FOREIGN KEY (`rental_id`) REFERENCES `Reserve` (`rental_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Reserve`
--
ALTER TABLE `Reserve`
  ADD CONSTRAINT `Reserve_ibfk_1` FOREIGN KEY (`rh_id`) REFERENCES `ReserveHis` (`rh_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
