<?php
require_once(__DIR__."/MwTemplate.php");
require_once(__DIR__."/../../backend/Results/ResultsDatabase.php");
require_once(__DIR__."/../../backend/Db/Userpage.php");
require_once(__DIR__."/../../backend/Db/Wikiname.php");
require_once(__DIR__."/../../backend/Db/Username.php");
require_once(__DIR__."/../../backend/Db/User.php");

class ResultsPage extends MwTemplate {
    protected $target;

    function __construct($rq_userpage, $rq_wikiname, $rq_username) {
        if ($rq_userpage) {
            $userpage = new \edinc\Db\Userpage($rq_userpage);
            $wikiname = $userpage->getUser()->getWikiname();
            $username = $userpage->getUser()->getUsername();
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
