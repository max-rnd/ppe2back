<?php


namespace metier;


class oeuvre implements \JsonSerializable
{
    protected $id;
    protected $nom;
    protected $artiste;
    protected $date;
    protected $image;

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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
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
    public function setArtiste($artiste): void
    {
        $this->artiste = $artiste;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        $json = get_object_vars($this);
        $json["date"] = $this->dateDebut->format(YY);
        return $json;
    }
}