<?php
namespace edinc\Db;

class Wikiname {
    protected $name;

    function __construct($name) {
        $this->name = basename($name);
    }

    public function getValue() {
        return $this->name;
    }

    public function __toString() {
        return $this->getValue();
    }

    public function exists() {
        $filepath = __DIR__."/../../wikis/dbname/".$this->getValue();
        return file_exists($filepath);
    }
}

?>
