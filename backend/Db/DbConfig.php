<?php
namespace edinc\Db;

require_once(__DIR__."/../File/RealPath.php");

class DbConfig {
    private $config;

    public function __construct(\edinc\File\RealPath $cnfFile = null) {
        if ($cnfFile == null)
            $cnfFile = new \edinc\File\RealPath($_SERVER["HOME"]."/replica.my.cnf");
        $this->config = parse_ini_file($cnfFile->getString(),true);
    }

    public function __get($name) {
        switch ($name) {
            case "user":
                return $this->config["client"]["user"];
            case "password":
                return $this->config["client"]["password"];
        }
    }
}

?>
