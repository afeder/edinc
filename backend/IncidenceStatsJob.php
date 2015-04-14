<?php

require_once(__DIR__."/Grid/JobAbstract.php");
require_once(__DIR__."/Db/User.php");

class IncidenceStatsJob extends \edinc\Grid\JobAbstract {
    protected $target;

    function __construct(\edinc\Db\User $target) {
        $this->target = $target;
    }

    public function getRelativeResultPath() {
        return "../results/".(string)$this->target->wikiname."/".(string)$this->target->username.".json";
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
        return array(urlencode((string)$this->target->wikiname), urlencode((string)$this->target->username));
    }

    protected function getEnvs() {
        return new ArrayObject();
    }
}

?>
