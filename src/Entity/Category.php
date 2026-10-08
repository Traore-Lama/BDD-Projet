<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Implant>
     */
    #[ORM\OneToMany(targetEntity: Implant::class, mappedBy: 'Category')]
    private Collection $implants;

    /**
     * @var Collection<int, Medecin>
     */
    #[ORM\ManyToMany(targetEntity: Medecin::class, mappedBy: 'Category')]
    private Collection $medecins;

    /**
     * @var Collection<int, SalleOperation>
     */
    #[ORM\OneToMany(targetEntity: SalleOperation::class, mappedBy: 'Category')]
    private Collection $salleOperations;

    public function __construct()
    {
        $this->implants = new ArrayCollection();
        $this->medecins = new ArrayCollection();
        $this->salleOperations = new ArrayCollection();
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

    /**
     * @return Collection<int, Implant>
     */
    public function getImplants(): Collection
    {
        return $this->implants;
    }

    public function addImplant(Implant $implant): static
    {
        if (!$this->implants->contains($implant)) {
            $this->implants->add($implant);
            $implant->setCategory($this);
        }

        return $this;
    }

    public function removeImplant(Implant $implant): static
    {
        if ($this->implants->removeElement($implant)) {
            // set the owning side to null (unless already changed)
            if ($implant->getCategory() === $this) {
                $implant->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Medecin>
     */
    public function getMedecins(): Collection
    {
        return $this->medecins;
    }

    public function addMedecin(Medecin $medecin): static
    {
        if (!$this->medecins->contains($medecin)) {
            $this->medecins->add($medecin);
            $medecin->addCategory($this);
        }

        return $this;
    }

    public function removeMedecin(Medecin $medecin): static
    {
        if ($this->medecins->removeElement($medecin)) {
            $medecin->removeCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, SalleOperation>
     */
    public function getSalleOperations(): Collection
    {
        return $this->salleOperations;
    }

    public function addSalleOperation(SalleOperation $salleOperation): static
    {
        if (!$this->salleOperations->contains($salleOperation)) {
            $this->salleOperations->add($salleOperation);
            $salleOperation->setCategory($this);
        }

        return $this;
    }

    public function removeSalleOperation(SalleOperation $salleOperation): static
    {
        if ($this->salleOperations->removeElement($salleOperation)) {
            // set the owning side to null (unless already changed)
            if ($salleOperation->getCategory() === $this) {
                $salleOperation->setCategory(null);
            }
        }

        return $this;
    }
}
