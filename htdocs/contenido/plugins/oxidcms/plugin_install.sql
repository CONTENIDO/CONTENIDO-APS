CREATE TABLE if not exists `pi_user_comments` (`id_user_comment` int(11) NOT NULL AUTO_INCREMENT, `idart` int(11) NOT NULL DEFAULT '0', `idcat` int(11) NOT NULL DEFAULT '0', `idlang` int(5) NOT NULL DEFAULT '0', `userid` int(6) NOT NULL DEFAULT '0', `email` varchar(100) NOT NULL DEFAULT '', `realname` varchar(50) NOT NULL DEFAULT '', `comment` mediumtext NOT NULL, `editedat` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',`editedby` varchar(50) NOT NULL DEFAULT '',`timestamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',`ipaddress` varchar(32) NOT NULL DEFAULT '',PRIMARY KEY (`id_user_comment`)) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;