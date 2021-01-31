# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.28)
# Database: learnEnglish
# Generation Time: 2021-01-30 12:16:45 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table answer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `answer`;

CREATE TABLE `answer` (
  `eid` int(4) NOT NULL,
  `pid` int(4) NOT NULL,
  `sid` int(11) NOT NULL,
  `answer` varchar(2) DEFAULT NULL,
  `score` int(4) DEFAULT '0',
  PRIMARY KEY (`eid`,`pid`,`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `answer` WRITE;
/*!40000 ALTER TABLE `answer` DISABLE KEYS */;

INSERT INTO `answer` (`eid`, `pid`, `sid`, `answer`, `score`)
VALUES
	(101,101,18005,'d',1),
	(101,101,18007,'b',0),
	(101,107,18005,'d',3),
	(101,107,18007,'d',3);

/*!40000 ALTER TABLE `answer` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `judge` BEFORE INSERT ON `answer` FOR EACH ROW begin
	DECLARE s1 VARCHAR(4)character set utf8;
	DECLARE s2 int(4);
	SELECT bestchoice,`value`into @s1,@s2 from problem WHERE pid=new.pid;
	if new.answer=@s1 then
		set new.score=@s2;
	end if;
end */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table answrite
# ------------------------------------------------------------

DROP TABLE IF EXISTS `answrite`;

CREATE TABLE `answrite` (
  `eid` int(4) NOT NULL,
  `sid` int(11) NOT NULL,
  `wid` int(4) NOT NULL,
  `content` text,
  `score` int(4) DEFAULT '0',
  `status` int(4) DEFAULT '0' COMMENT '1为已经批改',
  PRIMARY KEY (`eid`,`sid`,`wid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `answrite` WRITE;
/*!40000 ALTER TABLE `answrite` DISABLE KEYS */;

INSERT INTO `answrite` (`eid`, `sid`, `wid`, `content`, `score`, `status`)
VALUES
	(101,18005,101,'how to promote college student’s creativity as we know,there are signs that college students are lack of creativity in china.this condition is caused by many reasons.frist of all,in chinese tradition”teaching by holding his hand”is the best way to develop skills,which makes students lose the ability of thinking deeply.besides,solving problems with computers makes students very lazy,so much so that they lose the interest of creativity.what’s worse,quantities of students hold the view that creativity is useless. in my opinion,measures must be taken to promote college student’s creativity.there are many things that we can do.on the one hand,the government should issue some polices which are good at creativity.on the other hand,we should learn some useful experience from western style,for example,paying more attention to originality and independence.what’s important is that we college students should set up the ideas that creativity create new world and we have potential to create new world.\r\n　　in conclusion,only if we make concerted efforts we can own the sprirt of creativity.',15,1),
	(101,18007,101,'most people emphasize the important of creativity. what is creativity? creativity is the bringing into being of something that does not exist before, it can be a product, a process or a thought. but china is criticized as one of the countries which lack of creativity. it is because creative thinking are not advocated in our education system. creativity is the most crucial factor for future success. most successful leaders or managers own creativity, they can set their country or company apart from competition. they innovate a new way to develop or solve the crisis. two good examples are bill gate of mircosoft and steve jobs of apple. in order to compete in the future, developing creativity is a must in china.',0,0);

/*!40000 ALTER TABLE `answrite` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table article
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `ano` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `head` varchar(10) DEFAULT NULL,
  `body` text,
  `tid` int(11) DEFAULT NULL,
  PRIMARY KEY (`ano`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;

INSERT INTO `article` (`ano`, `head`, `body`, `tid`)
VALUES
	(101,'英语语法','When I was young, I\'d listen to the radio. Carpenters的声音传唱了《Yesterday once more》的经典。\n\n这就是状语从句。没有名词性从句的复杂，没有定语从句的特殊，只有干脆和纯粹。\n\n你只需要了解种类，记住几个单词和词组的用法，就可以彻底搞定。\n\n所以，鄙人认为，状语从句是三大类从句中最容易的。\n\n无论是什么种类，引导词引导状语从句，外加一个主句，将两个以上动词紧密衔接。\n\n比如When I was young, I\'d listen to the radio.中，when就是这个引导词，从句是when I was young，主句是I\'d listen to the radio。when翻译为“当”，理解了，全句意思就自然出来了。所以状语从句的学习，最重要的就是借助大量练习，熟悉这些引导词。\n\n',18003),
	(102,'小技巧','	分享一下我对巨人结局的预测（只是我个人观点），我觉得主体艾伦灭世不会成功，最后世界上会剩下帕岛和极少部分大陆人！截止漫画135话的信息来看完全佐证了我一年前的预测：1 尤弥尔希望毁灭人类，2  最终艾伦会被阿尔敏所唤醒停止灭世，3 最终艾伦会解放尤弥尔的灵魂使之自由，艾伦会接替尤弥尔灵魂活在通道里结束尤弥尔民巨人的历史。  \n	关于尤弥尔黑化其实从尤弥尔为初代王裆下那一枪之后选择死去就已经印证了尤弥尔其实那时心已经死了，她痛恨人类，希望人类全部消失，这一点从艾尔迪亚人变成巨人之后吃人这个设定开始，谏山创就已经暗示了，也就是说所有艾尔迪亚人变身的无垢巨人都是遵从尤弥尔的意志所以才吃人的！艾伦之所以能得到始祖尤弥尔的力量也是因为艾伦目前和尤弥尔的目的是相同的，但是不同的是艾伦有想保护的人（三笠，阿尔敏等），大家都知道进巨的能力是能看到历代继承者的记忆，所以始祖尤弥尔也是可以看到未来继承者的记忆的，当初尤弥尔生活的时代，她本身是奴隶，是不自由的，她得不到尊重，得不到信任，得不到爱，她想拥有这些，所以才有那致两千年后的你（艾伦），所以她放走了猪，开启了巨人时代！因为她看到了艾伦会给她自由，这也是唯一能让她获得自由的方法！当初尤弥尔之所以没有用巨人之力灭世也是因为她自己无法办到，她必须让尤弥尔民继承自己能变成巨人的能力，也就是现在尤弥尔民会变成巨人的诅咒！其实尤弥尔致两千年后的艾伦就是让他帮助自己获得自由，反之艾伦致两千年前的尤弥尔是他要保护他所爱的人。 \n	最终法尔科会继承艾伦的巨人之力，大家可以去看最终季的ed，尤弥尔亲手开启的通道，最终在艾伦手中被终结，然后去到法尔科的身体里！第二季的ed也揭示了艾伦会灭世！还有就是最终季刚开场法尔科被哥哥救回来，懵的时候说的那句｛我们刚才还拿着剑到处乱飞，嗖的一下把巨人...｝这其实就是进巨的能力，其他智慧巨人继承者是不会在没有继承巨人之力的时候看见前任继承者的记忆的，发生这种情况的只有艾伦，所以法尔科会继承艾伦的巨人之力，但是此时艾伦在通道里不再制造巨人，他的意志能通过通道传达到每一位尤弥尔民那里，这也是艾伦的自由（想去哪就去哪）！',18003);

/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table class
# ------------------------------------------------------------

DROP TABLE IF EXISTS `class`;

CREATE TABLE `class` (
  `cno` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  `tid` int(11) DEFAULT NULL,
  PRIMARY KEY (`cno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `class` WRITE;
/*!40000 ALTER TABLE `class` DISABLE KEYS */;

INSERT INTO `class` (`cno`, `name`, `tid`)
VALUES
	(181,'信安181',18004),
	(182,'计科181',18003),
	(183,'软工181',18003);

/*!40000 ALTER TABLE `class` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table exam
# ------------------------------------------------------------

DROP TABLE IF EXISTS `exam`;

CREATE TABLE `exam` (
  `eid` int(4) NOT NULL AUTO_INCREMENT,
  `tid` int(11) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `stime` datetime DEFAULT NULL,
  `etime` datetime DEFAULT NULL,
  `cno` int(10) DEFAULT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `exam` WRITE;
/*!40000 ALTER TABLE `exam` DISABLE KEYS */;

INSERT INTO `exam` (`eid`, `tid`, `name`, `stime`, `etime`, `cno`)
VALUES
	(101,18003,'期末考试','2021-01-30 00:00:00','2021-01-02 21:00:00',182),
	(103,18003,'课程小测','2021-01-30 00:00:00','2021-01-05 09:00:00',183);

/*!40000 ALTER TABLE `exam` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table listening
# ------------------------------------------------------------

DROP TABLE IF EXISTS `listening`;

CREATE TABLE `listening` (
  `lid` int(4) NOT NULL AUTO_INCREMENT,
  `audiourl` varchar(255) DEFAULT NULL,
  `eid` int(4) DEFAULT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `listening` WRITE;
/*!40000 ALTER TABLE `listening` DISABLE KEYS */;

INSERT INTO `listening` (`lid`, `audiourl`, `eid`)
VALUES
	(103,'/storage/music/20210128/e9026101616df2180c812269e22d9bb5.mp3',103),
	(104,'/storage/music/20210128/cec926462e0ca62cf01e8fcf772c13d9.mp3',101);

/*!40000 ALTER TABLE `listening` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table problem
# ------------------------------------------------------------

DROP TABLE IF EXISTS `problem`;

CREATE TABLE `problem` (
  `pid` int(4) NOT NULL AUTO_INCREMENT,
  `content` text,
  `value` int(4) DEFAULT NULL,
  `a` varchar(255) DEFAULT NULL,
  `b` varchar(255) DEFAULT NULL,
  `c` varchar(255) DEFAULT NULL,
  `d` varchar(255) DEFAULT NULL,
  `bestchoice` varchar(2) DEFAULT NULL,
  `lid` int(4) DEFAULT NULL,
  `rid` int(4) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `problem` WRITE;
/*!40000 ALTER TABLE `problem` DISABLE KEYS */;

INSERT INTO `problem` (`pid`, `content`, `value`, `a`, `b`, `c`, `d`, `bestchoice`, `lid`, `rid`)
VALUES
	(100,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(101,'今天几号？',1,'1.1','1.2','1.3','1.4','d',NULL,102),
	(104,'where is the speakers?',2,'shop','school','home','sport','b',102,NULL),
	(105,'how is the speaker feel?',5,'happy','sad','mild','nofeeling','d',NULL,104),
	(106,'这段对话长多少分钟？',2,'1','2','3','4','b',103,NULL),
	(107,'这段对话出现了几次小明？',3,'1','2','3','4','d',104,NULL);

/*!40000 ALTER TABLE `problem` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reading
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reading`;

CREATE TABLE `reading` (
  `rid` int(4) NOT NULL AUTO_INCREMENT,
  `material` text,
  `eid` int(4) DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `reading` WRITE;
/*!40000 ALTER TABLE `reading` DISABLE KEYS */;

INSERT INTO `reading` (`rid`, `material`, `eid`)
VALUES
	(100,'c测试',NULL),
	(102,'假日',101),
	(104,'There are moments in life when you miss someone so much that you just want to pick them from your dreams and hug them for real! Dream what you want to dream;go where you want to go;be what you want to be,because you have only one life and one chance to do all the things you want to do.\r\n　　May you have enough happiness to make you sweet,enough trials to make you strong,enough sorrow to keep you human,enough hope to make you happy? Always put yourself in others’shoes.If you feel that it hurts you,it probably hurts the other person, too.',103);

/*!40000 ALTER TABLE `reading` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table student
# ------------------------------------------------------------

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `sid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sno` int(10) DEFAULT NULL COMMENT '学号',
  `name` varchar(10) DEFAULT NULL,
  `gender` varchar(4) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `dept` varchar(10) DEFAULT NULL,
  `cno` int(3) DEFAULT NULL COMMENT '班级号',
  PRIMARY KEY (`sid`),
  CONSTRAINT `student_user` FOREIGN KEY (`sid`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;

INSERT INTO `student` (`sid`, `sno`, `name`, `gender`, `birthday`, `dept`, `cno`)
VALUES
	(18005,18171,'张三','男','2000-01-01','CSDN',182),
	(18006,18172,'李四','男','2001-03-03','CS',182),
	(18007,18173,'王舞','女','2002-02-02','CS',182),
	(18009,18165,'钱九','男','2020-12-01','CS',183),
	(18010,18990,'章叁','男','2021-01-07','CS',183),
	(18011,18174,'孙展鹏','男','2021-01-30','CS',181),
	(180018,1001,'测试分页','男','2021-01-30','CS',181),
	(180019,1002,'测试分页','男','2021-01-30','CS',181),
	(180020,1003,'测试分页','男','2021-01-30','CS',181),
	(180021,1004,'测试分页','男','2021-01-30','CS',181),
	(180022,1005,'测试分页','男','2021-01-30','CS',181),
	(180023,1006,'测试分页','男','2021-01-30','CS',181);

/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table teacher
# ------------------------------------------------------------

DROP TABLE IF EXISTS `teacher`;

CREATE TABLE `teacher` (
  `tid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tno` int(10) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `gender` varchar(4) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `dept` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`tid`),
  CONSTRAINT `teacher_user` FOREIGN KEY (`tid`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;

INSERT INTO `teacher` (`tid`, `tno`, `name`, `gender`, `birthday`, `dept`)
VALUES
	(18003,1999001,'胡贵','男','1987-01-01','CS'),
	(18004,1998002,'林晨','女','1988-01-01','MA');

/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(20) NOT NULL DEFAULT '',
  `type` int(2) NOT NULL DEFAULT '2',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`uid`, `password`, `type`)
VALUES
	(18001,'root',0),
	(18002,'root',0),
	(18003,'123456',1),
	(18004,'123456',1),
	(18005,'123456',2),
	(18006,'123456',2),
	(18007,'123456',2),
	(18009,'123456',2),
	(18010,'123456',2),
	(18011,'123456',2),
	(180018,'123456',2),
	(180019,'123456',2),
	(180020,'123456',2),
	(180021,'123456',2),
	(180022,'123456',2),
	(180023,'123456',2);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `user_insert` AFTER INSERT ON `users` FOR EACH ROW begin
	if new.type=2 
	then
		insert into student values(new.uid,NULL,NULL,NULL,NULL,NULL,NULL);
	else 
	insert into teacher values(new.uid,NULL,NULL,NULL,NULL,NULL);
	end if;
end */;;
/*!50003 SET SESSION SQL_MODE="ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `user_delete` BEFORE DELETE ON `users` FOR EACH ROW begin
	if old.type=2 
	then
		delete from student where sid=old.uid;
	else 
		delete from teacher where tid=old.uid;
	end if;
end */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;


# Dump of table writing
# ------------------------------------------------------------

DROP TABLE IF EXISTS `writing`;

CREATE TABLE `writing` (
  `wid` int(4) NOT NULL AUTO_INCREMENT,
  `value` int(4) DEFAULT NULL,
  `subject` text,
  `eid` int(4) DEFAULT NULL,
  PRIMARY KEY (`wid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `writing` WRITE;
/*!40000 ALTER TABLE `writing` DISABLE KEYS */;

INSERT INTO `writing` (`wid`, `value`, `subject`, `eid`)
VALUES
	(101,3,'请写一篇关于创造力的作文',101),
	(103,20,'How to Fit In the Group ',103);

/*!40000 ALTER TABLE `writing` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
