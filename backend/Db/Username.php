<?php
namespace edinc\Db;

class Username {
    protected $username;

    function __construct($username) {
        //TODO: Sanitize, validate.
        $this->username = basename($username);
    }

    public function getValue() {
        return $this->username;
    }

    public function __toString() {
        return $this->getValue();
    }
}

?>
