<?php
namespace edinc\Db;

function QIdentifier($identifier, $adapter) {
    $plt = $adapter->getPlatform();
    if (is_array($identifier))
        $expr = $plt->quoteIdentifierChain($identifier);
    else
        $expr = $plt->quoteIdentifier($identifier);
    return $expr;
}

?>
