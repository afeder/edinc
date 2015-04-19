#!/usr/bin/php
<?php
require_once(__DIR__."/TestQuery_IncidenceStats.php");

$query->order(array("IncidentArticlesCount DESC",
                    "IncidentEditsCount DESC",
                    "rev_user_text ASC"
                    ));
$query->limit(10);

$result = $query->toArray();
print_r($result);
?>
