#!/usr/bin/php
<?php

require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__."/../Db/Adapter.php");
require_once(__DIR__."/../IncidenceStats.php");

$target = urldecode($argv[1]);

$adapter = new \edinc\Db\Adapter($_SERVER["HOME"]."/replica.my.cnf", "enwiki");
$query = new \edinc\IncidenceStats($adapter, $target);
$query->order(array("IncidentArticlesCount DESC",
                    "IncidentEditsCount DESC",
                    "rev_user_text ASC"
                    ));
$query->limit(10);

$result = json_encode($query->toArray());
file_put_contents(__DIR__."/../../results/".basename($target).".json", $result);

?>
