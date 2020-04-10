<?php
include_once "modele/const.php";
use metier\exposition;

try {
    $dbh = new PDO($dsn,$user,$pass);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e){
    echo $e;
    die();
}
$resultat[0] = null;
try{
    $sql = "select * from Exposition";
    $sth = $dbh->query($sql);
    $sth->setFetchMode(\PDO::FETCH_CLASS,"metier/exposition");
    $resultat = $sth->fetchAll(\PDO::FETCH_CLASS);
}
catch (\PDOException $e){
    echo $e;
}

echo json_encode($resultat);