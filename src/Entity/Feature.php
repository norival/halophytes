<?php

namespace App\Entity;

use App\Repository\FeatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FeatureRepository::class)
 */
class Feature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $data_type;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $unit;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=SpeciesFeature::class, mappedBy="feature")
     */
    private $speciesFeatures;

    public function __construct()
    {
        $this->speciesFeatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDataType(): ?string
    {
        return $this->data_type;
    }

    public function setDataType(string $data_type): self
    {
        $this->data_type = $data_type;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
            $speciesFeature->setFeature($this);
        }

        return $this;
    }

    public function removeSpeciesFeature(SpeciesFeature $speciesFeature): self
    {
        if ($this->speciesFeatures->contains($speciesFeature)) {
            $this->speciesFeatures->removeElement($speciesFeature);
            // set the owning side to null (unless already changed)
            if ($speciesFeature->getFeature() === $this) {
                $speciesFeature->setFeature(null);
            }
        }

        return $this;
    }
}
