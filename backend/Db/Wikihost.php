<?php
namespace edinc\Db;

require_once(__DIR__."/../File/Directory.php");
require_once(__DIR__."/../File/Path.php");
require_once(__DIR__."/Wikiname.php");

class Wikihost {
    protected $hostname;
    protected $filepath;

    function __construct($hostname) {
        $this->hostname = $hostname;
        $hostsdir = new \edinc\File\Directory(__DIR__."/../../wikis/host");
        $subpath = new \edinc\File\Path(basename($this->hostname));
        $this->filepath = $hostsdir->realJoin($subpath);
    }

    public function getHostname() {
        return $this->hostname;
    }

    public function __toString() {
        return $this->getValue();
    }

    public function getWikiname() {
        $name = basename($this->filepath->getString());
        return new Wikiname($name);
    }
}

?>
