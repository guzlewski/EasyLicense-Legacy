CREATE TABLE `license` (
  `id` int(11) NOT NULL,
  `lickey` char(64) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `hwid` char(32) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `owner` char(32) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logins` int(11) NOT NULL DEFAULT '0',
  `type` char(32) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `lastip` char(39) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `ip` char(39) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `success` tinyint(1) NOT NULL DEFAULT '0',
  `lickey` char(64) NOT NULL,
  `hwid` char(32) NOT NULL,
  `type` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `license`
--
ALTER TABLE `license`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `license`
--
ALTER TABLE `license`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
