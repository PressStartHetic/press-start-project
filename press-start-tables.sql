-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2018 at 12:24 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `press_start`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `userId` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(44) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(44) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pseudonyme` varchar(44) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(44) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_phone` int(11) DEFAULT NULL,
  `pro_phone` int(11) DEFAULT NULL,
  `city` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` int(11) DEFAULT NULL,
  `adress` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consoles` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `facebook` varchar(44) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` varchar(44) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitch` varchar(44) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(44) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `userId`, `firstname`, `lastname`, `pseudonyme`, `email`, `mobile_phone`, `pro_phone`, `city`, `postcode`, `adress`, `consoles`, `website`, `notes`, `facebook`, `youtube`, `twitch`, `twitter`) VALUES
(1, 35, 'Pika', 'Chu', 'pikachu', 'pika@pika.chu', 123456789, 0, 'Bourg Palette', 11111, '12 maison du fond', '', 'www.pikachu.fr', '', 'pikachu', 'pikachu', '', 'pikachu'),
(2, 36, 'Julie', 'Manhes', 'Julie', 'julie@manhes.fr', 123456789, 0, 'Paris', 75000, '162 avenue de rivoli', '', 'www.jaimlebio.fr', '', 'julie', '', '', 'julie'),
(3, 37, 'Lara', 'Croft', 'Lara', 'lara@croft.fr', 123456789, 123456789, 'Londres', 55555, 'croft manor', '', 'www.lara.croft', '', '', '', 'crystaldynamics', ''),
(4, 38, 'Link', '', 'zelda', 'legendofzelda@hyrule.fr', 123455628, 0, 'Cocorico', 0, '5 rue de la triforce', '', 'www.linkzeldalol.fr', '', '', '', 'nintendo', ''),
(5, 39, 'Ganon', 'Dorf', 'ganondorf', 'mechant@lol.fr', 123456789, 0, 'Cité Gerudo', 1234567, '12 allée du gros nez', '', 'www.geru.do', '', '', '', 'nintendo', ''),
(6, 40, 'Cayde', '6', 'cassis', 'cayde@tour.com', 668718627, 0, 'La Tour', 123456, '22 rue du hangar', '', 'www.destinythegame.fr', '', '', '', 'bungie', 'bungie'),
(7, 41, 'Mario', '', 'Mario', 'super@mario.fr', 668718627, 0, 'Peach Castle', 0, 'Chateau de la princesse Peach', '', 'www.nintendo.fr', '', '', '', 'nintendo', 'nintendo'),
(8, 42, 'Nathan', 'Drake', 'Nate', 'nate@drake.fr', 668718627, 0, 'La Plage', 13486152, 'la jolie plage', '', 'www.naughtydog.fr', '', '', '', 'naughtydog', 'naughtydog'),
(9, 43, 'Elena', 'Fischer', 'elenazebest', 'elena@fisher.fr', 668718627, 668718627, 'World', 0, '', '', 'www.uncharted.com', '', '', '', 'naughtydog', 'naughtydog');

-- --------------------------------------------------------

--
-- Table structure for table `clients_tags`
--

