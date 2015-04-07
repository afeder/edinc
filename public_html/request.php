<?php
require_once(__DIR__."/../backend/Results/ResultsDatabase.php");
require_once(__DIR__."/../backend/Editor/Username.php");
?>
<html>
  <head>
    <title>edinc</title>
    <script>
function generateTable(result) {
    var div = document.getElementById("resultdiv");
    div.innerHTML = "";
    var table = document.createElement("TABLE");
    for (var i=0; i < result.length; i++) {
        var row = table.insertRow(-1);
        var cellA = row.insertCell(-1);
        cellA.innerHTML = result[i].rev_user_text;
        var cellB = row.insertCell(-1);
        cellB.innerHTML = result[i].IncidentArticlesCount;
        var cellC = row.insertCell(-1);
        cellC.innerHTML = result[i].IncidentEditsCount;
    }
    div.appendChild(table);
}

var request = new XMLHttpRequest();
request.open("GET", "api/GetEditorIncidenceStats/?target=<?= urlencode($_GET["target"]) ?>", true);
request.onload = function(e) {
    if (request.readyState === 4) {
        if (request.status === 200) {
            generateTable(JSON.parse(request.responseText));
        }
    }
}
request.send(null);

<?php
$resultsdb = new \edinc\Results\ResultsDatabase();
if ($result = $resultsdb->GetResult(new \edinc\Editor\Username($_GET["target"]))) {
    print $result->getJsVar("cachedResult");
}
?>
    </script>
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
