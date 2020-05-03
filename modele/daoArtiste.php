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

    public function getArtiste(int $id) : artiste
    {
        $resultat=null;
        try {
            $sql = "select * from artiste where id = $id";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, artiste::class);
            $sth->execute();
            $resultat = $sth->fetch(\PDO::FETCH_CLASS);
        }
        catch (\PDOException $e){
            $this->objLog->insertErrException($e);
        }
        if ($resultat == null)
        {
            $resultat = new artiste();
            $resultat->setNom("NULL");
        }
        return $resultat;
    }
    public function getAllArtiste() : array
    {
        $resultat[0]=null;
        try {
            $sql = "select * from artiste";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, artiste::class);
            $sth->execute();
            $resultat = $sth->fetchAll(\PDO::FETCH_CLASS);
        }
        catch (\PDOException $e){
            $this->objLog->insertErrException($e);
        }
        if ($resultat[0] == null)
        {
            $resultat[0] = new artiste();
            $resultat[0]->setNom("NULL");
        }
        return $resultat;
    }
    public function insert(artiste $lartiste){
        try {
            $tab['nom'] = $lartiste->getNom();
            $tab['prenom'] = $lartiste->getPrenom();
            $tab['portait'] = $lartiste->getPortait();
            $tab['resuBio'] = $lartiste->getResuBio();
            $tab['bio'] = $lartiste->getBio();

            $sql = "INSERT INTO artiste (nom, prenom, portait, resuBio, bio) VALUES (:nom, :prenom, :portait, :resuBio, :bio)";
            $sth = $this->pdo->prepare($sql);
            $sth->execute($tab);
        }
        catch (\PDOException $e) {
            $this->objLog->insertErrException($e);
        }
    }
}