CREATE TABLE `clients_tags` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients_tags`
--

INSERT INTO `clients_tags` (`id`, `client_id`, `tag_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'journaliste'),
(2, 'blog');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  `verified` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `resettable` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `roles_mask` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `registered` int(10) UNSIGNED NOT NULL,
  `last_login` int(10) UNSIGNED DEFAULT NULL,
  `force_logout` mediumint(7) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`) VALUES
(35, 'pika@pika.chu', '$2y$10$QfqHtxpw2cWPy5GOtZnfYe5qFNEVh/vaovrrnHX.hGNtCNKxoi3Je', 'pikachu', 0, 1, 1, 0, 1528971627, NULL, 0),
(3, 'admin@admin.fr', '$2y$10$oSUnklW4ioA/8qeiKR.K4exp/ckfhegSN9zyPyhSrr0S7FM7eXZDW', 'admin', 0, 1, 1, 262145, 1528874700, 1528978031, 1),
(36, 'julie@manhes.fr', '$2y$10$XemagyUS4cEH2mvM1gYy0.bnaHcawUvUh0tr7m.o9wlVLjgKNtZ7y', 'Julie', 0, 1, 1, 0, 1528971731, NULL, 0),
(9, 'pitch@pitch.fr', '$2y$10$.r4G.Ok3AwSlAiuUFNYIh.CX1MRB7cQ5EJ0I/uEvzh/CVvQOG57gm', 'pitch', 0, 1, 1, 1, 1528892269, 1528892505, 0),
(38, 'legendofzelda@hyrule.fr', '$2y$10$NJA78hnSIdqh29cu0KM8V.pb2sg57P8D4jkz0QJ/Tmjno7JwHyO0i', 'zelda', 0, 1, 1, 0, 1528972065, NULL, 0),
(37, 'lara@croft.fr', '$2y$10$O1RvrcLCL5C0vRgfimkwg.SfjR72RUD9RLFnXvrQlw36KJ9cDocC2', 'Lara', 0, 1, 1, 0, 1528971935, NULL, 0),
(39, 'mechant@lol.fr', '$2y$10$R8zIM8lG7c3awHfS2pco7.ukjS8dCsEGq7rVAIru5hh8S4ZStqbrK', 'ganondorf', 0, 1, 1, 0, 1528972202, NULL, 0),
(40, 'cayde@tour.com', '$2y$10$NoI0Ovo73C/I.u0.TMWFp.MKsA0R6v7EOd5YLcLqJYaDD5YAj7bRe', 'cassis', 0, 1, 1, 0, 1528972258, NULL, 0),
(41, 'super@mario.fr', '$2y$10$k9ZriHxRnzP6uxuO4fKBkOwanfP/zOtZ0tumW7GVbHzNNK8DNWNES', 'Mario', 0, 1, 1, 0, 1528972319, NULL, 0),
(42, 'nate@drake.fr', '$2y$10$9EIrOSxh/Bg7lndIOUl5X.28879Typt9HV5bI1FeKhmd4.Tbf25yO', 'Nate', 0, 1, 1, 0, 1528972435, NULL, 0),
(43, 'elena@fisher.fr', '$2y$10$SONANWz5yblgVe7wctQkLOC8Vo9CrP3IhyLP4IgsG6Nv3ZYfrpVsa', 'elenazebest', 0, 1, 1, 0, 1528972504, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_confirmations`
--

CREATE TABLE `users_confirmations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_remembered`
--

