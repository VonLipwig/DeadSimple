<?php

$dbh->prepare("CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;", array())->execute();

$dbh->prepare("CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hash` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;", array())->execute();