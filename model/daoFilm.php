<?php


namespace model;

use metier\film;

class daoFilm extends initPdo
{
    public function getFilms(int $idArtiste) : array
    {
        $resultat[0]=null;
        try {
            $sql = "select * from film where artiste = $idArtiste";
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