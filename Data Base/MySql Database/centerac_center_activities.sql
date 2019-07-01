-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2019 at 11:31 PM
-- Server version: 10.2.25-MariaDB
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
-- Table structure for table `CheckIn`
--

CREATE TABLE `CheckIn` (
  `check_in_id` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rent_id` int(11) NOT NULL,
  `item_Backid` int(11) NOT NULL,
  `empl_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CheckIn`
--

INSERT INTO `CheckIn` (`check_in_id`, `time_stamp`, `rent_id`, `item_Backid`, `empl_id`) VALUES
(4, '2019-06-04 14:21:17', 46, 524, 28),
(5, '2019-06-04 14:21:17', 46, 561, 28),
(6, '2019-06-04 14:21:17', 46, 583, 28),
(7, '2019-06-04 14:21:17', 46, 487, 28),
(59, '2019-06-23 19:47:55', 85, 857, 30),
(60, '2019-06-25 09:20:54', 86, 858, 30),
(61, '2019-06-25 09:21:04', 89, 858, 30),
(62, '2019-06-25 12:36:22', 87, 857, 30),
(63, '2019-06-26 10:36:39', 93, 400, 30),
(64, '2019-06-26 10:36:39', 93, 405, 30),
(65, '2019-06-26 10:36:39', 93, 414, 30),
(66, '2019-06-26 10:36:39', 93, 904, 30),
(67, '2019-06-26 10:36:39', 93, 917, 30),
(68, '2019-06-26 10:36:39', 93, 30, 30),
(69, '2019-06-26 10:36:39', 93, 89, 30),
(70, '2019-06-26 10:36:39', 93, 90, 30),
(71, '2019-06-26 10:36:39', 93, 91, 30),
(72, '2019-06-26 10:36:39', 93, 120, 30),
(73, '2019-06-26 10:36:54', 95, 97, 30),
(74, '2019-06-26 10:36:54', 95, 117, 30),
(75, '2019-06-26 12:22:15', 88, 857, 30),
(76, '2019-06-26 12:22:15', 88, 860, 30),
(77, '2019-06-26 12:22:15', 88, 1, 30),
(78, '2019-06-26 12:22:15', 88, 1, 30),
(79, '2019-06-26 12:22:15', 88, 1, 30),
(80, '2019-06-26 12:22:15', 88, 7, 30),
(81, '2019-06-26 12:22:15', 88, 7, 30),
(82, '2019-06-26 12:22:15', 88, 7, 30),
(83, '2019-06-26 12:22:15', 88, 7, 30),
(84, '2019-06-26 12:22:32', 91, 860, 30),
(85, '2019-06-26 12:22:32', 91, 1, 30),
(86, '2019-06-26 12:22:32', 91, 1, 30),
(87, '2019-06-26 12:22:32', 91, 1, 30),
(88, '2019-06-26 12:22:32', 91, 7, 30),
(89, '2019-06-26 12:22:32', 91, 7, 30),
(90, '2019-06-26 12:22:32', 91, 7, 30),
(91, '2019-06-26 12:22:32', 91, 7, 30),
(92, '2019-06-26 12:22:44', 96, 1, 30),
(93, '2019-06-26 12:22:44', 96, 1, 30),
(94, '2019-06-26 12:22:44', 96, 1, 30),
(95, '2019-06-26 12:22:44', 96, 7, 30),
(96, '2019-06-26 12:22:44', 96, 7, 30),
(97, '2019-06-26 12:22:44', 96, 7, 30),
(98, '2019-06-26 12:22:44', 96, 7, 30),
(99, '2019-06-26 13:59:44', 97, 962, 30),
(100, '2019-06-26 13:59:44', 97, 139, 30),
(101, '2019-06-26 13:59:44', 97, 141, 30),
(102, '2019-06-26 13:59:44', 97, 390, 30),
(103, '2019-06-26 13:59:44', 97, 538, 30),
(104, '2019-06-26 13:59:44', 97, 842, 30),
(105, '2019-06-26 13:59:44', 97, 582, 30),
(106, '2019-06-26 13:59:44', 97, 476, 30),
(109, '2019-07-01 12:00:17', 90, 936, 30),
(110, '2019-07-01 12:00:17', 90, 220, 30),
(111, '2019-07-01 12:00:17', 90, 300, 30),
(112, '2019-07-01 12:00:17', 90, 173, 30),
(113, '2019-07-01 12:00:17', 90, 335, 30);

-- --------------------------------------------------------

--
-- Table structure for table `CheckOut`
--

CREATE TABLE `CheckOut` (
  `check_out_id` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rent_id` int(11) NOT NULL,
  `item_Backid` int(11) NOT NULL,
  `empl_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CheckOut`
--

INSERT INTO `CheckOut` (`check_out_id`, `time_stamp`, `rent_id`, `item_Backid`, `empl_id`) VALUES
(33, '2019-06-04 00:00:00', 62, 293, 28),
(34, '2019-06-04 00:00:00', 62, 509, 28),
(35, '2019-06-04 00:00:00', 62, 560, 28),
(36, '2019-06-04 00:00:00', 62, 585, 28),
(37, '2019-06-04 00:00:00', 62, 468, 28),
(80, '2019-06-23 16:40:27', 85, 857, 30),
(81, '2019-06-23 19:52:37', 86, 860, 30),
(82, '2019-06-24 00:00:00', 88, 857, 30),
(83, '2019-06-24 00:00:00', 89, 858, 30),
(84, '2019-06-24 18:57:31', 89, 858, 30),
(85, '2019-06-25 00:00:00', 90, 936, 28),
(86, '2019-06-25 00:00:00', 90, 220, 28),
(87, '2019-06-25 00:00:00', 90, 300, 28),
(88, '2019-06-25 00:00:00', 90, 173, 28),
(89, '2019-06-25 00:00:00', 90, 335, 28),
(95, '2019-06-25 00:00:00', 91, 860, 30),
(96, '2019-06-25 00:00:00', 92, 99, 28),
(97, '2019-06-25 00:00:00', 92, 94, 28),
(98, '2019-06-25 00:00:00', 92, 95, 28),
(99, '2019-06-25 00:00:00', 92, 398, 28),
(100, '2019-06-25 00:00:00', 92, 399, 28),
(101, '2019-06-25 00:00:00', 92, 402, 28),
(102, '2019-06-25 00:00:00', 92, 412, 28),
(103, '2019-06-25 00:00:00', 92, 413, 28),
(104, '2019-06-25 00:00:00', 92, 146, 28),
(105, '2019-06-25 00:00:00', 93, 400, 28),
(106, '2019-06-25 00:00:00', 93, 405, 28),
(107, '2019-06-25 00:00:00', 93, 414, 28),
(108, '2019-06-25 00:00:00', 93, 904, 28),
(109, '2019-06-25 00:00:00', 93, 917, 28),
(110, '2019-06-25 00:00:00', 93, 30, 28),
(111, '2019-06-25 00:00:00', 93, 89, 28),
(112, '2019-06-25 00:00:00', 93, 90, 28),
(113, '2019-06-25 00:00:00', 93, 91, 28),
(114, '2019-06-25 00:00:00', 93, 120, 28),
(115, '2019-06-25 00:00:00', 94, 178, 28),
(116, '2019-06-25 00:00:00', 95, 97, 28),
(117, '2019-06-25 00:00:00', 95, 117, 28),
(120, '2019-06-26 00:00:00', 96, 1, 30),
(121, '2019-06-26 00:00:00', 96, 1, 30),
(122, '2019-06-26 00:00:00', 96, 1, 30),
(123, '2019-06-26 00:00:00', 96, 7, 30),
(124, '2019-06-26 00:00:00', 96, 7, 30),
(125, '2019-06-26 00:00:00', 96, 7, 30),
(126, '2019-06-26 00:00:00', 96, 7, 30),
(127, '2019-06-26 00:00:00', 97, 962, 30),
(128, '2019-06-26 00:00:00', 97, 139, 30),
(129, '2019-06-26 00:00:00', 97, 141, 30),
(130, '2019-06-26 00:00:00', 97, 390, 30),
(131, '2019-06-26 00:00:00', 97, 538, 30),
(132, '2019-06-26 00:00:00', 97, 842, 30),
(133, '2019-06-26 00:00:00', 97, 582, 30),
(134, '2019-06-26 00:00:00', 97, 476, 30);

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `cust_id` int(11) NOT NULL,
  `f_name` varchar(25) NOT NULL,
  `l_name` varchar(25) NOT NULL,
  `c_stu_id` varchar(10) DEFAULT NULL,
  `c_driver_id` varchar(8) DEFAULT NULL,
  `c_street_addr` varchar(100) NOT NULL,
  `c_city` varchar(30) DEFAULT NULL,
  `c_state` varchar(13) DEFAULT NULL,
  `c_zip_code` varchar(10) DEFAULT NULL,
  `c_phone` varchar(12) NOT NULL,
  `c_email` varchar(50) NOT NULL,
  `is_student` varchar(5) NOT NULL,
  `is_employee` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`cust_id`, `f_name`, `l_name`, `c_stu_id`, `c_driver_id`, `c_street_addr`, `c_city`, `c_state`, `c_zip_code`, `c_phone`, `c_email`, `is_student`, `is_employee`) VALUES
