CREATE TABLE IF NOT EXISTS `servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `port` text NOT NULL,
  `players` text NOT NULL,
  `maxplayers` text NOT NULL,
  `os` text NOT NULL,
  `map` text NOT NULL,
  `game` text NOT NULL,
  `vip` text NOT NULL,
  `rate` text NOT NULL,
  `name` text NOT NULL,
  `comments` text NOT NULL,
  `dobavenot` text NOT NULL,
  `site` text NOT NULL,
  `startvip` text,
  `expirevip` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;