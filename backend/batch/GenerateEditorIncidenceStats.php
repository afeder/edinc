#!/usr/bin/php
<?php

require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__."/../Db/Adapter.php");
require_once(__DIR__."/../Db/Wikiname.php");
require_once(__DIR__."/../Db/Username.php");
require_once(__DIR__."/../IncidenceStats.php");

$target = array("dbname"=>new \edinc\Db\Wikiname(urldecode($argv[1])),
                "username"=>new \edinc\Db\Username(urldecode($argv[2])));

$adapter = new \edinc\Db\Adapter($_SERVER["HOME"]."/replica.my.cnf", $target["dbname"]);
$query = new \edinc\IncidenceStats($adapter, $target["username"]);
$query->order(array("IncidentArticlesCount DESC",
                    "IncidentEditsCount DESC",
                    "rev_user_text ASC"
                    ));
$query->limit(10);

$result = $query->toArray();
if (count($result)) {
    $dir = __DIR__."/../../results/".(string)$target["dbname"];
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    
    file_put_contents($dir."/".$target["username"].".json", json_encode($result));
}

?>
