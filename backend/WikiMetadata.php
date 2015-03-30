<?php
namespace edinc\Db;

require_once(__DIR__."/vendor/autoload.php");

// Only returns "slice" metadata, on the basis of Labs naming conventions.
// Much faster than a full metadata lookup.
class WikiMetadataDumb {
    private $metadata;

    public function __construct($config, $wiki = null) {
        $this->metadata["slice"] = $wiki.".labsdb";
    }

    public function __get($name) {
        return $this->metadata[$name];
    }
}

class WikiMetadata {
    private $metadata;

    public function __construct($config, $wiki = null) {
        $configArray = array(
            'driver'   => "Mysqli",
            'hostname' => "s1.labsdb",
            'username' => $config->user,
            'password' => $config->password,
            'database' => "meta_p");

        $adapter = new \Zend\Db\Adapter\Adapter($configArray);

        $sql = new \Zend\Db\Sql\Sql($adapter);
        $select = $sql->select();
        $select->from("wiki");
        if ($wiki)
            $select->where(array("dbname" => $wiki));

        $statement = $sql->prepareStatementForSqlObject($select);
        if ($wiki)
            $this->metadata = $statement->execute()->current();
    }

    public function __get($name) {
        return $this->metadata[$name];
    }
}

?>
