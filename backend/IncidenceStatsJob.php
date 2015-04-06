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

    public function run($wait = false) {
        $resultpath = $this->getResultPath();
        if (file_exists($resultpath))
            unlink($resultpath);
        parent::run($wait);
    }

    protected function getOptions() {
        return array("-N","IncidenceStatsJob",
                     "-mem","1g",
                     "-sync","y",
                     "-o",$this->getResultPath(),
                     );
    }

    protected function getExec() {
        return __DIR__."/batch/GenerateEditorIncidenceStats.php";
    }

    protected function getArgs() {
        return array($this->target);
    }

    protected function getEnvs() {
        return new ArrayObject();
    }
}

?>
