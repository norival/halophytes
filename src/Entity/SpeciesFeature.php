<?php

namespace App\Entity;

use App\Repository\SpeciesFeatureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpeciesFeatureRepository::class)
 */
class SpeciesFeature
{
    const STATE_NEEDS_REVIEW = 0;
    const STATE_PUBLISHED    = 1;
    const STATE_REJECTED     = 2;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Species::class, inversedBy="speciesFeatures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $species;

    /**
     * @ORM\ManyToOne(targetEntity=Feature::class, inversedBy="speciesFeatures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $feature;

    /**
     * @ORM\Column(type="smallint")
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="speciesFeatures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="speciesFeatures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     */
    private $value_min;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     */
    private $value_max;

    /**
     * @ORM\Column(type="boolean")
     */
    private $range_value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getSpecies(): ?Species
    {
        return $this->species;
    }

    public function setSpecies(?Species $species): self
    {
        $this->species = $species;

        return $this;
    }

    public function getFeature(): ?Feature
    {
        return $this->feature;
    }

    public function setFeature(?Feature $feature): self
    {
        $this->feature = $feature;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(?int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getValueMin(): ?string
    {
        return $this->value_min;
    }

    public function setValueMin(?string $value_min): self
    {
        $this->value_min = $value_min;

        return $this;
    }

    public function getValueMax(): ?string
    {
        return $this->value_max;
    }

    public function setValueMax(?string $value_max): self
    {
        $this->value_max = $value_max;

        return $this;
    }

    public function getRangeValue(): ?bool
    {
        return $this->range_value;
    }

    public function setRangeValue(bool $range_value): self
    {
        $this->range_value = $range_value;

        return $this;
    }
}
