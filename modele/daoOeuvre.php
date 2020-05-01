<?php


namespace modele;

use metier\oeuvre;

class daoOeuvre
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

    public function getOeuvres(int $idArtiste) : array
    {
        $resultat[0]=null;
        try {
            $sql = "select * from oeuvre where artiste = $idArtiste";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, oeuvre::class);
            $sth->execute();
            $resultat = $sth->fetchAll(\PDO::FETCH_CLASS);
        }
        catch (\PDOException $e){
            $this->objLog->insertErrException($e);
        }
        if ($resultat[0] == null)
        {
            $resultat[0] = new oeuvre();
            $resultat[0]->setNom("NULL");
        }
        return $resultat;
    }
    public function insert(oeuvre $loeuvre){
        try {
            $tab['nom'] = $loeuvre->getNom();
            $tab['date'] = $loeuvre->getDate();
            $tab['image'] = $loeuvre->getImage();
            $tab['artiste'] = $loeuvre->getArtiste();

            $sql = "INSERT INTO oeuvre (nom, date, image, artiste) VALUES (:nom, :date, :image, :artiste)";
            $sth = $this->pdo->prepare($sql);
            $sth->execute($tab);
        }
        catch (\PDOException $e) {
            $this->objLog->insertErrException($e);
        }
    }
}