<?php
namespace edinc\Db;

require_once(__DIR__."/Wikiname.php");

class Wikihost {
    protected $host;

    function __construct($host) {
        $this->host = basename($host);
    }

    public function getValue() {
        return $this->host;
    }

    public function __toString() {
        return $this->getValue();
    }

    public function getWikiname() {
        $name = basename(readlink(__DIR__."/../../wikis/host/".$this->getValue()));
        return new Wikiname($name);
    }
}

?>
