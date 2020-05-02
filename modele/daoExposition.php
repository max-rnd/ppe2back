<?php

namespace modele;

use metier\exposition;

class daoExposition
{
    protected $pdo;
    protected $objLog;

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


    /**
     * daoExposition constructor.
     * @param $pdo
     * @param $objLog
     */
    public function __construct(\PDO $pdo, $objLog)
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
    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllExpo() : array
    {
        $resultat[0]=null;
        try{
            $sql = "select * from exposition";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, exposition::class);
            $sth->execute();
            $resultat = $sth->fetchAll(\PDO::FETCH_CLASS);
        }
        catch (\PDOException $e){
            $this->objLog->insertErrException($e);
        }
        return $resultat;
    }

    public function getExpoEnCours() : exposition
    {
        $resultat=null;
        try {
            $sql = "select * from exposition where dateFin > NOW() AND NOW() > dateDebut";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, exposition::class);
            $sth->execute();
            $resultat = $sth->fetch(\PDO::FETCH_CLASS);
        }
        catch (\PDOException $e){
            $this->objLog->insertErrException($e);
        }
        if ($resultat == null)
        {
            $resultat = new exposition();
            $resultat->setTitre("NULL");
        }
        return $resultat;
    }

    public function getProchaineExpo() : exposition
    {
        $resultat = null;
        try {
            $sql = "select * from exposition where dateFin > NOW() ORDER BY dateDebut";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, exposition::class);
            $sth->execute();
            $resultat = $sth->fetchAll(\PDO::FETCH_CLASS);
        } catch (\PDOException $e) {
            $this->objLog->insertErrException($e);
        }
        if ($resultat == null) {
            $resultat = new exposition();
            $resultat->setTitre("NULL");
        }
        return $resultat;
    }

    public function insert(exposition $lexpo){
        try {
            $tab['titre'] = $lexpo->getTitre();
            $tab['noteComm'] = $lexpo->getNoteComm();
            $tab['dateDebut'] = $lexpo->getDateDebut()->format('Y-m-d');
            $tab['dateFin'] = $lexpo->getDateFin()->format('Y-m-d');
            $tab['artiste'] = $lexpo->getArtiste();

            $sql = "INSERT INTO exposition (titre, noteComm, dateDebut, dateFin, artiste) VALUES (:titre, :noteComm, :dateDebut, :dateFin, :artiste)";
            $sth = $this->pdo->prepare($sql);
            $sth->execute($tab);
        }
        catch (\PDOException $e) {
            $this->objLog->insertErrException($e);
        }
    }
}