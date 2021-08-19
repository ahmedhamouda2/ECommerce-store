--
-- Database name : shop
--

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
    `GroupID` int(11) NOT NULL DEFAULT '0' COMMENT 'Identify User Group',
    `RegStatus` int(11) NOT NULL DEFAULT '0' COMMENT 'User Approval',
    `Date` date NOT NULL,
    `Avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `GroupID`, `RegStatus`, `Date`, `avatar`) VALUES
(1, 'ahmedadel97', '601f1889667efaebb33b8c12572835da3f027f78', 'ahmedhamouda9797@gmail.com', 'ahmed adel hamouda', 1, 1, '2021-08-02', ''),
(2, 'mohammed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mohammed@gmail.com', 'mohammed adel', 0, 0, '2021-08-10', ''),
(3, 'Yazan alsharif', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Yazan@gmail.com', 'Yazan mohammed', 0, 1, '2021-08-10', '259942_EYVxlOSXsAExOpX.jpg'),
(17, 'mahmoud', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'mahmoud@gmail.com', 'Mahmoud Ahmed', 0, 0, '2021-08-12', '259942_EYVxlOSXsAExOpX.jpg'),
(18, 'ahmed', '601f1889667efaebb33b8c12572835da3f027f78', 'ahmed@gmail.com', 'Ahmed Khalid', 0, 0, '2021-08-12', ''),
(19, 'alia', '601f1889667efaebb33b8c12572835da3f027f78', 'alia0@gmail.com', 'Alia Abdulhadi', 0, 0, '2021-08-12', ''),
(20, 'alaa', '601f1889667efaebb33b8c12572835da3f027f78', 'alaa@gmail.com', 'Alaa Hamouda', 0, 1, '2021-08-12', ''),
(21, 'ahmed mohammed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ahmedmohammed@gmail.com', 'ahmed mohammed', 0,1, '2021-08-18', '');
(22, 'husam abu odah02', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'husam abu odah02', 'husam abu odah', 0, 1, '2021-08-18', '259942_EYVxlOSXsAExOpX.jpg');
(23, 'Rola', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'rolaali@gmail.com', 'Rola ahmed', 0, 1, '2021-08-18','');
