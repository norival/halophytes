<?php

namespace App\Entity;

use App\Repository\StateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StateRepository::class)
 */
class State
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=SpeciesFeature::class, mappedBy="state")
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
            $speciesFeature->setState($this);
        }

        return $this;
    }

    public function removeSpeciesFeature(SpeciesFeature $speciesFeature): self
    {
        if ($this->speciesFeatures->contains($speciesFeature)) {
            $this->speciesFeatures->removeElement($speciesFeature);
            // set the owning side to null (unless already changed)
            if ($speciesFeature->getState() === $this) {
                $speciesFeature->setState(null);
            }
        }

        return $this;
    }
}
