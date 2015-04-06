<?php
namespace edinc\Results;

require_once(__DIR__."/../Editor/Username.php");
require_once(__DIR__."/../File/Directory.php");
require_once(__DIR__."/Result.php");

class ResultsDatabase {
    protected function GetResultPath(\edinc\Editor\Username $target) {
        $resultsdir = new \edinc\File\Directory(__DIR__."/../../results");
        $filepath = $resultsdir->join($target.".json");
        if ($resultsdir->isDirectoryOf($filepath) && $filepath->exists())
            return $filepath;
    }

    public function GetResult(\edinc\Editor\Username $target) {
        $path = $this->GetResultPath($target);
        if ($path)
            return new Result($path);
    }

    public function DeleteResult(\edinc\Editor\Username $target) {
        return unlink($this->GetResultPath($target));
    }
}

?>
