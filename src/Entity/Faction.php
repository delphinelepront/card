<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FactionRepository")
 */
class Faction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Card", mappedBy="Faction")
     */
    private $Card;

    public function __construct()
    {
        $this->Card = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection|Card[]
     */
    public function getCard(): Collection
    {
        return $this->Card;
    }

    public function addCard(Card $card): self
    {
        if (!$this->Card->contains($card)) {
            $this->Card[] = $card;
            $card->setFaction($this);
        }

        return $this;
    }

    public function removeCard(Card $card): self
    {
        if ($this->Card->contains($card)) {
            $this->Card->removeElement($card);
            // set the owning side to null (unless already changed)
            if ($card->getFaction() === $this) {
                $card->setFaction(null);
            }
        }

        return $this;
    }
}
