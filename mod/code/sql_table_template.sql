-- Creation of the SQL table for the entity '{{ENTITY_NAME}}'
-- Code Generated by the Code Generator module of ZnetDK 4 Mobile.
CREATE TABLE `{{TABLE_NAME}}` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Internal identifier',
{{TABLE_COLUMNS}}
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='{{ENTITY_NAME}}' AUTO_INCREMENT=1 ;