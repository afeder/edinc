<?php
require_once(__DIR__."/../backend/Results/ResultsDatabase.php");
require_once(__DIR__."/../backend/Editor/Username.php");
?>
<html>
  <head>
    <title>edinc</title>
    <link rel="stylesheet" type="text/css" href="stylesheet/main.css">
  </head>
  <body>
    <div id="content" class="mw-body">
      <div id="bodyContent" class="mw-body-content">
        <h2><?= $_GET["target"] ?></h2>
        <div id="resultDiv"/>
      </div>
    </div>
    <script>
function generateTable(result) {
    var div = document.getElementById("resultDiv");
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
    print PHP_EOL.$result->getJsVar("cachedResult");
?>
generateTable(cachedResult);
<?php
}
?>
    </script>
  </body>
</html>
