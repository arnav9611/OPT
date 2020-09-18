-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2020 at 04:30 PM
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
(7, 'KI BE', 'KI BE', 'KI BE', '2020-09-12 11:39:48', '2020-09-12 11:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(4, 1, 'Liverpool', 'ok', 'draft', 'Liverppol', '1', '2020-09-13 07:16:17', '2020-09-13 07:16:17');

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
  `slug` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uid`, `title`, `content`, `status`, `slug`, `pic`, `created`, `updated`) VALUES
(2, 1, '7', '8', 'published', '9', '', '2020-09-10 14:52:57', '2020-09-13 12:36:52'),
(4, 1, '123123', '123123', 'draft', '123123', '', '2020-09-10 15:18:26', '2020-09-13 12:37:11'),
(6, 1, 'is ronaldo greatest and the best footballer of the world??', 'Nikola Jokic and the Denver Nuggets already overcame a 3-1 deficit this postseason, but the Los Angeles Clippers are a much tougher test than the Utah Jazz.\r\n\r\n\r\n\r\nIf you remove Denver\'s 17-of-24 first quarter in Game 2, the Nuggets are shooting just 41.7 percent against this defense. Over the course of the entire series, Nuggets not named Jokic are at 41.5 percent.\r\n\r\nFinding decent looks against the length and switchability of Kawhi Leonard, Paul George, Marcus Morris Sr. and Patrick Beverley has proved difficult. And if Denver isn\'t scoring at its typical level, it\'s in trouble. This isn\'t a roster that can grind out many wins through its defense, especially against a title contender.\r\n\r\nJamal Murray returning to anywhere near the form he displayed against the Jazz would obviously help, but the real key might be Michael Porter Jr.\r\n\r\nAt 6\'10\", he has the size to effectively shoot over those switchy defenders, and he\'s the only rotation player who doesn\'t have a negative plus-minus in this series.\r\n\r\nGetting him more involved would force L.A. to commit more defensive attention, thus loosening things up for the two stars.\r\n\r\n\"We kept going to [Jokic] and [Murray] and they are two amazing players, but I just think to beat them we need to get more players involved,\" Porter said of his team\'s offense fading down the stretch of Game 4. \"We have to move the ball a little bit better. We can\'t be predictable against that team.\"\r\n\r\nThe Murray-Jokic pick-and-roll is one of the most entertaining sets in the league, but more kickouts to a scorer like Porter, who is averaging over 20 points per 36 minutes in the bubble, would reduce that predictability.\r\n\r\nThe Nuggets will do that a bit more in Game 5 and stave off elimination, but the Clippers will bounce back and end the series in six.', 'draft', 'is he', '', '2020-09-11 15:25:23', '2020-09-13 12:37:15'),
(7, 1, 'hehehehehhe', 'jejjejejeje\'\'\r\n\r\n\r\nasdasdasd', 'published', 'asdasd', '', '2020-09-12 11:31:08', '2020-09-13 12:35:44'),
(9, 1, 'thik ase', 'thike ase', 'draft', 'thik ase', '', '2020-09-12 11:48:25', '2020-09-13 12:05:36'),
(11, 1, 'CHELSEA', 'CHELSEA', 'draft', 'CHELSEA', 'media/1599983046IMG_20171030_181206.jpeg', '2020-09-13 07:44:06', '2020-09-13 07:44:06'),
(12, 1, 'BUJISU', 'BUJISU', 'draft', 'ok', 'media/1599985718IMG_20170511_075253.jpeg', '2020-09-13 08:28:06', '2020-09-13 08:28:38'),
(13, 1, 'HMM', 'HMM', 'review', 'HMM', '', '2020-09-13 10:15:33', '2020-09-13 10:15:48');

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
(25, 6, 7, '2020-09-13 12:37:15', '2020-09-13 12:37:15');

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
(1, 'sitetitle', 'blog', '2020-09-13 13:55:05', '2020-09-13 13:55:05'),
(2, 'tagline', 'PHP Blog', '2020-09-13 13:55:05', '2020-09-13 13:55:05'),
(3, 'email', 'arnav9611@gmail.com', '2020-09-13 13:56:39', '2020-09-13 13:56:39'),
(4, 'userreg', 'yes', '2020-09-13 13:56:39', '2020-09-13 13:56:39'),
(5, 'resultsperpage', '10', '2020-09-13 13:57:15', '2020-09-13 13:57:15'),
(6, 'comments', 'yes', '2020-09-13 13:57:15', '2020-09-13 13:57:15'),
(7, 'cleanurls', 'yes', '2020-09-13 13:57:45', '2020-09-13 13:57:45');

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
(1, 'Murchana ', 'Devi', 'Arnav Kumar Nath', 'arnav9611@gmail.com', '$2y$10$WsL0GWy5/8M1yzXvTR06f.LDqQ.GUmGJfiSyGEDi335a2IgKVNuz.', 'administrator', '2020-09-10 07:24:39', '2020-09-13 12:18:51'),
(4, '98989898', '0000000', 'hjhjhj', '77@gmail.com', '$2y$10$1orFqtTXfyqiuRAcQcs6AOlTepdkZZj0PBkdxbmNWmB50eQpK5tKq', 'administrator', '2020-09-11 10:27:42', '2020-09-13 11:51:52');

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
(9, 'Page', 'pages', 'ok', '1', '2020-09-13 07:20:18', '2020-09-13 07:20:18');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `widget`
--
ALTER TABLE `widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
