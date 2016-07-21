-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2016 at 01:58 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jury_of_peers`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation_code`
--

CREATE TABLE IF NOT EXISTS `activation_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) DEFAULT NULL,
  `activation_code` varchar(1000) DEFAULT NULL,
  `timestamps` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `activation_code`
--

INSERT INTO `activation_code` (`id`, `user_id`, `activation_code`, `timestamps`) VALUES
(1, 20, 'JVEQW4RMZI', '1467208403'),
(2, 21, 'AGUMCRFH47', '1467208892'),
(3, 22, 'QANYVRX9O4', '1467227075'),
(4, 0, 'ZNNCVWHT8Q', '1467244276'),
(5, 2, 'MGHLGMAWKV', '1467386488'),
(6, 3, 'WAPAOMAE5S', '1467386934'),
(7, 4, 'EBV76EKHVL', '1467386936'),
(8, 5, 'PXSR0BNXIQ', '1467387317'),
(9, 6, 'FMBR4CR408', '1467387345'),
(10, 7, 'UG0VE39P5G', '1467392100'),
(11, 8, 'QVRXY5Q9LF', '1467392848'),
(12, 9, 'BJDZVX7E2R', '1467393042'),
(13, 10, '3WJHILFZZU', '1467393079'),
(14, 11, 'J6JF7NA7EJ', '1467393120'),
(15, 12, '3NEMBDNKMY', '1467394162'),
(16, 13, 'IEUZJZQU2L', '1467394426');

-- --------------------------------------------------------

--
-- Table structure for table `block_setting`
--

CREATE TABLE IF NOT EXISTS `block_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `blocker_id` int(255) NOT NULL,
  `blockee_id` int(255) NOT NULL,
  `timestamps` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `related_app_id` int(255) NOT NULL,
  `related_app_name` varchar(1000) NOT NULL,
  `comment_contents` mediumtext NOT NULL,
  `timestamps` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_one` int(255) NOT NULL,
  `user_two` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courtroom_comments`
--

CREATE TABLE IF NOT EXISTS `courtroom_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `court_id` int(255) NOT NULL,
  `comment_txt` varchar(1000) NOT NULL,
  `comment_img` varchar(1000) NOT NULL,
  `comment_link` varchar(1000) NOT NULL,
  `timestamps` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courtroom_init`
--

CREATE TABLE IF NOT EXISTS `courtroom_init` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `court_title` varchar(1000) NOT NULL,
  `court_cause` mediumtext NOT NULL,
  `post_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `plaintiff_id` int(255) NOT NULL,
  `defedant_id` int(255) NOT NULL,
  `setlment_plnf` text NOT NULL,
  `setlment_dfnt` text NOT NULL,
  `timestamps` varchar(1000) NOT NULL,
  `time_estimated` varchar(1000) NOT NULL,
  `courtroom_access` int(255) NOT NULL DEFAULT '0',
  `is_accepted` int(255) NOT NULL DEFAULT '0',
  `is_finished` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courtroom_invitations`
--

CREATE TABLE IF NOT EXISTS `courtroom_invitations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `court_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `timestmps` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courtroom_in_contolling`
--

CREATE TABLE IF NOT EXISTS `courtroom_in_contolling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `app_type` int(255) NOT NULL,
  `app_id` int(255) NOT NULL,
  `descriptions` varchar(1000) NOT NULL,
  `timestamps` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courtroom_votes`
--

CREATE TABLE IF NOT EXISTS `courtroom_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `court_id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `likes_dislikes` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courtroom_winned`
--

CREATE TABLE IF NOT EXISTS `courtroom_winned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `court_id` int(255) NOT NULL,
  `winned_id` int(255) NOT NULL,
  `timestamps` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `friend_system`
--

CREATE TABLE IF NOT EXISTS `friend_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sender` int(255) NOT NULL,
  `id_receiver` int(255) NOT NULL,
  `is_accepted` int(255) NOT NULL DEFAULT '0',
  `is_seen` int(255) NOT NULL DEFAULT '0',
  `timestamps` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE IF NOT EXISTS `general_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(1000) NOT NULL,
  `about` varchar(1000) NOT NULL,
  `mobile` varchar(1000) NOT NULL,
  `country` varchar(1000) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `job_title` varchar(1000) NOT NULL,
  `at_company` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `album_id` int(255) NOT NULL,
  `img_dscription` mediumtext NOT NULL,
  `app_serial` varchar(2550) NOT NULL,
  `img_size` varchar(10000) NOT NULL,
  `img_blob` blob NOT NULL,
  `img_src` varchar(1000) NOT NULL,
  `img_type` varchar(1000) NOT NULL,
  `created_on` varchar(1000) NOT NULL,
  `access_permission` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jury_of_peers`
--

CREATE TABLE IF NOT EXISTS `jury_of_peers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `court_id` int(255) NOT NULL,
  `pln_or_dfn` int(255) NOT NULL DEFAULT '0',
  `post_id` int(255) NOT NULL,
  `jury_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messagae`
