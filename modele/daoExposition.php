<?php


namespace modele;

use metier\exposition;

class daoExposition
{
    protected $pdo;
    protected $objLog;

    /**
     * daoExposition constructor.
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
    public function getNowExpo() : exposition
    {
        $resultat=null;
        try {
            $sql = "select * from exposition where dateFin > NOW() AND NOW() < dateDebut";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, 'metier\\exposition');
            $resultat = $sth->fetch(\PDO::FETCH_CLASS);
        }
        catch (\PDOException $e){
            $this->objLog->insertErrException($e);
        }
        if ($resultat==null)
        {
            $resultat = new exposition();
            $resultat->setNom("NULL");
        }
        return $resultat;
    }
}