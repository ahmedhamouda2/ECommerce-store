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
