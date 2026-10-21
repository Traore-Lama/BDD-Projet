<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $heureDebut = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $compteRendu = null;

    #[ORM\Column(length: 255)]
    private ?string $statut = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?Patient $Patient = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?DemandeRdv $demandeRdv = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?Medecin $Medecin = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?SalleOperation $SalleOperation = null;

    /**
     * @var Collection<int, NotesIntervention>
     */
    #[ORM\OneToMany(targetEntity: NotesIntervention::class, mappedBy: 'Intervention')]
    private Collection $notesInterventions;

    public function __construct()
    {
        $this->notesInterventions = new ArrayCollection();
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

    public function getHeureDebut(): ?\DateTime
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTime $heureDebut): static
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getCompteRendu(): ?string
    {
        return $this->compteRendu;
    }

    public function setCompteRendu(string $compteRendu): static
    {
        $this->compteRendu = $compteRendu;

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

    public function getPatient(): ?Patient
    {
        return $this->Patient;
    }

    public function setPatient(?Patient $Patient): static
    {
        $this->Patient = $Patient;

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->Medecin;
    }

    public function setMedecin(?Medecin $Medecin): static
    {
        $this->Medecin = $Medecin;

        return $this;
    }

    public function getSalleOperation(): ?SalleOperation
    {
        return $this->SalleOperation;
    }

    public function setSalleOperation(?SalleOperation $SalleOperation): static
    {
        $this->SalleOperation = $SalleOperation;

        return $this;
    }

    /**
     * @return Collection<int, NotesIntervention>
     */
    public function getNotesInterventions(): Collection
    {
        return $this->notesInterventions;
    }

    public function addNotesIntervention(NotesIntervention $notesIntervention): static
    {
        if (!$this->notesInterventions->contains($notesIntervention)) {
            $this->notesInterventions->add($notesIntervention);
            $notesIntervention->setIntervention($this);
        }

        return $this;
    }

    public function removeNotesIntervention(NotesIntervention $notesIntervention): static
    {
        if ($this->notesInterventions->removeElement($notesIntervention)) {
            // set the owning side to null (unless already changed)
            if ($notesIntervention->getIntervention() === $this) {
                $notesIntervention->setIntervention(null);
            }
        }

        return $this;
    }

    public function getDemandeRdv(): ?DemandeRdv
    {
        return $this->demandeRdv;
    }

    public function setDemandeRdv(?DemandeRdv $demandeRdv): static
    {
        $this->demandeRdv = $demandeRdv;
        return $this;
    }
}
