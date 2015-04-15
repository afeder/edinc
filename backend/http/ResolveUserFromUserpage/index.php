<?php
require_once(__DIR__."/../../Db/Userpage.php");

header("Content-Type: application/json; charset=utf-8");

if (isset($_GET["userpage"])) {
    $userpage = new \edinc\Db\Userpage($_GET["userpage"]);
    print $userpage->GetJson();
}

?>
