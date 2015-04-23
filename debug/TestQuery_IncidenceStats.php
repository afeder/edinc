<?php
require_once(__DIR__."/../backend/Db/Adapter.php");
require_once(__DIR__."/../backend/Db/Wikiname.php");
require_once(__DIR__."/../backend/Db/Username.php");
require_once(__DIR__."/../backend/IncidenceStats.php");

$target = array("dbname"=>new \edinc\Db\Wikiname("enwiki"),
                "username"=>new \edinc\Db\Username("Test~enwiki")
                );

$adapter = new \edinc\Db\Adapter($target["dbname"]);
$query = new \edinc\IncidenceStats($adapter, $target["username"]);
?>
