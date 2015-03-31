<?php
namespace edinc\Db;

class DbConfig {
    private $config;

    public function __construct($cnfFile) {
        $this->config = parse_ini_file($cnfFile,true);
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
