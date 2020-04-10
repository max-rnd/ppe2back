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
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllExpo() : array
    {
        $resultat[0]=null;
        try{
            $sql = "select * from exposition";
            $sth = $this->pdo->query($sql);
            $resultat = $sth->fetchAll(\PDO::FETCH_CLASS,  "metier/exposition");
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
            echo $sql;
            $sth = $this->pdo->query();
            $sth->setFetchMode(\PDO::FETCH_CLASS, 'metier/exposition');
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

    public function getProchaineExpo() : exposition
    {
        $resultat = null;
        try {
            $sql = "select * from exposition where dateDebut > NOW() ORDER By dateDebut";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, 'metier/exposition');
            $resultat = $sth->fetch(\PDO::FETCH_CLASS);
        } catch (\PDOException $e) {
            $this->objLog->insertErrException($e);
        }
        if ($resultat == null) {
            $resultat = new exposition();
            $resultat->setNom("NULL");
        }
        return $resultat;
    }

    public function insert(exposition $lexpo){
        try {
            $tab['nom'] = $lexpo->getNom();
            $tab['dateDebut'] = $lexpo->getDateDebut()->format('Y-m-d H:i:s');
            $tab['dateFin'] = $lexpo->getDateFin()->format('Y-m-d H:i:s');
            $tab['idArtiste'] = $lexpo->getIdArtiste();

            $sql = "INSERT INTO exposition ( nom, dateDebut, dateFin, idArtiste) VALUES (:nom, :dateDebut, :dateFin, :idArtiste)";
            $sth = $this->pdo->prepare($sql);
            $sth->execute($tab);
        }
        catch (\PDOException $e) {
            $this->objLog->insertErrException($e);
        }
    }
}