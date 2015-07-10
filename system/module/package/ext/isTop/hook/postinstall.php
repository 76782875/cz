<?php
//@author Éñ¶ÜÍøÂç(43437761@qq.com)
$sql = 'ALTER TABLE `eps_article` ADD `isTop` BOOLEAN NOT NULL DEFAULT false AFTER `id`';
$sql = str_replace('eps_', $this->config->db->prefix, $sql);
$this->dbh->query($sql);