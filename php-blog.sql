-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2021 at 06:10 PM
-- Server version: 8.0.26
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php-blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Linux'),
(2, 'CSS'),
(3, 'Javascript');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `comment_user` int NOT NULL,
  `comment_post` int NOT NULL,
  `comment_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `company` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `postcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `name`, `company`, `city`, `postcode`, `start_date`, `end_date`) VALUES
(2, 'Apprenti fleuriste', 'Amaryllis', 'La Garenne-Colombes', '92250', '2007-09-01', '2011-08-31'),
(4, 'Conseiller de vente', 'Botanic', 'Suresnes', '92150', '2011-09-01', '2012-08-31'),
(5, 'Fleuriste', 'Boucicaut', 'Paris', '75015', '2013-03-01', '2013-06-30'),
(6, 'Assistant technique', 'CNAP', 'La défense', '92911', '2014-05-01', '2016-04-30'),
(7, 'Employé polyvalent', 'L\'eau vive', 'Courbevoie', '92400', '2016-05-01', '2018-10-31'),
(8, 'Jardinier', 'Mairie', 'Bois-colombes', '92270', '2019-04-01', '2019-09-30'),
(9, 'Fleuriste', 'Le 107', 'Paris', '75116', '2019-12-01', '2021-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

CREATE TABLE `formation` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `formation`
--

INSERT INTO `formation` (`id`, `name`, `school`, `city`, `postcode`, `start_date`, `end_date`) VALUES
(2, 'CAP, Fleuriste', 'École des fleuristes de Paris', 'Paris', '75019', '2007-09-01', '2009-08-31'),
(3, 'BP, Fleuriste', 'École des fleuristes de Paris', 'Paris', '75019', '2009-09-01', '2011-08-31'),
(4, 'Administrateur système et réseaux CISCO', 'GRETA MTE', 'Lognes', '77185', '2013-09-01', '2013-12-31'),
(5, 'Développeur PHP/Symphony', 'Openclassrooms', '', '', '2021-04-01', '2022-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `dir` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE `interest` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`id`, `name`) VALUES
(2, 'Apprentissage de l\'anglais'),
(3, 'Design graphique');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `excerpt` varchar(255) NOT NULL,
  `content` longtext,
  `creation_date` datetime DEFAULT NULL,
  `post_status` int NOT NULL,
  `post_user` int NOT NULL,
  `post_category` int DEFAULT NULL,
  `post_image` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `name`, `excerpt`, `content`, `creation_date`, `post_status`, `post_user`, `post_category`, `post_image`) VALUES
(3, 'Ciao la vida!', '', '&lt;p&gt;Energistically maintain optimal models with frictionless systems. Rapidiously incubate standards compliant markets for leading-edge initiatives. Efficiently deploy innovative niche markets via backward-compatible alignments. Proactively deploy technically sound processes for 24/365 processes. Monotonectally provide access to efficient users with empowered collaboration and idea-sharing. Dramatically reintermediate resource sucking products for installed base outsourcing. Conveniently reinvent focused users after enterprise-wide manufactured products. Seamlessly redefine granular mindshare vis-a-vis reliable vortals. Distinctively maximize empowered total linkage vis-a-vis timely value. Collaboratively.&lt;/p&gt;', '2021-10-18 11:42:41', 3, 1, 2, NULL),
(15, 'Hello world!', '', '&lt;p style=&quot;text-align: justify;&quot;&gt;Energistically maintain optimal models with frictionless systems. Rapidiously incubate standards compliant markets for leading-edge initiatives. Efficiently deploy innovative niche markets via backward-compatible alignments. Proactively deploy technically sound processes for 24/365 processes. Monotonectally provide access to efficient users with empowered collaboration and idea-sharing. Dramatically reintermediate resource sucking products for installed base outsourcing. Conveniently reinvent focused users after enterprise-wide manufactured products. Seamlessly redefine granular mindshare vis-a-vis reliable vortals. Distinctively maximize empowered total linkage vis-a-vis timely value. Collaboratively.&lt;/p&gt;', '2021-10-18 11:42:41', 3, 1, 1, NULL),
(41, 'Bonjour tout le monde', 'Lorem ipsum', '', '2021-11-27 13:44:44', 3, 1, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `charset` varchar(45) DEFAULT NULL,
  `language` varchar(45) DEFAULT NULL,
  `site_user` int DEFAULT NULL,
  `site_logo` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `name`, `description`, `charset`, `language`, `site_user`, `site_logo`) VALUES
(1, 'Axel Buob | D&eacute;veloppeur PHP/Symphony', 'Un blog d&eacute;velopp&eacute; en PHP de A &agrave; Z', 'utf-8', 'en_EN', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`id`, `name`, `class`) VALUES
(1, 'PHP jfedfjhds', 'fab fa-php'),
(2, 'Javascript', 'fab fa-js'),
(3, 'CSS', 'fab fa-css3'),
(4, 'HTML', 'fab fa-html5'),
(5, 'Sass', 'fab fa-sass'),
(6, 'Bootstrap', 'fab fa-bootstrap'),
(7, 'Git', 'fab fa-git'),
(8, 'Docker', 'fab fa-docker'),
(9, 'Linux', 'fab fa-linux'),
(10, 'Gulp', 'fab fa-gulp'),
(11, 'Wordpress', 'fab fa-wordpress');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'draft'),
(2, 'validate'),
(3, 'publish');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `confirmed_token` varchar(255) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `job` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `linkedin` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `github` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `user_role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `confirmed_token`, `confirmed_at`, `reset_token`, `reset_at`, `job`, `about`, `first_name`, `last_name`, `city`, `twitter`, `linkedin`, `github`, `user_role`) VALUES
(1, 'contact@axelbuob.fr', '$2y$10$G.eEONaKpsTNUSftSTfBf.Xf8SWav2RtWhh1FHHJJ9EhIY2FLG7/S', NULL, '2021-10-21 13:54:41', '44ba410bef7ff22f73efe373f2d93df7', '2021-11-27 14:14:15', 'Développeur PHP/Symphony', 'Fleuriste de 29 ans et développeur web autodidacte en transition professionnelle. Curieux, polyvalent et aillant un trés fort esprit d\'équipe.', 'Axel', 'Buob', 'Paris', 'http://twitter.com/axelbuob', 'http://linkedin.com/in/axelbuob', 'http://github.com/axelbuob', 1),
(31, 'buobaxel@gmail.com', '$2y$10$QRLNqaCxFyarsPTItdBhIOYPCmqdyPI9LxgnE8eTA3Rd.AMjsAAWm', '', '2021-11-27 18:04:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_user_idx` (`comment_user`),
  ADD KEY `comment_post_idx` (`comment_post`),
  ADD KEY `comment_status_idx` (`comment_status`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_status_idx` (`post_status`),
  ADD KEY `post_user_idx` (`post_user`),
  ADD KEY `post_category_idx` (`post_category`),
  ADD KEY `post_image_idx` (`post_image`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_user_idx` (`site_user`),
  ADD KEY `site_logo_idx` (`site_logo`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role_idx` (`user_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `interest`
--
ALTER TABLE `interest`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_post` FOREIGN KEY (`comment_post`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `comment_status` FOREIGN KEY (`comment_status`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`comment_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_category` FOREIGN KEY (`post_category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `post_image` FOREIGN KEY (`post_image`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `post_status` FOREIGN KEY (`post_status`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `post_user` FOREIGN KEY (`post_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_logo` FOREIGN KEY (`site_logo`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `site_user` FOREIGN KEY (`site_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role` FOREIGN KEY (`user_role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
