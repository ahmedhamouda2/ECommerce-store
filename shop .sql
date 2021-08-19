-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2021 at 06:45 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `parent` int(11) NOT NULL,
  `Ordering` int(11) DEFAULT NULL,
  `Visibility` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_comment` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Ads` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `parent`, `Ordering`, `Visibility`, `Allow_comment`, `Allow_Ads`) VALUES
(6, 'Handmade', 'Hand made items', 0, 1, 1, 1, 1),
(7, 'Computers', 'Computers item', 0, 2, 0, 0, 1),
(8, 'Cell phones', 'cell phones', 0, 3, 0, 0, 0),
(9, 'Clothing', 'clothing and fashion', 0, 4, 1, 1, 1),
(10, 'Tools', 'home tools', 0, 5, 0, 1, 0),
(13, 'Samsung', 'Samsung smartphones', 8, 6, 1, 1, 0),
(15, 'Hammers', 'Hammers for testing', 10, 11, 0, 0, 0),
(16, 'iPhone mobiles', 'iPhone from apple inc', 8, 20, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `status`, `comment_date`, `item_id`, `user_id`) VALUES
(1, 'Very Nice', 1, '2021-08-11 18:37:10', 12, 2),
(2, 'Very nice', 1, '2021-08-11 21:56:34', 10, 3),
(20, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam quae ex, rem voluptatibus fugit magni corrupti esse perferendis reiciendis? Consectetur provident iste perspiciatis ratione, incidunt neque nemo cumque? Libero, laboriosam.', 1, '2021-08-13 22:04:39', 11, 3),
(21, 'This is wonderful of using', 1, '2021-08-19 15:07:11', 10, 3),
(22, 'This is very useful', 1, '2021-08-19 15:14:48', 13, 3),
(26, 'So cool', 1, '2021-08-19 15:15:40', 12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Approve` tinyint(4) NOT NULL DEFAULT 0,
  `Cat_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_ID`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Made`, `Image`, `Status`, `Approve`, `Cat_ID`, `Member_ID`, `tags`) VALUES
(10, 'Laptop', 'Very Good laptop', '700', '2021-08-10', 'China', 'Laptop.png', '1', 1, 7, 1, 'device , electronic , smart '),
(11, 'Magic Mouse', 'Apple Mouse', '20', '2021-08-10', 'USA', 'Magic_mouse.jpg', '1', 1, 7, 2, 'professional , great mouse , For gaming , Ergonomic , discount'),
(12, 'iPhone 12', 'apple mobile', '1500', '2021-08-10', 'japan', 'iPhone_12.jpg', '1', 1, 8, 3, 'discount , smart , phone , apple'),
(13, 'TP-Link Archer', 'the best', '70', '2021-08-10', 'china', 'TP_Link_Archer.jpg', '1', 1, 7, 3, 'Ergonomic , router, electrician , device'),
(14, 'Bluetooth Speaker', 'very good speaker ', '125', '2021-08-10', 'USA', 'Bluetooth_Speakeri_Wireless.webp', '1', 1, 7, 2, 'discount , speaker , music'),
(15, 'Remote', 'This is testing remote', '20', '2021-08-12', 'USA', 'Remote.jpg', '1', 1, 7, 19, 'discount'),
(19, 'Wooden Game', 'A Good Wooden game', '45', '2021-08-14', 'Palestine', 'Wooden_game_.jpg', '3', 1, 6, 23, 'homemade , discount , wood , gaming'),
(20, 'Network Cable', 'Cat 9 Network Cable', '100', '2021-08-14', 'USA', 'Network_cable.jpg', '4', 1, 10, 17, ' electronic , cable , network'),
(21, 'Air conditioner', 'To cool the air, very practical', '200', '2021-08-14', 'Korea', 'air-conditioning.jpg', '3', 1, 10, 21, 'discount , electrician , cooling , chilled , machine'),
(22, 'PlayStation 5', 'Good Playstation 5 Game', '120', '2021-08-14', 'Finland', 'PlayStation_5.jpg', '2', 1, 10, 3, 'discount , gaming , video game'),
(23, 'Washing Machine', 'kg1400 Washing Machine White', '450', '2021-08-14', 'Italia', 'Washing_machine.webp', '2', 1, 10, 22, 'discount , electical devices , machine'),
(24, 'embroidery robe', 'hand made works', '40', '2021-08-17', 'Palestine', 'embroidery_robe.webp', '1', 1, 6, 20, 'discount , handmade , heritage , legacy , tradition ,clothing'),
(25, 'T-shirt sport', 'T-shirt for playing sport', '50', '2021-08-19', 'spain', 'sports-t-shirt.webp', '1', 1, 9, 22, 'discount , sport ,clothing , football');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL COMMENT 'To Identify User',
  `Username` varchar(255) NOT NULL COMMENT 'Username To Login',
  `Password` varchar(255) NOT NULL COMMENT 'Password To Login',
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0 COMMENT 'Identify user Group',
  `RegStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'User Approval',
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `GroupID`, `RegStatus`, `Date`, `Avatar`) VALUES
(1, 'ahmedadel97', '601f1889667efaebb33b8c12572835da3f027f78', 'ahmedhamouda9797@gmail.com', 'ahmed adel hamouda', 1, 1, '2021-08-10', ''),
(2, 'mohammed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mohammed@gmail.com', 'mohammed adel', 0, 0, '2021-08-10', ''),
(3, 'Yazan alsharif', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Yazan@gmail.com', 'Yazan mohammed', 0, 1, '2021-08-10', '259942_EYVxlOSXsAExOpX.jpg'),
(17, 'mahmoud', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'mahmoud@gmail.com', 'Mahmoud Ahmed', 0, 0, '2021-08-12', '259942_EYVxlOSXsAExOpX.jpg'),
(18, 'ahmed', '601f1889667efaebb33b8c12572835da3f027f78', 'ahmed@gmail.com', 'Ahmed Khalid', 0, 0, '2021-08-12', ''),
(19, 'alia', '601f1889667efaebb33b8c12572835da3f027f78', 'alia0@gmail.com', 'Alia Abdulhadi', 0, 0, '2021-08-12', ''),
(20, 'alaa', '601f1889667efaebb33b8c12572835da3f027f78', 'alaa@gmail.com', 'Alaa Hamouda', 0, 1, '2021-08-12', ''),
(21, 'ahmed mohammed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ahmedmohammed@gmail.com', 'ahmed mohammed', 0, 1, '2021-08-18', ''),
(22, 'husam abu odah02', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'husam@gmail.com', 'husam abu odah', 0, 1, '2021-08-18', '259942_EYVxlOSXsAExOpX.jpg'),
(23, 'Rola', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'rolaali@gmail.com', 'Rola ahmed', 0, 1, '2021-08-18', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `items_comments` (`item_id`),
  ADD KEY `users_comments` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `member_1` (`Member_ID`),
  ADD KEY `cat_1` (`Cat_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'To Identify User', AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `items_comments` FOREIGN KEY (`item_id`) REFERENCES `items` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_comments` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
