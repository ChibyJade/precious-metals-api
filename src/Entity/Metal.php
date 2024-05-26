<?php

namespace App\Entity;

use App\Repository\MetalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetalRepository::class)]
class Metal
{
    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private ?string $ISO4217Code = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, MetalPrice>
     */
    #[ORM\OneToMany(targetEntity: MetalPrice::class, mappedBy: 'metal')]
    private Collection $metalPrices;

    public function __construct()
    {
        $this->metalPrices = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getISO4217Code(): ?string
    {
        return $this->ISO4217Code;
    }

    public function setISO4217Code(string $ISO4217Code): static
    {
        $this->ISO4217Code = $ISO4217Code;

        return $this;
    }

    /**
     * @return Collection<int, MetalPrice>
     */
    public function getMetalPrices(): Collection
    {
        return $this->metalPrices;
    }

    public function addMetalPrice(MetalPrice $metalPrice): static
    {
        if (!$this->metalPrices->contains($metalPrice)) {
            $this->metalPrices->add($metalPrice);
            $metalPrice->setMetal($this);
        }

        return $this;
    }

    public function removeMetalPrice(MetalPrice $metalPrice): static
    {
        if ($this->metalPrices->removeElement($metalPrice)) {
            // set the owning side to null (unless already changed)
            if ($metalPrice->getMetal() === $this) {
                $metalPrice->setMetal(null);
            }
        }

        return $this;
    }
}
