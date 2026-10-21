<?php

namespace App\Entity;

use App\Repository\ImplantPoseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImplantPoseRepository::class)]
class ImplantPose
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $numSerie = null;

    #[ORM\Column]
    private ?\DateTime $datePose = null;

    #[ORM\ManyToOne(inversedBy: 'implantPoses')]
    private ?Patient $patient = null;

    #[ORM\ManyToOne(inversedBy: 'implantPoses')]
    private ?Implant $implant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSerie(): ?string
    {
        return $this->numSerie;
    }

    public function setNumSerie(?string $numSerie): static
    {
        $this->numSerie = $numSerie;

        return $this;
    }

    public function getDatePose(): ?\DateTime
    {
        return $this->datePose;
    }

    public function setDatePose(?\DateTime $datePose): static
    {
        $this->datePose = $datePose;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): static
    {
        $this->patient = $patient;

        return $this;
    }

    public function getImplant(): ?Implant
    {
        return $this->implant;
    }

    public function setImplant(?Implant $implant): static
    {
        $this->implant = $implant;

        return $this;
    }
}
