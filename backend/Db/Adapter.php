<?php
namespace edinc\Db;

require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__."/DbConfig.php");
require_once(__DIR__."/WikiMetadataDumb.php");

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

?>
