-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2020 at 04:58 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `optblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `slug`, `created`, `updated`) VALUES
(6, 'ARSENAL', 'BEST', 'BEST', '2020-09-12 10:54:26', '2020-09-12 10:54:26'),
(7, 'KI BE', 'KI BE', 'KI BE', '2020-09-12 11:39:48', '2020-09-12 11:39:48'),
(10, 'liverpool', 'liverpool', 'liverpool', '2020-09-14 16:36:55', '2020-09-14 16:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `pid`, `uid`, `comment`, `status`, `created`, `updated`) VALUES
(1, 2, 1, 'f', 'approved', '2020-09-14 08:17:52', '2020-09-14 08:55:00'),
(2, 2, 1, 'asdiuiu', 'approved', '2020-09-14 08:18:39', '2020-09-14 09:21:44'),
(3, 2, 1, 'asd', 'approved', '2020-09-14 08:18:57', '2020-09-14 08:55:03'),
(4, 2, 1, 'ok', 'approved', '2020-09-14 08:22:51', '2020-09-14 09:21:51'),
(5, 2, 1, 'okkkkkkkkk', 'approved', '2020-09-14 08:24:18', '2020-09-14 09:21:53'),
(6, 2, 1, 'ok', 'approved', '2020-09-14 08:24:52', '2020-09-14 09:21:54'),
(7, 2, 1, 'ok', 'approved', '2020-09-14 08:25:05', '2020-09-14 09:21:55'),
(8, 2, 1, 'thik ase', 'disapproved', '2020-09-14 08:35:27', '2020-09-14 16:41:14'),
(9, 14, 1, 'Thik ase de', 'approved', '2020-09-14 08:38:54', '2020-09-14 10:07:40'),
(10, 14, 1, 'thik ase', 'approved', '2020-09-14 08:48:01', '2020-09-14 10:07:39'),
(11, 2, 1, 'ki be', 'approved', '2020-09-14 10:07:24', '2020-09-14 10:07:38'),
(12, 4, 1, 'ki be', 'approved', '2020-09-14 10:11:12', '2020-09-14 10:11:20'),
(13, 17, 7, 'ki korisa o', 'approved', '2020-09-14 16:00:11', '2020-09-14 16:41:42');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `page_order` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `uid`, `title`, `content`, `status`, `slug`, `page_order`, `created`, `updated`) VALUES
(1, 1, '1', '1', 'draft', '1', '1', '2020-09-10 15:53:49', '2020-09-10 15:53:49'),
(3, 1, '12345', '12345', 'draft', '12345', '1', '2020-09-11 06:58:25', '2020-09-11 07:12:44'),
(4, 1, 'Liverpool', 'ok', 'draft', 'Liverppol', '1', '2020-09-13 07:16:17', '2020-09-13 07:16:17'),
(5, 7, '3', '3', 'draft', '3', '1', '2020-09-14 15:24:20', '2020-09-14 15:24:20'),
(6, 7, 'ytyt', 'oioio', 'published', '87878', '5', '2020-09-14 15:26:44', '2020-09-14 15:26:44'),
(7, 7, '23', '23', 'published', '23', '1', '2020-09-14 15:50:09', '2020-09-14 15:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `id` int(11) NOT NULL,
  `pos` int(11) NOT NULL,
  `club` varchar(255) NOT NULL,
  `mp` int(11) NOT NULL,
  `win` int(11) NOT NULL,
  `draw` int(11) NOT NULL,
  `lost` int(11) NOT NULL,
  `gf` int(11) NOT NULL,
  `ga` int(11) NOT NULL,
  `gd` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `league` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `pos`, `club`, `mp`, `win`, `draw`, `lost`, `gf`, `ga`, `gd`, `points`, `league`) VALUES
(2, -3, 'Arsenal', 1, 1, 0, 0, 0, 1, 1, 1, 'premierleague'),
(5, 0, 'ok', 1, -4, 1, 11, -3, -8, 1, 3, 'premierleague'),
(6, 0, 'JAI SHREE RAM', 1, 1, 1, 1, -5, 1, 3, 34, 'premierleague');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `news` varchar(255) NOT NULL,
  `header` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uid`, `title`, `content`, `status`, `news`, `header`, `slug`, `pic`, `created`, `updated`) VALUES
