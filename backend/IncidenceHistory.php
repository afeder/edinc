<?php
namespace edinc;

require_once(__DIR__."/vendor/autoload.php");
require_once(__DIR__."/Db/SelectQuery.php");
require_once(__DIR__."/Db/Distinct.php");

class IncidenceHistory extends Db\SelectQuery {
    public function __construct($adapter, $target) {
        parent::__construct($adapter);

        $targetEdits = new \Zend\Db\Sql\Select();
        $targetEdits->columns(array("rev_page" => Db\Distinct(array("revision_userindex","rev_page"), $adapter)));
        $targetEdits->from("revision_userindex");
        $targetEdits->where(array("revision_userindex.rev_user_text" => $target));

        $this->from("revision");
        $this->where->in("rev_page", $targetEdits);
    }
}

?>
