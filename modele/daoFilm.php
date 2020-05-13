<?php


namespace modele;

use metier\film;

class daoFilm
{
    protected $pdo;
    protected $objLog;

    /**
     * daoFilm constructor.
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

    public function getFilms(int $idArtiste) : array
    {
        $resultat[0]=null;
        try {
            $sql = "select * from artiste where artiste = $idArtiste";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, film::class);
            $sth->execute();
            $resultat = $sth->fetchAll(\PDO::FETCH_CLASS);
        }
        catch (\PDOException $e){
            $this->objLog->insertErrException($e);
        }
        if ($resultat[0]==null)
        {
            $resultat[0] = new film();
            $resultat[0]->setNom("NULL");
        }
        return $resultat;
    }
    public function insert(film $lefilm) : bool {
        $ok = true;
        try {
            $tab['nom'] = $lefilm->getNom();
            $tab['description'] = $lefilm->getDescription();
            $tab['image'] = $lefilm->getImage();
            $tab['artiste'] = $lefilm->getArtiste();

            $sql = "INSERT INTO film (nom, description, image, artiste) VALUES (:nom, :description, :image, :artiste)";
            $sth = $this->pdo->prepare($sql);
            $sth->execute($tab);
        }
        catch (\PDOException $e) {
            $this->objLog->insertErrException($e);
            $ok = false;
        }
        return $ok;
    }
}