<?php

namespace App\Entity;

use App\Repository\RemorquageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RemorquageRepository::class)]
class Remorquage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public $id;

    #[ORM\OneToOne(targetEntity: User::class, cascade: ['persist', 'remove'])]
    public $num_user;

    #[ORM\OneToOne(targetEntity: User::class, cascade: ['persist', 'remove'])]
    public $id_user;

    /**
     * @ORM\ManyToOne(targetEntity=Accident::class)
     * @ORM\JoinColumn(nullable=false)
     */
    public $Accident;

    // Getters and setters for the 'Accident' property
    public function getAccident(): ?Accident
    {
        return $this->Accident;
    }

    public function setAccident(?Accident $Accident): self
    {
        $this->Accident = $Accident;

        return $this;
    }

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Please provide the remorquage state')]
    #[Assert\Choice(choices: ["Assistance routière", "Remorquage après accident", "Remorquage d'urgence", "Remorquage longue distance", "Remorquage local", "Remorquage après vol", "Récupération tout-terrain", "Remorquage de VR ou de remorque"], message: 'Choose a valid remorquage type')]
    public $etat_Remorquage;

    #[ORM\OneToOne(inversedBy: 'remorquage', targetEntity: Accident::class, cascade: ['persist', 'remove'])]
    
    public $lieu_accident;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumUser(): ?User
    {
        return $this->num_user;
    }

    public function setNumUser(?User $num_user): self
    {
        $this->num_user = $num_user;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    #[Assert\NotBlank(message: 'Please provide the remorquage state')]
    #[Assert\Choice(choices: ["Assistance routière", "Remorquage après accident", "Remorquage d'urgence", "Remorquage longue distance", "Remorquage local", "Remorquage après vol", "Récupération tout-terrain", "Remorquage de VR ou de remorque"], message: 'Choose a valid remorquage type')]
    public function getEtatRemorquage(): ?string
    {
        return $this->etat_Remorquage;
    }

    public function setEtatRemorquage(string $etat_Remorquage): self
    {
        $this->etat_Remorquage = $etat_Remorquage;

        return $this;
    }

   
    public function getLieuAccident(): ?Accident
    {
        return $this->lieu_accident;
    }

    public function setLieuAccident(?Accident $lieu_accident): self
    {
        $this->lieu_accident = $lieu_accident;

        return $this;
    }
}
