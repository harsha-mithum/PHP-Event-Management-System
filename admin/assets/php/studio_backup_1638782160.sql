

CREATE TABLE `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `event_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `album_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

INSERT INTO album VALUES("52","New Album","uploads/albums/11-New Album/album_cover.jpg","","11","2021-11-28 00:28:50");
INSERT INTO album VALUES("53","New Album 2","uploads/albums/11-New Album 2/album_cover.jpg","","11","2021-11-28 00:29:15");
INSERT INTO album VALUES("55","New Album 3","uploads/albums/11-New Album 3/album_cover.jpg","","11","2021-11-28 01:12:38");



CREATE TABLE `album_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(255) NOT NULL,
  `img_order` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`album_id`),
  CONSTRAINT `album_images_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO event VALUES("1","new","2021-11-10 08:00:00","2021-11-10 20:00:00");
INSERT INTO event VALUES("2","neww","2021-11-24 02:00:00","2021-11-25 11:30:00");
INSERT INTO event VALUES("3","new","2021-11-11 00:00:00","2021-11-12 00:00:00");
INSERT INTO event VALUES("5","new","2021-11-12 00:00:00","2021-11-13 00:00:00");



CREATE TABLE `event_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO event_cat VALUES("1","Wedding");
INSERT INTO event_cat VALUES("4","Family");
INSERT INTO event_cat VALUES("5","Commercial");



CREATE TABLE `event_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  CONSTRAINT `event_types_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `event_cat` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO event_types VALUES("1","Engagement","1");
INSERT INTO event_types VALUES("3","Pre-Shoot","1");
INSERT INTO event_types VALUES("5","Wedding","1");
INSERT INTO event_types VALUES("6","Pregnancy","4");
INSERT INTO event_types VALUES("7","New Born","4");
INSERT INTO event_types VALUES("9","Birthday","4");



CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_event` datetime NOT NULL,
  `time` time NOT NULL,
  `people` int(11) NOT NULL,
  `cameramen` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `progress` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `unavailable` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`) USING BTREE,
  KEY `package_id` (`package_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `events_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `events_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `event_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `events_ibfk_4` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO events VALUES("7","1","5","4","","2021-11-17","2021-11-19 00:00:00","00:00:00","0","0","11","pas","harsha mithum","agent27037@gmail.com","786258763","20","","0");
INSERT INTO events VALUES("10","1","7","new","new","2021-11-02","2021-11-06 22:30:00","11:11:00","0","1","11","pas","harsha mithum","agent27037@gmail.com","786258763","0","","0");
INSERT INTO events VALUES("11","1","6","6","new","2021-11-26","0000-00-00 00:00:00","00:00:00","0","0","11","pas","harsha mithum","agent27037@gmail.com","786258763","100","","0");
INSERT INTO events VALUES("13","1","8","new","new","2021-11-02","2021-11-06 22:30:00","11:11:00","0","1","11","pas","harsha mithum","agent27037@gmail.com","786258763","80","","0");



CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `feedback` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `replied` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO feedback VALUES("4","11","event","success","2021-11-10 23:20:05","1");
INSERT INTO feedback VALUES("5","11","new subject","new text","2021-12-01 03:58:06","1");
INSERT INTO feedback VALUES("6","11","new subject","new","2021-12-01 03:58:30","0");



CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img_order` int(5) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `album_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`album_id`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4;

INSERT INTO images VALUES("103","16571638236940.jpg","1","2021-11-30 02:49:00","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("104","21671638236940.jpg","2","2021-11-30 02:49:00","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("105","32271638236940.jpg","3","2021-11-30 02:49:00","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("106","16401638236957.jpg","1","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("107","26611638236957.jpg","2","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("108","39861638236957.jpg","3","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("109","48171638236957.jpg","4","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("110","51421638236957.jpg","5","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("111","63941638236957.jpg","6","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("112","71361638236957.jpg","7","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("114","95951638236957.jpg","9","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("115","102181638236957.jpg","10","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("116","111541638236957.jpg","11","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("117","123281638236957.jpg","12","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("118","133041638236957.jpg","13","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("119","145891638236957.jpg","14","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("120","158351638236957.jpg","15","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("121","167261638236957.jpg","16","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("122","179111638236957.jpg","17","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("123","182871638236957.jpg","18","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("124","194431638236957.jpg","19","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("125","208741638236957.jpg","20","2021-11-30 02:49:17","0000-00-00 00:00:00","1","52");
INSERT INTO images VALUES("126","13741638237123.jpg","1","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("127","2381638237123.jpg","2","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("128","38501638237123.jpg","3","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("129","44921638237123.jpg","4","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("130","57271638237123.jpg","5","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("131","62551638237123.jpg","6","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("132","75511638237123.jpg","7","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("133","83471638237123.jpg","8","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("134","96401638237123.jpg","9","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("135","108201638237123.jpg","10","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("136","116821638237123.jpg","11","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("137","125271638237123.jpg","12","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("138","137221638237123.jpg","13","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("139","149181638237123.jpg","14","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("141","169341638237123.jpg","16","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("143","182671638237123.jpg","18","2021-11-30 02:52:03","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("144","13281638399619.jpg","1","2021-12-02 00:00:19","0000-00-00 00:00:00","1","53");
INSERT INTO images VALUES("145","28541638399619.jpg","2","2021-12-02 00:00:19","0000-00-00 00:00:00","1","53");



CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO notes VALUES("19","","","new","2021-12-06 08:12:15","2021-12-06 08:12:15");
INSERT INTO notes VALUES("20","","","new\n\n\n\ Sent by: \nhm,\nemail@example.com,\n","2021-12-06 08:12:57","2021-12-06 08:12:57");
INSERT INTO notes VALUES("21","","","\n\n\n\ Sent by: \nHarsha Mithum,\n,\n","2021-12-06 13:52:02","2021-12-06 13:52:02");
INSERT INTO notes VALUES("22","","","\n\n\n\ Sent by: \nHarsha Mithum,\n,\n","2021-12-06 14:10:37","2021-12-06 14:10:37");
INSERT INTO notes VALUES("23","","","\n\n\n\ Sent by: \nHarsha Mithum,\n,\n","2021-12-06 14:10:53","2021-12-06 14:10:53");
INSERT INTO notes VALUES("24","","","\n\n\n\ Sent by: \nHarsha Mithum,\n,\n","2021-12-06 14:10:57","2021-12-06 14:10:57");
INSERT INTO notes VALUES("25","","","\n\n\n\ Sent by: \nHarsha Mithum,\n,\n","2021-12-06 14:11:01","2021-12-06 14:11:01");



CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO notification VALUES("30","11","admin","Profile Updated.","2021-11-10 23:19:44");
INSERT INTO notification VALUES("31","11","admin","Feedback Written.","2021-11-10 23:20:05");
INSERT INTO notification VALUES("32","11","admin","Note Added.","2021-11-10 23:21:24");
INSERT INTO notification VALUES("34","11","admin","Profile Updated.","2021-11-11 01:54:01");
INSERT INTO notification VALUES("35","11","admin","Profile Updated.","2021-11-11 02:27:13");
INSERT INTO notification VALUES("36","11","admin","Profile Updated.","2021-11-22 13:27:11");
INSERT INTO notification VALUES("37","11","admin","Profile Updated.","2021-11-22 13:54:56");
INSERT INTO notification VALUES("38","11","admin","Profile Updated.","2021-11-22 13:55:52");
INSERT INTO notification VALUES("39","11","admin","Profile Updated.","2021-11-22 13:57:10");
INSERT INTO notification VALUES("40","11","admin","Profile Updated.","2021-11-22 14:00:47");
INSERT INTO notification VALUES("41","11","admin","Profile Updated.","2021-11-22 14:25:05");
INSERT INTO notification VALUES("42","11","admin","Profile Updated.","2021-11-22 14:25:21");
INSERT INTO notification VALUES("43","11","admin","Profile Updated.","2021-11-22 14:25:50");
INSERT INTO notification VALUES("44","11","admin","Profile Updated.","2021-11-22 14:26:38");
INSERT INTO notification VALUES("45","11","admin","Profile Updated.","2021-11-22 14:27:31");
INSERT INTO notification VALUES("46","11","admin","Profile Updated.","2021-11-22 14:27:53");
INSERT INTO notification VALUES("47","11","admin","Profile Updated.","2021-11-22 14:28:01");
INSERT INTO notification VALUES("48","11","admin","Profile Updated.","2021-11-22 14:29:12");
INSERT INTO notification VALUES("49","11","admin","Profile Updated.","2021-11-22 18:22:33");
INSERT INTO notification VALUES("50","11","admin","Profile Updated.","2021-11-22 18:25:11");
INSERT INTO notification VALUES("51","11","admin","Profile Updated.","2021-11-22 18:26:14");
INSERT INTO notification VALUES("52","11","admin","Profile Updated.","2021-11-22 18:31:36");
INSERT INTO notification VALUES("53","11","admin","Profile Updated.","2021-11-22 18:34:53");
INSERT INTO notification VALUES("54","11","admin","Profile Updated.","2021-11-22 18:43:20");
INSERT INTO notification VALUES("55","11","admin","Profile Updated.","2021-11-22 18:46:49");
INSERT INTO notification VALUES("56","11","admin","Profile Updated.","2021-11-22 18:47:03");
INSERT INTO notification VALUES("57","11","admin","Profile Updated.","2021-11-22 18:48:06");
INSERT INTO notification VALUES("58","11","admin","Profile Updated.","2021-11-22 18:48:38");
INSERT INTO notification VALUES("59","11","admin","Profile Updated.","2021-11-22 18:48:55");
INSERT INTO notification VALUES("60","11","admin","Profile Updated.","2021-11-22 18:49:11");
INSERT INTO notification VALUES("61","11","admin","Profile Updated.","2021-11-22 18:49:25");
INSERT INTO notification VALUES("62","11","admin","Profile Updated.","2021-11-22 18:49:39");
INSERT INTO notification VALUES("63","11","admin","Profile Updated.","2021-11-22 18:49:51");
INSERT INTO notification VALUES("64","11","admin","Profile Updated.","2021-11-22 18:50:00");
INSERT INTO notification VALUES("65","11","admin","Profile Updated.","2021-11-22 18:50:29");
INSERT INTO notification VALUES("66","11","admin","Profile Updated.","2021-11-22 18:50:45");
INSERT INTO notification VALUES("67","11","admin","Profile Updated.","2021-11-22 18:50:58");
INSERT INTO notification VALUES("68","11","admin","Profile Updated.","2021-11-22 18:52:42");
INSERT INTO notification VALUES("69","11","admin","Profile Updated.","2021-11-22 18:53:10");
INSERT INTO notification VALUES("70","11","admin","Profile Updated.","2021-11-22 18:53:56");
INSERT INTO notification VALUES("71","11","admin","Profile Updated.","2021-11-22 18:54:23");
INSERT INTO notification VALUES("72","11","admin","Profile Updated.","2021-11-22 18:54:36");
INSERT INTO notification VALUES("73","11","admin","Profile Updated.","2021-11-22 18:54:48");
INSERT INTO notification VALUES("74","11","admin","Profile Updated.","2021-11-22 18:57:03");
INSERT INTO notification VALUES("75","11","admin","Profile Updated.","2021-11-22 18:57:34");
INSERT INTO notification VALUES("76","11","admin","Profile Updated.","2021-11-22 18:57:42");
INSERT INTO notification VALUES("77","11","admin","Profile Updated.","2021-11-22 19:30:39");
INSERT INTO notification VALUES("78","11","admin","Profile Updated.","2021-11-22 19:31:00");
INSERT INTO notification VALUES("79","11","admin","Profile Updated.","2021-11-22 19:31:22");
INSERT INTO notification VALUES("80","11","admin","Profile Updated.","2021-11-22 19:31:50");
INSERT INTO notification VALUES("81","11","admin","Profile Updated.","2021-11-22 19:32:05");
INSERT INTO notification VALUES("82","11","admin","Profile Updated.","2021-11-22 19:32:44");
INSERT INTO notification VALUES("83","11","admin","Profile Updated.","2021-11-22 21:25:03");
INSERT INTO notification VALUES("84","11","admin","Password Changed.","2021-11-22 21:25:42");
INSERT INTO notification VALUES("85","11","admin","Profile Updated.","2021-11-22 21:28:31");
INSERT INTO notification VALUES("86","11","admin","Profile Updated.","2021-11-22 21:28:44");
INSERT INTO notification VALUES("87","11","admin","Profile Updated.","2021-11-22 21:29:23");
INSERT INTO notification VALUES("88","11","admin","Profile Updated.","2021-11-22 21:31:53");
INSERT INTO notification VALUES("89","19","admin","Profile Updated.","2021-11-30 07:46:19");
INSERT INTO notification VALUES("90","19","admin","Profile Updated.","2021-11-30 07:47:05");
INSERT INTO notification VALUES("91","19","admin","Profile Updated.","2021-11-30 07:47:50");
INSERT INTO notification VALUES("92","19","admin","Profile Updated.","2021-11-30 07:51:44");
INSERT INTO notification VALUES("93","19","admin","Profile Updated.","2021-11-30 07:52:23");
INSERT INTO notification VALUES("94","19","admin","Profile Updated.","2021-11-30 07:53:18");
INSERT INTO notification VALUES("95","19","admin","Profile Updated.","2021-11-30 07:54:03");
INSERT INTO notification VALUES("96","19","admin","Profile Updated.","2021-11-30 07:54:26");
INSERT INTO notification VALUES("97","19","admin","Profile Updated.","2021-11-30 07:55:00");
INSERT INTO notification VALUES("98","11","admin","Profile Updated.","2021-12-01 00:38:20");
INSERT INTO notification VALUES("99","11","admin","Feedback Written.","2021-12-01 03:58:06");
INSERT INTO notification VALUES("100","11","admin","Feedback Written.","2021-12-01 03:58:30");
INSERT INTO notification VALUES("101","11","user","Thank you","2021-12-01 03:59:16");
INSERT INTO notification VALUES("102","11","admin","Profile Updated.","2021-12-01 09:53:06");
INSERT INTO notification VALUES("107","1","admin","Password Changed.","2021-12-02 11:54:22");
INSERT INTO notification VALUES("108","1","admin","Password Changed.","2021-12-02 12:00:22");
INSERT INTO notification VALUES("109","1","admin","Password Changed.","2021-12-02 12:00:43");
INSERT INTO notification VALUES("110","1","admin","Password Changed.","2021-12-02 12:01:52");
INSERT INTO notification VALUES("111","11","admin","Profile Updated.","2021-12-03 03:13:36");
INSERT INTO notification VALUES("112","11","admin","Profile Updated.","2021-12-03 03:14:38");
INSERT INTO notification VALUES("113","11","admin","Profile Updated.","2021-12-03 03:14:56");
INSERT INTO notification VALUES("114","11","admin","Profile Updated.","2021-12-03 03:19:46");
INSERT INTO notification VALUES("115","11","admin","Profile Updated.","2021-12-03 03:20:12");
INSERT INTO notification VALUES("116","11","admin","Profile Updated.","2021-12-03 03:24:09");
INSERT INTO notification VALUES("117","11","admin","Profile Updated.","2021-12-03 03:25:17");
INSERT INTO notification VALUES("118","11","admin","Profile Updated.","2021-12-03 03:26:32");
INSERT INTO notification VALUES("119","11","admin","Profile Updated.","2021-12-03 03:26:49");
INSERT INTO notification VALUES("120","11","admin","Profile Updated.","2021-12-03 03:27:36");
INSERT INTO notification VALUES("121","11","admin","Profile Updated.","2021-12-03 03:28:00");
INSERT INTO notification VALUES("122","11","admin","Profile Updated.","2021-12-03 03:29:17");
INSERT INTO notification VALUES("123","11","admin","Profile Updated.","2021-12-03 03:29:35");
INSERT INTO notification VALUES("124","11","admin","Profile Updated.","2021-12-03 03:30:43");
INSERT INTO notification VALUES("125","11","admin","Profile Updated.","2021-12-03 03:37:34");
INSERT INTO notification VALUES("126","11","admin","Profile Updated.","2021-12-03 04:10:07");
INSERT INTO notification VALUES("127","11","admin","Profile Updated.","2021-12-03 04:10:40");
INSERT INTO notification VALUES("128","11","admin","Profile Updated.","2021-12-03 04:10:57");
INSERT INTO notification VALUES("129","11","admin","Profile Updated.","2021-12-03 04:11:05");
INSERT INTO notification VALUES("130","11","admin","Profile Updated.","2021-12-03 04:11:23");
INSERT INTO notification VALUES("131","11","admin","Profile Updated.","2021-12-03 04:11:50");
INSERT INTO notification VALUES("132","11","admin","Profile Updated.","2021-12-03 05:26:19");
INSERT INTO notification VALUES("133","11","admin","Profile Updated.","2021-12-03 05:53:17");
INSERT INTO notification VALUES("134","11","admin","Profile Updated.","2021-12-03 05:53:38");
INSERT INTO notification VALUES("135","11","admin","Profile Updated.","2021-12-03 05:55:37");
INSERT INTO notification VALUES("136","11","admin","Profile Updated.","2021-12-03 05:56:09");
INSERT INTO notification VALUES("137","11","admin","Profile Updated.","2021-12-03 06:10:51");
INSERT INTO notification VALUES("138","11","admin","Profile Updated.","2021-12-03 06:11:00");
INSERT INTO notification VALUES("139","11","admin","Profile Updated.","2021-12-03 06:11:32");
INSERT INTO notification VALUES("140","11","admin","Password Changed.","2021-12-03 06:39:59");
INSERT INTO notification VALUES("141","11","admin","Password Changed.","2021-12-03 06:40:56");
INSERT INTO notification VALUES("142","11","admin","Profile Updated.","2021-12-03 06:48:21");
INSERT INTO notification VALUES("143","11","admin","Profile Updated.","2021-12-03 06:49:55");
INSERT INTO notification VALUES("144","11","admin","Profile Updated.","2021-12-03 06:50:13");
INSERT INTO notification VALUES("145","14","admin","Account Deleted!","2021-12-03 07:23:39");
INSERT INTO notification VALUES("146","14","admin","Account Deleted!","2021-12-03 07:24:56");
INSERT INTO notification VALUES("147","11","admin","Account Deleted!","2021-12-04 02:40:23");
INSERT INTO notification VALUES("148","11","admin","Profile Updated.","2021-12-05 16:46:54");
INSERT INTO notification VALUES("149","11","admin","Profile Updated.","2021-12-05 16:47:35");
INSERT INTO notification VALUES("150","11","admin","Profile Updated.","2021-12-06 08:12:15");
INSERT INTO notification VALUES("151","11","admin","Profile Updated.","2021-12-06 08:12:57");
INSERT INTO notification VALUES("152","11","admin","Profile Updated.","2021-12-06 11:36:31");
INSERT INTO notification VALUES("153","87","admin","Profile Updated.","2021-12-06 13:40:19");
INSERT INTO notification VALUES("154","89","admin","Profile Updated.","2021-12-06 13:44:36");
INSERT INTO notification VALUES("155","88","admin","Profile Updated.","2021-12-06 13:45:34");
INSERT INTO notification VALUES("156","11","admin","Profile Updated.","2021-12-06 13:52:02");
INSERT INTO notification VALUES("157","11","admin","Password Changed.","2021-12-06 13:52:23");
INSERT INTO notification VALUES("162","11","admin","Note Deleted.","2021-12-06 14:13:24");



CREATE TABLE `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type_id` int(11) NOT NULL,
  `unavailable` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `event_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

INSERT INTO packages VALUES("5","Package 01","uploads/packages/1_Package 01.jpg","20000","Outdoor Photo shoot;
Unlimited Photos;
All Edited Photos in a DVD;","1","0");
INSERT INTO packages VALUES("6","Package 02","uploads/packages/1_Package 02.jpg","40000","8 x 16 (32page) Album - 01;
16 x 24 Enlargement - 01;
Outdoor Photo shoot;
Unlimited Photos;
All Edited Photos in a DVD;","1","0");
INSERT INTO packages VALUES("7","Package 03","uploads/packages/1_Package 03.jpg","60000","10 x 24 (32page) Album - 01;
16 x 24 Enlargement - 01;
Outdoor Photo shoot;
Unlimited Photos;
All Edited Photos in a DVD;","1","0");
INSERT INTO packages VALUES("8","Package 01","uploads/packages/9_Package 01.jpg","15000","Outdoor Photo shoot;
Unlimited Photos;
All Edited Photos in a DVD;","9","0");
INSERT INTO packages VALUES("9","Package 02","uploads/packages/9_Package 02.jpg","35000","8 x 16 (32page) Album - 01;
16 x 24 Enlargement - 01;
Outdoor Photo shoot;
Unlimited Photos;
All Edited Photos in a DVD;","9","0");
INSERT INTO packages VALUES("10","Package 03","uploads/packages/9_Package 03.jpg","55000","10 x 24 (32page) Album - 01;
16 x 24 Enlargement - 01;
Outdoor Photo shoot;
Unlimited Photos;
All Edited Photos in a DVD;","9","0");
INSERT INTO packages VALUES("11","Package 01","uploads/packages/5_Package 01.jpg","75000","Pre-Shoot Album 10 x 24 (60pgs);
Wedding Album 10 x 24 (60pgs);
Wedding Enlargement  16 x 24;
Home Coming Enlarge. 16 x 24;
Photo Print (With Frame) - 02;
Thanks Card - 100;
Include Pre-shoot;","5","0");
INSERT INTO packages VALUES("12","Package 02","uploads/packages/5_Package 02.jpg","95000","Pre-Shoot ,
Wedding,
Home Coming Album 10 x 24 (60pgs);
Family or Pre shoot album - 8 x 16 (32pgs);
Wedding Enlargement  16 x 24;
Home Coming Enlargement 16 x 24;
Photo Print (With Frame) - 02;
Photo Print (Without Frame) - 02;
Thanks Card - 150;
2 Day Full Coverage;
Full Day Pre Shoot;","5","0");
INSERT INTO packages VALUES("13","Package 03","uploads/packages/5_Package 03.jpg","120000","Pre shoot,
Wedding Album,
Home Coming
Album 12x28 or 15x20 (60pgs);
10x24 Pre Shoot Album or 
10x24 Family Album (32pgs);
Wedding Enlargement  20x30;
Home Coming Enlargement 16x24;
Photo Print (With Frame) - 02;
Photo Print (Without Frame) - 04;
Thanks Card - 150;
2 Day Full Full Coverage ;
Full Day Pre Shoot;
500+ Edited Photos in a DVD;","5","0");
INSERT INTO packages VALUES("14","Package 04","uploads/packages/5_Package 04.jpg","140000","Pre shoot,
Wedding Album,
Home Coming
Album 12x30 or 16x24  (60pgs);
Pre Shoot Album 12x16 (32pgs);
Family Album 10x24 (32pgs);
Wedding Enlargement  20x30;
Home Coming Enlargement 16x24;
Photo Print (With Frame) - 03;
Photo Print (Without Frame) - 04;
Thanks Card - 200;
2 Day Full Full Coverage ;
Full Day Pre Shoot;
500+ Edited Photos in a DVD;","5","0");
INSERT INTO packages VALUES("15","Package 05","uploads/packages/5_Package 05.jpg","180000","Pre shoot,
Wedding Album,
Home Coming
Album 12x32 or 17x24  (60pgs);
Pre Shoot Album 12x18 (32pgs);
Family Album 12x16 (32pgs);
Wedding Enlargement  24x36;
Home Coming Enlargement 10x30;
Photo Print (With Frame) - 04;
Photo Print (Without Frame) - 04;
Thanks Card - 300;
2 Day Full Full Coverage ;
Full Day Pre Shoot;
700+ Edited Photos in a DVD;","5","0");
INSERT INTO packages VALUES("16","Package 01","uploads/packages/6_Package 01.jpg","15000","Outdoor Photo shoot;
Unlimited Photos;
All Edited Photos in a DVD;","6","0");
INSERT INTO packages VALUES("17","Package 02","uploads/packages/6_Package 02.jpg","35000","8 x 16 (32page) Album - 01;
16 x 24 Enlargement - 01;
Outdoor Photo shoot;
Unlimited Photos;
All Edited Photos in a DVD;","6","0");
INSERT INTO packages VALUES("18","Package 03","uploads/packages/6_Package 03.jpg","55000","10 x 24 (32page) Album - 01;
16 x 24 Enlargement - 01;
Outdoor Photo shoot;
Unlimited Photos;
All Edited Photos in a DVD;","6","0");
INSERT INTO packages VALUES("19","Package 01","uploads/packages/3_Package 01.jpg","15000","Outdoor Photo shoot;
Unlimited Photos;
All Edited Photos in a DVD;","3","0");
INSERT INTO packages VALUES("20","Package 02","uploads/packages/3_Package 02.jpg","25000","8 x 16 (32page) Album - 01;
16 x 24 Enlargement - 01;
Outdoor Photo shoot;
Unlimited Photos;
All Edited Photos in a DVD;","3","0");
INSERT INTO packages VALUES("21","Package 03","uploads/packages/3_Package 03.jpg","40000","10 x 24 (32page) Album - 01;
16 x 24 Enlargement - 01;
Outdoor Photo shoot;
Unlimited Photos;
All Edited Photos in a DVD;","3","0");



CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL AUTO_INCREMENT,
  `post_type_id` int(3) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `post_date` datetime DEFAULT NULL,
  `post_image` text DEFAULT NULL,
  `post_content` text DEFAULT NULL,
  `yt_link` varchar(255) DEFAULT NULL,
  `post_tags` varchar(255) DEFAULT NULL,
  `post_comment_count` int(11) DEFAULT NULL,
  `post_status` varchar(255) DEFAULT 'draft',
  `unavailable` int(11) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `event_id` (`post_type_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_type_id`) REFERENCES `event_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

INSERT INTO posts VALUES("9","1","ddgdgdfbdb","2021-12-01","2021-12-06 12:44:05","uploads/posts/_.jpg","&lt;p&gt;bdbdf&lt;/p&gt;","","dfbfd","","draft","0");
INSERT INTO posts VALUES("10","1","ddgdgdfbdb","2021-12-01","2021-12-06 12:44:50","uploads/posts/_.jpg","&lt;p&gt;bdbdf&lt;/p&gt;","bdbdb","dfbfd","","draft","0");
INSERT INTO posts VALUES("11","1","ddgdgdfbdb","2021-12-01","","uploads/posts/1638680482.jpg","&lt;p&gt;bdbdf&lt;/p&gt;","bdbdb","dfbfd","","draft","0");
INSERT INTO posts VALUES("12","1","ddgdgdfbdb","2021-12-01","","uploads/posts/1638680482.jpg","&lt;p&gt;bdbdf&lt;/p&gt;","https://www.youtube.com/embed/Q4hCGStERlM","dfbfd","","draft","0");
INSERT INTO posts VALUES("13","1","ddgdgdfbdb","2021-12-01","","uploads/posts/1638680487.jpg","&lt;p&gt;bdbdf&lt;/p&gt;","bdbdb","dfbfd","","draft","0");
INSERT INTO posts VALUES("14","5","we","2021-12-15","2021-12-06 01:29:09","uploads/posts/1638680656.jpg","&lt;p&gt;new&lt;/p&gt;","https://www.youtube.com/embed/Q4hCGStERlM","new post","","draft","1");
INSERT INTO posts VALUES("16","1","ddgdgdfbdb","2021-12-01","2021-12-06 12:44:05","uploads/posts/1638774845.jpg","&lt;p&gt;bdbdf&lt;/p&gt;","","dfbfd","","draft","0");
INSERT INTO posts VALUES("17","1","ddgdgdfbdb","2021-12-01","2021-12-05 12:44:50","uploads/posts/1638774890.jpg","&lt;p&gt;bdbdf&lt;/p&gt;","bdbdb","dfbfd","","draft","0");



CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `token_expire` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO users VALUES("1","admin","","","$2y$10$kRZb09lM89uYi1.PBeJb7eWk.I.VpsNC9Q1k50K8hF6iPqpUdc89S","","","","","","","","","","","2021-12-02 12:01:52","2021-11-11 19:32:16","0","0","admin","");
INSERT INTO users VALUES("11","","Harsha Mithum","agent27037@gmail.com","$2y$10$ZE2ym9.oqsbCPnda15s5bOuk8OdibjrN5vgaTmJlmq24Gh.QmRgE.","0712342713","Male","","uploads/profiles/user_11.png","211/4-B, Dungalawaththa","Pasyala","","","","35a68a3396d91","2021-12-06 14:10:37","2021-11-10 23:16:37","1","0","user","");
INSERT INTO users VALUES("14","","mithum","harsha@gmail.com","$2y$10$zC94w0dGLMAxzxajWNS0huBMLxjW2QEqgR9NI6OMxoIfYTIAZwz3a","","female","","","","","","","","8255d56494f13","2021-12-06 09:44:41","2021-11-17 22:05:09","0","1","staff","Senior Photographer");
INSERT INTO users VALUES("15","","mithum","har@gmail.com","$2y$10$gP2zBW.R0P9KKn91OVuZ1erWeLCCe1T8SUf3PXrWLU3KU4rimXASi","","","","","","","","","","292c15df9a856","2021-12-06 13:13:12","2021-11-17 22:06:25","0","1","","");
INSERT INTO users VALUES("16","","mithum","h@gmail.com","$2y$10$4XQhJhMdV/YfvcHO/Fi50.e2H0oTUlNj0o6DZkxcESNAYvw6xJ8SO","","","","","","","","","","06bd92e9e3591","2021-11-19 00:04:07","2021-11-17 22:12:01","0","1","","");
INSERT INTO users VALUES("17","","mithum","hvcb@gmail.com","$2y$10$NAbShMKGa4JUpmnzlOixe.3Cc1avKn2TlfzGtjfRQTSAfHAZ65Y0q","","","","","","","","","","3659fc30c91c5","2021-11-19 00:03:37","2021-11-17 22:12:33","0","1","","");
INSERT INTO users VALUES("18","","mithum","hvcgdb@gmail.com","$2y$10$whGEfeHwMJilQLHFexIE4eTh/cz6cWRV7yoZ9YkndEveU40iZA1SW","","","","","","","","","","091300166a135","2021-11-19 00:03:31","2021-11-17 22:13:28","0","1","","");
INSERT INTO users VALUES("19","","Lakchitha Fernando","hvcgdhddb@gmail.com","$2y$10$5pE9wSZgociJeqpNREhmXezfcy2bkWAVYaZqz.aZBv6GQnGrwHAXa","","","","uploads/239732775_10226679415438586_5996553580824670828_n.jpg","","","","","","18995f5431263","2021-12-06 13:13:16","2021-11-17 22:13:49","0","1","staff","Senior Editor");
INSERT INTO users VALUES("21","","new","admin@admin.com","$2y$10$nlruZYxQwDWzGVEc7rx86eQcUX8AeIcL3ZboteEouOajLg.sBgAjO","","","","","","","","","","a5774b813f619","2021-11-19 00:02:07","2021-11-17 23:29:32","0","1","user","");
INSERT INTO users VALUES("80","","123","1123@1233.com","$2y$10$YnI6cSy4gpl49lctvxm5ZOOerhMDRXwtylxZyK6H3Om5E8U6RfumG","123","","","","","123","","","","66e119ecc7b61","2021-12-06 13:13:07","2021-11-25 04:42:33","0","1","user","");
INSERT INTO users VALUES("81","","Janith Rangika","janithrangika5@gmail.com","$2y$10$rBBPByIWD.3Ppp2aTG9qbe0FvqUSet2.m/xR5Mr91QDiVTNSm3Sxq","","","","","","","","","","d110d6eaac4bd","2021-12-06 13:17:49","2021-12-06 13:07:49","0","0","","");
INSERT INTO users VALUES("82","","Kasun chathuranga","Kasunchathuranga119@gmail.com","$2y$10$R/Foc6izFFf6p3xXNQ.t4utGX/E6p0d747F4vPURIYlsJ9L6mKDAy","","","","","","","","","","adce331d0b363","2021-12-06 13:19:31","2021-12-06 13:09:31","0","0","","");
INSERT INTO users VALUES("83","","Madushan chathuranga","Madushanchathu20@gmail.com","$2y$10$A8IDWlmzj5LRj3yKXqe90O.eT6g3my2uo8AhYPC3y9rMfOkb9NHzK","","","","","","","","","","baab10ed8b5e6","2021-12-06 13:20:00","2021-12-06 13:10:00","0","0","","");
INSERT INTO users VALUES("84","","Thilina Dulanjana","Thuninadulaj@gmail.com","$2y$10$WkoKV4IGwHTs5x71GfYtlO2RZqu99pVsEaEj4gJBOVUEwgOK8KpS.","","","","","","","","","","6a6a9e3d1d7b0","2021-12-06 13:20:32","2021-12-06 13:10:32","0","0","","");
INSERT INTO users VALUES("85","","Didula Ranasingha","Didulabhagya54@gmail.com","$2y$10$P.WqyGpbk3.Z4Tn90zJZDuDvfP.P.eakZ/rbD5VSTJIIUjTNUWP72","","","","","","","","","","aedd1e6b7ccea","2021-12-06 13:21:34","2021-12-06 13:11:34","0","0","","");
INSERT INTO users VALUES("86","","Ishara madushanka","Isharamadu9@gmail.com","$2y$10$1v/IrNdTD4T4tYS9Fa32TudAMbcwL6Bmh2UzCN3Y8WTvJCp6AVU1.","","","","","","","","","","0f73bdad126e2","2021-12-06 13:22:42","2021-12-06 13:12:42","0","0","","");
INSERT INTO users VALUES("87","","Dineth Sandeepa","dinethsandeepa0@gmail.com","$2y$10$2M2mnCvrtc/y.wp/dMn5FOuA6CvoHEw9Y1SZ/8Pjj3E9ZGhtEfJrm","0714794484","","","uploads/profiles/staff_87.png","","23-b,Walpola,Ragama","","","","bfbc2161d07a6","2021-12-06 13:40:19","2021-12-06 13:14:54","0","0","staff","Senior Photographer");
INSERT INTO users VALUES("88","","Malith Gurusinghe","prodevteams@gmail.com","$2y$10$9J1Q5sznPA03GygwUCKpDuSaTbLYCmBel3LYpP4u/Mv1PmsvTF/hu","0786258867","","","uploads/profiles/staff_88.png","","Nittambuwa","","","","150c919a2df68","2021-12-06 13:45:34","2021-12-06 13:19:38","0","0","staff","Senior Photographer");
INSERT INTO users VALUES("89","","Lakchitha Fernando","expa01@yandex.com","$2y$10$M1pnJ2c3K3a20454vj4OxO7hm1o1rXS4YTWlPh5PVtC6Fapzn5iSW","0782957564","","","uploads/profiles/staff_89.png","","Gampaha","","","","16c9dc9214b0a","2021-12-06 13:44:36","2021-12-06 13:24:44","0","0","staff","Senior Videographer");



CREATE TABLE `visitors` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `hits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO visitors VALUES("1","2415");

