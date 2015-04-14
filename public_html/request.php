<?php
require_once("template/ResultsPage.php");

$page = new ResultsPage($_GET["userpage"], $_GET["wikiname"], $_GET["username"]);
$page->execute();
?>
