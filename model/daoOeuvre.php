<?php


namespace model;

use metier\oeuvre;

class daoOeuvre extends initPdo
{
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
        $ok = true;
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
            $ok = false;
        }
        return $ok;
    }
}