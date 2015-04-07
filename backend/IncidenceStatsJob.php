<?php

require_once(__DIR__."/Grid/JobAbstract.php");

class IncidenceStatsJob extends \edinc\Grid\JobAbstract {
    protected $target;

    function __construct($target) {
        $this->target = $target;
    }

    public function getRelativeResultPath() {
        return "../results/".$this->target.".json";
    }

    public function getResultPath() {
        return __DIR__."/".$this->getRelativeResultPath();
    }

    protected function getOptions() {
        return array("-mem","1g",
                     "-sync","y"
                     );
    }

    protected function getExec() {
        return __DIR__."/batch/GenerateEditorIncidenceStats.php";
    }

    protected function getArgs() {
        return array(urlencode($this->target));
    }

    protected function getEnvs() {
        return new ArrayObject();
    }
}

?>
