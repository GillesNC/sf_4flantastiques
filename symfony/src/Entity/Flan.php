<?php

namespace App\Entity;

use App\Repository\FlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FlanRepository::class)]
class Flan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?array $category = [];

    #[ORM\Column(nullable: true)]
    private ?array $photo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $bio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0, nullable: true)]
    private ?string $avgScore = null;

    #[ORM\Column(nullable: true)]
    private ?int $reviewsCount = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $archivedAt = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isActive = null;

    #[ORM\ManyToOne(inversedBy: 'flans')]
    private ?User $user = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    /**
     * @var Collection<int, Document>
     */
    #[ORM\ManyToMany(targetEntity: Document::class, mappedBy: 'flan')]
    private Collection $documents;

    #[ORM\ManyToOne(inversedBy: 'flans')]
    private ?Spot $spot = null;

    /**
     * @var Collection<int, Review>
     */
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'flan')]
    private Collection $reviews;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?array
    {
        return $this->category;
    }

    public function setCategory(?array $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getPhoto(): ?array
    {
        return $this->photo;
    }

    public function setPhoto(?array $photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAvgScore(): ?string
    {
        return $this->avgScore;
    }

    public function setAvgScore(?string $avgScore): static
    {
        $this->avgScore = $avgScore;

        return $this;
    }

    public function getReviewsCount(): ?int
    {
        return $this->reviewsCount;
    }

    public function setReviewsCount(?int $reviewsCount): static
    {
        $this->reviewsCount = $reviewsCount;

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

    public function getArchivedAt(): ?\DateTimeImmutable
    {
        return $this->archivedAt;
    }

    public function setArchivedAt(?\DateTimeImmutable $archivedAt): static
    {
        $this->archivedAt = $archivedAt;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user;
    }

    public function setUserId(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): static
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->addFlan($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): static
    {
        if ($this->documents->removeElement($document)) {
            $document->removeFlan($this);
        }

        return $this;
    }

    public function getSpot(): ?Spot
    {
        return $this->spot;
    }

    public function setSpot(?Spot $spot): static
    {
        $this->spot = $spot;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setFlan($this);
        }

        return $this;
    }

    public function removeReview(Review $review): static
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getFlan() === $this) {
                $review->setFlan(null);
            }
        }

        return $this;
    }
}
