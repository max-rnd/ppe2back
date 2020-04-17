<?php


namespace modele;

use metier\artiste;

class daoArtiste
{
    protected $pdo;
    protected $objLog;

    /**
     * daoArtiste constructor.
     * @param $pdo
     * @param $objLog
     */
    public function __construct($pdo, $objLog)
    {
        $this->pdo = $pdo;
        $this->objLog = $objLog;
    }

    /**
     * @return mixed
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @param mixed $pdo
     */
    public function setPdo($pdo): void
    {
        $this->pdo = $pdo;
    }

    /**
     * @return mixed
     */
    public function getObjLog()
    {
        return $this->objLog;
    }

    /**
     * @param mixed $objLog
     */
    public function setObjLog($objLog): void
    {
        $this->objLog = $objLog;
    }

    public function getArtiste(int $id) // : artiste
    {
        $resultat=null;
        try {
            $sql = "select * from Artiste where id = $id";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, \metier\artiste::class);
            $resultat = $sth->fetch(\PDO::FETCH_CLASS);
            //$resultat = $sth->fetchAll(\PDO::FETCH_CLASS);
        }
        catch (\PDOException $e){
            echo $e;
            $this->objLog->insertErrException($e);
        }
        if ($resultat == null)
        {
            //$resultat = new artiste();
        }
        return $resultat;
    }
}