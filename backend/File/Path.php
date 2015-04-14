<?php
namespace edinc\File;

class Path implements \Countable {
    protected $components;

    function __construct($string) {
        if ($string)
            $this->components = explode(DIRECTORY_SEPARATOR, $string);
    }

    public function count() {
        return count($this->components);
    }

    public function shift() {
        return new Path(array_shift($this->components));
    }

    public function getString() {
        if (is_array($this->components))
            return implode(DIRECTORY_SEPARATOR, $this->components);
    }

    public function getDirPath() {
        return new Path(dirname($this->getString()));
    }

    public function exists() {
        return file_exists($this->getString());
    }

    public function equalsStr($string) {
        return $this->getString() === $string;
    }

    public function isDirOf($path) {
        return $this->equalsStr($path->getDirPath()->getString());
    }

    public function isOnPathOf($path) {
        return $this->equalsStr(substr($path->getString(), 0, strlen($this->getString())));
    }

    public function join($addpath) {
        $string = join(DIRECTORY_SEPARATOR, array($this->getString(), $addpath->getString()));
        return new Path($string);
    }

    public function __toString() {
        return $this->getString();
    }
}

?>
