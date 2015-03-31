<?php
namespace edinc\Db;

require_once(__DIR__."/../vendor/autoload.php");

// Convenience wrapper around \Zend\Db\Sql\Expression("COUNT(DISTINCT(?))")
class CountDistinct extends \Zend\Db\Sql\Expression {
    function __construct($column) {
        parent::__construct("COUNT(DISTINCT(?))", $column);
    }
}

?>
