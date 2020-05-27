<?php

namespace model;

use metier\exposition;

class daoExposition extends initPdo
{
    public function getAllExpo() : array
    {
        $resultat[0] = null;
        try{
            $sql = "select * from exposition where dateFin > NOW() ORDER BY dateDebut";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, exposition::class);
            $resultat = $sth->fetchAll();
        }
        catch (\PDOException $e){
            $this->objLog->insertErrException($e);
        }
        return $resultat;
    }
    public function getExpo(int $id) : exposition
    {
        $resultat=null;
        try {
            $sql = "select * from exposition where id = $id";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, exposition::class);
            $resultat = $sth->fetch();
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
    public function getExpoEnCours() : exposition
    {
        $resultat=null;
        try {
            $sql = "select * from exposition where dateFin > NOW() AND NOW() > dateDebut";
            $sth = $this->pdo->query($sql);
            $sth->setFetchMode(\PDO::FETCH_CLASS, exposition::class);
            $resultat = $sth->fetch();
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
        /*else {
            $this->forceDateType($resultat);
        }*/
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