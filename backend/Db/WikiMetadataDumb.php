<?php
namespace edinc\Db;

require_once(__DIR__."/WikiMetadataAbstract.php");

// Only returns "slice" metadata, on the basis of Labs naming conventions.
// Much faster than a full metadata lookup.
class WikiMetadataDumb extends WikiMetadataAbstract {
    public function __construct($config, $wiki) {
        if ($wiki)
            $this->metadata = array("slice" => $wiki.".labsdb");
    }
}

?>
