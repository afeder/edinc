<?php
namespace edinc;

require_once(__DIR__."/IncidenceHistory.php");
require_once(__DIR__."/Db/CountDistinct.php");
require_once(__DIR__."/Db/Count.php");

class IncidenceStats extends IncidenceHistory {
    public function __construct($adapter, $target) {
        parent::__construct($adapter, $target);

        $this->columns(array("rev_user_text",
                             "IncidentArticlesCount" => Db\CountDistinct(array("revision","rev_page"), $adapter),
                             "IncidentEditsCount" => Db\Count($this::SQL_STAR)
                             ));
        $this->group("rev_user_text");
    }
}

?>
