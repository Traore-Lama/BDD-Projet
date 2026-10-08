<?php

namespace App\Entity;

use App\Repository\ImplantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImplantRepository::class)]
class Implant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $numReference = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $prerequis = null;

    #[ORM\ManyToOne(inversedBy: 'implants')]
    private ?Category $Category = null;

    #[ORM\ManyToOne(inversedBy: 'implants')]
    private ?Patient $Patient = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'implants')]
    private Collection $incompatibles;

    /**
     * @var Collection<int, self>
     */
    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'incompatibles')]
    private Collection $implants;

    public function __construct()
    {
        $this->incompatibles = new ArrayCollection();
        $this->implants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumReference(): ?string
    {
        return $this->numReference;
    }

    public function setNumReference(string $numReference): static
    {
        $this->numReference = $numReference;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrerequis(): ?string
    {
        return $this->prerequis;
    }

    public function setPrerequis(string $prerequis): static
    {
        $this->prerequis = $prerequis;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): static
    {
        $this->Category = $Category;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->Patient;
    }

    public function setPatient(?Patient $Patient): static
    {
        $this->Patient = $Patient;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getIncompatibles(): Collection
    {
        return $this->incompatibles;
    }

    public function addIncompatible(self $incompatible): static
    {
        if (!$this->incompatibles->contains($incompatible)) {
            $this->incompatibles->add($incompatible);
        }

        return $this;
    }

    public function removeIncompatible(self $incompatible): static
    {
        $this->incompatibles->removeElement($incompatible);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getImplants(): Collection
    {
        return $this->implants;
    }

    public function addImplant(self $implant): static
    {
        if (!$this->implants->contains($implant)) {
            $this->implants->add($implant);
            $implant->addIncompatible($this);
        }

        return $this;
    }

    public function removeImplant(self $implant): static
    {
        if ($this->implants->removeElement($implant)) {
            $implant->removeIncompatible($this);
        }

        return $this;
    }
}
