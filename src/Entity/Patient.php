<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $civilite = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateNaiss = null;

    #[ORM\Column]
    private ?int $codePostal = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $numDossier = null;

    #[ORM\Column]
    private ?bool $estActif = null;

    #[ORM\Column]
    private ?\DateTime $dateCreation = null;

    /**
     * @var Collection<int, ImplantPose>
     */
    #[ORM\OneToMany(targetEntity: ImplantPose::class, mappedBy: 'patient')]
    private Collection $implantPoses;

    /**
     * @var Collection<int, DemandeRdv>
     */
    #[ORM\OneToMany(targetEntity: DemandeRdv::class, mappedBy: 'Patient')]
    private Collection $demandeRdvs;

    /**
     * @var Collection<int, Intervention>
     */
    #[ORM\OneToMany(targetEntity: Intervention::class, mappedBy: 'Patient')]
    private Collection $interventions;

    public function __construct()
    {
        parent::__construct();
        $this->setRoles(['ROLE_PATIENT']);
        $this->implantPoses = new ArrayCollection();
        $this->demandeRdvs = new ArrayCollection();
        $this->interventions = new ArrayCollection();
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

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): static
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getDateNaiss(): ?\DateTime
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(\DateTime $dateNaiss): static
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNumDossier(): ?string
    {
        return $this->numDossier;
    }

    public function setNumDossier(string $numDossier): static
    {
        $this->numDossier = $numDossier;

        return $this;
    }

    public function isEstActif(): ?bool
    {
        return $this->estActif;
    }

    public function setEstActif(bool $estActif): static
    {
        $this->estActif = $estActif;

        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTime $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, ImplantPose>
     */
    public function getImplantPoses(): Collection
    {
        return $this->implantPoses;
    }

    public function addImplantPose(ImplantPose $implantPose): static
    {
        if (!$this->implantPoses->contains($implantPose)) {
            $this->implantPoses->add($implantPose);
            $implantPose->setPatient($this);
        }

        return $this;
    }

    public function removeImplantPose(ImplantPose $implantPose): static
    {
        if ($this->implantPoses->removeElement($implantPose)) {

            if ($implantPose->getPatient() === $this) {
                $implantPose->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DemandeRdv>
     */
    public function getDemandeRdvs(): Collection
    {
        return $this->demandeRdvs;
    }

    public function addDemandeRdv(DemandeRdv $demandeRdv): static
    {
        if (!$this->demandeRdvs->contains($demandeRdv)) {
            $this->demandeRdvs->add($demandeRdv);
            $demandeRdv->setPatient($this);
        }

        return $this;
    }

    public function removeDemandeRdv(DemandeRdv $demandeRdv): static
    {
        if ($this->demandeRdvs->removeElement($demandeRdv)) {

            if ($demandeRdv->getPatient() === $this) {
                $demandeRdv->setPatient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Intervention>
     */
    public function getInterventions(): Collection
    {
        return $this->interventions;
    }

    public function addIntervention(Intervention $intervention): static
    {
        if (!$this->interventions->contains($intervention)) {
            $this->interventions->add($intervention);
            $intervention->setPatient($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): static
    {
        if ($this->interventions->removeElement($intervention)) {
            if ($intervention->getPatient() === $this) {
                $intervention->setPatient(null);
            }
        }

        return $this;
    }
}
