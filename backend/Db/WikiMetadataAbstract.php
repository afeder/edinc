<?php
namespace edinc\Db;

require_once(__DIR__."/Wikiname.php");

abstract class WikiMetadataAbstract {
    protected $metadata;

    abstract function __construct($config, Wikiname $wiki);

    public function __get($name) {
        return $this->metadata[$name];
    }
}

?>
