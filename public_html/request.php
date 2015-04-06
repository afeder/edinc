<?php
require_once(__DIR__."/../backend/Results/ResultsDatabase.php");
require_once(__DIR__."/../backend/Editor/Username.php");
?>
<html>
  <head>
    <title>edinc</title>
    <script>
<?php readfile(__DIR__."/scripts/edinc.js") ?>
    </script>
<?php
$resultsdb = new \edinc\Results\ResultsDatabase();
if ($result = $resultsdb->GetResult(new \edinc\Editor\Username($_GET["target"]))) {
?>
    <script>
<?php
    print $result->getJsVar("cachedResult");
?>
    </script>
<?php
}
?>
  </head>
<?php
if ($result) {
?>
  <body onload="generateTable(cachedResult)">
<?php
} else {
?>
  <body>
<?php
}
?>
    <h3><?= $_GET["target"] ?></h3>
    <div id="resultdiv"/>
  </body>
</html>