(6, 1, 'is ronaldo greatest and the best footballer of the world??', 'Nikola Jokic and the Denver Nuggets already overcame a 3-1 deficit this postseason, but the Los Angeles Clippers are a much tougher test than the Utah Jazz.\r\n\r\n\r\n\r\nIf you remove Denver\'s 17-of-24 first quarter in Game 2, the Nuggets are shooting just 41.7 percent against this defense. Over the course of the entire series, Nuggets not named Jokic are at 41.5 percent.\r\n\r\nFinding decent looks against the length and switchability of Kawhi Leonard, Paul George, Marcus Morris Sr. and Patrick Beverley has proved difficult. And if Denver isn\'t scoring at its typical level, it\'s in trouble. This isn\'t a roster that can grind out many wins through its defense, especially against a title contender.\r\n\r\nJamal Murray returning to anywhere near the form he displayed against the Jazz would obviously help, but the real key might be Michael Porter Jr.\r\n\r\nAt 6\'10\", he has the size to effectively shoot over those switchy defenders, and he\'s the only rotation player who doesn\'t have a negative plus-minus in this series.\r\n\r\nGetting him more involved would force L.A. to commit more defensive attention, thus loosening things up for the two stars.\r\n\r\n\"We kept going to [Jokic] and [Murray] and they are two amazing players, but I just think to beat them we need to get more players involved,\" Porter said of his team\'s offense fading down the stretch of Game 4. \"We have to move the ball a little bit better. We can\'t be predictable against that team.\"\r\n\r\nThe Murray-Jokic pick-and-roll is one of the most entertaining sets in the league, but more kickouts to a scorer like Porter, who is averaging over 20 points per 36 minutes in the bubble, would reduce that predictability.\r\n\r\nThe Nuggets will do that a bit more in Game 5 and stave off elimination, but the Clippers will bounce back and end the series in six.', 'published', 'esports', 'toppost', 'Can he be the best among the rest?', 'media/1600179194cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', '2020-09-11', '2020-09-15 14:27:38'),
(16, 1, 'CAn he become the best among the rest?', 'ok', 'published', 'football', 'editorchoice', 'ok', 'media/1600267804cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', '2020-09-14', '2020-09-16 14:50:04'),
(17, 7, 'KIBA HOBO', 'KIBA HOBO', 'published', 'football', 'editorchoice', 'KIBAHOBO', 'media/1600187183cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', '2020-09-14', '2020-09-16 14:41:24'),
(19, 1, 'kjkj', 'lklkl', 'published', 'football', 'editorchoice', 'kj', 'media/1600105205IMG_20170512_201412.jpeg', '2020-09-14', '2020-09-16 14:42:27'),
(20, 1, 'CAN YOU BECOME THE BEST??', 'asdasd', 'published', 'football', 'editorchoice', 'kjkj', 'media/1600268188cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', '2020-09-16', '2020-09-16 14:56:46');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `pid`, `cid`, `created`, `updated`) VALUES
(1, 1, 4, '2020-09-10 12:23:50', '2020-09-10 12:23:50'),
(2, 1, 5, '2020-09-10 12:23:50', '2020-09-10 12:23:50'),
(3, 3, 4, '2020-09-10 15:16:05', '2020-09-10 15:16:05'),
(4, 0, 4, '2020-09-10 15:16:23', '2020-09-10 15:16:23'),
(5, 4, 4, '2020-09-10 15:18:26', '2020-09-10 15:18:26'),
(6, 5, 4, '2020-09-10 15:22:10', '2020-09-10 15:22:10'),
(7, 0, 4, '2020-09-10 15:23:18', '2020-09-10 15:23:18'),
(8, 6, 4, '2020-09-11 15:25:23', '2020-09-11 15:25:23'),
(9, 7, 6, '2020-09-12 11:31:08', '2020-09-12 11:31:08'),
(10, 8, 7, '2020-09-12 11:40:10', '2020-09-12 11:40:10'),
(11, 9, 7, '2020-09-12 11:48:25', '2020-09-12 11:48:25'),
(12, 11, 6, '2020-09-13 07:44:06', '2020-09-13 07:44:06'),
(13, 0, 6, '2020-09-13 08:00:53', '2020-09-13 08:00:53'),
(14, 12, 7, '2020-09-13 08:28:06', '2020-09-13 08:28:06'),
(15, 0, 6, '2020-09-13 10:09:45', '2020-09-13 10:09:45'),
(16, 0, 7, '2020-09-13 10:09:45', '2020-09-13 10:09:45'),
(17, 13, 7, '2020-09-13 10:15:33', '2020-09-13 10:15:33'),
(18, 0, 6, '2020-09-13 11:57:02', '2020-09-13 11:57:02'),
(19, 0, 7, '2020-09-13 11:57:02', '2020-09-13 11:57:02'),
(20, 2, 6, '2020-09-13 12:05:32', '2020-09-13 12:05:32'),
(21, 9, 6, '2020-09-13 12:05:36', '2020-09-13 12:05:36'),
(22, 7, 7, '2020-09-13 12:35:44', '2020-09-13 12:35:44'),
(23, 2, 7, '2020-09-13 12:36:47', '2020-09-13 12:36:47'),
(24, 4, 6, '2020-09-13 12:37:11', '2020-09-13 12:37:11'),
(25, 6, 7, '2020-09-13 12:37:15', '2020-09-13 12:37:15'),
(26, 11, 7, '2020-09-14 07:59:50', '2020-09-14 07:59:50'),
(27, 14, 6, '2020-09-14 08:38:05', '2020-09-14 08:38:05'),
(28, 4, 7, '2020-09-14 12:35:10', '2020-09-14 12:35:10'),
(29, 15, 8, '2020-09-14 12:44:08', '2020-09-14 12:44:08'),
(30, 6, 8, '2020-09-14 13:00:01', '2020-09-14 13:00:01'),
(31, 6, 9, '2020-09-14 13:00:12', '2020-09-14 13:00:12'),
(32, 16, 9, '2020-09-14 13:17:45', '2020-09-14 13:17:45'),
(33, 17, 9, '2020-09-14 13:19:21', '2020-09-14 13:19:21'),
(34, 17, 8, '2020-09-14 15:21:21', '2020-09-14 15:21:21'),
(35, 18, 7, '2020-09-14 15:25:27', '2020-09-14 15:25:27'),
(36, 17, 6, '2020-09-14 16:06:07', '2020-09-14 16:06:07'),
(37, 19, 6, '2020-09-14 17:40:05', '2020-09-14 17:40:05'),
(38, 19, 7, '2020-09-14 17:40:12', '2020-09-14 17:40:12'),
(39, 20, 6, '2020-09-16 14:56:28', '2020-09-16 14:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created`, `updated`) VALUES
(1, 'sitetitle', 'blog', '2020-09-13 13:55:05', '2020-09-14 04:48:14'),
(2, 'tagline', 'PHP Blog', '2020-09-13 13:55:05', '2020-09-14 04:48:14'),
(3, 'email', 'arnav9611@gmail.com', '2020-09-13 13:56:39', '2020-09-14 04:48:14'),
(4, 'userreg', 'yes', '2020-09-13 13:56:39', '2020-09-14 04:48:14'),
(5, 'resultsperpage', '10', '2020-09-13 13:57:15', '2020-09-14 04:48:14'),
(6, 'comments', 'yes', '2020-09-13 13:57:15', '2020-09-14 04:48:15'),
(7, 'cleanurls', 'yes', '2020-09-13 13:57:45', '2020-09-14 04:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `password`, `role`, `created`, `updated`) VALUES
(1, 'Arnav', 'Kumar Nath', 'Arnav Kumar Nath', 'arnav9611@gmail.com', '$2y$10$SQ2LhKN5iEntqkIl7V6q1uVyTBqY740SdioH3zlAFqSuybp/v0ZIm', 'administrator', '2020-09-10 07:24:39', '2020-09-13 16:06:17'),
(5, '', '', 'Jayanta', 'jayanta@gmail.com', '$2y$10$KfQApuCEGqiwUIvGMTL6pOqTIAdqngGsAGACR5drV18Jhy1IiQkzy', 'subscriber', '2020-09-13 15:36:14', '2020-09-13 15:36:14'),
(7, 'Sumki', 'Devi', 'Sumki Devi', 'sumki@gmail.com', '$2y$10$L8xPOvJH1/5YvYX0k83nhuu3HvW5K7V8.ppovt/HfWM6zdO8XBDte', 'editor', '2020-09-14 04:53:35', '2020-09-14 13:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

CREATE TABLE `widget` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `widget_order` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`id`, `title`, `type`, `content`, `widget_order`, `created`, `updated`) VALUES
(7, 'Categories', 'search', 'ok', '1', '2020-09-12 16:38:26', '2020-09-12 16:38:26'),
(8, 'Is Messi the best', 'articles', 'ok', '1', '2020-09-12 16:38:46', '2020-09-12 16:38:46'),
(9, 'Page', 'pages', 'ok', '1', '2020-09-13 07:20:18', '2020-09-13 07:20:18'),
(10, 'JILALA', 'categories', 'JILALA', '1', '2020-09-14 12:41:08', '2020-09-14 12:41:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `widget`
--
ALTER TABLE `widget`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `widget`
--
ALTER TABLE `widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
