SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `loqbox_database`
--

CREATE DATABASE IF NOT EXISTS `loqbox_database` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `loqbox_database`;

-- --------------------------------------------------------

--
-- User: `loqbox`
--

CREATE USER 'loqbox'@'%' IDENTIFIED BY '0000';
GRANT ALL PRIVILEGES ON *.* TO 'loqbox'@'%' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `loqbox_database`.* TO 'loqbox'@'%';

-- --------------------------------------------------------

--
-- Table structure for table `overdrafts`
--

CREATE TABLE `overdrafts` (
  `overdraft_no` int(5) UNSIGNED NOT NULL,
  `overdraft` decimal(10,2) NOT NULL DEFAULT '250.00',
  `user` int(1) NOT NULL,
  `dateposted` datetime NOT NULL,
  `postedby` int(5) NOT NULL DEFAULT '0',
  `ip` varchar(30) DEFAULT NULL,
  `host` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overdrafts`
--

INSERT INTO `overdrafts` (`overdraft_no`, `overdraft`, `user`, `dateposted`, `postedby`, `ip`, `host`) VALUES
(1, '200.00', 1, '2022-04-06 17:11:50', 1, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(2, '250.00', 1, '2022-04-06 17:12:30', 1, '127.0.0.1', 'Windows NT 10.0; Win64; x64');

-- --------------------------------------------------------

--
-- Table structure for table `spending_saving`
--

CREATE TABLE `spending_saving` (
  `ss_no` int(5) UNSIGNED NOT NULL,
  `threshold` decimal(10,2) NOT NULL DEFAULT '250.00',
  `user` int(1) NOT NULL,
  `dateposted` datetime NOT NULL,
  `postedby` int(5) NOT NULL DEFAULT '0',
  `ip` varchar(30) DEFAULT NULL,
  `host` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spending_saving`
--

INSERT INTO `spending_saving` (`ss_no`, `threshold`, `user`, `dateposted`, `postedby`, `ip`, `host`) VALUES
(1, '3000.00', 1, '2022-04-06 17:11:50', 1, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(2, '4000.00', 1, '2022-04-06 17:12:30', 1, '127.0.0.1', 'Windows NT 10.0; Win64; x64');

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `title_no` int(5) UNSIGNED NOT NULL,
  `title` varchar(40) NOT NULL,
  `dateposted` datetime NOT NULL,
  `dateupdated` datetime DEFAULT NULL,
  `postedby` int(5) NOT NULL DEFAULT '0',
  `editedby` int(5) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `host` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`title_no`, `title`, `dateposted`, `dateupdated`, `postedby`, `editedby`, `ip`, `host`) VALUES
(1, 'Bills', '2022-04-06 11:59:34', '2022-04-06 11:59:34', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(2, 'Charity', '2022-04-06 11:59:34', '2022-04-06 11:59:34', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(3, 'Eating Out', '2022-04-06 12:00:48', '2022-04-06 12:00:48', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(4, 'Entertainment', '2022-04-06 12:00:48', '2022-04-06 12:00:48', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(5, 'Expenses', '2022-04-06 12:01:42', '2022-04-06 12:01:42', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(6, 'Family', '2022-04-06 12:01:42', '2022-04-06 12:01:42', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(7, 'Finances', '2022-04-06 12:01:42', '2022-04-06 12:01:42', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(8, 'General', '2022-04-06 12:01:42', '2022-04-06 12:01:42', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(9, 'Gifts', '2022-04-06 12:01:42', '2022-04-06 12:01:42', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(10, 'Groceries', '2022-04-06 12:01:42', '2022-04-06 12:01:42', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(11, 'Holiday', '2022-04-06 12:01:42', '2022-04-06 12:01:42', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(12, 'Income', '2022-04-06 12:01:42', '2022-04-06 12:01:42', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(13, 'Personal Care', '2022-04-06 12:01:42', '2022-04-06 12:01:42', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(14, 'Savings', '2022-04-06 12:01:42', '2022-04-06 12:01:42', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(15, 'Shopping', '2022-04-06 12:12:18', '2022-04-06 12:12:18', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(16, 'Transfers', '2022-04-06 12:12:18', '2022-04-06 12:12:18', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64'),
(17, 'Transport', '2022-04-06 12:12:18', '2022-04-06 12:12:18', 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_no` int(5) UNSIGNED NOT NULL,
  `transactionID` varchar(10) NOT NULL,
  `user` int(5) NOT NULL,
  `logType` int(1) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `overdraft` varchar(5) DEFAULT NULL,
  `title` int(2) NOT NULL,
  `description` text,
  `posteddate` datetime NOT NULL,
  `dateposted` datetime NOT NULL,
  `dateupdated` datetime DEFAULT NULL,
  `postedby` int(5) NOT NULL DEFAULT '0',
  `editedby` int(5) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `host` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_no`, `transactionID`, `user`, `logType`, `amount`, `overdraft`, `title`, `description`, `posteddate`, `dateposted`, `dateupdated`, `postedby`, `editedby`, `ip`, `host`) VALUES
(1, 'LL40935671', 1, 1, '2000.00', '', 12, 'Initial Deposit', '2022-04-06 22:13:00', '2022-04-06 22:13:50', NULL, 1, NULL, '127.0.0.1', 'Windows NT 10.0; Win64; x64');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_no` int(5) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `phone` varchar(14) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  `dateposted` datetime NOT NULL,
  `dateupdated` datetime DEFAULT NULL,
  `dateended` datetime DEFAULT NULL,
  `postedby` int(5) NOT NULL DEFAULT '0',
  `editedby` int(5) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `host` varchar(60) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `photo` text,
  `online` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_no`, `first_name`, `last_name`, `occupation`, `phone`, `email`, `password`, `dateposted`, `dateupdated`, `dateended`, `postedby`, `editedby`, `ip`, `host`, `status`, `photo`, `online`) VALUES
(1, 'Oliver', 'Twist', 'CTO, Loqbox', '+447777777777', 'oliver@loqbox.com', '4a7d1ed414474e4033ac29ccb8653d9b', '2022-04-06 15:27:21', '2022-04-06 21:39:43', NULL, 1, 1, '127.0.0.1', 'Windows NT 10.0; Win64; x64', 2, 'Oliver_Twist_Profile_Photo.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_activities`
--

CREATE TABLE `user_activities` (
  `act_no` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `user_no` int(10) NOT NULL DEFAULT '0',
  `ip` text NOT NULL,
  `host` text NOT NULL,
  `dateposted` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_activities`
--

INSERT INTO `user_activities` (`act_no`, `description`, `user_no`, `ip`, `host`, `dateposted`) VALUES
(1, 'Oliver Twist signed in for the first time from Windows NT 10.0; Win64; x64', 1, '127.0.0.1', 'Windows NT 10.0; Win64; x64', '2022-04-06 22:13:07'),
(2, 'Oliver Twist added a new transaction: LL40935671', 1, '127.0.0.1', 'Windows NT 10.0; Win64; x64', '2022-04-06 22:13:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `log_no` int(10) UNSIGNED NOT NULL,
  `user_no` int(10) NOT NULL,
  `lastlogin_time` datetime NOT NULL,
  `login_count` bigint(30) NOT NULL,
  `Ip` varchar(30) DEFAULT NULL,
  `host` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`log_no`, `user_no`, `lastlogin_time`, `login_count`, `Ip`, `host`) VALUES
(1, 1, '2022-04-06 22:13:07', 1, '127.0.0.1', 'Windows NT 10.0; Win64; x64');

-- --------------------------------------------------------

--
-- Table structure for table `user_logintimes`
--

CREATE TABLE `user_logintimes` (
  `logs_no` bigint(20) UNSIGNED NOT NULL,
  `user_no` int(10) NOT NULL,
  `login_time` datetime NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `host` varchar(60) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_logintimes`
--

INSERT INTO `user_logintimes` (`logs_no`, `user_no`, `login_time`, `ip`, `host`) VALUES
(1, 1, '2022-04-06 22:13:07', '127.0.0.1', 'Windows NT 10.0; Win64; x64');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `overdrafts`
--
ALTER TABLE `overdrafts`
  ADD PRIMARY KEY (`overdraft_no`);

--
-- Indexes for table `spending_saving`
--
ALTER TABLE `spending_saving`
  ADD PRIMARY KEY (`ss_no`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`title_no`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_no`),
  ADD UNIQUE KEY `subjectID` (`transactionID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_no`),
  ADD UNIQUE KEY `phone` (`phone`,`email`);

--
-- Indexes for table `user_activities`
--
ALTER TABLE `user_activities`
  ADD PRIMARY KEY (`act_no`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`log_no`),
  ADD UNIQUE KEY `user_login` (`user_no`,`lastlogin_time`);

--
-- Indexes for table `user_logintimes`
--
ALTER TABLE `user_logintimes`
  ADD PRIMARY KEY (`logs_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `overdrafts`
--
ALTER TABLE `overdrafts`
  MODIFY `overdraft_no` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `spending_saving`
--
ALTER TABLE `spending_saving`
  MODIFY `ss_no` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
  MODIFY `title_no` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_no` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_no` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_activities`
--
ALTER TABLE `user_activities`
  MODIFY `act_no` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `log_no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_logintimes`
--
ALTER TABLE `user_logintimes`
  MODIFY `logs_no` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


COMMIT;