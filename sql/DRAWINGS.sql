DROP TABLE IF EXISTS `drawings`;
CREATE TABLE IF NOT EXISTS `drawings` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`id_user`  int(11) NOT NULL,
`drawingCommands` text DEFAULT NULL,
`picture` blob DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
