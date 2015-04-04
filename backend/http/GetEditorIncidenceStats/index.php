<?php

require_once(__DIR__."/../../IncidenceStatsJob.php");

$target = $_GET["target"];
$job = new IncidenceStatsJob($target);
if ($job->run(true) == 0)
    header("Location: ../".$job->getRelativeResultPath());

?>
