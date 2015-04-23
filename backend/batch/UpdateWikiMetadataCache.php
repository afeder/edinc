#!/usr/bin/php
<?php

require_once(__DIR__."/../Db/WikiMetadataQuery.php");
require_once(__DIR__."/../File/Directory.php");

$wikis_dir = new \edinc\File\Directory(__DIR__."/../../wikis/");
$dbname_dir = $wikis_dir->descendStr("dbname");
$hosts = array();
$query = new \edinc\Db\WikiMetadataQuery();
echo "Generating dbnames";
foreach ($query as $result) {
    $dbname_path = $dbname_dir->joinStr($result["dbname"]);
    file_put_contents($dbname_path->getString(), serialize($result));
    if ($hostname = parse_url($result["url"], PHP_URL_HOST)) {
        if (!array_key_exists($hostname, $hosts)) {
            $hosts[$hostname] = $result;
            echo ".";
        } else {
            $hosts[$hostname] = NULL;
            echo "!";
        }
    } else {
        echo "!";
    }
}
echo "\n";

echo "\n";
$host_dir = $wikis_dir->descendStr("host");
$optionshtml = "";
echo "Generating hosts";
foreach ($hosts as $hostname => $result) {
    $dbname = $result["dbname"];
    $dbname_path = $dbname_dir->joinStr($dbname);
    $host_pathstr = $host_dir->joinStr($hostname)->getString();
    if (is_link($host_pathstr)) {
        if (!unlink($host_pathstr))
            echo "!";
    }
    if (symlink($dbname_path->getString(), $host_pathstr)) {
        $selected = $dbname == "enwiki" ? " selected" : "";
        $optionshtml .= "                <option value=\"".$dbname."\"".$selected.">".$hostname."</option>\n";
        echo ".";
    } else {
        echo "!";
    }
}
echo "\n";

echo "\n";
$optionshtml_path = $wikis_dir->joinStr("options.html");
echo "Generating options.html";
if (file_put_contents($optionshtml_path->getString(), $optionshtml))
    echo ".";
else
    echo "!";
echo "\n";

?>
