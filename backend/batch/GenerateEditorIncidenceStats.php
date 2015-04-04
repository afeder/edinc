#!/usr/bin/php
<?php

require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__."/../Db/Adapter.php");
require_once(__DIR__."/../IncidenceStats.php");

$adapter = new \edinc\Db\Adapter($_SERVER["HOME"]."/replica.my.cnf", "enwiki");
$query = new \edinc\IncidenceStats($adapter, $argv[1]);
$query->order(array("IncidentArticlesCount DESC",
                    "IncidentEditsCount DESC",
                    "rev_user_text ASC"
                    ));
$query->limit(5);

echo json_encode($query->toArray());

?>
