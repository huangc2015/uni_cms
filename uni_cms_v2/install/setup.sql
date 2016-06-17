#
# TABLE STRUCTURE FOR: uni_dir
#

DROP TABLE IF EXISTS `uni_dir`;

CREATE TABLE `uni_dir` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `sort` int(255) DEFAULT NULL,
  `pid` int(255) DEFAULT NULL,
  `lv` int(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

INSERT INTO `uni_dir` (`id`, `sort`, `pid`, `lv`, `title`, `type`, `status`) VALUES ('1', '1', '0', '1', '关于我们', '2', '0');
INSERT INTO `uni_dir` (`id`, `sort`, `pid`, `lv`, `title`, `type`, `status`) VALUES ('3', '3', '0', '1', '联系我们', '2', '0');
INSERT INTO `uni_dir` (`id`, `sort`, `pid`, `lv`, `title`, `type`, `status`) VALUES ('4', '2', '0', '1', '工坊发布', '1', '0');


#
# TABLE STRUCTURE FOR: uni_page
#

DROP TABLE IF EXISTS `uni_page`;

CREATE TABLE `uni_page` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `dir` int(255) DEFAULT NULL,
  `type` int(2) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `add_time` datetime DEFAULT NULL,
  `edit_time` datetime DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `hits` int(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` text,
  `extend` text,
  `status` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO `uni_page` (`id`, `dir`, `type`, `title`, `author`, `add_time`, `edit_time`, `thumb`, `hits`, `description`, `content`, `extend`, `status`) VALUES ('1', '1', '1', '关于我们', '', '2016-02-04 10:37:39', '2016-02-16 11:25:52', '0', '0', '', '<p>&nbsp;</p>\r\n\r\n<p><strong>什么是&ldquo;优理707代码工坊&rdquo;？</strong><br />\r\n优理707是黄先生创建的个人网站，&ldquo;优理&rdquo;取自&ldquo;优秀理论&rdquo;之意，707则为黄先生的姓名中一汉字的Unicode 代码中抽出的数字组合，并且uni也有暗示Unicode的意思。</p>\r\n\r\n<p><br />\r\n<strong>&ldquo;代码工坊&rdquo;</strong>指的是黄先生的敲代码以及研究代码的地方，本站以发布代码工坊的开发研究成果和实践经验为主的资讯网站。</p>\r\n\r\n<p><br />\r\n<strong>关于707（站长）</strong><br />\r\n站长曾经从事装潢设计、平面设计、网页设计等与艺术设计有关的工作，最高学历是&ldquo;视觉传达设计&rdquo;的本科学历，由于很早就接触了计算机和互联网（大概在1998年左右），所以现在所从事的工作也与互联网和计算机有着非常大的关系。目前站长从事互联网网站建设相关工作，并投入了很大的精力研究计算机代码和开发新应用。</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '', '0');
INSERT INTO `uni_page` (`id`, `dir`, `type`, `title`, `author`, `add_time`, `edit_time`, `thumb`, `hits`, `description`, `content`, `extend`, `status`) VALUES ('2', '3', '1', '联系我们', '', '2016-02-04 11:04:48', '2016-03-17 11:30:19', '0', '0', '', '<p>&nbsp;</p>\r\n\r\n<p>电子邮件（国内）：<a href=\"mailto:595973917@QQ.com\">595973917@QQ.com</a></p>\r\n\r\n<p>E-MAIL（国际）：huangc2014@gmail.com</p>\r\n\r\n<p>QQ：上面电子邮件@符号之前的那串数字</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>提示：站长基本上每天都会上QQ、看邮件(但国际邮箱不常用，大约每月看一次)，所以不用担心联系不到站长。</p>\r\n', '', '0');
INSERT INTO `uni_page` (`id`, `dir`, `type`, `title`, `author`, `add_time`, `edit_time`, `thumb`, `hits`, `description`, `content`, `extend`, `status`) VALUES ('6', '4', '1', '优理CMS-v1.0测试版线上测试运行', '', '2016-02-04 15:52:43', '2016-02-16 12:15:23', '0', '0', '', '<p>优理CMSv1.0测试版线上测试运行。</p>\r\n\r\n<p>您现在看到的本站内容正是由该系统进行管理和控制。</p>\r\n\r\n<p>v1版本仅作为测试版，进行测试，根据其测试结果，将其分析数据导入到v2版本的开发。</p>\r\n\r\n<p>v2版本将采用&ldquo;全组件自加载聚合式&rdquo;框架，使得系统开发和使用便于规划管理。</p>\r\n', '', '0');
INSERT INTO `uni_page` (`id`, `dir`, `type`, `title`, `author`, `add_time`, `edit_time`, `thumb`, `hits`, `description`, `content`, `extend`, `status`) VALUES ('16', '4', '0', '优理CMS-v2.0概念版线上开源免费下载', '', '2016-02-04 20:38:45', '2016-02-04 20:38:45', NULL, '0', '优理CMS-v2.0概念版线上开源免费下载', '<p>经历了1个多月的调整和测试，优理CMS-v2.0概念版终于在原1.0的基础上完成改造与优化。</p>\n\n<p>本次开源的&ldquo;概念版&rdquo;，主要是为了展示这个系统的整个设计理念，如果需要用于商业环境的话，还需更多的开发资源的投入。</p>\n\n<p>本系统基于Codeigniter 3.0 框架设计编写而成，系统后台使用自动加载组件的方式，开发和管理整个系统的功能。</p>\n\n<p>每个组件代表一个功能，显示在后台面板侧栏上，一个功能由1个控制文件（controllers)和1个视图片段(viewparts)组成，模型（models）作为所有控制器的公共资源供控制器调用。</p>\n\n<p>界面的交互方式，采用比较前沿的AJAX交互方式，将操控体验提升至像在本地操作应用的感觉。</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n', NULL, '0');
INSERT INTO `uni_page` (`id`, `dir`, `type`, `title`, `author`, `add_time`, `edit_time`, `thumb`, `hits`, `description`, `content`, `extend`, `status`) VALUES ('12', '0', '0', 'kakakaakk', '', NULL, '2016-03-22 16:27:10', NULL, NULL, 'aaaaaaaaaaaaaaaaaaaaaaa', '                                      \n                                        ', NULL, '0');
INSERT INTO `uni_page` (`id`, `dir`, `type`, `title`, `author`, `add_time`, `edit_time`, `thumb`, `hits`, `description`, `content`, `extend`, `status`) VALUES ('13', '0', '0', 'kakakaakk', '', NULL, '2016-03-22 16:27:10', NULL, NULL, 'aaaaaaaaaaaaaaaaaaaaaaa', '                                      \n                                        ', NULL, '0');
INSERT INTO `uni_page` (`id`, `dir`, `type`, `title`, `author`, `add_time`, `edit_time`, `thumb`, `hits`, `description`, `content`, `extend`, `status`) VALUES ('14', '0', '0', '', '', '2016-03-22 16:40:58', '2016-03-22 16:40:58', NULL, NULL, '', '                                      \n                                        ', NULL, '1');
INSERT INTO `uni_page` (`id`, `dir`, `type`, `title`, `author`, `add_time`, `edit_time`, `thumb`, `hits`, `description`, `content`, `extend`, `status`) VALUES ('15', '0', '0', '', '', '2016-03-22 16:40:58', '2016-03-22 16:40:58', NULL, '0', '', '                                      \n                                        ', NULL, '1');


#
# TABLE STRUCTURE FOR: uni_user
#

DROP TABLE IF EXISTS `uni_user`;

CREATE TABLE `uni_user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `enc_account` varchar(255) DEFAULT NULL,
  `enc_password` varchar(255) DEFAULT NULL,
  `login_time` date DEFAULT NULL,
  `is_login` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `uni_user` (`id`, `name`, `account`, `enc_account`, `enc_password`, `login_time`, `is_login`) VALUES ('4', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', '96e79218965eb72c92a549dd5a330112', '2016-03-31', NULL);
INSERT INTO `uni_user` (`id`, `name`, `account`, `enc_account`, `enc_password`, `login_time`, `is_login`) VALUES ('5', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL);


#
# TABLE STRUCTURE FOR: uni_vlog
#

DROP TABLE IF EXISTS `uni_vlog`;

CREATE TABLE `uni_vlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `time` varchar(64) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `target` varchar(128) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

