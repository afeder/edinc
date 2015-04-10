<?php
require_once(__DIR__."/MwTemplate.php");
require_once(__DIR__."/../../backend/Results/ResultsDatabase.php");
require_once(__DIR__."/../../backend/Editor/Username.php");

class ResultsPage extends MwTemplate {
    protected $target = array();

    function __construct($userpage, $site, $username) {
        if ($userpage) {
            if ($site = parse_url($userpage, PHP_URL_HOST)) {
                $path = explode("/", parse_url($userpage, PHP_URL_PATH), 3);
                if ($path[1] == "wiki") {
                    $article = explode("/", $path[2]);
                    $top = explode(":", $article[0]);
                    switch ($top[0]) {
                        case "User":
                        case "User_talk":
                          $this->target["site"] = $site;
                          $this->target["username"] = $top[1];
                          break;
                        case "Special":
                          if ($top[1] == "Contributions") {
                            $this->target["site"] = $site;
                            $this->target["username"] = $article[1];
                          }
                          break;
                    }
                }
            }
        } elseif ($username) {
            if (!$site)
                $site = "en.wikipedia.org";
            $this->target["site"] = $site;
            $this->target["username"] = $username;
        }
    }

    function execBodyContent() {
        if ($this->target["site"] && $this->target["username"]) {
?>
        <h2><?= $this->target["username"] ?></h2>
        <div id="resultDiv"></div>
<?php
        } else {
?>
        Invalid request: No <?= $this->target["site"] ? "site" : "username"; ?> specified.

<?php
        }
    }

    function execPostScript() {
?>
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
request.open("GET", "api/GetEditorIncidenceStats/?target=<?= urlencode($this->target["username"]) ?>", true);
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
        if ($result = $resultsdb->GetResult(new \edinc\Editor\Username($this->target["username"]))) {
            print PHP_EOL.$result->getJsVar("cachedResult");
?>
generateTable(cachedResult);
<?php
        }
    }
}
?>
