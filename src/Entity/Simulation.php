<?php

namespace App\Entity;

use App\Repository\SimulationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SimulationRepository::class)]
class Simulation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $ageUser = null;

    #[ORM\Column]
    private ?int $puissanceFiscale = null;

    #[ORM\Column]
    private ?int $ageVehicule = null;

    #[ORM\Column(length: 100)]
    private ?string $marque = null;

    #[ORM\Column(length: 20)]
    private ?string $modele = null;

    #[ORM\Column]
    private ?int $cout = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $critereAgeUser = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $critereModelVoiture = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct() {
        $this->createdAt = new \DateTimeImmutable();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAgeUser(): ?int
    {
        return $this->ageUser;
    }

    public function setAgeUser(int $ageUser): static
    {
        $this->ageUser = $ageUser;

        return $this;
    }

    public function getPuissanceFiscale(): ?int
    {
        return $this->puissanceFiscale;
    }

    public function setPuissanceFiscale(int $puissanceFiscale): static
    {
        $this->puissanceFiscale = $puissanceFiscale;

        return $this;
    }

    public function getAgeVehicule(): ?int
    {
        return $this->ageVehicule;
    }

    public function setAgeVehicule(int $ageVehicule): static
    {
        $this->ageVehicule = $ageVehicule;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getCout(): ?int
    {
        return $this->cout;
    }

    public function setCout(int $cout): static
    {
        $this->cout = $cout;

        return $this;
    }

    public function getCritereAgeUser(): ?int
    {
        return $this->critereAgeUser;
    }

    public function setCritereAgeUser(int $critereAgeUser): static
    {
        $this->critereAgeUser = $critereAgeUser;

        return $this;
    }

    public function getCritereModelVoiture(): ?int
    {
        return $this->critereModelVoiture;
    }

    public function setCritereModelVoiture(int $critereModelVoiture): static
    {
        $this->critereModelVoiture = $critereModelVoiture;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
