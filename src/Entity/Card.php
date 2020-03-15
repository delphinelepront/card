<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CardRepository")
 */
class Card
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
    private $Attac;

    /**
     * @ORM\Column(type="integer")
     */
    private $SelfDefense;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="Cards")
     */
    private $Maker;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Faction", inversedBy="Card")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Faction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getAttac(): ?string
    {
        return $this->Attac;
    }

    public function setAttac(string $Attac): self
    {
        $this->Attac = $Attac;

        return $this;
    }

    public function getSelfDefense(): ?int
    {
        return $this->SelfDefense;
    }

    public function setSelfDefense(int $SelfDefense): self
    {
        $this->SelfDefense = $SelfDefense;

        return $this;
    }

    public function getMaker(): ?User
    {
        return $this->Maker;
    }

    public function setMaker(?User $Maker): self
    {
        $this->Maker = $Maker;

        return $this;
    }

    public function getFaction(): ?Faction
    {
        return $this->Faction;
    }

    public function setFaction(?Faction $Faction): self
    {
        $this->Faction = $Faction;

        return $this;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

}
