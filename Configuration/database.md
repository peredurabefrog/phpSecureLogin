These are MySQL database specific, but they are easily portable to any other database type.

CREATE DATABASE `secureLogin` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `loginTimeStamp` datetime NOT NULL,
  `loginStatus` int(2) NOT NULL COMMENT 'wrong password: -3\nsuccess: 0',
  PRIMARY KEY (`user_id`,`loginTimeStamp`,`loginStatus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` char(128) COLLATE utf8_bin NOT NULL,
  `salt` char(128) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `members` (`id`, `username`, `email`, `password`, `salt`) VALUES
(1, 'test_user', 'test@example.com', '445fc3655cede6a6c841d08f0776fac92a0118d1d1597046e09909310b2664538642292515aee4737c39826d70508466f5df36417f09274cb470ca4b6857be7a', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef');
