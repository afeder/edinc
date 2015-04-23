<?php
namespace edinc\Db;

require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__."/SelectQuery.php");
require_once(__DIR__."/DbConfig.php");

class WikiMetadataQuery extends SelectQuery {
    public function __construct(DbConfig $config = null) {
        if ($config == null)
            $config = new DbConfig();
        $configArray = array(
            'driver'   => "Mysqli",
            'hostname' => "s1.labsdb",
            'username' => $config->user,
            'password' => $config->password,
            'database' => "meta_p");

        $adapter = new \Zend\Db\Adapter\Adapter($configArray);

        parent::__construct($adapter);

        $this->from("wiki");
    }
}

?>
