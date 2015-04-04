<?php //die() //kill switch ?>
<html>
<body>
<form>
<input type="text" name="target"/>
<input type="submit">
</form>

<h3><?= $_GET["target"] ?></h3>
<?php
require_once("../backend/Db/Adapter.php");
require_once("../backend/IncidenceStats.php");
require_once("../backend/vendor/autoload.php");

$cnfpath = ($_SERVER["DOCUMENT_ROOT"] ? $_SERVER["DOCUMENT_ROOT"]."/.." : $_SERVER["HOME"]);
$adapter = new \edinc\Db\Adapter($cnfpath."/replica.my.cnf", "enwiki");
$t = new \edinc\IncidenceStats($adapter, $_GET["target"]);
$t->order(array("IncidentArticlesCount DESC",
                "IncidentEditsCount DESC",
                "rev_user_text ASC"
                ));
$t->limit(5);
?>
<table>
<tr>
<th>User</th>
<th>Incident articles</th>
<th>Incident edits</th>
<?php
foreach ($t as $r) {
?>
<tr>
<?php
foreach ($r as $c) {
?>
<td><?= $c ?></td>
<?php
}
?>
</tr>
<?php
}
?>
</table>
</body>
</html>