--

CREATE TABLE IF NOT EXISTS `messagae` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` int(255) NOT NULL,
  `user_from` int(255) NOT NULL,
  `user_to` int(255) NOT NULL,
  `message_text` longtext NOT NULL,
  `message_link` varchar(10000) NOT NULL,
  `message_files` varchar(10000) NOT NULL,
  `is_seen` int(255) NOT NULL DEFAULT '0',
  `timestamps` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `music_albums`
--

CREATE TABLE IF NOT EXISTS `music_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `albume_name` varchar(1000) NOT NULL,
  `timestamps` varchar(1000) NOT NULL,
  `access_permission` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `music_posts`
--

CREATE TABLE IF NOT EXISTS `music_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(255) NOT NULL,
  `music_name` varchar(1000) NOT NULL,
  `music_discribtion` mediumtext NOT NULL,
  `music_blob` longblob NOT NULL,
  `music_src` varchar(1000) NOT NULL,
  `app_serial` varchar(1000) NOT NULL,
  `music_add_on` varchar(1000) NOT NULL,
  `singer_name` varchar(1000) NOT NULL,
  `app_unavailable` int(255) NOT NULL DEFAULT '0',
  `access_permisions` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification_system`
--

CREATE TABLE IF NOT EXISTS `notification_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sender` int(255) NOT NULL,
  `id_receiver` int(255) NOT NULL,
  `app_type` int(255) NOT NULL,
  `app_con_id` int(255) NOT NULL,
  `is_seen` int(255) NOT NULL DEFAULT '0',
  `timestamps` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `photo_albums`
--

CREATE TABLE IF NOT EXISTS `photo_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `album_name` varchar(1000) NOT NULL,
  `album_description` mediumtext NOT NULL,
  `app_serial` varchar(1000) NOT NULL,
  `img_cover` varchar(1000) NOT NULL,
  `timestamps` varchar(1000) NOT NULL,
  `access_permission` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_setting`
--

