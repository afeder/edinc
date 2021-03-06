<?php
namespace edinc\Db;

require_once(__DIR__."/WikiMetadataAbstract.php");
require_once(__DIR__."/Wikiname.php");
require_once(__DIR__."/WikiMetadataQuery.php");

class WikiMetadataFull extends WikiMetadataAbstract {
    public function __construct($config, Wikiname $wiki) {
        $query = new WikiMetadataQuery($config);
        $query->where(array("dbname" => (string)$wiki));
        $this->metadata = $query->execute()->current();
    }
}

?>
