<?php


namespace metier;


class exposition implements \JsonSerializable
{
    protected $id;
    protected $titre;
    protected $noteComm;
    protected $dateDebut = null;
    protected $dateFin = null;

    /**
     * exposition constructor.
     * @param $id
     * @param $titre
     * @param $noteComm
     * @param null $dateDebut
     * @param null $dateFin
     */
    public function __construct($id, $titre, $noteComm, $dateDebut, $dateFin)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->noteComm = $noteComm;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
    }

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
    public function setDateDebut($dateDebut): void
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
    public function setDateFin($dateFin): void
    {
        $this->dateFin = $dateFin;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        $json = get_object_vars($this);
        $json["dateDebut"] = $this->dateDebut->format("d/m/YY");
        $json["dateFin"] = $this->dateFin->format("d/m/YY");
        return $json;
    }
}