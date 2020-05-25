<?php

namespace model;

use metier\exposition;

class daoExposition extends initPdo
{
    private function forceDateType(exposition $expo) :exposition { // Le fetch renvoie des string (pas pratique pour changer le format de date)
        $expo->setDateDebut(new \DateTime($expo->getDateDebut()));
        $expo->setDateFin(new \DateTime($expo->getDateFin()));
        return $expo;
    }

    public function getAllExpo() : array
    {
        $resultat[0] = null;
        try{
            $sql = "select * from exposition";
            $sth = $this->pdo->query($sql);
            // $sth->setFetchMode(\PDO::FETCH_CLASS, exposition::class); Je precise le mod au moment du fetch
            $resultat = $sth->fetchAll(\PDO::FETCH_CLASS, exposition::class);
        }
        catch (\PDOException $e){
            $this->objLog->insertErrException($e);
        }
        foreach ($resultat as $expo) {
            $this->forceDateType($expo);
        }
        return $resultat;
    }

    public function getExpoEnCours() : exposition
    {
        $resultat=null;
        try {
            $sql = "select * from exposition where dateFin > NOW() AND NOW() > dateDebut";
            $sth = $this->pdo->query($sql);
            $resultat = $sth->fetch(\PDO::FETCH_CLASS, exposition::class);
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
            $sql = "select * from exposition where dateDebut > NOW() ORDER BY dateDebut";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, exposition::class);
            $resultat = $sth->fetch();
        } catch (\PDOException $e) {
            $this->objLog->insertErrException($e);
        }
        if ($resultat == null) {
            $resultat = new exposition();
            $resultat->setTitre("NULL");
        }
        return $resultat;
    }

    public function insert(exposition $lexpo) : bool {
        $ok = true;
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
            $ok = false;
        }
        return $ok;
    }
}