<?php
namespace edinc\Db;

require_once(__DIR__."/vendor/autoload.php");
require_once(__DIR__."/WikiMetadata.php");

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

class Adapter extends \Zend\Db\Adapter\Adapter {
    function __construct($cnfFile, $wiki) {
        $config = new DbConfig($cnfFile);
        $metadata = new WikiMetadataDumb($config, $wiki);

        $adapterConfig = array(
            'driver'   => "Mysqli",
            'hostname' => $metadata->slice,
            'username' => $config->user,
            'password' => $config->password,
            'database' => $wiki."_p");

        parent::__construct($adapterConfig);
    }
}

// Convenience wrapper around \Zend\Db\Sql\Expression("COUNT(?)")
class Count extends \Zend\Db\Sql\Expression {
    function __construct($column) {
        parent::__construct("COUNT(?)", $column);
    }
}

// Convenience wrapper around \Zend\Db\Sql\Expression("COUNT(DISTINCT(?))")
class CountDistinct extends \Zend\Db\Sql\Expression {
    function __construct($column) {
        parent::__construct("COUNT(DISTINCT(?))", $column);
    }
}

?>
