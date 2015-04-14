<?php
namespace edinc\File;

require(__DIR__."/Path.php");

class RealPath extends Path {
    function __construct($string) {
        parent::__construct(realpath($string));
    }

    public function realJoin(Path $addpath) {
        return new RealPath($this->join($addpath)->getString());
    }

    public function descend(Path $descpath) {
        if ($next = $this->realJoin($descpath->shift())) {
            if ($this->isDirOf($next) && $descpath->count()) {
                return $next->descend($descpath);
            } else {
                return $next;
            }
        }
    }
}

?>
