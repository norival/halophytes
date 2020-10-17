<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url(normalizer = "trim")
     */
    private $url;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Type("string")
     */
    private $abstract;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=SpeciesFeature::class, mappedBy="article")
     */
    private $speciesFeatures;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $first_author_last_name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $year;

    public function __construct()
    {
        $this->speciesFeatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(?string $abstract): self
    {
        $this->abstract = $abstract;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|SpeciesFeature[]
     */
    public function getSpeciesFeatures(): Collection
    {
        return $this->speciesFeatures;
    }

    public function addSpeciesFeature(SpeciesFeature $speciesFeature): self
    {
        if (!$this->speciesFeatures->contains($speciesFeature)) {
            $this->speciesFeatures[] = $speciesFeature;
            $speciesFeature->setArticle($this);
        }

        return $this;
    }

    public function removeSpeciesFeature(SpeciesFeature $speciesFeature): self
    {
        if ($this->speciesFeatures->contains($speciesFeature)) {
            $this->speciesFeatures->removeElement($speciesFeature);
            // set the owning side to null (unless already changed)
            if ($speciesFeature->getArticle() === $this) {
                $speciesFeature->setArticle(null);
            }
        }

        return $this;
    }

    public function getFirstAuthorLastName(): ?string
    {
        return $this->first_author_last_name;
    }

    public function setFirstAuthorLastName(string $first_author_last_name): self
    {
        $this->first_author_last_name = $first_author_last_name;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function __toString()
    {
        return $this->getFirstAuthorLastName() . ' (' . $this->getYear() . ')';
    }
}
