#!/usr/bin/php
<?php
require_once(__DIR__."/TestQuery_IncidenceStats.php");
$sql = new \Zend\Db\Sql\Sql($adapter);
die($sql->getSqlStringForSqlObject($query)."\n");
?>
