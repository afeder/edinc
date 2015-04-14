<?php
require_once(__DIR__."/../../Db/User.php");
require_once(__DIR__."/../../IncidenceStatsJob.php");

header("Content-Type: application/json");

$target = new \edinc\Db\User(new \edinc\Db\Wikiname($_GET["dbname"]),
                             new \edinc\Db\Username($_GET["username"]));
$job = new IncidenceStatsJob($target);
if ($job->run(true) == 0)
    readfile($job->getResultPath());

?>
