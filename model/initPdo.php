<?php


namespace model;

use util\log;

class initPdo
{
    protected $objLog;
    protected $pdo;

    /**
     * initPdo constructor.
     * Ici pour changer les info de connexion BDD
     */
    public function __construct()
    {
        $user = "root";
        $pass = "";
        $dsn ='mysql:host=localhost;dbname=ppe;charset=UTF8';

        $this->objLog = new \util\log();
        try {
            $this->pdo = new \PDO($dsn,$user,$pass);
            $this->pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $e) {
            $this->objLog->insertErrException($e);
            die();
        }
    }

    /**
     * @return log
     */
    public function getObjLog(): log
    {
        return $this->objLog;
    }

    /**
     * @param log $objLog
     */
    public function setObjLog(log $objLog): void
    {
        $this->objLog = $objLog;
    }

    /**
     * @return \PDO
     */
    public function getPdo(): \PDO
    {
        return $this->pdo;
    }

    /**
     * @param \PDO $pdo
     */
    public function setPdo(\PDO $pdo): void
    {
        $this->pdo = $pdo;
    }

}