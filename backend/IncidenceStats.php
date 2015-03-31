<?php
namespace edinc;

require_once(__DIR__."/IncidenceHistory.php");
require_once(__DIR__."/Db.php");

class IncidenceStats extends IncidenceHistory {
    public function __construct($adapter, $target) {
        parent::__construct($adapter, $target);
        $this->columns(array("rev_user_text",
                             "IncidentArticlesCount" => Db::CountDistinct("rev_page"),
                             "IncidentEditsCount" => Db::Count("*")
                             ));
        $this->group("rev_user_text");
    }
}

?>
