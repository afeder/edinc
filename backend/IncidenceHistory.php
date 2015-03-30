<?php
namespace edinc;

require_once(__DIR__."/vendor/autoload.php");
require_once(__DIR__."/Db.php");

class IncidenceHistorySql extends \Zend\Db\Sql\Select {
    public function __construct($target) {
        parent::__construct();

        $targetEdits = new \Zend\Db\Sql\Select();
        $targetEdits->columns(array("rev_page"));
        $targetEdits->from("revision_userindex");
        $targetEdits->where(array("revision_userindex.rev_user_text" => $target));

        $this->from("revision");
        $this->where->in("rev_page", $targetEdits);
    }
}

class IncidenceHistory extends IncidenceHistorySql implements \IteratorAggregate {
    private $adapter;

    public function __construct($adapter, $target) {
        $this->adapter = $adapter;
        parent::__construct($target);
    }

    public function execute() {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $statement = $sql->prepareStatementForSqlObject($this);
        return $statement->execute();
    }

    public function getIterator() {
        return $this->execute();
    }
}

?>
