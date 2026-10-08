<?php

namespace App\Entity;

use App\Repository\DemandeRdvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeRdvRepository::class)]
class DemandeRdv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $motif = null;

    #[ORM\Column]
    private ?\DateTime $dateDemande = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTime $heure = null;

    #[ORM\ManyToOne(inversedBy: 'demandeRdvs')]
    private ?Patient $Patient = null;

    /**
     * @var Collection<int, CreneauxRdv>
     */
    #[ORM\ManyToMany(targetEntity: CreneauxRdv::class, inversedBy: 'demandeRdvs')]
    private Collection $creneauxRdvs;

    public function __construct()
    {
        $this->creneauxRdvs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): static
    {
        $this->motif = $motif;

        return $this;
    }

    public function getDateDemande(): ?\DateTime
    {
        return $this->dateDemande;
    }

    public function setDateDemande(\DateTime $dateDemande): static
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getHeure(): ?\DateTime
    {
        return $this->heure;
    }

    public function setHeure(?\DateTime $heure): static
    {
        $this->heure = $heure;

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
     * @return Collection<int, CreneauxRdv>
     */
    public function getCreneauxRdvs(): Collection
    {
        return $this->creneauxRdvs;
    }

    public function addCreneauxRdv(CreneauxRdv $creneauxRdv): static
    {
        if (!$this->creneauxRdvs->contains($creneauxRdv)) {
            $this->creneauxRdvs->add($creneauxRdv);
        }

        return $this;
    }

    public function removeCreneauxRdv(CreneauxRdv $creneauxRdv): static
    {
        $this->creneauxRdvs->removeElement($creneauxRdv);

        return $this;
    }
}
