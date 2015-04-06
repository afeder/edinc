<?php
namespace edinc\File;

class RealPath {
    protected $realpath;

    function __construct($path) {
        $this->realpath = realpath($path);
    }

    public function getPath() {
        return $this->realpath;
    }

    public function getDirname() {
        return dirname($this->realpath);
    }

    public function exists() {
        return file_exists($this->realpath);
    }

    public function join($addpath) {
        $path = realpath(join(DIRECTORY_SEPARATOR, array($this->realpath, $addpath)));
        return new RealPath($path);
    }

    public function __toString() {
        return $this->realpath;
    }
}

?>
