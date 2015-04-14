<?php
namespace edinc\File;

require(__DIR__."/RealPath.php");

class Directory extends RealPath {
    function __construct($dirpath) {
        parent::__construct($dirpath);
        if (!is_dir($this->getString()))
            die();
    }
}

?>
