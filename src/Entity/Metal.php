<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Repository\MetalRepository;
use App\State\MetalPriceProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetalRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/metal/{symbol}/spot',
            requirements: ['symbol' => '\w+'],
            output: MetalPrice::class,
            provider: MetalPriceProvider::class
        )
    ]
)]
class Metal
{
    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private ?string $symbol = null;

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

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): static
    {
        $this->symbol = $symbol;

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
