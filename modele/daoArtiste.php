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

    public function getArtiste(int $idExpo) // : artiste
    {
        $resultat[0]=null;
        try {
            $sql = "select * from artiste where expo = $idExpo";
            $sth = $this->pdo->query($sql);
            $resultat = $sth->fetchAll();
        }
        catch (\PDOException $e){
            $this->objLog->insertErrException($e);
        }
        if ($resultat == null)
        {
            //$resultat = new artiste(); // On ne peux pas crée d'objet quand on est dans une class (apparemment)
        }
        return $resultat[0]; // [0] pour si il y a plusieurs artiste sur une même expo (pas encore géré)
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
            echo $e;
        }
    }
}