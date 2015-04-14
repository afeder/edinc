<?php
namespace edinc\Db;

require_once(__DIR__."/Wikiname.php");
require_once(__DIR__."/Username.php");

class User {
    protected $wikiname;
    protected $username;

    function __construct(Wikiname $wikiname, Username $username) {
        //TODO: Sanitize, validate.
        $this->wikiname = $wikiname;
        $this->username = $username;
    }

    public function getWikiname() {
        return $this->wikiname;
    }

    public function getUsername() {
        return $this->username;
    }

    public function __get($name) {
        switch ($name) {
            case "wikiname":
                return $this->getWikiname();
                break;
            case "username":
                return $this->getUsername();
                break;
        }
    }
}

?>
