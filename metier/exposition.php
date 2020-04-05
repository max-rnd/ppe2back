<?php


namespace metier;


class exposition implements \JsonSerializable
{
    protected $titre;
    protected $dateDebut;
    protected $dateFin;

    /**
     * exposition constructor.
     * @param $titre
     * @param $dateDebut
     * @param $dateFin
     */
    public function __construct(string $titre, \DateTime $dateDebut, \DateTime $dateFin)
    {
        $this->titre = $titre;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        $tab = get_object_vars($this);
        $tab["dateDebut"] = $this->dateDebut->format("YY");
        $tab["dateFin"] = $this->dateFin->format("YY");
        return $tab;
    }
}