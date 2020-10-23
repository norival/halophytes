<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use App\Service\CrossrefHelper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $doi;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $meta_data = [];

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

    public function getMetaData(): ?array
    {
        return $this->meta_data;
    }

    public function setMetaData(?array $meta_data): self
    {
        $this->meta_data = $meta_data;

        return $this;
    }

    public function getDoi(): ?string
    {
        return $this->doi;
    }

    public function setDoi(?string $doi): self
    {
        $this->doi = $doi;

        return $this;
    }

    public function getAuthors()
    {
        if (empty($this->meta_data)) {
            return ;
        }

        return $this->meta_data['message']['author'];
    }

    public function getYearPublished()
    {
        if (empty($this->meta_data)) {
            return ;
        }

        return $this->meta_data['message']['author'];
    }

    public function __toString()
    {
        return $this->title;
    }

    /**************************************************************************
     * Lifecylcle doctrine events
     **************************************************************************/

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->created_at = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function parseMetaData(LifecycleEventArgs $args)
    {
        $crossrefHelper = new CrossrefHelper();

        // parse DOI
        $this->doi = $crossrefHelper->parseUrl($this->url);

        if (!$this->doi) {
            $this->meta_data = [];

            return ;
        }

        $this->meta_data = $crossrefHelper->query($this->doi);

        /* TODO
         * If no DOI is found
         *      -> Crawl the web page to find a DOI?
         *      -> Leave meta data blank?
         */
    }
}
