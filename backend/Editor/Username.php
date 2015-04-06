<?php
namespace edinc\Editor;

class Username {
    protected $username;

    function __construct($username) {
        //TODO: Sanitize, validate.
        $this->username = $username;
    }

    public function __toString() {
        return $this->username;
    }
}

?>
