<?php
//@author Éñ¶ÜÍøÂç(43437761@qq.com)
$sql = 'ALTER TABLE `eps_article` DROP `isTop`';
$sql = str_replace('eps_', $this->config->db->prefix, $sql);
$this->dbh->query($sql);

define('DS', DIRECTORY_SEPARATOR);
$moduleName = 'article';
$mergedModelDir  = $this->app->getTmpRoot() . 'model' . DS . $this->app->siteCode{0} . DS . $this->app->siteCode . DS;
$mergedModelFile = $mergedModelDir . $this->app->siteCode . '.' . $moduleName . '.php';
unlink($mergedModelFile);