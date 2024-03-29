<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    #[Assert\Length(min: 1, max: 50)]
    private ?string $fullName = null;

    #[ORM\Column(type: 'string', length: 180)]
    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    #[Assert\Email()]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\Length(min: 1, max: 50)]
    private ?string $subject = null;

    #[ORM\Column(type: 'text', length: 300)]
    #[Assert\Length(min: 1, max: 300, maxMessage: "Le message est trop long")]
    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    private ?string $message = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    #[Assert\Regex(
        pattern: "/^0[1-9]\d{8}$/",
    )]
    private ?string $phoneNumber = null;

    #[ORM\ManyToOne(inversedBy: 'contacts')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?Car $car = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    } 
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * Get the value of fullName
     */ 
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set the value of fullName
     *
     * @return  self
     */ 
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): static
    {
        $this->car = $car;

        return $this;
    }
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

  

}
