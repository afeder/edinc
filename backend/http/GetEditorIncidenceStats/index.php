<?php
require_once(__DIR__."/../../IncidenceStatsJob.php");

header("Content-Type: application/json");

$target = $_GET["target"];
$job = new IncidenceStatsJob($target);
if ($job->run(true) == 0)
    readfile($job->getResultPath());

?>
