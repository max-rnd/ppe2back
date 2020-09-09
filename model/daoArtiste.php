<?php


namespace model;

use metier\artiste;

class daoArtiste extends initPdo
{
    public function getAllArtiste() : array
    {
        $resultat[0] = null;
        try {
            $sql = "select * from artiste";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, artiste::class);
            $sth->execute();
            $resultat = $sth->fetchAll();
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
    public function getArtiste(int $id) : artiste
    {
        $resultat = null;
        try {
            $sql = "select * from artiste where id = $id";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, artiste::class);
            $sth->execute();
            $resultat = $sth->fetch();
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
    public function insert(artiste $lartiste) : bool {
        $ok = true;
        try {
            $tab['nom'] = $lartiste->getNom();
            $tab['portait'] = $lartiste->getPortait();
            $tab['resuBio'] = $lartiste->getResuBio();
            $tab['bio'] = $lartiste->getBio();

            $sql = "INSERT INTO artiste (nom, portait, resuBio, bio) VALUES (:nom, :portait, :resuBio, :bio)";
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