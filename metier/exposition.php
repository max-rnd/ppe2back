<?php


namespace metier;


class exposition implements \JsonSerializable
{
    protected $titre;
    protected $dateDebut = null;
    protected $dateFin = null;

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
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        $tab = get_object_vars($this);
        $tab["dateDebut"] = $this->dateDebut->format("d/m/yy");
        $tab["dateFin"] = $this->dateFin->format("d/m/yy");
        return $tab;
    }
}