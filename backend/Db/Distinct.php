<?php
namespace edinc\Db;

require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__."/QIdentifier.php");

// Convenience wrapper around \Zend\Db\Sql\Expression("DISTINCT($)").
class Distinct extends \Zend\Db\Sql\Expression {
    function __construct($column, $adapter = null) {
        if ($adapter)
            $expr = QIdentifier($column, $adapter);
        else
            $expr = $column;
        parent::__construct("DISTINCT($expr)");
    }
}

// Convenience factory
function Distinct($column, $adapter = null) {
    return new Distinct($column, $adapter);
}

?>
