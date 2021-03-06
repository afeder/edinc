<?php
namespace edinc\Db;

require_once(__DIR__."/../vendor/autoload.php");

class SelectQuery extends \Zend\Db\Sql\Select implements \IteratorAggregate {
    private $adapter;

    public function __construct(\Zend\Db\Adapter\Adapter $adapter) {
        $this->adapter = $adapter;
        parent::__construct();
    }

    public function execute() {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $statement = $sql->prepareStatementForSqlObject($this);
        return $statement->execute();
    }

    public function getSqlString_() {
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        return $sql->getSqlStringForSqlObject($this);
    }

    public function getIterator() {
        return $this->execute();
    }

    public function toArray() {
        $result = $this->execute();
        $result->buffer();
        $resultset = new \Zend\Db\ResultSet\ResultSet();
        return $resultset->initialize($result)->toArray();
    }
}

?>
