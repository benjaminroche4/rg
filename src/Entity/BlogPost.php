<?php

namespace App\Entity;

use App\Repository\BlogPostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogPostRepository::class)]
class BlogPost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $publishedAt = null;

    #[ORM\Column(length: 160)]
    private ?string $summary = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $mainPhotoUrl = null;

    #[ORM\Column(length: 60)]
    private ?string $status = null;

    /**
     * @var Collection<int, BlogCategory>
     */
    #[ORM\ManyToMany(targetEntity: BlogCategory::class, inversedBy: 'blogPosts')]
    private Collection $category;

    #[ORM\ManyToOne(inversedBy: 'blogPosts')]
    private ?BlogEditor $editor = null;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeImmutable $publishedAt): static
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getMainPhotoUrl(): ?string
    {
        return $this->mainPhotoUrl;
    }

    public function setMainPhotoUrl(string $mainPhotoUrl): static
    {
        $this->mainPhotoUrl = $mainPhotoUrl;

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

    /**
     * @return Collection<int, BlogCategory>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(BlogCategory $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(BlogCategory $category): static
    {
        $this->category->removeElement($category);

        return $this;
    }

    public function getEditor(): ?BlogEditor
    {
        return $this->editor;
    }

    public function setEditor(?BlogEditor $editor): static
    {
        $this->editor = $editor;

        return $this;
    }
}
