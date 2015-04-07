<?php
namespace edinc\Results;

require_once(__DIR__."/../File/RealPath.php");

class Result implements \IteratorAggregate {
    protected $data;

    function __construct(\edinc\File\RealPath $jsonfile) {
        if (file_exists($jsonfile))
            $this->data = json_decode(file_get_contents($jsonfile));
    }

    public function getIterator() {
        return new ArrayIterator($this->data);
    }

    public function getJson() {
        return json_encode($this->data);
    }

    public function getJsVar($name) {
        return "var ".$name." = ".$this->getJson().";\n";
    }
}

?>
