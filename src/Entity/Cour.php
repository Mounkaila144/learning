<?php

namespace App\Entity;

use App\Repository\CourRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: CourRepository::class)]
class Cour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'cours', fileNameProperty: 'image')]
    private ?File $imageFile = null;
    #[Vich\UploadableField(mapping: 'fichier', fileNameProperty: 'fichier')]
    private ?File $fichierFile = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $fichier = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Formation $formation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contenue = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
    }

    public function setFichierFile(File $fichier = null)
    {
        $this->fichierFile = $fichier;
    }

    public function __toString(): string
    {
        return $this->nom;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function getFichierFile()
    {
        return $this->fichierFile;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(string $fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    public function getContenue(): ?string
    {
        return $this->contenue;
    }

    public function setContenue(?string $contenue): self
    {
        $this->contenue = $contenue;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
