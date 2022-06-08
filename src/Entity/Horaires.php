<?php

namespace App\Entity;

use App\Repository\HorairesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HorairesRepository::class)]
class Horaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $jourPremierEntrainement;

    #[ORM\Column(type: 'time')]
    private $debutPremierEntrainement;

    #[ORM\Column(type: 'time')]
    private $finPremierEntrainement;

    #[ORM\Column(type: 'string', length: 255)]
    private $jourDeuxiemeEntrainement;

    #[ORM\Column(type: 'time')]
    private $debutDeuxiemeEntrainement;

    #[ORM\Column(type: 'time')]
    private $finDeuxiemeEntrainement;

    #[ORM\Column(type: 'boolean')]
    private $deuxiemeEntrainementExiste;

    #[ORM\Column(type: 'string', length: 255)]
    private $jourEnfantsEntrainement;

    #[ORM\Column(type: 'time')]
    private $debutEnfantsEntrainement;

    #[ORM\Column(type: 'time')]
    private $finEnfantsEntrainement;

    #[ORM\Column(type: 'boolean')]
    private $enfantsEntrainementExiste;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJourPremierEntrainement(): ?string
    {
        return $this->jourPremierEntrainement;
    }

    public function setJourPremierEntrainement(string $jourPremierEntrainement): self
    {
        $this->jourPremierEntrainement = $jourPremierEntrainement;

        return $this;
    }

    public function getDebutPremierEntrainement(): ?\DateTimeInterface
    {
        return $this->debutPremierEntrainement;
    }

    public function setDebutPremierEntrainement(\DateTimeInterface $debutPremierEntrainement): self
    {
        $this->debutPremierEntrainement = $debutPremierEntrainement;

        return $this;
    }

    public function getFinPremierEntrainement(): ?\DateTimeInterface
    {
        return $this->finPremierEntrainement;
    }

    public function setFinPremierEntrainement(\DateTimeInterface $finPremierEntrainement): self
    {
        $this->finPremierEntrainement = $finPremierEntrainement;

        return $this;
    }

    public function getJourDeuxiemeEntrainement(): ?string
    {
        return $this->jourDeuxiemeEntrainement;
    }

    public function setJourDeuxiemeEntrainement(string $jourDeuxiemeEntrainement): self
    {
        $this->jourDeuxiemeEntrainement = $jourDeuxiemeEntrainement;

        return $this;
    }

    public function getDebutDeuxiemeEntrainement(): ?\DateTimeInterface
    {
        return $this->debutDeuxiemeEntrainement;
    }

    public function setDebutDeuxiemeEntrainement(\DateTimeInterface $debutDeuxiemeEntrainement): self
    {
        $this->debutDeuxiemeEntrainement = $debutDeuxiemeEntrainement;

        return $this;
    }

    public function getFinDeuxiemeEntrainement(): ?\DateTimeInterface
    {
        return $this->finDeuxiemeEntrainement;
    }

    public function setFinDeuxiemeEntrainement(\DateTimeInterface $finDeuxiemeEntrainement): self
    {
        $this->finDeuxiemeEntrainement = $finDeuxiemeEntrainement;

        return $this;
    }

    public function getDeuxiemeEntrainementExiste(): ?bool
    {
        return $this->deuxiemeEntrainementExiste;
    }

    public function setDeuxiemeEntrainementExiste(bool $deuxiemeEntrainementExiste): self
    {
        $this->deuxiemeEntrainementExiste = $deuxiemeEntrainementExiste;

        return $this;
    }

    public function getJourEnfantsEntrainement(): ?string
    {
        return $this->jourEnfantsEntrainement;
    }

    public function setJourEnfantsEntrainement(string $jourEnfantsEntrainement): self
    {
        $this->jourEnfantsEntrainement = $jourEnfantsEntrainement;

        return $this;
    }

    public function getDebutEnfantsEntrainement(): ?\DateTimeInterface
    {
        return $this->debutEnfantsEntrainement;
    }

    public function setDebutEnfantsEntrainement(\DateTimeInterface $debutEnfantsEntrainement): self
    {
        $this->debutEnfantsEntrainement = $debutEnfantsEntrainement;

        return $this;
    }

    public function getFinEnfantsEntrainement(): ?\DateTimeInterface
    {
        return $this->finEnfantsEntrainement;
    }

    public function setFinEnfantsEntrainement(\DateTimeInterface $finEnfantsEntrainement): self
    {
        $this->finEnfantsEntrainement = $finEnfantsEntrainement;

        return $this;
    }

    public function getEnfantsEntrainementExiste(): ?bool
    {
        return $this->enfantsEntrainementExiste;
    }

    public function setEnfantsEntrainementExiste(bool $enfantsEntrainementExiste): self
    {
        $this->enfantsEntrainementExiste = $enfantsEntrainementExiste;

        return $this;
    }
}
