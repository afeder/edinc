<?php
namespace edinc\Db;

abstract class WikiMetadataAbstract {
    protected $metadata;

    abstract function __construct($config, $wiki);

    public function __get($name) {
        return $this->metadata[$name];
    }
}

?>
