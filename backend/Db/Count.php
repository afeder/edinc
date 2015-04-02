<?php
namespace edinc\Db;

require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__."/QIdentifier.php");

// Convenience wrapper around \Zend\Db\Sql\Expression("COUNT($)").
class Count extends \Zend\Db\Sql\Expression {
    function __construct($column, $adapter = null) {
        if ($adapter)
            $expr = QIdentifier($column, $adapter);
        else
            $expr = $column;
        parent::__construct("COUNT($expr)");
    }
}

// Convenience factory
function Count($column, $adapter = null) {
    return new Count($column, $adapter);
}

?>
