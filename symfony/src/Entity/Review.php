<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $texture = null;

    #[ORM\Column(nullable: true)]
    private ?float $dough = null;

    #[ORM\Column(nullable: true)]
    private ?float $visual = null;

    #[ORM\Column(nullable: true)]
    private ?float $valueForMoney = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2, nullable: true)]
    private ?string $globalRating = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\Column(length: 255)]
    private ?string $status = 'En attente';

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Flan $flan = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    //Calcul des notes globales
    public function calculateGlobalRating(): void
    {
        if ($this->texture && $this->dough && $this->visual && $this->valueForMoney) {
            $this->globalRating = number_format(
                ($this->texture + $this->dough + $this->visual + $this->valueForMoney) / 4,
                2
            );
        } else {
            $this->globalRating = null;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexture(): ?float
    {
        return $this->texture;
    }

    public function setTexture(?float $texture): static
    {
        $this->texture = $texture;

        return $this;
    }

    public function getDough(): ?float
    {
        return $this->dough;
    }

    public function setDough(?float $dough): static
    {
        $this->dough = $dough;

        return $this;
    }

    public function getVisual(): ?float
    {
        return $this->visual;
    }

    public function setVisual(?float $visual): static
    {
        $this->visual = $visual;

        return $this;
    }

    public function getValueForMoney(): ?float
    {
        return $this->valueForMoney;
    }

    public function setValueForMoney(?float $valueForMoney): static
    {
        $this->valueForMoney = $valueForMoney;

        return $this;
    }

    public function getGlobalRating(): ?string
    {
        return $this->globalRating;
    }

    public function setGlobalRating(?string $globalRating): static
    {
        $this->globalRating = $globalRating;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getFlan(): ?Flan
    {
        return $this->flan;
    }

    public function setFlan(?Flan $flan): static
    {
        $this->flan = $flan;

        return $this;
    }
}
