<?php
namespace edinc\Results;

require_once(__DIR__."/../Db/User.php");
require_once(__DIR__."/../File/Directory.php");
require_once(__DIR__."/../File/Path.php");
require_once(__DIR__."/Result.php");

class ResultsDatabase {
    protected function GetResultPath(\edinc\Db\User $target) {
        $resultsdir = new \edinc\File\Directory(__DIR__."/../../results");
        $subpath = new \edinc\File\Path((string)$target->wikiname."/".(string)$target->username.".json");
        if ($filepath = $resultsdir->descend($subpath))
            return $filepath;
    }

    public function GetResult(\edinc\Db\User $target) {
        if ($path = $this->GetResultPath($target))
            return new Result($path);
    }

    public function DeleteResult(\edinc\Db\User $target) {
        return unlink($this->GetResultPath($target));
    }
}

?>
