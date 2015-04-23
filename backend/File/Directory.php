<?php
namespace edinc\File;

require_once(__DIR__."/RealPath.php");

class Directory extends RealPath {
    function __construct($dirpath) {
        parent::__construct($dirpath);
        if (!is_dir($this->getString()))
            die();
    }

    public function realJoin(Path $addpath) {
        $newpath = parent::realJoin($addpath);
        if (is_dir($newpath->getString()))
          return new Directory($newpath);
        else
          return $newpath;
    }
}

?>