CREATE TABLE `users_remembered` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_resets`
--

CREATE TABLE `users_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_resets`
--

INSERT INTO `users_resets` (`id`, `user`, `selector`, `token`, `expires`) VALUES
(16, 29, 'd4OEFemarfT7AfGifMej', '$2y$10$HmD.PL.fEHtPKfVo6zMP0etb0iR4qFBPpVsqhbY1.rPuAteXIc.lq', 1528992719),
(15, 28, 'e8EkBQ3Ei73cgy-ZAR7S', '$2y$10$Mw759SeIT4csxOmGXhNrZOF.z7YG2ocl6sESviHiDoYl9qVvWIitO', 1528992679),
(14, 27, 'tiKlK1MvHIwFDvJlYDmu', '$2y$10$SKfuBx3CHUjTGO59WLdsOu51orW245ua1s4XQL1Gv6vJXsah3HeiW', 1528992601),
(13, 24, '_R3spgnbvnHCkfKYkd6g', '$2y$10$AnPek2GuFuAT4nok4TAcyOphJOwMNN7ld1uEAjlTT4vhEIagRcscG', 1528992126),
(17, 30, 'yeXpVHRUlQg45r_GqCWM', '$2y$10$ZftPpZ5FcALlnoUX3LyJ7.lI06tnzb/MmAYxyTDJ.bwJeyJy0q94C', 1528992776),
(18, 31, '1FUz9sPR8NLCrej38jyT', '$2y$10$fonUZtggdmbwI6m0H3nF8uPOjCGi9P73tKTc02wHx7ELFTHc.KqD6', 1528992818),
(19, 32, 'mRbO-YevLHHXxDKTn2is', '$2y$10$bvmARVnoBw/OdLvcVtvGieFLacnefWQktP7sE6Yv9d6pH0hx7Rocu', 1528992893),
(20, 33, 'QTkn7ZxDKFUc6fKOg1O6', '$2y$10$JXCx3JaHDCKroqzISESCEur8/i8Duo9UUCpPnwOLPLzjwAXU2BJu2', 1528992924),
(21, 34, 'sq-QVV4RqLvM42koSBJk', '$2y$10$tK7s9Zuf8VnuwkDseeu/0O/Mge29C9ayhXEhLbZY/sBHqLUfGz4Si', 1528992947),
(22, 35, '8LCftS5FVPaAF-ksjSEN', '$2y$10$YICMcclWgmSfbIBgrqrUhuv7m715om1eg6r2DOvn5yeBIts6zuP3C', 1528993227),
(23, 36, '6t5ao7J1QWcZZWBBbEAs', '$2y$10$zshT98WNjlql3edI.l6huOWU4Gj7MBj0JixUWJquiyre.62MS/GJe', 1528993331),
(24, 37, 'Al7z4oRXy46o1FCrgtE8', '$2y$10$jSkX2s2sUR2cS1aO4/DfpOY74JAUN58gzVhi4HxISZay3nKB7UXkC', 1528993535),
(25, 38, '29p7ITgjFuD02GoOOLJA', '$2y$10$7Sa9lfP89CzKMXEWO8h3X.stUW0lB21wow99rG1.Wqd/QAX7GTC56', 1528993665),
(26, 39, 'CqATE1y_CFkyAGMS1Qm3', '$2y$10$G5fs7KfZSkHSagv.mgQBZu4eMPOfBkJ6K8KSuBLxM16mhEr2vaLgK', 1528993802),
(27, 40, 'p46VQJ27qEi7IK57NTGh', '$2y$10$8VwkvuV6SNP9j8PzGDmPCubF3PFH1VCegLKsB53IMPQe0ZhnXz0he', 1528993858),
(28, 41, '9FF464G4-S5IH4Lzzokx', '$2y$10$2KnbscS4yc8xADRnQ0Oo5uNkLzQkz3EeRjawicbaJd20YK2TMUBLK', 1528993919),
(29, 42, 'FQMJ3dbiqufg54j81ocA', '$2y$10$Tfg6Ha4qTYVHLRzONZMCyebclUCU7FLAZ8WQUnPhGuJ6dASBV8KkK', 1528994035),
(30, 43, 'QBOpvuJL2CK2EKJx6Fpn', '$2y$10$f9O2jdTsP8lFHn4eBpGAjOtjQ7IG2oWz3tJLw/BzUCN7WR8WhJU6W', 1528994104);

-- --------------------------------------------------------

--
-- Table structure for table `users_throttling`
--

CREATE TABLE `users_throttling` (
  `bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `tokens` float UNSIGNED NOT NULL,
  `replenished_at` int(10) UNSIGNED NOT NULL,
  `expires_at` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_tags`
--
ALTER TABLE `clients_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_confirmations`
--
ALTER TABLE `users_confirmations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `email_expires` (`email`,`expires`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_remembered`
--
ALTER TABLE `users_remembered`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `users_resets`
--
ALTER TABLE `users_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user_expires` (`user`,`expires`);

--
-- Indexes for table `users_throttling`
--
ALTER TABLE `users_throttling`
  ADD PRIMARY KEY (`bucket`),
  ADD KEY `expires_at` (`expires_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `clients_tags`
--
ALTER TABLE `clients_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `users_confirmations`
--
ALTER TABLE `users_confirmations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_remembered`
--
ALTER TABLE `users_remembered`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_resets`
--
ALTER TABLE `users_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients_tags`
--
ALTER TABLE `clients_tags`
  ADD CONSTRAINT `client_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
