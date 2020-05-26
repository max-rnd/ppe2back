<?php


namespace metier;


class exposition implements \JsonSerializable
{
    protected $id = null;
    protected $titre = null;
    protected $noteComm = null;
    protected $dateDebut = null;
    protected $dateFin = null;
    protected $artiste;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getNoteComm()
    {
        return $this->noteComm;
    }

    /**
     * @param mixed $noteComm
     */
    public function setNoteComm($noteComm): void
    {
        $this->noteComm = $noteComm;
    }

    /**
     * @return null
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param null $dateDebut
     */
    public function setDateDebut(\DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return null
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param null $dateFin
     */
    public function setDateFin(\DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return mixed
     */
    public function getArtiste()
    {
        return $this->artiste;
    }

    /**
     * @param mixed $artiste
     */
    public function setArtiste(int $artiste): void
    {
        $this->artiste = $artiste;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        // $tab = get_object_vars($this);
        // $tab["dateDebut"] = $this->dateDebut->format("d/m/Y");
        // $tab["dateFin"] = $this->dateFin->format("d/m/Y");
        return get_object_vars($this);
    }
}