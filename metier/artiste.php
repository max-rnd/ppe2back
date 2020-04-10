<?php


namespace metier;


class artiste implements \JsonSerializable
{
    protected $id;
    protected $nom;
    protected $prenom;
    protected $portait;
    protected $resuBio;
    protected $bio;
    protected $expo;

    /**
     * artiste constructor.
     * @param $id
     * @param $nom
     * @param $prenom
     * @param $portait
     * @param $resuBio
     * @param $bio
     * @param $expo
     */
    public function __construct($id, $nom, $prenom, $portait, $resuBio, $bio, $expo)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->portait = $portait;
        $this->resuBio = $resuBio;
        $this->bio = $bio;
        $this->expo = $expo;
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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getPortait()
    {
        return $this->portait;
    }

    /**
     * @param mixed $portait
     */
    public function setPortait($portait): void
    {
        $this->portait = $portait;
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
     * @return mixed
     */
    public function getExpo()
    {
        return $this->expo;
    }

    /**
     * @param mixed $expo
     */
    public function setExpo($expo): void
    {
        $this->expo = $expo;
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