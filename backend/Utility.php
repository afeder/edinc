<?php
namespace edinc;

require_once(__DIR__."/Db.php");

// Utility factories for Db functions
class Db {
    public static function Count($column) {
        return new Db\Count($column);
    }

    public static function CountDistinct($column) {
        return new Db\CountDistinct($column);
    }
}
