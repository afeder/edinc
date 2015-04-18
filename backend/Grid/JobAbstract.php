<?php
namespace edinc\Grid;

abstract class JobAbstract {
    abstract protected function getOptions();
    abstract protected function getExec();
    abstract protected function getArgs();
    abstract protected function getEnvs();

    public function run() {
        $args = array_merge(array("jsub"), $this->getOptions(), array($this->getExec()), $this->getArgs());
        $output = array("path" => trim(`which jsub`),
                        "args" => $args,
                        "env" => $this->getEnvs()
                        );
        $handle = popen(__DIR__."/../execve.py", "w");
        fwrite($handle, json_encode($output));
        return pclose($handle);
    }
}

?>