(51, 'Lam', 'Ngo', '', '', '2351 Westwood Ct. Apt #F4', 'Arcata', 'CA', '95521', '7148558785', 'lhn41@humboldt.edu', 'No', 'Yes'),
(61, 'Jose', 'Cabello', '949398808', '', '2351 Westwood Ct., Apt. D4', 'Arcata', 'CA', '95521', '9094610589', 'jac937@humboldt.edu', 'Yes', 'Yes'),
(62, 'Geniva', 'Hayden', '', '44444', '1 harpst st.', 'Arcata', 'CA', '95521', '7073656670', 'gih11@humboldt.edu', 'No', 'Yes'),
(63, 'Jack', 'Mezera', '012470000', '', '337 I street', 'Arcata', 'CA', '95521', '6308155709', 'jgm295@humboldt.edu', 'Yes', 'Yes'),
(66, 'Rowan', 'Gill', '012503228', '', 'PO Box 1088', 'Fort Bragg', 'CA', '95437', '707-357-4830', 'rtg67@humboldt.edu', 'Yes', 'Yes'),
(67, 'Levi', 'Kujawa-Seda', '012484521', '', '2402 Myrtle Ave', 'Eureka', 'CA', '95501', '707-273-3223', 'lrk128@humboldt.edu', 'Yes', 'Yes'),
(68, 'Teja', 'Blue-Kerr', '013613935', '', '355 Granite Avenue', 'Arcata', 'CA', '95521', '530-514-9928', 'tkk14@humboldt.edu', 'Yes', 'No'),
(69, 'Azael', 'Caraves', '200033254', '', '890 12th Street', 'Arcata', 'CA', '95521', '408-603-6518', 'Azaelcaraves@gmail.com', 'Yes', 'No'),
(70, 'Clarissa', 'Honeker', '013212755', '', '1 Rossow St. #234 B1', 'Arcata', 'CA', '95521', '8086832517', 'cmb25@humboldt.edu', 'Yes', 'No'),
(71, 'Lukasz', 'Fornalski', '01162061', '', '560 24th Street Unit A', 'Arcata', 'CA', '95521', '916-412-0380', 'lj31@humboldt.edu', 'Yes', 'No'),
(72, 'Reagan', 'Hester', '012480660', '', '1454 Pedro Drive', 'Arcata', 'CA', '95521', '530-391-4536', 'ren268@humboldt.edu', 'Yes', 'No'),
(73, 'Jane', 'Lott', '013160755', '', '780 D Street', 'Arcata', 'CA', '95521', '818-641-4200', 'jml35@humboldt.edu', 'Yes', 'No'),
(74, 'Stephanie', 'Santana', '012593370', '', '1975 H Street Apt#E', 'Arcata', 'CA', '95521', '916-706-8820', 'sgs201@humboldt.edu', 'Yes', 'No'),
(75, 'Tonita', 'Johnson', '012954575', '', '830 Bayside Road Apt#A', 'Arcata', 'CA', '95521', '818-641-7861', 'tgj37@humboldt.edu', 'Yes', 'No'),
(76, 'Soledad', 'Carbajal-Osegura', '012291081', '', '2037 Tuna Ct', 'Arcata', 'CA', '95521', '805-260-3321', 'sc2596@humboldt.edu', 'Yes', 'No'),
(77, 'Leah', 'Lauritson', '012453243', '', '1851 E Florida St. #102', 'Long Beach', 'CA', '90802', '951-204-1192', 'lrl163@humboldt.edu', 'Yes', 'No'),
(78, 'Elias', 'Amador', '013256877', '', '3000 Granite Ave. #814', 'Arcata', 'CA', '95521', '323-474-7913', 'eda20@humboldt.edu', 'Yes', 'No'),
(79, 'Alexander', 'Boock', '013556241', '', '1 Rossow Street 122 D1', 'Arcata', 'CA', '95521', '714-457-4998', 'agb58@humboldt.edu', 'Yes', 'No'),
(80, 'Dalton', 'Duckett', '0131-12187', '', '708 Patrick Court', 'Arcata', 'CA', '95521', '951-704-8259', 'dwd15@humboldt.edu', 'Yes', 'No'),
(81, 'Tmike', 'Asprey', '', 'A9082568', '1968 Peninsula Drive', 'Arcata', 'CA', '95521', '619-944-5674', 'sockbike2@hotmail.com', 'No', 'No'),
(82, 'Carrissa', 'Hernandez', '012499575', '', '1961 H Street', 'Arcata', 'CA', '95521', '951-522-8849', 'crh436@humboldt.edu', 'Yes', 'No'),
(83, 'Alana', 'Sweeney', '0125-43034', '', '1975 H Street Apt#C', 'Arcata', 'CA', '95521', '303-834-5867', 'ans639@humboldt.edu', 'Yes', 'No'),
(84, 'Caroline', 'Ristuccia', '013154723', '', '1280 Foster Ave Apt#C', 'Arcata', 'CA', '95521', '630-408-8504', 'car27@humboldt.edu', 'Yes', 'No'),
(85, 'Andria', 'Martin', '012535520', '', '3200 West End Road', 'Arcata', 'CA', '95521', '208-608-1150', 'aam748@humboldt.edu', 'Yes', 'No'),
(86, 'Kyle', 'Barney', '013098979', '', '452 Beverly Drive', 'Arcata', 'CA', '95521', '530-859-2262', 'kab1525@humboldt.edu', 'Yes', 'Yes'),
(87, 'Cullen', 'Groom', '012203773', '', '180 South G Street Apt#D', 'Arcata', 'CA', '95521', '530-262-8946', 'cpg87@humboldt.edu', 'Yes', 'Yes'),
(88, 'Jennifer', 'Kloepfer', '012574637', '', '1 Rossow Street 335 D1', 'Arcata', 'CA', '95521', '714-833-8643', 'jlk525@humboldt.edu', 'Yes', 'No'),
(89, 'Michael', 'Curtis', '012342990', '', '700 Union Street', 'Arcata', 'CA', '95521', '619-807-8984', 'mic666@humboldt.edu', 'Yes', 'No'),
(90, 'Brianna', 'Neira', '012579148', '', '796 17th Street', 'Arcata', 'CA', '95521', '831-223-8563', 'bch58@humboldt.edu', 'Yes', 'No'),
(91, 'Bedo', 'Hernandez', '012166398', '', '315 Union Street Apt#2G', 'Arcata', 'CA', '95521', '424-240-2080', 'bh1012@humboldt.edu', 'Yes', 'No'),
(92, 'Alexis', 'Thompson', '', '22860268', '11701 Norwegian Wood Drive', 'Austin', 'TX', '78758', '512-557-0059', 'althompson021@gmail.com', 'No', 'No'),
(93, 'Dummy', 'Person', '12209832', 'F1247652', '111 Washington Street', 'Arcata', 'CA', '95521', '707-876-0009', 'DP725@gmail.com', 'Yes', 'No'),
(94, 'Dummy', 'Person2', '', '123412', 'testing 123 Street', 'Arcata', 'CA', '95521', '12341234', 'testing@gmail.com', 'No', 'No'),
(95, 'Ryan', 'Starbuck', '0132-70514', '', 'PO Box 6384', 'Eureka', 'CA', '95502', '8054402471', 'res18@humboldt.edu', 'Yes', 'No'),
(96, 'Damon', 'Stewart', '', 'Y8746138', '2258 Norma Ct.', 'Eureka', 'CA', '95503', '7075729333', 'damonwcf@gmail.com', 'No', 'No'),
(97, 'Doyle', 'Coyne', '948808439', '', '2230 Ross St.', 'Arcata', 'CA', '95521', '7072230321', 'djc509@humboldt.edu', 'Yes', 'No'),
(98, 'Cameron', 'Mejia', '012955368', '', '3353 Spear Ave.', 'Arcata', 'CA', '95521', '7026229246', 'ctm275@humboldt.edu', 'Yes', 'No'),
(99, 'Victoria', 'Kozbial', '', 'F4581542', '8183008915', 'Tarzana', 'CA', '91356', '8183008915', 'victoria.kozbial@eagles.cui.edu', 'No', 'No'),
(100, 'Patricia', 'Angeles', '013287271', '', '233 F Street', 'Arcata', 'CA', '95521', '251-376-0817', 'paa25@humboldt.edu', 'Yes', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `empl_id` int(11) NOT NULL,
  `empl_fname` varchar(20) NOT NULL,
  `empl_lname` varchar(20) NOT NULL,
  `phone_num` varchar(12) NOT NULL,
  `title` varchar(15) NOT NULL,
  `access_lvl` varchar(1) NOT NULL,
  `empl_email` varchar(50) NOT NULL,
  `user_n` varchar(20) NOT NULL,
  `pass_w` varchar(20) NOT NULL,
  `loc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`empl_id`, `empl_fname`, `empl_lname`, `phone_num`, `title`, `access_lvl`, `empl_email`, `user_n`, `pass_w`, `loc_id`) VALUES
(4, 'Bridget', 'Hand', '707-826-3357', 'Boss', '4', 'Bridget.Hand@humboldt.edu', 'bch48', 'Bridget95521', 1),
(22, 'Gen', 'Hayden', '7073656670', 'Front Desk', '2', 'gih11@humboldt.edu', 'gih11', 'Ihateclass1', 1),
(27, 'Aaron', 'Fry', '530-913-7117', 'Gear Room', '2', 'acf300@humboldt.edu', 'aaronfry', 'Lavagoo22', 1),
(28, 'Kacie', 'Hallahan', '5628435595', 'Receptionist', '2', 'krh12@humboldt.edu', 'Krh12', 'KrH100696', 1),
(29, 'Susan', 'Hamblen', '826-4195', 'Office Coordina', '3', 'slh2@humboldt.edu', 'slh2', 'Leapfrog29', 1),
(30, 'Lam', 'Ngo', '714-855-8785', 'App Guy', '4', 'lhn41@humboldt.edu', 'LN009', 'Evilvsgood123', 1);

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
(2, 'Tent(1-3 person)', 2, 20, 26, 25, 35, 32, 40),
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
(54, 'Outdoor Nation Sleeping Bag', 2, 6, 0, 6, 0, 6, 0),
(55, 'Outdoor Nation Tent', 2, 10, 0, 10, 0, 10, 0),
(56, 'Outdoor Nation Backpack', 2, 5, 0, 5, 0, 5, 0),
(57, 'Canoe Paddle', 1, 4, 7, 10, 13, 13, 16),
(58, 'Sea Kayak Paddle', 1, 4, 7, 10, 13, 13, 16),
(59, 'Inflatable Kayak Paddle', 1, 4, 7, 10, 13, 13, 16),
(60, 'Soft Car Racks', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'Tent(4-8 person)', 2, 25, 35, 32, 40, 45, 55),
(64, 'Canoes', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'Inflatable Rescue Boat', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'SailBoats', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'SUPs', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 'River Kayaks', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'Sea Kayaks', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'Sit On Top Kayaks', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'Hammock Strap', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'pan', 2, 10, 10, 10, 10, 10, 10),
(73, 'SUP Paddles', 4, 4, 7, 13, 16, 10, 13),
(74, 'Inflatable SUP', 4, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'Raft', 1, 0, 0, 0, 0, 0, 0),
(78, 'Sea Kayak Seat', 1, 0, 0, 0, 0, 0, 0),
(79, 'Stern Frames', 1, 0, 0, 0, 0, 0, 0),
(80, 'Rope', 1, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `InvLoc`
--

CREATE TABLE `InvLoc` (
  `invloc_id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(10, 6, 58),
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
(29, 7, 35),
(30, 1, 57),
(31, 4, 31),
(32, 4, 24),
(33, 4, 25),
(34, 6, 58),
(35, 6, 25),
(36, 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `Item`
--

CREATE TABLE `Item` (
  `item_Backid` int(11) NOT NULL,
  `item_Frontid` varchar(20) NOT NULL,
  `item_modeltype` varchar(50) DEFAULT NULL,
  `item_size` varchar(20) DEFAULT NULL,
  `inv_id` int(20) NOT NULL,
  `stat_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `pur_price` int(11) NOT NULL,
  `ven_id` int(11) NOT NULL,
  `dbw_own` tinyint(1) NOT NULL,
  `pur_date` date NOT NULL,
  `vin_num` varchar(20) DEFAULT NULL,
  `public` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Item`
--

INSERT INTO `Item` (`item_Backid`, `item_Frontid`, `item_modeltype`, `item_size`, `inv_id`, `stat_id`, `loc_id`, `pur_price`, `ven_id`, `dbw_own`, `pur_date`, `vin_num`, `public`) VALUES
(1, 'Red/Black', 'Pyranha H2 245', '8 feet', 37, 1, 1, 0, 0, 1, '2019-06-05', '', 1),
(2, 'Orange/Black', 'Pyranha H2 245', '8 feet', 37, 1, 1, 1, 0, 1, '2018-07-01', '0', 1),
(3, 'Red/Blue', 'Jackson Super Hero', 'Tall', 37, 1, 1, 1, 0, 0, '2018-07-01', 'JKQ10291G212', 0),
(4, 'Green', 'Jackson Super Hero', '7 feet, 9 inches', 37, 1, 1, 1, 0, 0, '2018-07-01', 'JKQ07638E212', 1),
(5, 'Orange', 'Jackson Little Hero', '7 feet, 1 inch', 37, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(6, 'Orange', 'Jackson Hero', '7 feet, 5 inches', 37, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(7, 'Green', 'Jackson Fun Runner', '7 feet, 9 inches', 37, 4, 1, 1, 0, 0, '2018-07-01', 'JKQ07155E212', 1),
(8, 'Red', 'Jackson Fun Runner 60', '8 feet', 37, 1, 1, 1, 0, 0, '2018-07-01', 'JKQ02343B212', 1),
(9, 'Pink', 'Jackson Hero', '7 feet, 5 inches', 37, 1, 1, 1, 0, 0, '2018-07-01', 'JKQD1574E8A8', 1),
(10, 'Pink', 'Jackson Super Hero', '7 feet, 9 inches', 37, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(11, 'Red', 'Jackson Hero', '7 feet, 5 inches', 37, 1, 1, 1, 0, 0, '2018-07-01', 'JKQ09481F212', 1),
(12, 'Red', 'Jackson Hero', '7 feet, 5 inches', 37, 1, 1, 1, 0, 0, '2018-07-01', 'JKQ09426F212', 1),
(13, 'Red/Blue', 'Jackson Hero', '7 feet, 5 inches', 37, 1, 1, 1, 0, 0, '2018-07-01', 'JKQ09416F212', 1),
(14, 'Red', 'Jackson Zen', '8 feet', 37, 1, 1, 1, 0, 0, '2018-07-01', 'JKQ10258G212', 0),
(15, '3', 'Seals Shocker 1.4', 'Medium', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 0),
(16, '23', 'NRS River', 'Medium', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(17, '41', 'NRS River', 'Medium', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(18, '5', 'Seals Shocker 1.4', 'Medium', 26, 1, 1, 0, 0, 0, '2018-07-01', '0', 0),
(19, '60', 'Seals Shocker 1.4', 'Medium', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(20, '1', 'Seals Shocker 1.7', 'Medium', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(21, '2', 'Seals Shocker 1.7', 'Medium', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 0),
(22, '34', 'Seals Shocker 1.7', 'Medium', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 0),
(23, '2', 'NRS River', 'Large', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(24, '42', 'Seals Shocker 1.7', 'Large', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(25, '1', 'Protec Ace Water', 'Small', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(26, '12', 'Protec Ace Water', 'Medium', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(27, 'IN16-018', 'NRS', 'Large/XL', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(28, 'F14-054', 'NRS Ace Water', 'Medium', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(29, 'F14-068', 'NRS Ace Water', 'Medium', 24, 5, 1, 1, 0, 0, '2018-07-01', '0', 1),
(30, 'F14-023', 'NRS Ace Water', 'Small', 24, 4, 1, 1, 0, 0, '2018-07-01', '0', 1),
(31, 'F14-09', 'NRS Ace Water', 'Medium', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(32, 'IN16-019', 'NRS', 'Large', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(33, 'F14-10', 'NRS Ace Water', 'Large', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(34, 'F14-14', 'NRS Ace Water', 'Large', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(35, 'IN16-83', 'NRS', 'Large/XL', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(36, 'IN16-062', 'NRS', 'Large/XL', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(37, 'IN16-049', 'NRS', 'Large/XL', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(39, '101', 'NRS Ace Water', 'Universal', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(40, '37', 'Protec Ace Water', 'Medium', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(41, 'S18-01', 'Hyside Yellow Helmet', 'Universal', 24, 1, 1, 15, 0, 0, '2018-07-01', '0', 1),
(42, 'S18-02', 'Hyside Yellow Helmet', 'Universal', 24, 1, 1, 15, 0, 0, '2018-07-01', '0', 1),
(43, 'S18-03', 'Hyside Yellow Helmet', 'Universal', 24, 1, 1, 15, 0, 0, '2018-07-01', '0', 1),
(44, 'S18-04', 'Hyside Yellow Helmet', 'Universal', 24, 1, 1, 15, 0, 0, '2018-07-01', '0', 1),
(45, 'S18-05', 'Hyside Yellow Helmet', 'Universal', 24, 1, 1, 15, 0, 0, '2018-07-01', '0', 1),
(46, 'S18-06', 'Hyside Yellow Helmet', 'Universal', 24, 1, 1, 15, 0, 0, '2018-07-01', '0', 1),
(47, 'S18-07', 'Hyside Yellow Helmet', 'Universal', 24, 1, 1, 15, 0, 0, '2018-07-01', '0', 1),
(48, 'S18-08', 'Hyside Yellow Helmet', 'Universal', 24, 1, 1, 15, 0, 0, '2018-07-01', '0', 1),
(49, 'S18-09', 'Hyside Yellow Helmet', 'Universal', 24, 1, 1, 15, 0, 0, '2018-07-01', '0', 1),
(50, 'S18-10', 'Hyside Yellow Helmet', 'Universal', 24, 1, 1, 15, 0, 0, '2018-07-01', '0', 1),
(51, 'S18-11', 'Hyside Yellow Helmet', 'Universal', 24, 1, 1, 15, 0, 0, '2018-07-01', '0', 1),
(52, 'S18-12', 'Hyside Yellow Helmet', 'Universal', 24, 1, 1, 15, 0, 0, '2018-07-01', '0', 1),
(53, 'S16-011', 'WRSI Current Helmet', 'Medium/Large', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(54, 'S16-022', 'WRSI Current Helmet', 'Medium/Large', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(55, 'S16-03', 'WRSI Current Helmet', 'Medium/Large', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(56, 'S16-55', 'WRSI Current Helmet', 'Small/Medium', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(57, 'S16-068', 'WRSI Current Helmet', 'Small/Medium', 24, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(58, 'S13-01', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(59, 'S13-3', 'NRS', 'One Size', 40, 2, 1, 1, 0, 0, '2018-07-01', '0', 1),
(60, 'S13-4', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(61, 'S13-5', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(62, 'S13-6', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(63, 'S13-8', 'NRS', 'One Size', 40, 2, 1, 1, 0, 0, '2018-07-01', '0', 1),
(64, 'S13-10', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(65, 'S13-11', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(66, 'S13-12', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(67, 'S13-13', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(68, 'S13-14', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(69, 'S13-17', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(70, 'S13-20', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(71, 'S13-22', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(72, 'S13-23', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 0),
(73, '1', 'NRS', 'One Size', 40, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(74, '12', 'Werner Sherpa', '185', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(75, '20', 'Werner Sherpa', '185', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(76, '31', 'Werner Sherpa', '185', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(77, '15', 'Werner Sherpa', '190', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(78, '22', 'Werner Sherpa', '190', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(79, '32', 'Werner Sherpa', '190', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(80, '16', 'Werner Sherpa', '195', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(81, '21', 'Werner Sherpa', '195', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(82, '33', 'Werner Sherpa', '195', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(83, '41', 'Werner', '195', 31, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(84, '5', 'Werner Sherpa', '195', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(85, '6', 'Werner Sherpa', '195', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(86, '7', 'Werner Sherpa', '195', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(87, '8', 'Werner Sherpa', '195', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(88, '14', 'Werner Sherpa', '200', 31, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(89, 'F1', 'Vanguard Inflatable', 'Single', 38, 4, 1, 1, 0, 0, '2018-07-01', '', 1),
(90, 'F2', 'Vanguard Inflatable', 'Single', 38, 4, 1, 1, 0, 0, '2018-07-01', '', 1),
(91, 'F3', 'Vanguard Inflatable', 'Single', 38, 4, 1, 1, 0, 0, '2018-07-01', '', 1),
(92, 'F4', 'Vanguard Inflatable', 'Single', 38, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(93, 'F5', 'Vanguard Inflatable', 'Single', 38, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(94, 'F6', 'Vanguard Inflatable', 'Single', 38, 3, 1, 1, 0, 0, '2018-07-01', '', 1),
(95, 'F7', 'Vanguard Inflatable', 'Single', 38, 3, 1, 1, 0, 0, '2018-07-01', '', 1),
(96, 'F7', NULL, NULL, 38, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(97, 'F8', 'Vanguard Inflatable', 'Double', 39, 4, 1, 1, 0, 0, '2018-07-01', '', 1),
(98, 'F9', 'Vanguard Inflatable', 'Double', 39, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(99, 'F10', 'Vanguard Inflatable', 'Double', 39, 3, 1, 1, 0, 0, '2018-07-01', '', 1),
(100, 'F14-01', 'Carlisle Inflatable', 'One Size', 59, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(101, 'F14-02', 'Inflatable', NULL, 59, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(102, 'F14-03', 'Carlisle Inflatable', 'One Size', 59, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(103, 'F14-04', 'Carlisle Inflatable', 'One Size', 59, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(104, 'F14-05', 'Carlisle Inflatable', 'One Size', 59, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(105, 'F14-06', 'Carlisle Inflatable', 'One Size', 59, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(106, 'F14-07', 'Carlisle Inflatable', 'One Size', 59, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(107, 'F14-08', 'Carlisle Inflatable', 'One Size', 59, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(108, 'F14-09', 'Carlisle Inflatable', 'One Size', 59, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(109, 'F14-10', 'Carlisle Inflatable', 'One Size', 59, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(110, 'F14-11', 'Carlisle Inflatable', 'One SIZE', 59, 1, 1, 1, 0, 0, '2018-07-01', '', 0),
(111, 'F14-12', 'Carlisle Inflatable', 'One Size', 59, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(112, 'F14-13', 'Carlisle Inflatable', 'One Size', 59, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(113, 'F14-14', 'Carlisle Inflatable', 'One Size', 59, 2, 1, 1, 0, 0, '2018-07-01', '', 1),
(114, '1', 'SnowBoard Shoes', NULL, 16, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(115, '1', 'K', 'Small', 41, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(116, '3', 'Carlson Barrel', 'Small', 41, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(117, 'S18-02', 'Carlson Barrel', 'Small', 41, 4, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(118, '1', 'Carlson Barrel', 'Big', 41, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(119, '2', 'Carlson Barrel', 'Big', 41, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(120, 'S18-01', 'Carlson Barrel', 'Big', 41, 4, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(121, 'Yellow', 'Necky-Manitou/Sit-In', '', 42, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(122, 'Yellow', 'Necky-Eskia/Sit-In', '', 42, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(123, 'A7', 'Malibu Two, Sit-On-Top', 'Two Person', 43, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(124, 'A34', 'Frenzy, Sit-On-Top', 'One Person', 42, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(125, 'A31', 'Frenzy, Sit-On-Top', 'One Person', 42, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(126, '2', 'Werner Sea', '230', 58, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(127, '30', 'Werner Sea', '230', 58, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(128, '40', 'Werner Sea', '230', 58, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(129, '13', 'Werner Sea', '205', 58, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(130, '3', 'Werner Sea', '235', 58, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(131, '11', 'Werner Sea', '260', 58, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(132, '12', 'Kokatat', 'Large/XL', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(133, '12', 'Kokatat', 'Universal', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(134, '30', 'Kokatat', 'Universal', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(135, '31', 'Harmony', 'Universal', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(136, '1', 'Seals Sea Sprite 1.4', 'Universal', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(137, '2', 'Seals Sea Sprite 1.7', 'Universal', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(138, '22', 'Kokatat', 'Universal', 26, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(139, '11', 'Dagger Legend', '16 feet', 36, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(140, '1', 'Carlisle, Canoe', 'Long', 57, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(141, '2', 'Carlisle, Canoe', 'Long', 57, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(142, '3', 'Carlisle, Canoe', 'Short', 57, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(143, '4', 'Carlisle, Canoe', 'Short', 57, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(144, '6', 'Canoe, Mohawk', 'Short', 57, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(145, 'F14-20', 'Seattle Sports', 'One Size', 44, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(146, '2', 'NRS', 'One Size', 44, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(147, '1', 'Seattle Sports', 'One Size', 45, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(148, '2', 'Seattle Sports', 'One Size', 45, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(149, '3', 'Seattle Sports', 'One Size', 45, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(150, '4', 'Seattle Sports', 'One Size', 45, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(151, 'S13-01', NULL, 'Small', 38, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(152, 'S13-02', NULL, 'Small', 38, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(153, 'S13-03', NULL, 'Small', 38, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(154, 'S13-01', NULL, 'Medium', 38, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(156, 'S13-02', NULL, 'Medium', 38, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(157, 'S13-03', NULL, 'Medium', 38, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(158, 'S13-04', NULL, 'Medium', 38, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(159, 'S13-01', NULL, 'Large', 38, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(160, 'S13-02', NULL, 'Large', 39, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(161, 'Sp17-03', 'Eureka, Amari Pass Solo', '1 Person', 2, 1, 1, 140, 0, 0, '2018-07-01', '0', 1),
(162, 'Sp17-04', 'Eureka, Amari Pass Solo', '1 Person', 2, 9, 1, 140, 0, 0, '2018-07-01', '0', 1),
(163, 'S18-02', 'Coleman', '6 Person', 63, 4, 1, 200, 0, 0, '2018-07-01', '0', 1),
(164, '1', 'Limelight', '3 Person', 2, 3, 1, 1, 0, 0, '2018-07-01', '0', 1),
(165, '2', 'Limelight', '3 Person', 2, 3, 1, 1, 0, 0, '2018-07-01', '0', 1),
(166, '3', 'Limelight', '3 Person', 2, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(169, 'S18-01', 'North Face Talus 2', '2 Person', 2, 1, 1, 220, 0, 0, '2018-07-01', '0', 1),
(170, '5', 'Eureka, Tetragon', '6 Person', 63, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(171, '4', 'Eureka, Tetragon', '6 Person', 63, 2, 1, 1, 0, 0, '2018-07-01', '0', 1),
(172, 'ONSP17-05', 'ON North Face', '2 Person', 55, 4, 1, 200, 0, 0, '2018-07-01', '0', 1),
(173, 'ONSP17-06', 'ON North Face', '2 Person', 55, 4, 1, 200, 0, 0, '2018-07-01', '0', 1),
(174, 'ONSP17-07', 'ON North Face', '2 Person', 55, 1, 1, 200, 0, 0, '2018-07-01', '0', 1),
(175, 'ONSP17-08', 'ON North Face', '2 Person', 55, 1, 1, 200, 0, 0, '2018-07-01', '0', 1),
(176, 'ONSP17-09', 'ON North Face', '2 Person', 55, 1, 1, 200, 0, 0, '2018-07-01', '0', 1),
(177, 'ONSP17-10', 'ON North Face', '2 Person', 55, 1, 1, 200, 0, 0, '2018-07-01', '0', 1),
(178, 'ONSP17-11', 'ON North Face', '2 Person', 55, 3, 1, 200, 0, 0, '2018-07-01', '0', 1),
(179, 'ONSP17-12', 'ON North Face', '2 Person', 55, 1, 1, 200, 0, 0, '2018-07-01', '0', 1),
(180, 'ONSP17-01', 'ON North Face', '3 Person', 55, 1, 1, 250, 0, 0, '2018-07-01', '0', 1),
(181, 'ONSP17-02', 'ON North Face', '3 Person', 55, 1, 1, 250, 0, 0, '2018-07-01', '0', 1),
(182, 'ONSP17-03', 'ON North Face', '3 Person', 55, 2, 1, 250, 0, 0, '2018-07-01', '0', 1),
(184, 'ONSP17-04', 'ON North Face', '3 Person', 55, 1, 1, 250, 0, 0, '2018-07-01', '0', 1),
(185, '11', 'Blue Wing Noah', NULL, 3, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(186, 'S18-011', 'Liberty Mountain, Blue/Gray', '5x7', 3, 4, 1, 1, 0, 0, '2018-07-01', '0', 1),
(187, 'SP14-02', 'Brown/Green', '5x7', 3, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(188, 'SP14-03', 'Brown', '5x8', 3, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(189, 'SP14-06', 'Brown', '10x12', 3, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(190, 'ID-2', 'Green', '10x12', 3, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(191, 'FA16-01', 'Dark Blue', '12x16', 3, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(193, 'F14-01', 'Grand Trunk', 'Regular', 1, 2, 1, 1, 0, 0, '2018-07-01', '0', 1),
(194, 'F14-02', 'Grand Trunk', 'Regular', 1, 5, 1, 1, 0, 0, '2018-07-01', '0', 1),
(195, 'F14-03', 'Grand Trunk', 'Regular', 1, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(196, 'F14-04', 'Grand Trunk', 'Regular', 1, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(197, 'F16-01', 'Laybag, Inflatable Hammock', 'One Size', 50, 1, 1, 60, 0, 0, '2018-07-01', '0', 1),
(198, 'F16-02', 'Laybag, Inflatable Hammock', 'One Size', 50, 1, 1, 60, 0, 0, '2018-07-01', '0', 1),
(199, 'F16-03', 'Laybag, Inflatable Hammock', 'One Size', 50, 1, 1, 60, 0, 0, '2018-07-01', '0', 1),
(200, 'ID-1', '0 Degree Bag, Marmot', 'Regular', 4, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(201, 'SP13-001', '0 Degree Bag, North Face', 'Regular', 4, 5, 1, 1, 0, 0, '2018-07-01', '0', 1),
(202, '2', '0 Degree Bag, Marmot', 'Long', 4, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(203, 'SP13-008', '15 Degree Bag, Marmot', 'Long', 4, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(204, '1', '15 Degree Bag, Marmot', 'Regular', 4, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(205, '1', '20 Degree Bag, Mountain Hardware', 'Regular', 4, 4, 1, 1, 0, 0, '2018-07-01', '0', 1),
(206, '4', '20 Degree Bag, Marmot', 'Long', 4, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(207, '8', '20 Degree Bag, Marmot', 'Long', 4, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(208, '9', '20 Degree Bag, Moonstone', 'Long', 4, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(209, '10', '20 Degree Bag, Sierra Designs', 'Regular', 4, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(210, '11', '20 Degree Bag, North Face', 'Regular', 4, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(211, 'SP13-002', '20 Degree Bag, North Face', 'Regular', 4, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(212, 'SP13-003', '20 Degree Bag, North Face', 'Regular', 4, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(213, 'SP13-004', '20 Degree Bag', 'Regular', 4, 1, 1, 1, 1, 0, '2018-07-01', NULL, 0),
(214, 'SP13-005', '20 Degree Bag, North Face', 'Long', 4, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(215, 'SP13-006', '20 Degree Bag, North Face', 'Long', 4, 3, 1, 1, 0, 0, '2018-07-01', '0', 1),
(216, 'SP13-007', '20 Degree Bag', 'Regular', 4, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(217, '2', '20 Degree Bag', 'Long', 4, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(218, 'S18-01', '20 Degree Bag', 'Regular', 4, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(219, 'ONSP17-01', 'ON 20 Degree Bag', 'Regular', 54, 4, 1, 1, 0, 0, '2018-07-01', '0', 1),
(220, 'ONSP17-02', 'ON 20 Degree Bag', 'Regular', 54, 4, 1, 1, 0, 0, '2018-07-01', '0', 1),
(221, 'ONSP17-03', 'ON 20 Degree Bag', 'Regular', 54, 2, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(222, 'ONSP17-04', 'ON 20 Degree Bag', 'Regular', 54, 2, 1, 1, 0, 0, '2018-07-01', '0', 1),
(223, 'ONSP17-05', 'ON 20 Degree Bag', 'Regular', 54, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(224, 'ONSP17-06', 'ON 20 Degree Bag', 'Regular', 54, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(225, 'ONSP17-07', 'ON 20 Degree Bag', 'Regular', 54, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(226, 'ONSP17-08', 'ON 20 Degree Bag', 'Regular', 54, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(228, 'F13-01', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 4, 1, 50, 0, 0, '2018-07-01', '0', 1),
(229, 'F13-03', '', '', 49, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(230, 'F13-04', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(232, 'Sp13-04', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(233, 'F13-05', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(234, 'Sp16-02', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(235, 'Sp16-03', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(236, 'Sp16-04', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(237, 'Sp16-05', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(238, 'Sp16-06', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 4, 1, 50, 0, 0, '2018-07-01', '0', 1),
(239, 'Sp16-07', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(240, 'Sp16-08', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(241, 'Sp16-09', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 4, 1, 50, 0, 0, '2018-07-01', '0', 1),
(242, 'Sp16-10', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(243, 'SP17-01', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(244, 'SP17-02', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(245, 'SP17-03', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 40, 0, 0, '2018-07-01', '0', 1),
(246, 'SP17-04', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 40, 0, 0, '2018-07-01', '0', 1),
(247, 'SP17-05', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 40, 0, 0, '2018-07-01', '0', 1),
(248, 'SP17-06', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 4, 1, 50, 0, 0, '2018-07-01', '0', 1),
(249, 'SP17-07', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 40, 0, 0, '2018-07-01', '0', 1),
(250, 'SP17-08', NULL, NULL, 49, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(251, 'SP17-09', NULL, NULL, 49, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(252, 'SP17-10', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 40, 0, 0, '2018-07-01', '0', 1),
(253, 'SP17-11', NULL, NULL, 49, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(254, 'SP17-13', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 40, 0, 0, '2018-07-01', '0', 1),
(255, 'SP17-14', NULL, NULL, 49, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(256, 'SP17-15', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 40, 0, 0, '2018-07-01', '0', 1),
(257, 'IN-1', 'Kokatat, Cotton, Teal', 'N/A', 49, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(258, 'IN-2', 'Kokatat, Cotton, Blue', 'N/A', 49, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(259, 'IN16-04', 'Cocoon', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(260, 'S18-01', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-07-01', '0', 1),
(261, '2', 'Ridgecrest Foam', 'Regular', 5, 4, 1, 1, 0, 0, '2018-07-01', '0', 1),
(262, '3', 'Ridgecrest Foam', 'Regular', 5, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(263, '4', 'Ridgecrest Foam', 'Regular', 5, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(264, '5', 'Ridgecrest Foam', 'Regular', 5, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(265, 'Sp13-002', 'Thermarest Ridgecrest', 'Regular', 5, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(266, 'Sp13-003', 'Thermarest Ridgecrest', 'Regular', 5, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(267, 'Sp13-005', 'Thermarest Ridgecrest', 'Regular', 5, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(269, 'F14-07', 'Thermarest Ridgecrest', 'Regular', 5, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(270, 'Sp16-01', 'Thermarest Ridgecrest', 'Regular', 5, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(271, 'Sp16-03', 'Thermarest Ridgecrest', 'Regular', 5, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(272, 'F18-01', 'Thermarest Ridgecrest', 'Regular', 5, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(273, 'F18-02', 'Thermarest Ridgecrest Classic', 'Regular', 5, 1, 1, 20, 0, 0, '2018-07-01', '0', 1),
(274, 'F18-04', 'Thermarest Ridgecrest Solite', 'Regular', 5, 1, 1, 30, 0, 0, '2018-07-01', '0', 1),
(275, 'F18-05', 'Thermarest Ridgecrest Solite', 'Regular', 5, 1, 1, 30, 0, 0, '2018-07-01', '0', 1),
(276, 'F18-06', 'Thermarest Ridgecrest Solite', 'Regular', 5, 4, 1, 30, 0, 0, '2018-07-01', '0', 1),
(277, 'S17-06', NULL, NULL, 6, 6, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(278, 'S17-07', '', '', 6, 6, 1, 1, 0, 0, '2018-07-01', '0', 1),
(279, 'S17-08', NULL, NULL, 6, 6, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(280, 'S17-09', NULL, NULL, 6, 6, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(281, 'S17-10', NULL, NULL, 6, 6, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(282, 'S17-01', NULL, NULL, 6, 6, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(283, 'S17-02', NULL, NULL, 6, 6, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(284, 'S17-03', NULL, NULL, 6, 6, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(285, 'S17-04', NULL, NULL, 6, 6, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(286, 'S17-05', NULL, NULL, 6, 6, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(287, 'F13-01', 'Osprey, Ace', 'Youth', 9, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(288, 'F13-02', 'Osprey, Escalante 70', 'Small/Medium', 9, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(289, 'F13-03', 'Osprey, Escalante 70', 'Small/Medium', 9, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(290, 'F13-04', 'Osprey, Escalante 70', 'Small/Medium', 9, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(291, 'F13-09', 'Osprey, Escalante 70', 'Small/Medium', 9, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(292, 'IO-1', 'Rokk Flat, Iron', 'Large/XL', 9, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(293, '4', 'Osprey, La Plata 70', 'Large/XL', 9, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(294, 'F13-06', 'Osprey, Escalante 70', 'Large/XL', 9, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(295, 'F13-07', 'Osprey, Escalante 70', 'Large/XL', 9, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(296, 'F13-08', 'Osprey, Escalante 70', 'Large/XL', 9, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(297, 'ONSP17-01', 'North Face, Terra 65', 'Large/XL', 56, 3, 1, 180, 0, 0, '2018-07-01', '0', 1),
(298, 'ONSP17-02', 'North Face, Terra 65', 'Large/XL', 56, 1, 1, 180, 0, 0, '2018-07-01', '0', 1),
(299, 'ONSP17-03', 'North Face, Terra 66', 'Large/XL', 56, 1, 1, 180, 0, 0, '2018-07-01', '0', 1),
(300, 'ONSP17-04', 'North Face, Terra 67', 'Large/XL', 56, 4, 1, 180, 0, 0, '2018-07-01', '0', 1),
(301, 'ONSP17-05', 'North Face, Terra 68', 'Large/XL', 56, 1, 1, 180, 0, 0, '2018-07-01', '0', 1),
(302, 'ONSP17-06', 'North Face, Terra 69', 'Large/XL', 56, 1, 1, 180, 0, 0, '2018-07-01', '0', 1),
(303, 'ONSP17-07', 'North Face, Terra 70', 'Large/XL', 56, 1, 1, 180, 0, 0, '2018-07-01', '0', 1),
(304, 'ONSP17-08', 'North Face, Terra 71', 'Large/XL', 56, 1, 1, 180, 0, 0, '2018-07-01', '0', 1),
(305, 'ONSP17-09', 'North Face, Terra 72', 'Large/XL', 56, 1, 1, 180, 0, 0, '2018-07-01', '0', 1),
(306, '1', 'Primus', 'Regular', 11, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(307, '3', 'Primus', 'Regular', 11, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(308, 'SP16-001', 'Primus Classic Trail', 'Regular', 10, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(309, 'SP16-003', 'Primus Classic Trail', 'Regular', 10, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(310, 'S17-01', 'Luci Outdoor 2, Inflatable Solar', 'One Size', 7, 1, 1, 18, 0, 0, '2018-07-01', '0', 1),
(311, 'S17-02', 'Luci Outdoor 2, Inflatable Solar', 'One Size', 7, 1, 1, 18, 0, 0, '2018-07-01', '0', 1),
(313, 'S17-04', 'Luci Outdoor 2, Inflatable Solar', 'One Size', 7, 1, 1, 18, 0, 0, '2018-07-01', '0', 1),
(314, '1', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(316, '3', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(317, '4', 'Backpackers Cache', 'Tall', 13, 3, 1, 1, 0, 0, '2018-07-01', '0', 1),
(318, '5', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(319, '6', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(320, '7', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(321, '8', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(322, '9', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(323, '10', 'Backpackers Cache', 'Tall', 13, 3, 1, 1, 0, 0, '2018-07-01', '0', 1),
(324, '11', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(325, '12', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(326, '13', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(327, '14', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(328, '15', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(329, '16', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(330, '17', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(331, '18', 'Backpackers Cache', 'Tall', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(332, 'SP13-001', 'Bear Vault', 'Wide', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(333, 'SP13-002', 'Bear Vault', 'Wide', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(334, 'SP13-003', 'Bear Vault', 'Wide', 13, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(335, 'SP13-004', 'Bear Vault', 'Wide', 13, 4, 1, 1, 0, 0, '2018-07-01', '0', 1),
(336, '2', 'Rubbermaid', '80 Qt', 14, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(337, 'IN-1', 'Rubbermaid', '80 Qt', 14, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(338, 'IN-1', 'Yeti', '95 Qt', 14, 1, 1, 1, 0, 0, '2018-07-01', '0', 0),
(339, 'IN-3', 'Yeti', '125 Qt', 14, 1, 1, 1, 0, 0, '2018-07-01', '0', 0),
(340, 'IN-4', 'Yeti', '95 Qt', 14, 1, 1, 1, 0, 0, '2018-07-01', '0', 0),
(341, 'IN-1', 'Igloo', NULL, 15, 4, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(342, 'IN-2', 'Igloo', '', 15, 2, 1, 1, 0, 0, '2018-07-01', '0', 1),
(343, 'IN-3', 'Igloo', NULL, 15, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(344, 'IN-5', 'Igloo', NULL, 15, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(346, 'IN-1', 'Katadyn Hiker', 'One Size', 12, 5, 1, 80, 0, 0, '0000-00-00', '0', 1),
(347, 'F14-04', 'Katadyn Hiker', 'One Size', 12, 1, 1, 80, 0, 0, '0000-00-00', '0', 1),
(348, 'SP13-001', 'MSR', 'Regular', 1, 1, 1, 0, 0, 0, '0000-00-00', '0', 0),
(349, '1', '', '', 47, 1, 1, 1, 0, 0, '2018-07-01', '0', 0),
(350, '2', '', '', 47, 1, 1, 1, 0, 0, '2018-07-01', '0', 0),
(351, '1', NULL, NULL, 48, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(352, '2', NULL, NULL, 48, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(353, '3', NULL, NULL, 48, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(354, '1', 'Net, Ball, 4 Wooden ', '', 23, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(355, '1', 'NRS Titanium', 'XXSmall', 27, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(356, '1', 'NRS Titanium', 'XSmall', 27, 5, 1, 1, 0, 0, '2018-07-01', '0', 1),
(357, 'SP15-18', 'NRS Titanium', 'XSmall', 27, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(358, 'SP15-04', 'NRS Titanium', 'Small', 27, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(359, '4', 'NRS Titanium', 'Medium', 27, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(360, 'S18-01', 'NRS Farmer Bill', 'Medium', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(361, 'S18-02', 'NRS Farmer Bill', 'Medium', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(362, 'S18-03', 'NRS Farmer Bill', 'Medium', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(363, 'S18-04', 'NRS Farmer Bill', 'Medium', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(364, 'S18-05', 'NRS Farmer Bill', 'Large', 27, 3, 1, 63, 0, 1, '2018-07-01', '0', 1),
(365, 'S18-06', 'NRS Farmer Bill', 'Large', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(366, 'S18-07', 'NRS Farmer Bill', 'Large', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(367, 'S18-08', 'NRS Farmer Bill', 'Large', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(368, 'S18-09', 'NRS Farmer Bill', 'Large', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(369, 'S18-10', 'NRS Farmer Bill', 'XL', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(370, 'S18-11', 'NRS Farmer Bill', 'XL', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(371, 'S18-12', 'NRS Farmer Bill', 'XL', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(372, 'S18-13', 'NRS Farmer Bill', 'XL', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(374, 'S18-14', 'NRS Farmer Bill', 'XL', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(375, '1', 'NRS Titanium', 'XXL', 27, 2, 1, 1, 0, 0, '2018-07-01', '0', 1),
(376, 'S18-15', 'NRS Farmer Bill', 'XXL', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(377, 'S18-16', 'NRS Farmer Bill', 'XXL', 27, 1, 1, 63, 0, 1, '2018-07-01', '0', 1),
(378, 'SP15-01', 'NRS Titanium', 'XXXL', 27, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(379, 'SP15-02', 'NRS Titanium', 'XXXL', 27, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(380, 'SP16-01', 'Kokatat', 'Small', 29, 5, 1, 1, 0, 1, '2018-07-01', '0', 1),
(381, '1', 'Kokatat', 'Large', 29, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(382, '2', 'Kokatat', 'Large', 29, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(383, '3', 'Kokatat', 'Large', 29, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(385, 'SP16-04', 'Kokatat', 'XL', 29, 5, 1, 1, 0, 0, '2018-07-01', '0', 1),
(386, 'SP16-05', 'Kokatat Tropos Super Breeze', 'XL', 29, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(390, '15', 'Extrasport UT3-5', 'Adult Universal', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(394, 'IN16-05', 'Extrasport UT3-5', 'Adult Universal', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(395, 'IN16-061', 'Extrasport UT3-5', 'Adult Universal', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(396, 'IN16-070', 'Extrasport UT3-5', 'Adult Universal', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(397, 'S18-01', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 1, 1, 59, 0, 1, '2018-07-01', '0', 1),
(398, 'S18-02', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 3, 1, 59, 0, 1, '2018-07-01', '0', 1),
(399, 'S18-03', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 3, 1, 59, 0, 1, '2018-07-01', '0', 1),
(400, 'S18-04', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 4, 1, 59, 0, 1, '2018-07-01', '0', 1),
(401, 'S18-05', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 1, 1, 59, 0, 1, '2018-07-01', '0', 1),
(402, 'S18-06', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 3, 1, 59, 0, 1, '2018-07-01', '0', 1),
(403, 'S18-07', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 1, 1, 59, 0, 1, '2018-07-01', '0', 1),
(404, 'S18-08', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 1, 1, 59, 0, 1, '2018-07-01', '0', 1),
(405, 'S18-09', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 4, 1, 59, 0, 1, '2018-07-01', '0', 1),
(406, 'S18-10', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 1, 1, 59, 0, 1, '2018-07-01', '0', 1),
(407, 'S18-11', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 1, 1, 59, 0, 1, '2018-07-01', '0', 1),
(408, 'S18-12', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 1, 1, 59, 0, 1, '2018-07-01', '0', 1),
(409, 'S18-13', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 1, 1, 59, 0, 1, '2018-07-01', '0', 1),
(410, 'S18-14', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 1, 1, 59, 0, 1, '2018-07-01', '0', 1),
(411, 'S18-15', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 1, 1, 59, 0, 1, '2018-07-01', '0', 1),
(412, 'S18-16', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 3, 1, 59, 0, 1, '2018-07-01', '0', 1),
(413, 'S18-17', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 3, 1, 59, 0, 1, '2018-07-01', '0', 1),
(414, 'S18-18', 'Stohlquist Canyon High Float', 'Adult Universal', 25, 4, 1, 59, 0, 1, '2018-07-01', '0', 1),
(423, 'F14-01', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(424, 'F14-02', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(425, 'F14-03', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(426, 'F14-04', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(427, 'F14-05', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(428, 'F14-06', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(429, 'F14-07', 'NRS White Water', 'Adult', 25, 9, 1, 1, 0, 0, '2018-07-01', '0', 1),
(430, 'F14-08', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(431, 'F14-09', 'NRS White Water', 'Adult', 25, 9, 1, 1, 0, 0, '2018-07-01', '0', 1),
(432, 'F14-10', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(433, 'F14-11', 'NRS White Water', 'Adult', 25, 9, 1, 1, 0, 0, '2018-07-01', '0', 1),
(434, 'F14-12', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(435, 'F14-13', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(436, 'F14-14', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(437, 'F14-15', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(438, 'F14-16', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(439, 'F14-17', 'NRS White Water', 'Adult', 25, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(440, '3', 'Foam', 'Universal', 60, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(441, '12', 'Foam', 'Universal', 60, 1, 1, 1, 0, 0, '2018-07-01', '', 1),
(442, '2', 'Marmot Blue Shell', 'Medium', 52, 5, 1, 1, 0, 0, '2018-07-01', '0', 1),
(443, '1', 'Marmot Purple Parka', 'Medium', 52, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(444, '1', 'Marmot Bib Snow Pants', 'Medium', 51, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(445, '2', 'Marmot Bib Snow Pants', 'Medium', 51, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(446, '5', 'Marmot Bib Snow Pants', 'Medium', 51, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(447, '3', 'Rain', 'Women Medium', 51, 4, 1, 1, 0, 0, '2018-07-01', '0', 1),
(448, '4', 'Campmor Rain Pants', 'Large', 51, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(449, '6', 'Campmor Rain Pants', 'XL', 51, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(450, '1', 'Marmot Glove', 'Medium', 20, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(451, '3', 'Marmot Glove', 'Medium/Large', 20, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(452, 'IN-5', 'Marmot Glove', 'Medium', 20, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(453, '1', 'Marmot Randunne Mitt', 'Large', 20, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(454, '2', 'Marmot Randunne Glove', 'Large', 20, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(455, 'IN-1', 'Marmot Snowdrift Mitt with Liner', 'Large', 20, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(456, 'IN-2', 'Marmot Shell Mitt', 'Large', 20, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(457, 'IN-3', 'Marmot Expedition Mitt', 'Large', 20, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(458, 'IN-4', 'Marmot Shell Mitt', 'Large', 20, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(459, 'IN-1', 'Evolve Lace Shoe', '5', 22, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(460, 'IN-2', 'Evolve Lace Shoe', '5', 22, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(461, 'IN-3', 'Evolve Lace Shoe', '6', 22, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(462, 'IN-4', 'Evolve Lace Shoe', '6', 22, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(463, 'IN-9', 'Evolve Lace Shoe', '8', 22, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(464, 'IN-5', 'Evolve Lace Shoe', '9', 22, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(465, 'IN-6', 'Evolve Lace Shoe', '9', 22, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(466, 'IN-7', 'Evolve Lace Shoe', '10', 22, 5, 1, 1, 0, 0, '2018-07-01', '0', 1),
(467, 'IN-8', 'Evolve Lace Shoe', '11', 22, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(468, '1', 'Xcel 3/2 Youth', '8', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(469, 'SP15-02', 'Hotline Phase Two 3/2 Youth', '8', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(470, 'SP15-03', 'Hotline Phase Two 3/2 Youth', '8', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(471, 'SP15-01', 'Hotline Phase Two 3/2 Youth', '10', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(472, 'SP15-04', 'Hotline Phoenixx 4/3 Youth', '10', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(473, 'SP15-05', 'Hotline Phoenixx 4/3 Youth', '10', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(474, '4', 'Hotline Phoenixx 4/3 Youth', '12', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(475, 'SP15-06', 'Hotline Phoenixx 4/3 Youth', '12', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(476, 'SP15-07B', 'Hotline 4/3mm Youth', '12', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(477, 'SP15-11', 'Hotline 4/3mm Youth', '16', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(478, 'SP15-12', 'Hotline 4/3mm Youth', '16', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(479, 'S17-06', 'Hotline JR Backzip 4/3 Youth', '16', 28, 1, 1, 150, 0, 0, '2018-07-01', '0', 1),
(480, '1', 'Hotline Reflex Men', 'Small/Medium', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(482, 'S17-03', 'Hotline Reflex 5/4 Men', 'Small/Medium', 28, 1, 1, 322, 0, 0, '2018-07-01', '0', 1),
(483, 'S15-13', 'Hotline UHC Men', 'Medium', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(484, 'S17-04', 'Hotline Reflex 5/4 Men', 'Medium', 28, 1, 1, 322, 0, 0, '2018-07-01', '0', 1),
(485, '1', 'Hotline UHC Men', 'Medium', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(486, '3', 'Hotline UHC Men', 'Large', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(487, 'S15-15', 'Hotline UHC Men', 'Large', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(488, 'S17-05', 'Hotline Reflex 5/4 Men', 'Large', 28, 1, 1, 322, 0, 0, '2018-07-01', '0', 1),
(489, '2', 'Hotline UHC Men', 'XL', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(490, 'SP15-07', 'Hotline UHC 5/4 Women', '4', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(491, 'SP15-17', 'Hotline Firefly GT Women', '4', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(492, 'S17-01', 'Hotline Reflex2 5/4 Women', '6', 28, 1, 1, 322, 0, 0, '2018-07-01', '0', 1),
(493, 'S15-09', 'Hotline UHC Women', '8', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(494, 'S15-08', 'Hotline UHC Women', '8', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(495, 'SP15-10', 'Hotline UHC Women', '10', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(496, 'S15-16', 'Hotline UHC Women', '10', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(497, '1', 'Hotline Reflex Women', '10', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(498, '1', 'Hotline Reflex Women', '12', 28, 2, 1, 1, 0, 0, '2018-07-01', '0', 1),
(499, '2', 'Hotline Reflex Women', '12', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(500, '3', 'Hotline UHC Women', '12', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(501, 'S13-1', 'Hotline UHC 5/4 Women', '14', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(502, 'S13-2', 'Hotline UHC 5/4 Women', '14', 28, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(503, '3.1', 'NRS Titanium', '3', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(504, '3.2', 'NRS Titanium', '3', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(505, '3.3', 'NRS Titanium', '3', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(506, '3.4', 'NRS Titanium', '3', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(507, '4.1', 'NRS Titanium', '4', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(508, '4.2', 'NRS Titanium', '4', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(509, 'IN16-3', 'GUL Titanium', '4', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(510, '5.1', 'NRS Titanium', '5', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(511, '5.3', 'NRS Titanium', '5', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(512, '5.5', 'NRS Titanium', '5', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(513, '6.1', 'NRS Titanium', '6', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(514, '6.12', 'NRS Titanium', '6', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(515, '6.2', 'NRS Titanium', '6', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(516, '6.3', 'NRS  Titanium', '6', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(517, '6.4', 'NRS Titanium', '6', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(518, '7.1', 'NRS Titanium', '7', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(519, '7.2', 'NRS Titanium', '7', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(520, '7.3', 'NRS Titanium', '7', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(521, '7.41', 'NRS Titanium', '7', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(523, '7.8', 'Kokatat Titanium', '7', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(524, '8.1', 'NRS Titanium', '8', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(525, '8.2', 'NRS Titanium', '8', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(526, '8.3', 'NRS Titanium', '8', 30, 5, 1, 1, 0, 0, '2018-07-01', '0', 1),
(527, '8.4', 'NRS Titanium', '8', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(528, '8.5', 'NRS Titanium', '8', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(529, '8.6', 'NRS Titanium', '8', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(530, '8.7', 'NRS Titanium', '8', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(531, '8.8', 'NRS Titanium', '8', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(532, '9.1', 'NRS Titanium', '9', 30, 4, 1, 1, 0, 0, '2018-07-01', '0', 1),
(533, '9.2', 'NRS Titanium', '9', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(534, '9.3', 'NRS Titanium', '9', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(535, '9.31', 'NRS Titanium', '9', 30, 5, 1, 1, 0, 0, '2018-07-01', '0', 1),
(536, '9.5', 'NRS Titanium', '9', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(537, '9.6', 'NRS Titanium', '9', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(538, '10.1', 'NRS Titanium', '10', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(539, '10.3', 'NRS Titanium', '10', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(540, '10.2', 'NRS Titanium', '10', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(541, 'IN16-04', 'NRS Titanium', '10', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(542, '11.1', 'NRS Titanium', '11', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(543, '11.2', 'NRS Titanium', '11', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(544, '11.24', 'NRS Titanium', '11', 30, 5, 1, 1, 0, 0, '2018-07-01', '0', 1),
(545, '11.3', 'NRS Titanium', '11', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(546, '11.31', 'NRS Titanium', '11', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(547, '11.4', 'NRS Titanium', '11', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(548, '11.6', 'NRS Titanium', '11', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(549, '11.7', 'NRS Titanium', '11', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(550, '11.8', 'NRS Titanium', '11', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(551, '12.2', 'NRS Titanium', '12', 30, 3, 1, 1, 0, 0, '2018-07-01', '0', 1),
(552, '12.3', 'NRS Titanium', '12', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(553, '12.4', 'NRS Titanium', '12', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(554, '13.1', 'NRS Titanium', '13', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(555, '13.12', 'NRS Titanium', '13', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(556, '13.2', 'NRS Titanium', '13', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(557, '13.23', 'NRS Titanium', '13', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(558, '13.3', 'NRS Titanium', '13', 30, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(559, '1', 'Surftech Softop', '8 feet', 34, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(560, '2', 'Surftech Softop', '9 feet', 34, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(561, '3', 'Surftech Softop', '9 feet', 34, 5, 1, 1, 0, 0, '2018-07-01', '0', 1),
(562, '4', 'Surftech Softop', '9 feet', 34, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(563, '5', 'Surftech Softop', '9 feet', 34, 5, 1, 1, 0, 0, '2018-07-01', '0', 1),
(564, '9', 'Surftech Softop', '8 feet', 34, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(565, '10', 'Surftech Softop', '10 feet', 34, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(566, '12', 'Surftech Softop', '9 feet', 34, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(567, '13', 'Surftech Softop', '9 feet', 34, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(568, '14', 'Surftech Softop', '9 feet', 34, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(569, '15', 'Surftech Softop', '9 feet', 34, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(570, '16', 'Surftech Softop', '10 feet', 34, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(571, '17', 'Surftech Softop', '10 feet', 34, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(572, '18', 'Surftech Softop', '9.5 feet', 34, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(573, '19', 'Surftech Softop', '10 feet', 34, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(574, '2', 'Hotline', '9 feet', 35, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(575, '3', 'Hotline', '9 feet', 35, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(576, '4', 'Hotline', '9 feet', 35, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(577, '5', 'Hotline', '9 feet', 35, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(578, '6', 'Hotline', '9 feet', 35, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(579, '7', 'Ocean and Earth', '9 feet', 35, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(580, '9', 'Surf More USA', '9 feet', 35, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(581, '10', 'Surf More USA', '9 feet', 35, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(582, '11', 'BlockSurf', '9 feet', 35, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(583, '13', 'Creature', '12 feet', 35, 1, 1, 45, 0, 0, '2018-07-01', '0', 1),
(584, '14', 'PowerClip XM', '11 feet', 35, 5, 1, 1, 0, 0, '2018-07-01', '0', 1),
(585, '15', 'PowerClip XM', '12 feet', 35, 1, 1, 33, 0, 0, '2018-07-01', '0', 1),
(586, '91', 'Creature', '12 feet', 35, 1, 1, 45, 0, 0, '2018-07-01', '0', 1),
(587, '101', 'PowerClip XM', '10 feet', 35, 1, 1, 32, 0, 0, '2018-07-01', '0', 1),
(588, '17', 'BlockSurf', '9 feet', 35, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(589, '4', 'Morey Boogie', 'One Size', 33, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(590, '5', 'Morey Boogie', 'One Size', 33, 1, 1, 1, 0, 0, '2018-07-01', '0', 1),
(677, '1', 'KS', '146', 16, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(678, '2', 'OD', '154', 16, 2, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(679, '4', 'Burton', '161', 16, 2, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(680, 'IN-1', 'Yakima', 'XSmall', 21, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(681, '2', 'Yakima', 'Small/Medium', 21, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(682, 'F13-01', 'Elekra', 'Medium', 21, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(683, 'F13-02', 'Atlas', 'Medium/Large', 21, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(684, 'F13-03', 'Atlas', 'Medium/Large', 21, 1, 1, 1, 1, 0, '2018-07-01', NULL, 1),
(685, 'F13-01', 'Red Feather', 'XL', 21, 1, 1, 1, 0, 0, '2008-01-10', '0', 1),
(704, '11', 'Dagger Legend', '16 Feet', 36, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(705, ' ', 'Dagger Legend', '16 Feet', 36, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(706, 'B5', 'Dagger Legend', '16 Feet', 36, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(707, 'B4', 'Dagger Legend', '16 Feet', 36, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(708, 'B6', 'Dagger Legend', '16 Feet', 36, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(709, 'B7', 'Dagger Legend', '16 Feet', 36, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(710, 'B3', 'Dagger Legend', '16 Feet', 36, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(711, ' ', 'Dagger Legend', '16 Feet', 36, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(712, 'B9', 'Wenonah Spirit 11', '17 Feet', 36, 1, 2, 150, 2, 0, '0000-00-00', '89876', 1),
(713, 'B10', 'Wenonah Spirit 11', '17 Feet', 36, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(714, 'B8', 'Wenonah Spirit 11', '17 Feet', 36, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(715, 'B1', 'Penebescot', '17 Feet', 36, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(716, 'B2', 'Penebescot', '17 Feet', 36, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(717, ' ', 'Red Rescue Boat', '14 Feet', 65, 2, 2, 1, 0, 0, '0000-00-00', '2', 0),
(718, ' ', 'Yellow Rescue Boat', '18 feet', 65, 2, 2, 150, 0, 0, '0000-00-00', '89876', 0),
(719, 'D14', 'Pico', '11 Feet 6 Inch', 66, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(720, 'D13', 'Pico', '11 Feet 6 Inch', 66, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(721, 'D20', 'Pico', '11 Feet 6 Inch', 66, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(722, 'D19', 'Pico', '11 Feet 6 Inch', 66, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(723, 'D15', 'Pico', '11 Feet 6 Inch', 66, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(724, 'D17', 'Pico', '11 Feet 6 Inch', 66, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(725, 'D18', 'Pico', '11 Feet 6 Inch', 66, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(726, 'D11', 'Pico', '11 Feet 6 Inch', 66, 2, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(727, 'D21', 'Catalina 15', '15 Feet 4 Inch', 66, 1, 2, 150, 2, 0, '0000-00-00', '89876', 1),
(728, 'D24', 'Catalina 15', '15 Feet 4 Inch', 66, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(729, 'D22', 'Catalina 15', '15 Feet 4 Inch', 66, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(730, 'D23', 'Catalina 15', '15 Feet 4 Inch', 66, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(731, 'D11', 'Laser', '13 Feet 11 Inch', 66, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(732, 'D12', 'Laser', '13 Feet 11 Inch', 66, 1, 2, 1, 0, 0, '0000-00-00', '2', 0);
INSERT INTO `Item` (`item_Backid`, `item_Frontid`, `item_modeltype`, `item_size`, `inv_id`, `stat_id`, `loc_id`, `pur_price`, `ven_id`, `dbw_own`, `pur_date`, `vin_num`, `public`) VALUES
(733, 'D4', 'Laser', '13 feet 11 Inch', 66, 1, 2, 150, 2, 0, '0000-00-00', '89876', 1),
(734, 'D10', 'Laser', '13 Feet 11 Inch', 66, 2, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(735, 'D7', 'Laser', '13 Feet 11 Inch', 66, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(736, 'D5', 'Laser', '13 Feet 11 Inch', 66, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(737, 'D1', 'Laser', '13 Feet 11 Inch', 66, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(738, 'D6', 'Laser', '13 Feet 11 Inch', 66, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(739, 'D2', 'Laser', '13 Feet 11 Inch', 66, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(740, 'D9', 'Laser', '13 Feet 11 Inch', 66, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(741, 'D8', 'Laser', '13 Feet 11 Inch', 66, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(742, 'D3', 'Laser', '13 Feet 11 Inch', 66, 1, 2, 150, 2, 0, '0000-00-00', '89876', 1),
(743, '1', 'Surftech Air Travel', '11 feet', 74, 1, 1, 600, 0, 1, '2018-09-10', '0', 1),
(744, '8', 'Surftech Air Travel', '11 feet', 74, 1, 1, 600, 0, 1, '2018-09-10', '0', 1),
(745, '9', 'Surftech Air Travel', '11 Feet', 74, 1, 1, 600, 0, 1, '2018-09-10', '0', 1),
(746, '10', 'Surftech Air Travel', '11 feet', 74, 1, 1, 600, 0, 1, '2018-09-10', '0', 1),
(747, '11', 'Surftech Air Travel', '11 feet', 74, 1, 1, 600, 0, 1, '2018-09-10', '0', 1),
(748, '12', 'Surftech Air Travel', '11 feet', 74, 1, 1, 600, 0, 1, '2018-09-10', '0', 1),
(750, '2', 'Surftech Air Travel', '11 feet', 74, 1, 1, 600, 0, 1, '2018-09-10', '0', 1),
(751, '3', 'Surftech Air Travel', '11 feet', 74, 1, 1, 600, 0, 1, '2018-09-10', '0', 1),
(752, '4', 'Surftech Air Travel', '11 feet', 74, 1, 1, 600, 0, 1, '2018-09-10', '0', 1),
(753, '5', 'Surftech Air Travel', '11 feet', 74, 1, 1, 600, 0, 1, '2018-09-10', '0', 1),
(754, '6', 'Surftech Air Travel', '11 feet', 74, 1, 1, 600, 0, 1, '2018-09-10', '0', 1),
(755, '7', 'Surftech Air Travel', '11 feet', 74, 1, 1, 600, 0, 1, '2018-09-10', '0', 1),
(756, ' ', 'Jackson Little Hero', ' ', 37, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(757, ' ', 'Jackson Little Hero', '7 Feet 6 Inch', 37, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(758, ' ', 'Jackson Little Hero', '7 Feet 11 Inch', 37, 5, 2, 1, 0, 0, '0000-00-00', '2', 0),
(759, ' ', 'Jackson Hero', ' ', 37, 5, 2, 1, 0, 0, '0000-00-00', '2', 0),
(760, ' ', 'Jackson Fun Runner 60', '7 feet 9 Inch', 37, 5, 2, 150, 2, 0, '0000-00-00', '89876', 1),
(761, ' ', 'Jackson Zen 65', '8 Feet 4 Inch', 37, 5, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(762, ' ', 'Jackson Hero', '7 Feet 4 Inch', 37, 5, 2, 1, 0, 0, '0000-00-00', '0', 1),
(763, ' ', 'Jackson Hero', '7 Feet 4 Inch', 37, 5, 2, 1, 0, 0, '0000-00-00', '2', 0),
(764, ' ', 'Jackson Hero', '4 Feet 4 Inch', 37, 5, 2, 1, 0, 0, '0000-00-00', '2', 0),
(765, ' ', 'Eskimo Kendo', ' ', 37, 2, 2, 150, 2, 0, '0000-00-00', '89876', 1),
(766, 'A22', 'Hobie', ' ', 69, 2, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(767, 'A23', 'Hobie', ' ', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(768, 'A21', 'Hobie', ' ', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(769, 'A20', 'Hobie', ' ', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(770, 'A25', 'Necky Dolphin', ' ', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(771, 'A24', 'Necky Spike', ' ', 69, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(772, ' ', 'Perception Torrent', '10 Feet', 69, 6, 2, 1, 0, 0, '0000-00-00', '2', 0),
(773, '16', 'Necky Eliza', ' ', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(774, '20', 'Necky Eliza', ' ', 69, 1, 2, 150, 2, 0, '0000-00-00', '89876', 1),
(775, '8', 'Necky Eliza', ' ', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(776, '17', 'Necky Eliza', '15 Feet', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(777, '19', 'Necky Eliza', ' ', 69, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(778, '31', 'Necky Eliza', ' ', 69, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(779, '30', 'Necky Eliza', ' ', 69, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(780, '15', 'Necky Eliza', ' ', 69, 1, 2, 150, 2, 0, '0000-00-00', '89876', 1),
(781, '28', 'Necky Sharpa', '', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(782, '23', 'Necky Looksha V', ' ', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(783, '29', 'Necky Looksha V', ' ', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(784, '21', 'Necky Looksha Sport', ' ', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(785, '4', 'Necky Elaho HV', ' ', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(786, '30', 'Necky Elaho HV', ' ', 69, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(787, '26', 'Necky Eskia', ' ', 69, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(788, '32', 'Necky Eskia', ' ', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(789, '22', 'Necky Eskia', ' ', 69, 1, 2, 150, 2, 0, '0000-00-00', '89876', 1),
(790, '33', 'Necky Eskia', ' ', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(791, '25', 'Necky Eskia', ' ', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(792, '27', 'Necky Eskia', ' ', 69, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(793, '6', 'Necky Eskia', '14 Feet', 69, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(794, '7', 'Necky Manitou', '13 Feet', 69, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(795, '18', 'Necky Manitou', '13 Feet', 69, 1, 2, 150, 2, 0, '0000-00-00', '89876', 1),
(796, '3', 'Necky Manitou', '13 Feet', 69, 2, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(797, '24', 'Necky Manitou', '13 Feet', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(798, '5', 'Necky Manitou', '13 Feet', 69, 2, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(799, '1', 'Necky Manitou', '13 Feet', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(800, '6', 'Necky Manitou', '13 Feet', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(801, '2', 'Necky Manitou', '13 Feet', 69, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(802, '13', 'Necky Manitou', '14 Feet', 69, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(803, '12', 'Necky Manitou', '14 Feet', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(804, '10', 'Necky Manitou', '14 Feet', 69, 1, 2, 150, 2, 0, '0000-00-00', '89876', 1),
(805, '11', 'Necky Manitou', '14 Feet', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(806, '9', 'Necky Manitou', '13 Feet', 69, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(807, '14', 'Necky Manitou', '14 Feet', 69, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(808, 'A3', 'Malibu Two', 'Double', 70, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(809, 'A2', 'Malibu Two', 'Double', 70, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(810, 'A5', 'Malibu Two', 'Double', 70, 1, 2, 150, 2, 0, '0000-00-00', '89876', 1),
(811, 'A4', 'Malibu Two', 'Double', 70, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(812, 'A0', 'Malibu Two', 'Double', 70, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(813, 'A6', 'Malibu Two', 'Double', 70, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(814, 'A1', 'Malibu Two', 'Double', 70, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(815, 'A12', 'Frenzy', 'Single', 70, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(816, 'A11', 'Frenzy', 'Single', 70, 1, 2, 150, 2, 0, '0000-00-00', '89876', 1),
(817, 'A9', 'Frenzy', 'Single', 70, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(818, 'A13', 'Frenzy', 'Single', 70, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(819, 'A8', 'Frenzy', 'Single', 70, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(820, 'A10', 'Frenzy', 'Single', 70, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(821, 'A26', 'Frenzy', 'Single', 70, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(822, 'A27', 'Frenzy', 'Single', 70, 1, 2, 1, 2, 0, '0000-00-00', '2', 1),
(823, 'A28', 'Frenzy', 'Single', 70, 1, 2, 1, 1, 0, '0000-00-00', '2', 1),
(824, 'A29', 'Frenzy', 'Single', 70, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(825, 'A30', 'Frenzy', 'Single', 70, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(826, 'A32', 'Frenzy', 'Single', 70, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(827, 'A33', 'Frenzy', 'Single', 70, 1, 2, 1, 2, 0, '0000-00-00', '2', 1),
(828, 'A35', 'Frenzy', 'Single', 70, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(829, 'A36', 'Frenzy', 'Single', 70, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(830, 'A17', 'Banzai', 'Single', 70, 1, 2, 1, 2, 0, '0000-00-00', '89876', 1),
(831, 'A16', 'Banzai', 'Single', 70, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(832, 'A19', 'Banzai', 'Single', 70, 1, 2, 1, 1, 0, '0000-00-00', NULL, 1),
(833, 'A15', 'Banzai', 'Single', 70, 1, 2, 1, 0, 0, '0000-00-00', '0', 1),
(834, 'A14', 'Banzai', 'Single', 70, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(835, 'A18', 'Banzai', 'Single', 70, 1, 2, 1, 0, 0, '0000-00-00', '2', 0),
(836, 'F14-01', 'Liberty Mountain', 'Regular', 71, 1, 1, 0, 0, 0, '2019-03-01', '0', 1),
(837, 'F14-02', 'Liberty Mountain', 'Regular', 71, 1, 1, 0, 0, 0, '2019-03-01', '0', 1),
(838, 'F14-03', 'Liberty Mountain', 'Regular', 71, 1, 1, 0, 0, 0, '2019-03-01', '0', 1),
(839, 'F14-04', 'Liberty Mountain', 'Regular', 71, 1, 1, 0, 0, 0, '2019-03-01', '0', 1),
(840, 'F18-03', 'Thermarest Ridgecrest Classic', 'Regular', 5, 1, 1, 20, 0, 0, '2019-03-01', '0', 1),
(842, '21', 'Surftech Blacktip L2S ', '8 feet', 34, 1, 1, 0, 0, 0, '2019-03-01', '0', 1),
(843, 'F13-06', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2013-09-01', '0', 1),
(844, 'S18-02', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-04-01', '0', 1),
(845, 'F18-01', 'Cocoon, Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 0, 0, '2018-09-01', '0', 1),
(848, 'S19-01', 'NRS, Mesh Drag Bag', 'One Size', 46, 1, 1, 25, 12, 0, '2019-06-13', '0', 0),
(849, 'SP19-01', 'Primus Classic Trail', 'Regular', 10, 1, 1, 1, 12, 0, '2019-06-17', '0', 1),
(850, 'SP19-02', 'Primus Classic Trail', 'Regular', 10, 1, 1, 1, 12, 0, '2019-06-17', '0', 1),
(851, '1', 'MSR Whisperlite', 'Regular', 10, 1, 1, 1, 13, 0, '2019-06-17', '0', 0),
(852, '2', 'MSR Whisperlite', 'Regular', 10, 1, 1, 1, 13, 0, '2019-06-17', '0', 0),
(853, 'S18-01', 'Whisperlite Expedition, Serive Kit', 'Regular', 10, 1, 1, 20, 13, 0, '2019-06-17', '0', 0),
(854, 'S18-02', 'Whisperlite Expedition, Serive Kit', 'Regular', 10, 1, 1, 20, 13, 0, '2019-06-17', '0', 0),
(855, 'S18-03', 'Whisperlite Expedition, Serive Kit', 'Regular', 10, 1, 1, 20, 13, 0, '2019-06-17', '0', 0),
(856, 'S18-04', 'Whisperlite Expedition, Serive Kit', 'Regular', 10, 1, 1, 20, 13, 0, '2019-06-17', '0', 0),
(857, 'f15-01', 'Dummy Data', 'Testing', 2, 1, 1, 100, 5, 0, '2019-06-17', '0', 1),
(858, 'sp13-01', 'Dummy Data 2', 'Testing', 4, 1, 1, 80, 5, 0, '2019-06-17', '0', 1),
(859, 'Sp13-001', 'MSR Hiker', 'Regular', 12, 1, 1, 1, 13, 0, '2019-06-17', '0', 1),
(860, 's08-17', 'Dummy Data 3', 'Testing', 13, 1, 1, 50, 10, 0, '2019-06-17', '0', 1),
(861, 'S19-01', 'Katadyn Hiker', 'Regular', 12, 1, 1, 68, 12, 0, '2019-06-13', '0', 1),
(862, 'S19-02', 'Katadyn Hiker', 'Regular', 12, 1, 1, 68, 12, 0, '2019-06-13', '0', 1),
(863, 'F14-01', 'Hanging Filter', 'Regular', 12, 1, 1, 1, 13, 0, '2019-06-17', '0', 0),
(864, 'IN-2', 'Katadyn Basecamp', 'Regular', 12, 1, 1, 1, 13, 0, '2019-06-17', '0', 0),
(865, 'SP17-01', 'Eureka Amari Pass 3', '2 Person', 2, 1, 1, 190, 13, 0, '2019-06-17', '0', 1),
(866, 'SP17-02', 'Eureka Amari Pass 3', '2 Person', 2, 1, 1, 190, 13, 0, '2019-06-17', '0', 1),
(867, 'F18-01', 'Kokatat Stance Jacket', 'Small', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(868, 'F18-02', 'Kokatat Stance Jacket', 'Small', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(869, 'F18-03', 'Kokatat Stance Jacket', 'Medium', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(870, 'F18-04', 'Kokatat Stance Jacket', 'Medium', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(871, 'F18-05', 'Kokatat Stance Jacket', 'Medium', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(872, 'F18-06', 'Kokatat Stance Jacket', 'Medium', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(873, 'F18-07', 'Kokatat Stance Jacket', 'Medium', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(874, 'F18-08', 'Kokatat Stance Jacket', 'Medium', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(875, 'F18-09', 'Kokatat Stance Jacket', 'Large', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(876, 'F18-10', 'Kokatat Stance Jacket', 'Large', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(877, 'F18-11', 'Kokatat Stance Jacket', 'Large', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(878, 'F18-12', 'Kokatat Stance Jacket', 'Large', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(879, '10', 'Kokatat', 'XL', 29, 1, 1, 1, 13, 0, '2019-06-17', '0', 1),
(880, 'F18-13', 'Kokatat Stance Jacket', 'XXL', 29, 1, 1, 65, 0, 1, '2019-06-17', '0', 1),
(881, 'F18-14', 'Kokatat Stance Jacket', 'XXL', 29, 1, 1, 65, 0, 1, '2019-06-17', '0', 1),
(882, 'SP19-01', 'Kokatat Stance Jacket', 'XL', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(883, 'SP19-02', 'Kokatat Stance Jacket', 'XL', 29, 1, 1, 65, 13, 1, '2019-06-17', '0', 1),
(884, 'F18-01', 'NRS Big Water Guide', 'Small/Medium', 25, 1, 1, 75, 12, 1, '2019-06-17', '0', 1),
(885, 'F18-02', 'NRS Big Water Guide', 'Small/Medium', 25, 1, 1, 75, 12, 1, '2019-06-17', '0', 1),
(886, 'F18-03', 'NRS Big Water Guide', 'Small/Medium', 25, 1, 1, 75, 12, 1, '2019-06-17', '0', 1),
(887, 'F18-04', 'NRS Big Water Guide', 'Small/Medium', 25, 1, 1, 75, 12, 1, '2019-06-17', '0', 1),
(888, 'F18-05', 'NRS Big Water Guide', 'Small/Medium', 25, 1, 1, 75, 12, 1, '2019-06-17', '0', 1),
(889, 'F18-06', 'NRS Big Water Guide', 'Small/Medium', 25, 1, 1, 75, 12, 1, '2019-06-17', '0', 1),
(890, 'F18-07', 'NRS Big Water Guide', 'Small/Medium', 25, 1, 1, 75, 12, 1, '2019-06-17', '0', 1),
(891, 'F18-08', 'NRS Big Water Guide', 'Large/XL', 25, 1, 1, 75, 12, 1, '2019-06-17', '0', 1),
(892, 'F18-09', 'NRS Big Water Guide', 'Large/XL', 25, 1, 1, 75, 12, 1, '2019-06-17', '0', 1),
(893, 'F18-10', 'NRS Big Water Guide', 'Large/XL', 25, 1, 1, 75, 12, 1, '2019-06-17', '0', 1),
(894, 'F18-11', 'NRS Big Water Guide', 'Large/XL', 25, 1, 1, 75, 0, 1, '2019-06-17', '0', 1),
(895, 'F18-12', 'NRS Big Water Guide', 'Large/XL', 25, 1, 1, 75, 12, 1, '2019-06-17', '0', 1),
(896, 'F18-13', 'NRS Big Water Guide', 'Large/XL', 25, 1, 1, 75, 12, 1, '2019-06-17', '0', 1),
(897, 'F18-14', 'NRS Big Water Guide', 'Large/XL', 25, 1, 1, 75, 12, 1, '2019-06-17', '0', 1),
(898, '150', 'Extrasport UT3-5', 'Youth', 25, 1, 1, 1, 13, 0, '2019-06-17', '0', 1),
(900, 'IN16-22', 'Extrasport UT3-5', 'Youth', 25, 9, 1, 1, 0, 0, '2019-06-17', '0', 1),
(901, '71', 'Extrasport UT3-5', 'Adult Universal', 25, 1, 1, 1, 13, 0, '2019-06-17', '0', 1),
(902, '51', 'Extrasport UT3-5', 'Adult Universal', 25, 5, 1, 1, 0, 0, '2019-06-17', '0', 1),
(903, '72', 'Extrasport UT3-5', 'Adult Universal', 25, 1, 1, 1, 13, 0, '2019-06-17', '0', 1),
(904, 'S16-44', 'WRSI Current Helmet', 'Small/Medium', 24, 4, 1, 1, 0, 0, '2019-06-18', '0', 1),
(905, '202', 'NRS Ace Water', 'Universal', 24, 1, 1, 1, 12, 0, '2019-06-18', '0', 1),
(906, 'F14-035', 'NRS Ace Water', 'Small', 24, 1, 1, 1, 12, 0, '2019-06-18', '0', 1),
(907, 'F14-161', 'NRS Ace Water', 'X-Large', 24, 1, 1, 1, 12, 0, '2019-06-18', '0', 1),
(908, 'F14-17', 'NRS Ace Water', 'X-Large', 24, 1, 1, 1, 12, 0, '2019-06-18', '0', 1),
(909, 'F14-060', 'NRS', 'Medium', 24, 1, 1, 1, 12, 0, '2019-06-18', '0', 1),
(910, 'F14-132', 'NRS', 'Universal', 24, 1, 1, 1, 12, 0, '2019-06-18', '0', 1),
(911, '20', 'Protec Ace Water', 'Medium', 24, 1, 1, 1, 13, 0, '2019-06-18', '0', 1),
(912, '98', 'Protec Ace Water', 'Large', 24, 1, 1, 1, 13, 0, '2019-06-18', '0', 1),
(913, '99', 'Protec Ace Water', 'Large', 24, 5, 1, 1, 13, 0, '2019-06-18', '0', 1),
(914, 'S19-07', 'Protec Classic Water', 'Large/XL', 24, 5, 1, 1, 13, 0, '2019-06-18', '0', 1),
(915, 'IN16-051', 'NRS Ace Water', 'Medium', 24, 1, 1, 1, 0, 0, '2019-06-18', '0', 1),
(916, '101', 'Protec Ace Water', 'Medium', 24, 5, 1, 1, 13, 0, '2019-06-18', '0', 1),
(917, 'F14-013', 'NRS Ace Water', 'Small', 24, 4, 1, 1, 12, 0, '2019-06-18', '0', 1),
(918, 'F14-13', 'NRS Ace Water', 'Large', 24, 5, 1, 1, 12, 0, '2019-06-18', '0', 1),
(919, 'S15-18', 'Hotline UHC Men', 'Medium', 28, 1, 1, 1, 13, 0, '2019-06-19', '0', 1),
(920, 'S19-02', 'Hotline UHC 5/4 Men', 'Medium', 28, 1, 1, 315, 13, 0, '2019-06-19', '0', 1),
(921, 'S19-03', 'Hotline UHC 5/4 Men', 'Extra Large', 28, 1, 1, 315, 13, 0, '2019-06-19', '0', 1),
(922, 'S19-04', 'Hotline UHC 5/4 Men', 'Large', 28, 1, 1, 315, 13, 0, '2019-06-19', '0', 1),
(923, 'S19-05', 'Hotline UHC 5/4 Men', 'Large', 28, 1, 1, 315, 13, 0, '2019-06-11', '0', 1),
(924, 'S19-06', 'Hotline UHC 5/4', '8', 28, 1, 1, 295, 13, 0, '2019-06-19', '0', 1),
(925, 'S19-07', 'Hotline Reflex2 5/4 Women', '12', 28, 1, 1, 315, 13, 0, '2019-06-19', '0', 1),
(926, 'S19-01', 'Hotline Reflex2 5/4 Women', '14', 28, 1, 1, 295, 13, 0, '2019-06-19', '0', 1),
(927, '7.4', 'NRS Titanium', '7', 30, 1, 1, 1, 0, 0, '2019-06-20', '0', 1),
(928, 'IN16-19', 'Extrasport UT3-5', 'Youth', 25, 1, 1, 1, 13, 0, '2019-06-20', '0', 1),
(929, 'S19-01', 'Jetboil Sumo', 'One Size', 10, 1, 1, 135, 8, 0, '2019-06-21', '0', 0),
(930, 'S19-01', 'Peregrine Endurance 0', 'Regular', 4, 1, 1, 110, 8, 0, '2019-06-21', '0', 1),
(931, 'S19-02', 'Peregrine Endurance 0', 'Regular', 4, 1, 1, 110, 8, 0, '2019-06-21', '0', 1),
(932, 'S19-01', 'Eureka Spire', 'One Size', 11, 1, 1, 95, 8, 0, '2019-06-21', '0', 1),
(933, 'S19-02', 'Eureka Spire', 'One Size', 11, 1, 1, 95, 8, 0, '2019-06-21', '0', 1),
(934, 'S19-01', 'Cocoon Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 8, 0, '2019-06-21', '0', 1),
(935, 'S19-02', 'Cocoon Mummyliner Coolmax', 'Regular', 49, 1, 1, 50, 8, 0, '2019-06-21', '0', 1),
(936, 'S19-03', 'Cocoon Mummyliner Coolmax', 'Regular', 49, 4, 1, 50, 8, 0, '2019-06-21', '0', 1),
(937, 'S19-01', 'Eureka Radama', '2/3 Person', 2, 1, 1, 200, 8, 0, '2019-06-21', '0', 1),
(938, 'S19-02', 'Eureka Radama', '2/3 Person', 2, 1, 1, 200, 8, 0, '2019-06-21', '0', 1),
(939, '20', 'Surftech Blacktip L2S', '8 feet', 34, 1, 1, 300, 13, 0, '2018-11-01', '0', 1),
(940, '7', 'Surftech Softop', '9 feet', 34, 1, 1, 1, 8, 0, '2019-06-21', '0', 1),
(941, '16', 'Power Clip', '11 feet', 35, 1, 1, 1, 13, 0, '2019-06-21', '0', 1),
(942, 'F18-01', 'NSP', 'Adjustable', 73, 1, 1, 40, 0, 1, '2019-06-24', '0', 1),
(943, 'F18-02', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(944, 'F18-03', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(945, 'F18-04', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(946, 'F18-05', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(947, 'F18-05', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(948, 'F18-06', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(949, 'F18-07', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(950, 'F18-08', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(951, 'F18-09', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(952, 'F18-10', 'NSP', 'Adjustable', 73, 5, 1, 40, 15, 1, '2019-06-24', '0', 1),
(953, 'F18-11', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(954, 'F18-12', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(955, 'F18-13', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(956, 'F18-14', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(957, 'F18-15', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(958, 'F18-16', 'NSP', 'Adjustable', 73, 1, 1, 40, 15, 1, '2019-06-24', '0', 1),
(959, 'S19-08', 'Hotline Reflex2.0', 'Medium/Large', 28, 1, 1, 264, 14, 0, '2019-06-19', '0', 1),
(960, 'S19-09', 'Hotline Reflex2.0', 'Large', 28, 1, 1, 264, 14, 0, '2019-06-19', '0', 1),
(961, 'S19-10', 'Hotline Reflex2', 'Womens 16', 28, 1, 1, 264, 14, 0, '2019-06-19', '0', 1),
(962, 'F18-03', 'Dummy Data4', 'testing', 1, 4, 1, 0, 4, 0, '2019-06-25', '0', 1),
(963, '4', 'Kokatat', 'Universal', 26, 1, 1, 1, 13, 0, '2019-06-25', '0', 1),
(964, '33', 'NRS River', 'Medium', 26, 1, 1, 1, 0, 0, '2019-06-25', '0', 1),
(965, '7', 'NRS River', 'XL', 26, 1, 1, 1, 13, 0, '2019-06-25', '0', 1),
(966, 'V16-27', 'Seals Shocker 1.7', 'Universal', 26, 1, 1, 1, 13, 0, '2019-06-25', '0', 1),
(967, 'V16-22', 'Seals Shocker 1.7', 'Universal', 26, 1, 1, 1, 13, 0, '2019-06-25', '0', 1),
(968, 'V16-15', 'Seals Shocker 1.7', 'Universal', 26, 1, 1, 1, 13, 0, '2019-06-25', '0', 1),
(969, 'V16-24', 'Seals Shocker 1.7', 'Universal', 26, 1, 1, 1, 13, 0, '2019-06-25', '0', 1),
(970, 'V16-30', 'Seals Shocker 1.7', 'Universal', 26, 1, 1, 1, 13, 0, '2019-06-25', '0', 1),
(971, 'V16-20', 'Seals Shocker 1.7', 'Universal', 26, 1, 1, 1, 13, 0, '2019-06-25', '0', 1),
(972, 'V16-31', 'Seals Shocker 1.7', 'Universal', 26, 1, 1, 1, 13, 0, '2019-06-25', '0', 1),
(973, 'V16-23', 'Seals Shocker 1.7', 'Univseral', 26, 1, 1, 1, 13, 0, '2019-06-25', '0', 1),
(974, 'V16-53', 'NRS Kilt', 'Large', 26, 1, 1, 1, 13, 0, '2019-06-25', '0', 1),
(975, '2', 'NRS', 'One Size', 40, 1, 1, 1, 12, 0, '2019-06-25', '0', 1),
(976, 'S13-24', 'NRS', 'One Size', 40, 1, 1, 1, 12, 0, '2019-06-25', '0', 1),
(977, 'S13-9', 'NRS', 'One Size', 40, 1, 1, 1, 12, 0, '2019-06-25', '0', 1),
(978, 'S13-16', 'NRS', 'One Size', 40, 1, 1, 1, 12, 0, '2019-06-25', '0', 1),
(979, '8', 'Necky Eskia, Sea Sit-In', 'Long, One Person', 42, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(980, '1', 'Necky Manitou, Sea Sit-In', 'Short, One Person', 42, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(981, 'S18-01', 'NRS, Red', 'Small', 46, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(982, 'S13-01', 'NRS, Green', 'Medium', 46, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(983, 'S13-02', 'NRS, Green', 'Medium', 46, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(984, 'S13-03', 'NRS, Green', 'Medium', 46, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(985, 'S13-011', 'NRS, Blue', 'Large', 46, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(986, 'S13-12', 'NRS, Blue', 'Large', 46, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(987, 'S13-04', 'NRS, Blue', 'Large', 46, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(988, 'S13-031', 'NRS, Blue', 'Large', 46, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(989, 'S13-21', 'NRS, Green', 'XL', 46, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(990, 'S13-22', 'NRS, Green', 'XL', 46, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(991, 'S18-08', 'Hyside, SealLine Baja', '5L', 46, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(992, 'F15-06', 'Ocean Kayak, Comfort Plus Seat Back', 'One Size', 78, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(993, 'V16-10', 'Ocean Kayak, Comfort Plus Seat Back', 'One Size', 78, 5, 1, 1, 13, 0, '2019-06-27', '0', 1),
(994, 'F17-14', 'Ocean Kayak, Comfort Plus Seat Back', 'One Size', 78, 5, 1, 1, 13, 0, '2019-06-27', '0', 1),
(995, 'S17-14', 'Ocean Kayak, Comfort Plus Seat Back', 'One Size', 78, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(996, 'S17-01', 'Ocean Kayak, Comfort Backrest', 'One Size', 78, 1, 1, 1, 0, 0, '2019-06-27', '0', 1),
(997, 'S17-02', 'Ocean Kayak, Comfort Backrest', 'One Size', 78, 1, 1, 1, 0, 0, '2019-06-27', '0', 1),
(998, 'S17-09', 'Ocean Kayak, Comfort Plus Seat Back', 'One Size', 78, 1, 1, 1, 13, 0, '2019-06-27', '0', 1),
(999, 'Sp19-01', 'Ocean Kayak, Comfort Plus Seat Back', 'One Size', 78, 1, 1, 1, 0, 0, '2019-06-27', '0', 1),
(1000, 'Sp19-02', 'Ocean Kayak, Comfort Plus Seat Back', 'One Size', 78, 5, 1, 1, 0, 0, '2019-06-27', '0', 1),
(1001, 'Raft', 'Wing Inflatable 11.5', 'One Size', 75, 1, 1, 1, 13, 0, '2019-06-28', '0', 0),
(1002, 'Raft', 'Wing Inflatable 13.5', 'One Size', 75, 1, 1, 1, 13, 0, '2019-06-28', '0', 0),
(1003, 'Raft', 'Wing Inflatable 14.5', 'One Size', 75, 1, 1, 1, 13, 0, '2019-06-28', '0', 0),
(1004, 'Raft', 'Hyside Outfitter 13', 'One Size', 75, 1, 1, 3200, 11, 1, '2018-04-01', '0', 0),
(1005, 'Raft', 'Hyside Outfitter 13', 'One Size', 75, 1, 1, 3200, 11, 1, '2018-04-01', '0', 0),
(1006, 'Raft', 'Hyside Outfitter 13', 'One Size', 75, 1, 1, 3200, 11, 1, '2018-04-01', '0', 0),
(1007, 'Raft', 'Hyside Outfitter 13', 'One Size', 75, 1, 1, 3200, 11, 1, '2018-04-01', '0', 0),
(1008, '13', 'Foam', 'Universal', 60, 1, 1, 1, 13, 0, '2019-07-01', '0', 1),
(1009, 'S19-02', 'NRS, Mesh Drag Bag', 'One Size', 46, 1, 1, 25, 0, 0, '2019-06-01', '0', 1),
(1010, 'S19-03', 'NRS, Mesh Drag Bag', 'One Size', 46, 1, 1, 25, 12, 0, '2019-06-01', '0', 1),
(1011, '1', 'Custom', 'One Size', 79, 1, 1, 1, 13, 0, '2019-07-01', '0', 0),
(1012, '2', 'Custom', 'One Size', 79, 1, 1, 1, 13, 0, '2019-07-01', '0', 1),
(1013, '3', 'Custom', 'One Size', 79, 1, 1, 1, 13, 0, '2019-07-01', '0', 1),
(1014, 'SP14-01', 'Seals', '75 ft.', 80, 1, 1, 1, 13, 0, '2019-07-01', '0', 1),
(1015, 'SP14-02', 'Seals', '75 ft.', 80, 1, 1, 1, 13, 0, '2019-07-01', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE `Location` (
  `loc_id` int(11) NOT NULL,
  `loc_name` varchar(100) NOT NULL,
  `loc_phone_num` varchar(15) NOT NULL,
  `loc_address` varchar(50) NOT NULL,
  `loc_city` varchar(30) NOT NULL,
  `loc_state` varchar(13) NOT NULL,
  `loc_zip` varchar(10) NOT NULL,
  `loc_tax` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Location`
--

INSERT INTO `Location` (`loc_id`, `loc_name`, `loc_phone_num`, `loc_address`, `loc_city`, `loc_state`, `loc_zip`, `loc_tax`) VALUES
(1, 'Center Activities', '(707) 826-3357', '1 Harpst Street', 'Arcata', 'CA', '95521', 8.5),
(2, 'Humboldt Bay Aquatic Center', '(707) 826-4197', '921 Waterfront Drive', 'Eureka', 'CA', '95501', 8.75);

-- --------------------------------------------------------

--
-- Table structure for table `MainInvPack`
--

CREATE TABLE `MainInvPack` (
  `main_inv_pack_id` int(11) NOT NULL,
  `pack_id` int(11) NOT NULL,
  `inv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `MainInvPack`
--

INSERT INTO `MainInvPack` (`main_inv_pack_id`, `pack_id`, `inv_id`) VALUES
(1, 1, 36),
(2, 2, 37),
(3, 3, 38),
(4, 4, 39),
(5, 5, 42),
(6, 6, 43),
(7, 7, 34),
(8, 10, 66),
(9, 9, 67),
(10, 8, 74);

-- --------------------------------------------------------

--
-- Table structure for table `Notes`
--

CREATE TABLE `Notes` (
  `note_id` int(11) NOT NULL,
  `note` varchar(200) NOT NULL,
  `timestamp` datetime NOT NULL,
  `empl_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Notes`
--

INSERT INTO `Notes` (`note_id`, `note`, `timestamp`, `empl_id`) VALUES
(278, 'Bear canister rented for free', '2019-06-25 12:23:47', 28),
(279, 'Staff use only; missing D-ring', '2019-06-25 04:10:11', 28),
(280, 'Staff use only; missing D-ring', '2019-06-25 04:10:22', 28),
(281, 'Private trips only', '2019-06-26 04:24:42', 28),
(282, 'Broken', '2019-06-26 04:25:43', 28);

-- --------------------------------------------------------

--
-- Table structure for table `NotesCust`
--

CREATE TABLE `NotesCust` (
  `notecust_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `NotesEmpl`
--

CREATE TABLE `NotesEmpl` (
  `noteempl_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `empl_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `NotesItem`
--

CREATE TABLE `NotesItem` (
  `noteitem_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `item_Backid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `NotesItem`
--

INSERT INTO `NotesItem` (`noteitem_id`, `note_id`, `item_Backid`) VALUES
(293, 279, 72),
(294, 280, 72),
(295, 281, 110),
(296, 282, 113);

-- --------------------------------------------------------

--
-- Table structure for table `NotesRental`
--

CREATE TABLE `NotesRental` (
  `noterental_id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL,
  `rent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `NotesRental`
--

INSERT INTO `NotesRental` (`noterental_id`, `note_id`, `rent_id`) VALUES
(2, 278, 90);

-- --------------------------------------------------------

--
-- Table structure for table `OnSitePrices`
--

CREATE TABLE `OnSitePrices` (
  `on_site_id` int(11) NOT NULL,
  `pack_id` int(11) NOT NULL,
  `stu_price` int(11) NOT NULL,
  `reg_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `OnSitePrices`
--

INSERT INTO `OnSitePrices` (`on_site_id`, `pack_id`, `stu_price`, `reg_price`) VALUES
(1, 1, 25, 35),
(2, 5, 20, 26),
(3, 6, 20, 26),
(4, 9, 20, 26);

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
(8, 'Inflatable Stand Up Paddleboard Package', 20, 26, 32, 45, 45, 60),
(9, 'Stand Up Paddle Board Package', 20, 26, 32, 45, 45, 60),
(10, 'Sailboat Package', 45, 60, 70, 90, 115, 150);

-- --------------------------------------------------------

--
-- Table structure for table `PackLoc`
--

CREATE TABLE `PackLoc` (
  `packloc_id` int(11) NOT NULL,
  `pack_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PackLoc`
--

INSERT INTO `PackLoc` (`packloc_id`, `pack_id`, `loc_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 3, 1),
(5, 4, 1),
(6, 5, 2),
(7, 6, 2),
(8, 8, 1),
(9, 7, 1),
(10, 9, 2),
(11, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Rental`
--

CREATE TABLE `Rental` (
  `rent_id` int(11) NOT NULL,
  `request_date` date NOT NULL DEFAULT '0000-00-00',
  `due_date` date NOT NULL DEFAULT '0000-00-00',
  `pick_up_date` timestamp NULL DEFAULT current_timestamp(),
  `return_date` timestamp NULL DEFAULT current_timestamp(),
  `sub_total_cost` float NOT NULL,
  `total_cost` float NOT NULL,
  `rental_status` varchar(9) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Rental`
--

INSERT INTO `Rental` (`rent_id`, `request_date`, `due_date`, `pick_up_date`, `return_date`, `sub_total_cost`, `total_cost`, `rental_status`, `cust_id`, `loc_id`) VALUES
(43, '2019-05-03', '2019-05-07', '2019-05-03 11:07:46', '2019-05-06 09:35:51', 16, 17, 'Completed', 81, 1),
(44, '2019-05-07', '2019-05-09', '2019-05-03 13:20:40', '2019-05-03 13:46:51', 10, 10, 'Completed', 86, 1),
(45, '2019-05-14', '2019-05-17', NULL, NULL, 10, 10, 'Cancelled', 68, 1),
(46, '2019-05-03', '2019-05-06', '2019-05-03 13:32:12', '2019-06-04 14:21:17', 0, 0, 'Completed', 61, 1),
(47, '2019-05-03', '2019-05-06', '2019-05-03 22:48:29', '2019-06-10 16:35:38', 20, 21, 'Completed', 77, 1),
(48, '2019-05-10', '2019-05-13', '2019-05-13 12:48:52', '2019-05-13 12:49:09', 30, 32, 'Completed', 75, 1),
(49, '2019-05-14', '2019-05-15', NULL, NULL, 14, 15, 'Cancelled', 89, 1),
(50, '2019-05-14', '2019-05-15', NULL, NULL, 14, 15, 'Cancelled', 89, 1),
(51, '2019-05-14', '2019-05-15', NULL, NULL, 14, 15, 'Cancelled', 89, 1),
(52, '2019-05-17', '2019-05-20', NULL, NULL, 30, 32, 'Cancelled', 66, 1),
(53, '2019-05-17', '2019-05-20', NULL, NULL, 30, 32, 'Cancelled', 66, 1),
(54, '2019-05-17', '2019-05-20', NULL, NULL, 20, 21, 'Cancelled', 77, 1),
(55, '2019-05-13', '2019-05-17', '2019-05-13 11:36:49', '2019-06-10 16:36:11', 29, 31, 'Completed', 76, 1),
(56, '2019-05-20', '2019-05-24', NULL, NULL, 23, 24, 'Cancelled', 89, 1),
(57, '2019-05-13', '2019-05-17', '2019-05-13 11:43:13', '2019-06-10 16:36:18', 38, 41, 'Completed', 80, 1),
(58, '2019-05-20', '2019-05-24', NULL, NULL, 38, 41, 'Cancelled', 71, 1),
(59, '2019-05-27', '2019-05-31', NULL, '2019-06-10 16:28:47', 13, 14, 'Completed', 83, 1),
(60, '2019-05-16', '2019-05-17', '2019-05-16 09:43:14', '2019-06-10 16:36:29', 16, 17, 'Completed', 77, 1),
(61, '2019-06-03', '2019-06-04', '2019-06-03 15:37:16', '2019-06-10 16:36:36', 4, 4, 'Completed', 84, 1),
(62, '2019-06-04', '2019-06-05', '2019-06-04 14:20:08', '2019-06-10 16:33:16', 0, 0, 'Completed', 61, 1),
(63, '2019-06-10', '2019-06-10', '2019-06-10 16:28:34', '2019-06-10 16:29:09', 4, 4, 'Completed', 83, 1),
(64, '2019-06-10', '2019-06-10', '2019-06-10 16:38:46', '2019-06-10 16:39:23', 4, 4, 'Completed', 83, 1),
(65, '2019-06-10', '2019-06-10', '2019-06-10 16:40:07', '2019-06-10 16:40:14', 7, 7, 'Completed', 81, 1),
(73, '2019-06-14', '2019-06-17', NULL, NULL, 20, 21, 'Cancelled', 78, 1),
(74, '2019-06-14', '2019-06-17', '2019-06-18 10:52:36', '2019-06-18 10:53:13', 99, 107.42, 'Completed', 92, 1),
(77, '2019-06-17', '2019-06-18', '2019-06-17 11:28:09', '2019-06-17 11:28:33', 0, 0, 'Completed', 86, 1),
(78, '2019-06-17', '2019-06-18', '2019-06-17 13:22:40', '2019-06-17 13:27:16', 46, 0, 'Completed', 93, 1),
(79, '2019-06-21', '2019-06-24', '2019-06-17 13:37:24', '2019-06-17 13:37:56', 74, 0, 'Completed', 93, 1),
(80, '2019-06-17', '2019-06-24', '2019-06-17 13:47:25', '2019-06-17 13:48:22', 137, 148.65, 'Completed', 93, 1),
(81, '2019-06-21', '2019-06-24', '2019-06-17 14:50:46', '2019-06-17 14:50:55', 61, 66.19, 'Completed', 93, 1),
(82, '2019-06-21', '2019-06-24', '2019-06-17 14:57:47', '2019-06-17 14:57:53', 74, 80.29, 'Completed', 93, 1),
(83, '2019-06-18', '2019-06-20', '2019-06-18 10:42:05', '2019-06-18 12:16:33', 5, 5.43, 'Completed', 93, 1),
(84, '2019-06-18', '2019-06-21', '2019-06-18 12:23:18', '2019-06-21 00:00:00', 55, 59.68, 'On-Going', 93, 1),
(85, '2019-06-24', '2019-06-25', '2019-06-23 16:40:27', '2019-06-23 19:47:55', 20, 21.7, 'Completed', 93, 1),
(86, '2019-06-24', '2019-06-25', '2019-06-23 19:52:37', '2019-06-25 09:20:54', 7, 7.6, 'Completed', 94, 1),
(87, '2019-06-28', '2019-07-01', NULL, '2019-06-25 12:36:22', 20, 21.7, 'Completed', 93, 1),
(88, '2019-06-24', '2019-06-27', '2019-06-24 16:50:16', '2019-06-26 12:22:15', 25, 27.13, 'Completed', 93, 1),
(89, '2019-06-18', '2019-06-21', '2019-06-24 18:57:31', '2019-06-25 09:21:04', 26, 28.21, 'Completed', 94, 1),
(90, '2019-06-24', '2019-06-28', '2019-06-25 12:23:47', '2019-07-01 12:00:17', 21, 22.79, 'Completed', 95, 1),
(91, '2019-06-18', '2019-06-21', NULL, '2019-06-26 12:22:32', 10, 10.85, 'Completed', 93, 1),
(92, '2019-06-20', '2019-06-26', '2019-06-20 00:00:00', '2019-06-27 14:44:53', 185, 200.73, 'Completed', 96, 1),
(93, '2019-06-20', '2019-06-26', '2019-06-25 13:25:23', '2019-06-26 10:36:39', 135, 0, 'Completed', 97, 1),
(94, '2019-06-20', '2019-06-26', '2019-06-25 13:28:51', '2019-06-28 12:00:04', 10, 10.85, 'Completed', 98, 1),
(95, '2019-06-25', '2019-06-26', '2019-06-25 14:24:45', '2019-06-26 10:36:54', 35, 37.98, 'Completed', 99, 1),
(96, '2019-06-26', '2019-06-27', '2019-06-26 12:20:52', '2019-06-26 12:22:44', 24, 26.04, 'Completed', 93, 1),
(97, '2019-06-26', '2019-06-27', '2019-06-26 13:59:13', '2019-06-26 13:59:44', 49, 53.17, 'Completed', 93, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Repair`
--

CREATE TABLE `Repair` (
  `repair_id` int(11) NOT NULL,
  `item_Backid` int(11) NOT NULL,
  `empl_id` int(11) NOT NULL,
  `repair_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Reserve1`
--

CREATE TABLE `Reserve1` (
  `reserve_id` int(11) NOT NULL,
  `cost_at_time` int(11) NOT NULL,
  `rent_id` int(11) NOT NULL,
  `item_Backid` int(11) NOT NULL,
  `empl_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Reserve1`
--

INSERT INTO `Reserve1` (`reserve_id`, `cost_at_time`, `rent_id`, `item_Backid`, `empl_id`) VALUES
(48, 40, 74, 163, 29),
(50, 26, 74, 205, 29),
(93, 20, 85, 857, 30),
(94, 7, 86, 860, 30),
(95, 20, 87, 858, 30),
(96, 25, 88, 857, 30),
(97, 26, 89, 858, 30),
(98, 0, 90, 936, 28),
(99, 6, 90, 220, 28),
(100, 5, 90, 300, 28),
(101, 10, 90, 173, 28),
(102, 13, 90, 335, 28),
(103, 10, 91, 860, 30),
(104, 0, 92, 99, 28),
(105, 0, 92, 94, 28),
(106, 0, 92, 95, 28),
(107, 16, 92, 398, 28),
(108, 16, 92, 399, 28),
(109, 16, 92, 402, 28),
(110, 16, 92, 412, 28),
(111, 16, 92, 413, 28),
(112, 0, 92, 146, 28),
(113, 13, 93, 400, 28),
(114, 13, 93, 405, 28),
(115, 13, 93, 414, 28),
(116, 13, 93, 904, 28),
(117, 13, 93, 917, 28),
(118, 13, 93, 30, 28),
(119, 0, 93, 89, 28),
(120, 0, 93, 90, 28),
(121, 0, 93, 91, 28),
(122, 0, 93, 120, 28),
(123, 10, 94, 178, 28),
(124, 0, 95, 97, 28),
(125, 0, 95, 117, 28),
(126, 4, 97, 962, 30),
(127, 25, 97, 139, 30),
(128, 0, 97, 141, 30),
(129, 0, 97, 390, 30),
(130, 0, 97, 538, 30),
(131, 20, 97, 842, 30),
(132, 0, 97, 582, 30),
(133, 0, 97, 476, 30);

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
(7, 'Reserved'),
(8, 'Drying'),
(9, 'In Wash'),
(10, 'In Storage');

-- --------------------------------------------------------

--
-- Table structure for table `Vendor`
--

CREATE TABLE `Vendor` (
  `ven_id` int(11) NOT NULL,
  `ven_name` varchar(50) NOT NULL,
  `ven_phone` varchar(16) NOT NULL,
  `ven_street_address` varchar(50) NOT NULL,
  `ven_city` varchar(30) DEFAULT NULL,
  `ven_state` varchar(13) DEFAULT NULL,
  `ven_zip_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Vendor`
--

INSERT INTO `Vendor` (`ven_id`, `ven_name`, `ven_phone`, `ven_street_address`, `ven_city`, `ven_state`, `ven_zip_code`) VALUES
(4, 'Costco', '(707) 441-8750', '1006 W Wabash Ave', ' Eureka', 'Ca', '95501'),
(5, ' Recreational Equipment, Inc. (REI Online) ', ' 1-(800) 426-484', ' 85 Rossanley Drive', 'Medford', 'OR', '97501 '),
(8, 'Liberty Mountain(Online)', '1-(800) 366-2666', '680 Fairfield Rd ', 'Montoursville', 'PA', '17754'),
(9, 'Pacific Outfitters', '(707) 822-0321', '737 G Street', 'Arcata', 'Ca', '95521'),
(10, 'Amazon (Online)', '1-(800) 280-4331', '990 Beecher Street', 'San Leandro', 'Ca', '94577'),
(11, 'Hyside (Online)', '1-(800) 868-5987', '12100 Sierra Way', 'Kernville', 'Ca', '93238'),
(12, 'Northwest River Supplies (NRS Online)', '(877) 677-4327', '2009 S. Main Street', 'Moscow', 'ID', '83843'),
(13, 'No Vendor', 'No Vendor', 'No Vendor', 'No Vendor', 'No Vendor', 'No Vendor'),
(14, ' Hotline ', '  800-521-2982', '719 Swift Street #42', 'Santa Cruz', 'CA', '95060'),
(15, 'Surf Technologies', '7602843562', '5825 Avenida Encinas, Suite 104', 'Carlsbad', 'CA', '92008');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `CheckIn`
--
ALTER TABLE `CheckIn`
  ADD PRIMARY KEY (`check_in_id`),
  ADD KEY `rent_id` (`rent_id`),
  ADD KEY `item_Backid` (`item_Backid`),
  ADD KEY `empl_id` (`empl_id`);

--
-- Indexes for table `CheckOut`
--
ALTER TABLE `CheckOut`
  ADD PRIMARY KEY (`check_out_id`),
  ADD KEY `rent_id` (`rent_id`),
  ADD KEY `item_Backid` (`item_Backid`),
  ADD KEY `empl_id` (`empl_id`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`empl_id`),
  ADD KEY `loc_id` (`loc_id`);

--
-- Indexes for table `Inventory`
--
ALTER TABLE `Inventory`
  ADD PRIMARY KEY (`inv_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `InvLoc`
--
ALTER TABLE `InvLoc`
  ADD PRIMARY KEY (`invloc_id`),
  ADD KEY `InvLoc_ibfk_1` (`inv_id`),
  ADD KEY `loc_id` (`loc_id`);

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
  ADD KEY `stat_id` (`stat_id`) USING BTREE,
  ADD KEY `loc_id` (`loc_id`);

--
-- Indexes for table `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `MainInvPack`
--
ALTER TABLE `MainInvPack`
  ADD PRIMARY KEY (`main_inv_pack_id`),
  ADD KEY `inv_id` (`inv_id`),
  ADD KEY `pack_id` (`pack_id`);

--
-- Indexes for table `Notes`
--
ALTER TABLE `Notes`
  ADD PRIMARY KEY (`note_id`),
  ADD KEY `empl_id` (`empl_id`);

--
-- Indexes for table `NotesCust`
--
ALTER TABLE `NotesCust`
  ADD PRIMARY KEY (`notecust_id`),
  ADD KEY `note_id` (`note_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `NotesEmpl`
--
ALTER TABLE `NotesEmpl`
  ADD PRIMARY KEY (`noteempl_id`),
  ADD KEY `note_id` (`note_id`),
  ADD KEY `empl_id` (`empl_id`);

--
-- Indexes for table `NotesItem`
--
ALTER TABLE `NotesItem`
  ADD PRIMARY KEY (`noteitem_id`),
  ADD KEY `note_id` (`note_id`),
  ADD KEY `item_Backid` (`item_Backid`);

--
-- Indexes for table `NotesRental`
--
ALTER TABLE `NotesRental`
  ADD PRIMARY KEY (`noterental_id`),
  ADD KEY `note_id` (`note_id`),
  ADD KEY `rent_id` (`rent_id`);

--
-- Indexes for table `OnSitePrices`
--
ALTER TABLE `OnSitePrices`
  ADD PRIMARY KEY (`on_site_id`),
  ADD KEY `pack_id` (`pack_id`);

--
-- Indexes for table `Packages`
--
ALTER TABLE `Packages`
  ADD PRIMARY KEY (`pack_id`);

--
-- Indexes for table `PackLoc`
--
ALTER TABLE `PackLoc`
  ADD PRIMARY KEY (`packloc_id`),
  ADD KEY `pack_id` (`pack_id`),
  ADD KEY `loc_id` (`loc_id`);

--
-- Indexes for table `Rental`
--
ALTER TABLE `Rental`
  ADD PRIMARY KEY (`rent_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `loc_id` (`loc_id`);

--
-- Indexes for table `Repair`
--
ALTER TABLE `Repair`
  ADD PRIMARY KEY (`repair_id`),
  ADD KEY `empl_id` (`empl_id`),
  ADD KEY `item_Backid` (`item_Backid`);

--
-- Indexes for table `Reserve1`
--
ALTER TABLE `Reserve1`
  ADD PRIMARY KEY (`reserve_id`),
  ADD KEY `rent_id` (`rent_id`),
  ADD KEY `item_Backid` (`item_Backid`),
  ADD KEY `emp_id` (`empl_id`);

--
-- Indexes for table `Status`
--
ALTER TABLE `Status`
  ADD PRIMARY KEY (`stat_id`);

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
-- AUTO_INCREMENT for table `CheckIn`
--
ALTER TABLE `CheckIn`
  MODIFY `check_in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `CheckOut`
--
ALTER TABLE `CheckOut`
  MODIFY `check_out_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `Employee`
--
ALTER TABLE `Employee`
  MODIFY `empl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `Inventory`
--
ALTER TABLE `Inventory`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `InvLoc`
--
ALTER TABLE `InvLoc`
  MODIFY `invloc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `InvPack`
--
ALTER TABLE `InvPack`
  MODIFY `invpack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `Item`
--
ALTER TABLE `Item`
  MODIFY `item_Backid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1016;

--
-- AUTO_INCREMENT for table `Location`
--
ALTER TABLE `Location`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `MainInvPack`
--
ALTER TABLE `MainInvPack`
  MODIFY `main_inv_pack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Notes`
--
ALTER TABLE `Notes`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT for table `NotesCust`
--
ALTER TABLE `NotesCust`
  MODIFY `notecust_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `NotesEmpl`
--
ALTER TABLE `NotesEmpl`
  MODIFY `noteempl_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `NotesItem`
--
ALTER TABLE `NotesItem`
  MODIFY `noteitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table `NotesRental`
--
ALTER TABLE `NotesRental`
  MODIFY `noterental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `OnSitePrices`
--
ALTER TABLE `OnSitePrices`
  MODIFY `on_site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Packages`
--
ALTER TABLE `Packages`
  MODIFY `pack_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `PackLoc`
--
ALTER TABLE `PackLoc`
  MODIFY `packloc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Rental`
--
ALTER TABLE `Rental`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `Repair`
--
ALTER TABLE `Repair`
  MODIFY `repair_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Reserve1`
--
ALTER TABLE `Reserve1`
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `Status`
--
ALTER TABLE `Status`
  MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Vendor`
--
ALTER TABLE `Vendor`
  MODIFY `ven_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CheckIn`
--
ALTER TABLE `CheckIn`
  ADD CONSTRAINT `CheckIn_ibfk_1` FOREIGN KEY (`rent_id`) REFERENCES `Rental` (`rent_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `CheckIn_ibfk_2` FOREIGN KEY (`item_Backid`) REFERENCES `Item` (`item_Backid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CheckIn_ibfk_3` FOREIGN KEY (`empl_id`) REFERENCES `Employee` (`empl_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CheckOut`
--
ALTER TABLE `CheckOut`
  ADD CONSTRAINT `CheckOut_ibfk_1` FOREIGN KEY (`rent_id`) REFERENCES `Rental` (`rent_id`),
  ADD CONSTRAINT `CheckOut_ibfk_2` FOREIGN KEY (`item_Backid`) REFERENCES `Item` (`item_Backid`),
  ADD CONSTRAINT `CheckOut_ibfk_3` FOREIGN KEY (`empl_id`) REFERENCES `Employee` (`empl_id`) ON DELETE CASCADE;

--
-- Constraints for table `Employee`
--
ALTER TABLE `Employee`
  ADD CONSTRAINT `Employee_ibfk_1` FOREIGN KEY (`loc_id`) REFERENCES `Location` (`loc_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Inventory`
--
ALTER TABLE `Inventory`
  ADD CONSTRAINT `Inventory_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `Category` (`cat_id`);

--
-- Constraints for table `InvLoc`
--
ALTER TABLE `InvLoc`
  ADD CONSTRAINT `InvLoc_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `Inventory` (`inv_id`),
  ADD CONSTRAINT `InvLoc_ibfk_2` FOREIGN KEY (`loc_id`) REFERENCES `Location` (`loc_id`);

--
-- Constraints for table `InvPack`
--
ALTER TABLE `InvPack`
  ADD CONSTRAINT `InvPack_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `Inventory` (`inv_id`),
  ADD CONSTRAINT `InvPack_ibfk_2` FOREIGN KEY (`pack_id`) REFERENCES `Packages` (`pack_id`);

--
-- Constraints for table `Item`
--
ALTER TABLE `Item`
  ADD CONSTRAINT `Item_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `Inventory` (`inv_id`),
  ADD CONSTRAINT `Item_ibfk_2` FOREIGN KEY (`loc_id`) REFERENCES `Location` (`loc_id`);

--
-- Constraints for table `MainInvPack`
--
ALTER TABLE `MainInvPack`
  ADD CONSTRAINT `MainInvPack_ibfk_1` FOREIGN KEY (`inv_id`) REFERENCES `Inventory` (`inv_id`),
  ADD CONSTRAINT `MainInvPack_ibfk_2` FOREIGN KEY (`pack_id`) REFERENCES `Packages` (`pack_id`);

--
-- Constraints for table `Notes`
--
ALTER TABLE `Notes`
  ADD CONSTRAINT `Notes_ibfk_1` FOREIGN KEY (`empl_id`) REFERENCES `Employee` (`empl_id`);

--
-- Constraints for table `NotesCust`
--
ALTER TABLE `NotesCust`
  ADD CONSTRAINT `NotesCust_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `Customer` (`cust_id`),
  ADD CONSTRAINT `NotesCust_ibfk_2` FOREIGN KEY (`note_id`) REFERENCES `Notes` (`note_id`);

--
-- Constraints for table `NotesEmpl`
--
ALTER TABLE `NotesEmpl`
  ADD CONSTRAINT `NotesEmpl_ibfk_1` FOREIGN KEY (`empl_id`) REFERENCES `Employee` (`empl_id`),
  ADD CONSTRAINT `NotesEmpl_ibfk_2` FOREIGN KEY (`note_id`) REFERENCES `Notes` (`note_id`);

--
-- Constraints for table `NotesItem`
--
ALTER TABLE `NotesItem`
  ADD CONSTRAINT `NotesItem_ibfk_1` FOREIGN KEY (`item_Backid`) REFERENCES `Item` (`item_Backid`),
  ADD CONSTRAINT `NotesItem_ibfk_2` FOREIGN KEY (`note_id`) REFERENCES `Notes` (`note_id`);

--
-- Constraints for table `NotesRental`
--
ALTER TABLE `NotesRental`
  ADD CONSTRAINT `NotesRental_ibfk_1` FOREIGN KEY (`rent_id`) REFERENCES `Rental` (`rent_id`),
  ADD CONSTRAINT `NotesRental_ibfk_2` FOREIGN KEY (`note_id`) REFERENCES `Notes` (`note_id`);

--
-- Constraints for table `OnSitePrices`
--
ALTER TABLE `OnSitePrices`
  ADD CONSTRAINT `OnSitePrices_ibfk_1` FOREIGN KEY (`pack_id`) REFERENCES `Packages` (`pack_id`);

--
-- Constraints for table `PackLoc`
--
ALTER TABLE `PackLoc`
  ADD CONSTRAINT `PackLoc_ibfk_1` FOREIGN KEY (`loc_id`) REFERENCES `Location` (`loc_id`),
  ADD CONSTRAINT `PackLoc_ibfk_2` FOREIGN KEY (`pack_id`) REFERENCES `Packages` (`pack_id`);

--
-- Constraints for table `Rental`
--
ALTER TABLE `Rental`
  ADD CONSTRAINT `Rental_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `Customer` (`cust_id`),
  ADD CONSTRAINT `Rental_ibfk_2` FOREIGN KEY (`loc_id`) REFERENCES `Location` (`loc_id`);

--
-- Constraints for table `Repair`
--
ALTER TABLE `Repair`
  ADD CONSTRAINT `Repair_ibfk_1` FOREIGN KEY (`empl_id`) REFERENCES `Employee` (`empl_id`),
  ADD CONSTRAINT `Repair_ibfk_2` FOREIGN KEY (`item_Backid`) REFERENCES `Item` (`item_Backid`);

--
-- Constraints for table `Reserve1`
--
ALTER TABLE `Reserve1`
  ADD CONSTRAINT `Reserve1_ibfk_1` FOREIGN KEY (`rent_id`) REFERENCES `Rental` (`rent_id`),
  ADD CONSTRAINT `Reserve1_ibfk_2` FOREIGN KEY (`item_Backid`) REFERENCES `Item` (`item_Backid`),
  ADD CONSTRAINT `Reserve1_ibfk_3` FOREIGN KEY (`empl_id`) REFERENCES `Employee` (`empl_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
