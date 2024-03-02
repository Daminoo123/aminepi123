<?php

namespace App\Entity;

use App\Repository\AccidentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AccidentRepository::class)]
class Accident
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Please provide the type of accident')]
    public $type_accident;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Please provide the location of the accident')]
    public $lieu_Accident;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Please provide the date of the accident')]
    public $date_Accident;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Please provide the description of the accident')]
    public $description_Accident;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'accidents')]
    public $user;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Please provide the remorquage status')]
    public $Accident_remorquage;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Please provide the accident report')]
    public $constat;

    #[ORM\OneToOne(mappedBy: 'lieu_accident', targetEntity: Remorquage::class, cascade: ['persist', 'remove'])]
    private $remorquage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeAccident(): ?string
    {
        return $this->type_accident;
    }

    public function setTypeAccident(string $type_accident): self
    {
        $this->type_accident = $type_accident;

        return $this;
    }

    public function getLieuAccident(): ?string
    {
        return $this->lieu_Accident;
    }

    public function setLieuAccident(string $lieu_Accident): self
    {
        $this->lieu_Accident = $lieu_Accident;

        return $this;
    }

    public function getDateAccident(): ?string
    {
        return $this->date_Accident;
    }

    public function setDateAccident(string $date_Accident): self
    {
        $this->date_Accident = $date_Accident;

        return $this;
    }

    public function getDescriptionAccident(): ?string
    {
        return $this->description_Accident;
    }

    public function setDescriptionAccident(string $description_Accident): self
    {
        $this->description_Accident = $description_Accident;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAccidentRemorquage(): ?string
    {
        return $this->Accident_remorquage;
    }

    public function setAccidentRemorquage(string $Accident_remorquage): self
    {
        $this->Accident_remorquage = $Accident_remorquage;

        return $this;
    }

    public function getConstat(): ?string
    {
        return $this->constat;
    }

    public function setConstat(string $constat): self
    {
        $this->constat = $constat;

        return $this;
    }

    public function getRemorquage(): ?Remorquage
    {
        return $this->remorquage;
    }

    public function setRemorquage(?Remorquage $remorquage): self
    {
        // unset the owning side of the relation if necessary
        if ($remorquage === null && $this->remorquage !== null) {
            $this->remorquage->setLieuAccident(null);
        }

        // set the owning side of the relation if necessary
        if ($remorquage !== null && $remorquage->getLieuAccident() !== $this) {
            $remorquage->setLieuAccident($this);
        }

        $this->remorquage = $remorquage;

        return $this;
    }
    public function __toString()
    {
        return (string)$this->getLieuAccident();
    }
}
