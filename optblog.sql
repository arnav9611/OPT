-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2020 at 09:27 AM
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
(6, 'Arsenal', 'BEST', 'Arsenal', '2020-09-12 10:54:26', '2020-09-22 12:46:28'),
(10, 'Liverpool', 'liverpool', 'Liverpool', '2020-09-14 16:36:55', '2020-10-04 23:21:18'),
(11, 'Manchester United', 'Manchester United', 'Manchester United', '2020-09-22 18:01:16', '2020-09-22 18:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `pid`, `uid`, `parent_id`, `comment`, `status`, `created`, `updated`) VALUES
(1, 2, 1, 0, 'f', 'approved', '2020-09-14 08:17:52', '2020-09-14 08:55:00'),
(2, 2, 1, 0, 'asdiuiu', 'approved', '2020-09-14 08:18:39', '2020-09-14 09:21:44'),
(3, 2, 1, 0, 'asd', 'approved', '2020-09-14 08:18:57', '2020-09-14 08:55:03'),
(4, 2, 1, 0, 'ok', 'approved', '2020-09-14 08:22:51', '2020-09-14 09:21:51'),
(5, 2, 1, 0, 'okkkkkkkkk', 'approved', '2020-09-14 08:24:18', '2020-09-14 09:21:53'),
(6, 2, 1, 0, 'ok', 'approved', '2020-09-14 08:24:52', '2020-09-14 09:21:54'),
(7, 2, 1, 0, 'ok', 'approved', '2020-09-14 08:25:05', '2020-09-14 09:21:55'),
(8, 2, 1, 0, 'thik ase', 'disapproved', '2020-09-14 08:35:27', '2020-09-14 16:41:14'),
(9, 14, 1, 0, 'Thik ase de', 'approved', '2020-09-14 08:38:54', '2020-09-14 10:07:40'),
(10, 14, 1, 0, 'thik ase', 'approved', '2020-09-14 08:48:01', '2020-09-14 10:07:39'),
(11, 2, 1, 0, 'ki be', 'approved', '2020-09-14 10:07:24', '2020-09-14 10:07:38'),
(12, 4, 1, 0, 'ki be', 'approved', '2020-09-14 10:11:12', '2020-09-14 10:11:20'),
(13, 17, 7, 0, 'ki korisa o', 'approved', '2020-09-14 16:00:11', '2020-09-14 16:41:42'),
(14, 6, 1, 0, 'ksdlkf', 'approved', '2020-09-19 21:25:19', '2020-09-19 21:25:19'),
(15, 6, 1, 0, 'lklk', 'approved', '2020-09-19 21:33:06', '2020-09-19 21:33:06'),
(16, 6, 1, 0, ';l;l;l', 'approved', '2020-09-19 21:33:12', '2020-09-19 21:33:12'),
(17, 6, 1, 0, '\';\';\';', 'approved', '2020-09-19 21:33:18', '2020-09-19 21:33:18'),
(18, 20, 1, 0, 'ok', 'approved', '2020-09-20 21:50:39', '2020-09-20 21:50:39'),
(19, 22, 1, 0, 'ok', 'approved', '2020-09-20 22:17:12', '2020-09-20 22:17:12'),
(20, 25, 1, 0, 'asdasdasdsadasdasdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddasdasddddddddddddasd', 'approved', '2020-09-30 16:18:09', '2020-09-30 16:18:09'),
(21, 23, 1, 0, 'fdgdfg', 'approved', '2020-09-30 16:30:27', '2020-09-30 16:30:27'),
(22, 16, 1, 0, 'dfgf', 'approved', '2020-09-30 16:31:08', '2020-09-30 16:31:08'),
(23, 25, 1, 0, 'asdasd', 'approved', '2020-09-30 17:56:35', '2020-09-30 17:56:35'),
(24, 25, 1, 0, 'asdasd asdasd asdasdasd', 'approved', '2020-09-30 17:59:08', '2020-09-30 17:59:08'),
(25, 25, 5, 0, 'sadasd', 'approved', '2020-10-03 10:13:47', '2020-10-03 10:13:47'),
(26, 25, 5, 0, 'HELLO', 'approved', '2020-10-03 16:06:15', '2020-10-03 16:06:15'),
(27, 6, 5, 0, 'asdasd', 'approved', '2020-10-03 16:21:52', '2020-10-03 16:21:52'),
(28, 6, 5, 0, 'asdasd', 'approved', '2020-10-03 16:22:01', '2020-10-03 16:22:01'),
(29, 6, 5, 0, 'aaaaa', 'approved', '2020-10-03 16:22:06', '2020-10-03 16:22:06'),
(30, 25, 1, 0, 'asdasd', 'approved', '2020-10-04 07:32:19', '2020-10-04 07:32:19'),
(31, 17, 1, 0, 'asdasdasd', 'approved', '2020-10-04 21:34:40', '2020-10-04 21:34:40'),
(32, 17, 1, 0, 'KI BE', 'approved', '2020-10-04 21:34:48', '2020-10-04 21:34:48'),
(33, 23, 1, 0, 'asdasd', 'approved', '2020-10-04 21:54:47', '2020-10-04 21:54:47'),
(34, 25, 1, 0, 'HOBO', 'approved', '2020-10-04 21:55:29', '2020-10-04 21:55:29'),
(35, 25, 1, 0, 'asdasd', 'approved', '2020-10-04 21:57:04', '2020-10-04 21:57:04'),
(36, 21, 1, 0, 'asdasd', 'approved', '2020-10-04 21:57:17', '2020-10-04 21:57:17'),
(37, 22, 1, 0, 'asdasd', 'approved', '2020-10-04 21:59:53', '2020-10-04 21:59:53'),
(38, 21, 1, 0, 'ooo', 'approved', '2020-10-04 22:01:23', '2020-10-04 22:01:23'),
(39, 22, 1, 0, 'ooo', 'approved', '2020-10-04 22:04:33', '2020-10-04 22:04:33'),
(40, 22, 1, 0, 'asdasd', 'approved', '2020-10-04 22:13:59', '2020-10-04 22:13:59'),
(41, 21, 1, 0, 'asdasdasd', 'approved', '2020-10-04 22:19:04', '2020-10-04 22:19:04'),
(42, 17, 1, 0, 'asdasd', 'approved', '2020-10-04 22:20:16', '2020-10-04 22:20:16'),
(43, 22, 1, 0, 'asdasd', 'approved', '2020-10-04 22:21:00', '2020-10-04 22:21:00'),
(44, 17, 1, 0, 'asdas', 'approved', '2020-10-04 22:24:22', '2020-10-04 22:24:22'),
(45, 21, 1, 0, 'op', 'approved', '2020-10-04 22:34:39', '2020-10-04 22:34:39'),
(46, 25, 1, 0, 'POPO', 'approved', '2020-10-05 10:54:20', '2020-10-05 10:54:20'),
(47, 17, 1, 0, 'asdasd', 'approved', '2020-10-05 16:05:22', '2020-10-05 16:05:22'),
(48, 21, 1, 0, 'asdasd', 'approved', '2020-10-05 20:44:53', '2020-10-05 20:44:53'),
(49, 21, 1, 0, 'asdasd', 'approved', '2020-10-05 20:46:27', '2020-10-05 20:46:27'),
(50, 21, 1, 0, 'asdasd', 'approved', '2020-10-05 20:46:39', '2020-10-05 20:46:39');

-- --------------------------------------------------------

--
-- Table structure for table `fanposts`
--

CREATE TABLE `fanposts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `video` varchar(255) NOT NULL,
  `news` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fanposts`
--

INSERT INTO `fanposts` (`id`, `uid`, `title`, `pic`, `content`, `video`, `news`, `created`, `updated`) VALUES
(3, 1, 'is ronaldo greatest and the best footballer of the world?? ', 'media/1601814986bale.jpg', 'Yes he is . Kind of sus that we are facing these kind of problem everyday', 'media/1601814986bale.jpg', 'transfer', '2020-10-01 18:30:00', '2020-10-04 12:37:02'),
(6, 1, 'asdasd', 'media/1601817225cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', 'asdasd', 'media/1601817225cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', 'football', '2020-10-04 13:13:45', '2020-10-04 13:13:45'),
(7, 1, 'NAJANU MOI', 'media/1601817476The Bois.jpg', 'JANU MOI BE', 'media/1601817476The Bois.jpg', 'football', '2020-10-04 13:17:56', '2020-10-04 13:17:56'),
(8, 1, 'AJI DINTU GOROM NHOI', 'media/1601893755cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', 'AJI KHUB GOROM', 'media/1601893755cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', 'esports', '2020-10-05 10:29:15', '2020-10-05 10:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `fcomments`
--

CREATE TABLE `fcomments` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fcomments`
--

INSERT INTO `fcomments` (`id`, `uid`, `pid`, `comment`, `status`, `created`, `updated`) VALUES
(1, 1, 3, 'ok', 'approved', '2020-10-04 08:19:44', '2020-10-04 08:19:44'),
(2, 1, 3, 'najanu', 'approved', '2020-10-04 08:20:02', '2020-10-04 08:20:02'),
(3, 1, 3, 'sfddsf', 'approved', '2020-10-04 08:20:10', '2020-10-04 08:20:10'),
(4, 1, 3, 'dfsdf', 'approved', '2020-10-04 08:20:44', '2020-10-04 08:20:44'),
(5, 1, 3, 'sdfsdfsd', 'approved', '2020-10-04 08:20:49', '2020-10-04 08:20:49'),
(6, 1, 3, 'asdasd', 'approved', '2020-10-04 08:21:09', '2020-10-04 08:21:09'),
(7, 1, 3, 'asdasd', 'approved', '2020-10-04 08:21:34', '2020-10-04 08:21:34'),
(8, 1, 3, 'asdas', 'approved', '2020-10-04 08:21:49', '2020-10-04 08:21:49'),
(9, 1, 3, 'asdasd', 'approved', '2020-10-04 08:22:42', '2020-10-04 08:22:42'),
(10, 1, 3, 'asdasd', 'approved', '2020-10-04 08:24:22', '2020-10-04 08:24:22'),
(11, 1, 3, 'VAL NE TUMAR', 'approved', '2020-10-04 08:24:40', '2020-10-04 08:24:40'),
(12, 1, 3, 'asdasd', 'approved', '2020-10-04 08:34:00', '2020-10-04 08:34:00'),
(13, 1, 3, 'asdasd', 'approved', '2020-10-04 09:02:36', '2020-10-04 09:02:36'),
(14, 1, 3, 'asdasd', 'approved', '2020-10-04 12:09:02', '2020-10-04 12:09:02'),
(15, 1, 3, 'aaaaa', 'approved', '2020-10-04 12:09:08', '2020-10-04 12:09:08'),
(16, 1, 3, 'VAL ..AHIBA MON GOISE AHIBO', 'approved', '2020-10-04 12:10:07', '2020-10-04 12:10:07'),
(17, 1, 3, 'asdasd', 'approved', '2020-10-04 12:20:38', '2020-10-04 12:20:38'),
(18, 1, 3, 'asdasd', 'approved', '2020-10-04 12:21:15', '2020-10-04 12:21:15'),
(19, 1, 3, 'JANU', 'approved', '2020-10-04 12:21:22', '2020-10-04 12:21:22'),
(20, 1, 3, 'asdsad', 'approved', '2020-10-04 12:26:16', '2020-10-04 12:26:16'),
(21, 1, 3, 'JANU', 'approved', '2020-10-04 12:26:25', '2020-10-04 12:26:25'),
(22, 1, 3, 'asdasd', 'approved', '2020-10-04 12:28:09', '2020-10-04 12:28:09'),
(23, 1, 3, 'ererer', 'approved', '2020-10-04 12:28:14', '2020-10-04 12:28:14'),
(24, 1, 3, 'asdasd', 'approved', '2020-10-04 12:29:19', '2020-10-04 12:29:19'),
(25, 1, 3, 'asdasd', 'approved', '2020-10-04 12:29:23', '2020-10-04 12:29:23'),
(26, 1, 3, 'qrqrqr', 'approved', '2020-10-04 12:29:29', '2020-10-04 12:29:29'),
(27, 1, 3, 'qweqwe', 'approved', '2020-10-04 12:29:38', '2020-10-04 12:29:38'),
(28, 1, 3, 'rerer', 'approved', '2020-10-04 12:29:43', '2020-10-04 12:29:43'),
(29, 1, 3, 'asdasd', 'approved', '2020-10-04 12:31:43', '2020-10-04 12:31:43'),
(30, 1, 3, 'a', 'approved', '2020-10-04 12:32:57', '2020-10-04 12:32:57'),
(31, 1, 3, 'a', 'approved', '2020-10-04 12:35:32', '2020-10-04 12:35:32'),
(32, 1, 3, 'u8u8u8u', 'approved', '2020-10-04 12:37:20', '2020-10-04 12:37:20'),
(33, 1, 3, 'poopo', 'approved', '2020-10-04 12:48:07', '2020-10-04 12:48:07'),
(34, 1, 3, 'asdas', 'approved', '2020-10-04 13:16:53', '2020-10-04 13:16:53'),
(35, 1, 7, 'HBO DE', 'approved', '2020-10-04 13:18:11', '2020-10-04 13:18:11'),
(36, 1, 7, 'asdasdasdasda', 'approved', '2020-10-05 10:28:29', '2020-10-05 10:28:29'),
(37, 1, 7, 'HYEEEE', 'approved', '2020-10-05 10:28:34', '2020-10-05 10:28:34'),
(38, 1, 9, 'MAA VAL NE', 'approved', '2020-10-05 10:55:44', '2020-10-05 10:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `grandslam`
--

CREATE TABLE `grandslam` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `winner` varchar(255) NOT NULL,
  `runnerup` varchar(255) NOT NULL,
  `money` int(11) NOT NULL,
  `score` varchar(255) NOT NULL,
  `header` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grandslam`
--

INSERT INTO `grandslam` (`id`, `name`, `year`, `winner`, `runnerup`, `money`, `score`, `header`, `created`, `updated`) VALUES
(1, 'US Open', 2020, 'Dominic Thiem', 'Alexander Zverev', 400000, '7-4, 6-4, 6-5', 'atpsingle', '2020-09-25 13:00:38', '2020-09-25 13:00:38'),
(3, 'asdasd', 12341, 'asdas', 'asdasd', 12312, 'asdas', 'atpsingle', '2020-09-25 14:08:56', '2020-09-25 14:08:56');

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
(6, 0, 'JAI SHREE RAM', 1, 1, 1, 1, -5, 1, 3, 34, 'premierleague'),
(7, 3, 'Manchester United', 3, 4, 5, 6, 7, 8, 7, 34, 'premierleague');

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
  `likes` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uid`, `title`, `content`, `status`, `news`, `header`, `slug`, `pic`, `likes`, `created`, `updated`) VALUES
(6, 1, 'is ronaldo greatest and the best footballer of the world??', 'Nikola Jokic and the Denver Nuggets already overcame a 3-1 deficit this postseason, but the Los Angeles Clippers are a much tougher test than the Utah Jazz.\r\n\r\n\r\n\r\nIf you remove Denver\'s 17-of-24 first quarter in Game 2, the Nuggets are shooting just 41.7 percent against this defense. Over the course of the entire series, Nuggets not named Jokic are at 41.5 percent.\r\n\r\nFinding decent looks against the length and switchability of Kawhi Leonard, Paul George, Marcus Morris Sr. and Patrick Beverley has proved difficult. And if Denver isn\'t scoring at its typical level, it\'s in trouble. This isn\'t a roster that can grind out many wins through its defense, especially against a title contender.\r\n\r\nJamal Murray returning to anywhere near the form he displayed against the Jazz would obviously help, but the real key might be Michael Porter Jr.\r\n\r\nAt 6\'10\", he has the size to effectively shoot over those switchy defenders, and he\'s the only rotation player who doesn\'t have a negative plus-minus in this series.\r\n\r\nGetting him more involved would force L.A. to commit more defensive attention, thus loosening things up for the two stars.\r\n\r\n\"We kept going to [Jokic] and [Murray] and they are two amazing players, but I just think to beat them we need to get more players involved,\" Porter said of his team\'s offense fading down the stretch of Game 4. \"We have to move the ball a little bit better. We can\'t be predictable against that team.\"\r\n\r\nThe Murray-Jokic pick-and-roll is one of the most entertaining sets in the league, but more kickouts to a scorer like Porter, who is averaging over 20 points per 36 minutes in the bubble, would reduce that predictability.\r\n\r\nThe Nuggets will do that a bit more in Game 5 and stave off elimination, but the Clippers will bounce back and end the series in six.', 'published', 'esports', 'recent', 'Can he be the best among the rest?', 'media/1600179194cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', 0, '2020-09-10 18:30:00', '2020-10-04 05:46:23'),
(16, 1, 'Can he become the best among the rest?', 'They are the best', 'published', 'esports', 'recent', 'Lets go for the win', 'media/1600267804cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', 0, '2020-09-13 18:30:00', '2020-10-03 09:16:33'),
(17, 7, 'KIBA HOBO', 'KIBA HOBO', 'published', 'tennis', 'recent', 'KIBAHOBO', 'media/1600187183cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', 0, '2020-09-13 18:30:00', '2020-10-05 10:37:16'),
(19, 1, 'Pogba to ManU', 'lklkl', 'published', 'esports', 'recent', 'ok', '', 0, '2020-09-13 18:30:00', '2020-09-24 13:12:15'),
(20, 1, 'CAN YOU BECOME THE BEST??', 'Here we are for the best generation fight', 'published', 'tennis', 'editorchoice', 'Here we are for the best generation fight', 'media/1600554901The Bois.jpg', 0, '2020-09-15 18:30:00', '2020-10-05 11:01:18'),
(21, 1, 'Ronaldo on the verge of BALLON DOR', 'HEHEHEHHE', 'published', 'esports', 'editorchoice', 'HEHEHE', 'media/1600268641cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', 0, '2020-09-15 18:30:00', '2020-09-20 08:21:45'),
(22, 1, 'Welcome Messi !!', 'kllk', 'published', 'esports', 'editorchoice', 'kjk', 'media/1600555213gettyimages-955410340-612x612.jpg', 0, '2020-09-15 18:30:00', '2020-09-19 22:40:33'),
(23, 1, 'Gareth Bale: Tottenham secure return of Real Madrid superstar on season-long loan', 'Yes', 'published', 'tennis', 'toppost', 'Is it too late ', 'media/1600613841bale.jpg', 0, '2020-09-19 18:30:00', '2020-09-24 20:30:59'),
(24, 7, 'KI HE RONALDO AJI KHUB VAL LAGISE JANA KARON AJI MOI ?????', 'Ebosorot', 'published', 'esports', 'toppost', 'l', 'media/1600797735cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', 0, '2020-09-21 18:30:00', '2020-10-04 05:30:48'),
(25, 1, 'kjkdfksjdfk', 'kjkjkj', 'published', 'esports', 'recent', 'kjhkjkk', 'media/1601142575gettyimages-955410340-612x612.jpg', 0, '2020-09-25 18:30:00', '2020-09-26 17:49:35');

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
(39, 20, 6, '2020-09-16 14:56:28', '2020-09-16 14:56:28'),
(40, 19, 10, '2020-09-16 15:03:28', '2020-09-16 15:03:28'),
(41, 21, 10, '2020-09-16 15:04:01', '2020-09-16 15:04:01'),
(42, 22, 6, '2020-09-16 15:15:38', '2020-09-16 15:15:38'),
(43, 22, 10, '2020-09-18 18:00:13', '2020-09-18 18:00:13'),
(44, 21, 6, '2020-09-18 18:00:20', '2020-09-18 18:00:20'),
(45, 22, 7, '2020-09-18 18:00:28', '2020-09-18 18:00:28'),
(46, 23, 6, '2020-09-20 14:57:21', '2020-09-20 14:57:21'),
(47, 16, 6, '2020-09-22 09:24:29', '2020-09-22 09:24:29'),
(48, 24, 11, '2020-09-22 18:02:15', '2020-09-22 18:02:15'),
(49, 1, 11, '2020-09-26 13:26:24', '2020-09-26 13:26:24'),
(50, 2, 10, '2020-09-26 13:37:57', '2020-09-26 13:37:57'),
(51, 3, 11, '2020-09-26 13:48:18', '2020-09-26 13:48:18'),
(52, 25, 11, '2020-09-26 17:49:35', '2020-09-26 17:49:35'),
(53, 16, 11, '2020-10-03 09:16:01', '2020-10-03 09:16:01'),
(54, 6, 6, '2020-10-04 05:46:23', '2020-10-04 05:46:23'),
(55, 17, 10, '2020-10-05 10:37:17', '2020-10-05 10:37:17'),
(56, 20, 11, '2020-10-05 11:01:18', '2020-10-05 11:01:18');

-- --------------------------------------------------------

--
-- Table structure for table `rating_info`
--

CREATE TABLE `rating_info` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `rating_action` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `reaction` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `commentID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `uid` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'sitetitle', 'blog', '2020-09-13 13:55:05', '2020-10-01 07:29:21'),
(2, 'tagline', 'PHP Blog', '2020-09-13 13:55:05', '2020-10-01 07:29:21'),
(3, 'email', 'arnav9611@gmail.com', '2020-09-13 13:56:39', '2020-10-01 07:29:21'),
(4, 'userreg', 'yes', '2020-09-13 13:56:39', '2020-10-01 07:29:21'),
(5, 'resultsperpage', '2', '2020-09-13 13:57:15', '2020-10-01 07:29:21'),
(6, 'comments', 'yes', '2020-09-13 13:57:15', '2020-10-01 07:29:21'),
(7, 'cleanurls', 'yes', '2020-09-13 13:57:45', '2020-10-01 07:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `tennisevent`
--

CREATE TABLE `tennisevent` (
  `id` int(11) NOT NULL,
  `tournament` varchar(255) NOT NULL,
  `stage` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `start` varchar(255) NOT NULL,
  `end` varchar(255) NOT NULL,
  `money` int(11) NOT NULL,
  `surface` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `champion` varchar(255) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tennisevent`
--

INSERT INTO `tennisevent` (`id`, `tournament`, `stage`, `place`, `month`, `start`, `end`, `money`, `surface`, `pic`, `created`, `champion`, `updated`) VALUES
(2, 'US Open', 'DBL:16 \r\nSGL:32\r\n', 'New York, America', 'feb', '21 st July.2021', '3rd August,2021', 1230767, 'Hard', 'media/1601118329nadal.jpeg', '2020-09-25 21:18:25', 'Rafael Nadal', '2020-09-26 11:05:29'),
(3, '123123', 'eqweqweqwe', 'werwer', 'feb', 'werwe', 'werewr', 12312, 'werewr', 'media/1601115140cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', '2020-09-26 10:12:20', 'werwer', '2020-09-26 10:12:20'),
(4, 'sdfsf', 'dfsf', 'qweqwe', 'feb', 'qweqwe', 'qweqwe', 123123, 'rwerwe', 'media/1601116926cristiano-ronaldo-juventus-2018-19_9pv24viluywd1dqgbynte2tlo.jpeg', '2020-09-26 10:42:06', 'werwer', '2020-09-26 10:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `tennisrank`
--

CREATE TABLE `tennisrank` (
  `id` int(11) NOT NULL,
  `pos` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `header` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tennisrank`
--

INSERT INTO `tennisrank` (`id`, `pos`, `country`, `name`, `points`, `created`, `updated`, `header`) VALUES
(1, 2, 'Spain', 'Rafael Nadal', 9850, '2020-09-24 16:36:00', '2020-09-24 16:36:00', 'atpsingle'),
(3, 1, 'Serbia', 'Novak Djokovic', 11260, '2020-09-24 16:48:03', '2020-09-24 16:48:03', 'atpsingle'),
(4, 1, 'Australia', 'Ashleigh Barty', 8717, '2020-09-24 18:05:20', '2020-09-24 18:05:20', 'wtasingle'),
(5, 3, 'Austria', 'Dominic Thiem', 9125, '2020-09-25 08:25:49', '2020-09-25 08:25:49', 'atpsingle');

-- --------------------------------------------------------

--
-- Table structure for table `tennisresults`
--

CREATE TABLE `tennisresults` (
  `id` int(11) NOT NULL,
  `tournament` varchar(255) NOT NULL,
  `stage` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `player1` varchar(255) NOT NULL,
  `player2` varchar(255) NOT NULL,
  `set1a` int(11) NOT NULL,
  `set1b` int(11) NOT NULL,
  `set2a` int(11) NOT NULL,
  `set2b` int(11) NOT NULL,
  `set3a` int(11) NOT NULL,
  `set3b` int(11) NOT NULL,
  `set4a` int(11) NOT NULL,
  `set4b` int(11) NOT NULL,
  `set5a` int(11) NOT NULL,
  `set5b` int(11) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `updated` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `videoposts`
--

CREATE TABLE `videoposts` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `news` varchar(255) NOT NULL,
  `header` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videoposts`
--

INSERT INTO `videoposts` (`id`, `uid`, `title`, `content`, `status`, `news`, `header`, `slug`, `video`, `created`, `updated`) VALUES
(3, '1', 'jkjj', 'kllklk', 'published', 'esports', 'toppost', 'kjkjk', 'media/1601132309004 Boolean Variables and Operators-Python A-Z Tutorial.mp4', '2020-09-26 13:48:18', '2020-09-26 14:58:29');

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
-- Indexes for table `fanposts`
--
ALTER TABLE `fanposts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fcomments`
--
ALTER TABLE `fcomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grandslam`
--
ALTER TABLE `grandslam`
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
-- Indexes for table `rating_info`
--
ALTER TABLE `rating_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tennisevent`
--
ALTER TABLE `tennisevent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tennisrank`
--
ALTER TABLE `tennisrank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tennisresults`
--
ALTER TABLE `tennisresults`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videoposts`
--
ALTER TABLE `videoposts`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `fanposts`
--
ALTER TABLE `fanposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fcomments`
--
ALTER TABLE `fcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `grandslam`
--
ALTER TABLE `grandslam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tennisevent`
--
ALTER TABLE `tennisevent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tennisrank`
--
ALTER TABLE `tennisrank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tennisresults`
--
ALTER TABLE `tennisresults`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `videoposts`
--
ALTER TABLE `videoposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `widget`
--
ALTER TABLE `widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
