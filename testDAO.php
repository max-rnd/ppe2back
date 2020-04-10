<?php
include_once "modele/const.php";
include_once "modele/initPdo.php";
include_once "modele/daoExposition.php";

// pdo
try {
    $dbh = new PDO($dsn,$user,$pass);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
    //$ObjLog->insertErrException($e);
    echo $e;
    die();
}

// log
$ObjLog = null;

new \modele\daoExposition($dbh,$ObjLog);