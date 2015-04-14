<?php
require_once(__DIR__."/MwTemplate.php");
require_once(__DIR__."/../../backend/Results/ResultsDatabase.php");
require_once(__DIR__."/../../backend/Db/Wikihost.php");
require_once(__DIR__."/../../backend/Db/User.php");
require_once(__DIR__."/../../backend/Db/Wikiname.php");
require_once(__DIR__."/../../backend/Db/Username.php");

class ResultsPage extends MwTemplate {
    protected $target;

    function __construct($rq_userpage, $rq_wikiname, $rq_username) {
        if ($rq_userpage) {
            if ($host = parse_url($rq_userpage, PHP_URL_HOST)) {
                $wikihost = new \edinc\Db\Wikihost($host);
                $wikiname = $wikihost->getWikiname();
                $path = explode("/", parse_url($rq_userpage, PHP_URL_PATH), 3);
                if ($path[1] == "wiki") {
                    $article = explode("/", $path[2]);
                    $top = explode(":", $article[0]);
                    if (isset($article[1]))
                        $url_username = $article[1];
                    elseif ($top[1])
                        $url_username = $top[1];
                    $username =  new \edinc\Db\Username(str_replace("_", " ", $url_username));
                }
            }
        } elseif ($rq_username) {
            $username = new \edinc\Db\Username($rq_username);
            if ($rq_wikiname)
                $wikiname = new \edinc\Db\Wikiname($rq_wikiname);
            else
                $wikiname = new \edinc\Db\Wikiname("enwiki");
        }
        $this->target = new \edinc\Db\User($wikiname, $username);
    }

    function execBodyContent() {
        if ($this->target->wikiname && $this->target->username) {
?>
        <h2><?= (string)$this->target->username ?></h2>
        <div id="resultDiv"></div>
<?php
        } else {
?>
        Invalid request: No <?= (string)$this->target->wikiname ? "site" : "username"; ?> specified.

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
request.open("GET", "api/GetEditorIncidenceStats/?dbname=<?= urlencode((string)$this->target->wikiname) ?>&username=<?= urlencode((string)$this->target->username) ?>", true);
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
        if ($result = $resultsdb->GetResult($this->target)) {
            print PHP_EOL.$result->getJsVar("cachedResult");
?>
generateTable(cachedResult);
<?php
        }
    }
}
?>
