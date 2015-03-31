<?php
namespace edinc\Db;

require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__."/SelectQuery.php");

class WikiMetadataQuery extends SelectQuery {
    public function __construct($config) {
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
