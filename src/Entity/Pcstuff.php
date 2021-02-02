<?php

namespace App\Entity;

use App\Repository\PcstuffRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PcstuffRepository::class)
 */
class Pcstuff
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
     * @ORM\OneToMany(targetEntity=OneProduct::class, mappedBy="pcstuff", orphanRemoval=true)
     */
    private $oneProducts;

    public function __construct()
    {
        $this->oneProducts = new ArrayCollection();
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

    /**
     * @return Collection|OneProduct[]
     */
    public function getOneProducts(): Collection
    {
        return $this->oneProducts;
    }

    public function addOneProduct(OneProduct $oneProduct): self
    {
        if (!$this->oneProducts->contains($oneProduct)) {
            $this->oneProducts[] = $oneProduct;
            $oneProduct->setPcstuff($this);
        }

        return $this;
    }

    public function removeOneProduct(OneProduct $oneProduct): self
    {
        if ($this->oneProducts->removeElement($oneProduct)) {
            // set the owning side to null (unless already changed)
            if ($oneProduct->getPcstuff() === $this) {
                $oneProduct->setPcstuff(null);
            }
        }

        return $this;
    }
}
