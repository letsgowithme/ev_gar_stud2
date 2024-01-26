<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 50)]
    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    #[Assert\Length(min: 1, max: 50, maxMessage: "Le sujet est trop long")]
    private ?string $subject = null;

   
    #[ORM\Column(type: "text", length: 255)]
    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    #[Assert\Length(min: 1, max: 255, maxMessage: "Le message est trop long")]
    private ?string $content = null;

    #[ORM\Column(type: "string", length: 50)]
    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    #[Assert\Length(min: 1, max: 50, maxMessage: "Le nom est trop long")]
    private ?string $commentator = null;

    #[ORM\Column(type: "integer")]
    #[Assert\NotBlank(message: "Veuillez mettre la note")]
    private ?int $mark = null;


    #[ORM\Column(type: "boolean")]
    private ?bool $isApproved = null;

   
    public function getId(): ?int
    {
        return $this->id;
    }

 
    /**
     * Get the value of subject
     */ 
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of subject
     *
     * @return  self
     */ 
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function isIsApproved(): ?bool
    {
        return $this->isApproved;
    }

    public function setIsApproved(bool $isApproved): static
    {
        $this->isApproved = $isApproved;

        return $this;
    }
   /**
     * Get the value of commentator
     */ 
    public function getCommentator()
    {
        return $this->commentator;
    }

    /**
     * Set the value of commentator
     *
     * @return  self
     */ 
    public function setCommentator($commentator)
    {
        $this->commentator = $commentator;

        return $this;
    }
   
   

    /**
     * Get the value of mark
     */ 
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set the value of mark
     *
     * @return  self
     */ 
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    public function __toString(): string{
        return (string) $this->subject;
    }

 
}
