<?php

require_once(__DIR__."/Grid/JobAbstract.php");
require_once(__DIR__."/Db/User.php");
require_once(__DIR__."/File/Directory.php");
require_once(__DIR__."/File/Path.php");

class IncidenceStatsJob extends \edinc\Grid\JobAbstract {
    protected $target;
    protected $id;
    protected $output;

    function __construct(\edinc\Db\User $target) {
        $this->target = $target;
        $this->id = uniqid(true);
    }

    protected function getTmpDir() {
        return new \edinc\File\Directory(__DIR__."/../tmp");
    }

    protected function getInputPath() {
        $subpath = new \edinc\File\Path($this->id.".in");
        return $this->getTmpDir()->join($subpath);
    }

    protected function getOutputPath() {
        $subpath = new \edinc\File\Path($this->id.".out");
        return $this->getTmpDir()->join($subpath);
    }

    protected function prepareInput() {
        $input = array("dbname" => (string)$this->target->wikiname, 
                       "username" => (string)$this->target->username
                       );
        $inputjson = json_encode($input);
        return file_put_contents($this->getInputPath()->getString(), $inputjson);
    }

    protected function getOptions() {
        return array("-mem","1g",
                     "-sync","y",
                     "-i",$this->getInputPath()->getString(),
                     "-o",$this->getOutputPath()->getString()
                     );
    }

    protected function getExec() {
        return __DIR__."/batch/GenerateEditorIncidenceStats.php";
    }

    protected function getArgs() {
        return array();
    }

    protected function getEnvs() {
        return new ArrayObject();
    }

    public function run() {
        ignore_user_abort(true);
        if ($this->prepareInput()) {
            $status = parent::run();
            if ($this->output = file_get_contents($this->getOutputPath()->getString()))
                unlink($this->getOutputPath());
            unlink($this->getInputPath());
        }
        ignore_user_abort(false);
        return $status;
    }

    public function getOutput() {
        return $this->output;
    }
}

?>
