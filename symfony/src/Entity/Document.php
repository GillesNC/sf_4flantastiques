<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: DocumentRepository::class)]
#[Vich\Uploadable]
class Document
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $path = null;

    #[ORM\Column]
    private ?int $size = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[Vich\UploadableField(mapping: 'documents', fileNameProperty: 'path', size: 'size', mimeType: 'type', originalName: 'name')]
    private ?File $documentFile = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Flan>
     */
    #[ORM\ManyToMany(targetEntity: Flan::class, inversedBy: 'documents')]
    private Collection $flan;

    /**
     * @var Collection<int, Spot>
     */
    #[ORM\ManyToMany(targetEntity: Spot::class, inversedBy: 'documents')]
    private Collection $spot;

    public function __construct()
    {
        $this->flan = new ArrayCollection();
        $this->spot = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        $this->size = $size;

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

    /**
     * @return Collection<int, Flan>
     */
    public function getFlan(): Collection
    {
        return $this->flan;
    }

    public function addFlan(Flan $flan): static
    {
        if (!$this->flan->contains($flan)) {
            $this->flan->add($flan);
        }

        return $this;
    }

    public function removeFlan(Flan $flan): static
    {
        $this->flan->removeElement($flan);

        return $this;
    }

    /**
     * @return Collection<int, Spot>
     */
    public function getSpot(): Collection
    {
        return $this->spot;
    }

    public function addSpot(Spot $spot): static
    {
        if (!$this->spot->contains($spot)) {
            $this->spot->add($spot);
        }

        return $this;
    }

    public function removeSpot(Spot $spot): static
    {
        $this->spot->removeElement($spot);

        return $this;
    }

    public function setDocumentFile(?File $documentFile = null): void
    {
        $this->documentFile = $documentFile;

        if (null !== $documentFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getDocumentFile(): ?File
    {
        return $this->documentFile;
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
}
