<?php


namespace metier;


class artiste implements \JsonSerializable
{
    protected $id;
    protected $nom;
    protected $portrait;
    protected $resuBio;
    protected $bio;


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
    public function getPortait()
    {
        return $this->portait;
    }

    /**
     * @param mixed $portrait
     */
    public function setPortait($portrait): void
    {
        $this->portait = $portrait;
    }

    /**
     * @return mixed
     */
    public function getResuBio()
    {
        return $this->resuBio;
    }

    /**
     * @param mixed $resuBio
     */
    public function setResuBio($resuBio): void
    {
        $this->resuBio = $resuBio;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio): void
    {
        $this->bio = $bio;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        return get_object_vars($this);
    }
}