CREATE TABLE IF NOT EXISTS `privacy_setting` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `send_message_to_me` int(255) NOT NULL DEFAULT '0',
  `add_me` int(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profile_picture`
--

CREATE TABLE IF NOT EXISTS `profile_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `photo_name` varchar(1000) NOT NULL,
  `photo_size` varchar(1000) NOT NULL,
  `photo_blob` mediumblob NOT NULL,
  `photo_src` varchar(1000) NOT NULL,
  `photo_height` varchar(1000) NOT NULL,
  `photo_width` varchar(1000) NOT NULL,
  `photo_type` varchar(1000) NOT NULL,
  `position_y` varchar(1000) NOT NULL,
  `position_x` varchar(1000) NOT NULL,
  `timestamps` varchar(1000) NOT NULL,
  `is_current` int(255) NOT NULL DEFAULT '0',
  `app_serial` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reviews_rating`
--

CREATE TABLE IF NOT EXISTS `reviews_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(255) NOT NULL,
  `review_number` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `timestmps` varchar(1000) NOT NULL,
  `app_type` varchar(1000) NOT NULL,
  `app_content_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `security_setting`
--

CREATE TABLE IF NOT EXISTS `security_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `is_diactivated` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trending_courtrooms`
--

CREATE TABLE IF NOT EXISTS `trending_courtrooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `descriptions` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_apps`
--

CREATE TABLE IF NOT EXISTS `user_apps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(1000) DEFAULT NULL,
  `s_name` varchar(1000) DEFAULT NULL,
  `u_name` varchar(1000) DEFAULT NULL,
  `e_mail` varchar(1000) DEFAULT NULL,
  `p_assword` varchar(1000) NOT NULL,
  `gender` int(255) NOT NULL DEFAULT '1',
  `birthDay` varchar(2000) NOT NULL,
  `zip_code` varchar(1000) DEFAULT NULL,
  `is_activated` int(255) NOT NULL DEFAULT '0',
  `is_deleted` int(255) NOT NULL DEFAULT '0',
  `is_admin` int(255) NOT NULL DEFAULT '0',
  `timestamps` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user_apps`
--

INSERT INTO `user_apps` (`id`, `f_name`, `s_name`, `u_name`, `e_mail`, `p_assword`, `gender`, `birthDay`, `zip_code`, `is_activated`, `is_deleted`, `is_admin`, `timestamps`) VALUES
(3, 'Hussain', 'Said', 'Mony8888', 'Mony@mail.com', '148597c9d482b55ae4fa28d16e990fb3', 1, '', '1235', 1, 0, 0, '1467386934'),
(6, 'Montasser', 'Mossallem', 'Montasser_mgt', 'SSS@sdsd.cdf', 'd53aeb78abc83a52ab8982f5c82a3d5b', 0, '20/2/19', NULL, 0, 0, 0, '1467387345'),
(7, 'Montasserd', 'Mossallemd', 'Mony@mail.com', 'SSS@sdsd.cdfs', '8277e0910d750195b448797616e091ad', 0, '20/2/19d', NULL, 0, 0, 0, '1467392100'),
(8, 'Montasserd', 'Mossallemd', 'Monydmail.com', 'SSS@sddsd.cdfs', 'd926d7bb9ccf46fc04a61bd65d87b9b3', 0, '20/2/19d', NULL, 0, 0, 0, '1467392848'),
(9, 'Montasserd', 'Mossallemd', 'Monydmadil.com', 'SSS@sddsd.cddfs', 'd926d7bb9ccf46fc04a61bd65d87b9b3', 0, '20/2/19d', NULL, 0, 0, 0, '1467393042'),
(10, 'Montasserd', 'Mossallemd', 'Monydmadil.comd', 'SSS@sddsd.cddfsd', 'cc2bd8f09bb88b5dd20f9b432631b8ca', 0, '20/2/19d', NULL, 0, 0, 0, '1467393079'),
(11, 'Montasserd', 'Mossallemd', 'Monydmadil.comds', 'SSS@sddsd.cddfsds', 'cc2bd8f09bb88b5dd20f9b432631b8ca', 0, '20/2/19d', NULL, 0, 0, 0, '1467393119'),
(12, 'MON', 'MOSS', 'MONkkk', 'ksdsdsd@msdmsk.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, '4545', NULL, 0, 0, 0, '1467394161'),
(13, 'eerer', 'wew', 'ewewe', 'wwe@DF.COM', '87f8a786fd9e21dac15633801f01f49e', 0, 'wewewe', NULL, 0, 0, 0, '1467394426'),
(14, 'KJ', 'KJ', 'KJ', 'KKJ@ll.SSs', 'e9510081ac30ffa83f10b68cde1cac07', 0, '20/2/2016', NULL, 1, 0, 0, '1467466239');

-- --------------------------------------------------------

--
-- Table structure for table `user_available`
--

CREATE TABLE IF NOT EXISTS `user_available` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `timestamps` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_contents`
--

CREATE TABLE IF NOT EXISTS `user_contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `content_txt` mediumtext NOT NULL,
  `app_serial` mediumtext NOT NULL,
  `created_on` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_like_dislikes`
--

CREATE TABLE IF NOT EXISTS `user_like_dislikes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sender` int(255) NOT NULL,
  `id_receiver` int(255) NOT NULL,
  `related_app_id` int(255) NOT NULL,
  `related_app_name` int(255) NOT NULL,
  `is_liked` int(255) NOT NULL DEFAULT '0',
  `timestamps` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_links`
--

CREATE TABLE IF NOT EXISTS `user_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `url_links` varchar(1000) NOT NULL,
  `content_blob` longblob NOT NULL,
  `app_serial` varchar(1000) NOT NULL,
  `app_unavailable` int(255) NOT NULL DEFAULT '0',
  `created_on` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE IF NOT EXISTS `user_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `ip_address` varchar(1000) NOT NULL,
  `isp` varchar(1000) NOT NULL,
  `country` varchar(1000) NOT NULL,
  `state` varchar(1000) NOT NULL,
  `lat` varchar(1000) NOT NULL,
  `long` varchar(1000) NOT NULL,
  `user_agent` varchar(1000) NOT NULL,
  `operating_system` varchar(1000) NOT NULL,
  `brower` varchar(1000) NOT NULL,
  `type_of_device` varchar(1000) NOT NULL,
  `last_login` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE IF NOT EXISTS `user_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `post_app_id` int(255) NOT NULL,
  `app_serial` varchar(1000) NOT NULL,
  `post_conent_id` int(255) NOT NULL,
  `timestamps` varchar(1000) NOT NULL,
  `access_permission` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `video_film_categories`
--

CREATE TABLE IF NOT EXISTS `video_film_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(1000) NOT NULL,
  `file_type` varchar(1000) NOT NULL,
  `timestamps` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `video_posts`
--

CREATE TABLE IF NOT EXISTS `video_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `video_name` varchar(1000) NOT NULL,
  `video_description` mediumtext NOT NULL,
  `video_blob` longblob NOT NULL,
  `video_src` varchar(1000) NOT NULL,
  `app_serial` varchar(1000) NOT NULL,
  `app_unavailable` int(255) NOT NULL DEFAULT '0',
  `access_permission` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
