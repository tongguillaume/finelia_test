<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotesRepository")
 */
class Notes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matiere", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $matiere_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=0)
     */
    private $coefficient;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=0, max=20)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatiereId(): ?Matiere
    {
        return $this->matiere_id;
    }

    public function setMatiereId(Matiere $matiere_id): self
    {
        $this->matiere_id = $matiere_id;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getCoefficient(): ?int
    {
        return $this->coefficient;
    }

    public function setCoefficient(int $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }
}
