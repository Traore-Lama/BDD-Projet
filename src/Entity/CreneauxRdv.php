<?php

namespace App\Entity;

use App\Repository\CreneauxRdvRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: CreneauxRdvRepository::class)]
class CreneauxRdv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $heure = null;

    #[ORM\ManyToMany(targetEntity: DemandeRdv::class, mappedBy: 'creneauxRdvs')]
    private Collection $demandeRdvs;

    public function __construct()
    {
        $this->demandeRdvs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTime
    {
        return $this->heure;
    }

    public function setHeure(\DateTime $heure): static
    {
        $this->heure = $heure;

        return $this;
    }

    public function getDemandeRdvs(): Collection
    {
        return $this->demandeRdvs;
    }

    public function addDemandeRdv(DemandeRdv $demandeRdv): static
    {
        if (!$this->demandeRdvs->contains($demandeRdv)) {
            $this->demandeRdvs->add($demandeRdv);
        }
        return $this;
    }

    public function removeDemandeRdv(DemandeRdv $demandeRdv): static
    {
        $this->demandeRdvs->removeElement($demandeRdv);
        return $this;
    }
}
