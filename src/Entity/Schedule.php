<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScheduleRepository::class)]
class Schedule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $day = null;

    #[ORM\Column(nullable: true)]
    private ?string $openingTimeMorning = null;

    #[ORM\Column(nullable: true)]
    private ?string $closingTimeMorning = null;

    #[ORM\Column(nullable: true)]
    private ?string $openingTimeEvening = null;

    #[ORM\Column(nullable: true)]
    private ?string $closingTimeEvening = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get the value of openingTimeMorning
     */
    public function getopeningTimeMorning()
    {
        return $this->openingTimeMorning;
    }

    /**
     * Set the value of openingTimeMorning
     *
     * @return  self
     */
    public function setopeningTimeMorning($openingTimeMorning)
    {
        $this->openingTimeMorning = $openingTimeMorning;

        return $this;
    }

    /**
     * Get the value of closingTimeMorning
     */
    public function getclosingTimeMorning()
    {
        return $this->closingTimeMorning;
    }

    /**
     * Set the value of closingTimeMorning
     *
     * @return  self
     */
    public function setclosingTimeMorning($closingTimeMorning)
    {
        $this->closingTimeMorning = $closingTimeMorning;

        return $this;
    }

    /**
     * Get the value of openingTimeEvening
     */
    public function getopeningTimeEvening()
    {
        return $this->openingTimeEvening;
    }

    /**
     * Set the value of openingTimeEvening
     *
     * @return  self
     */
    public function setOpeningTimeEvening($openingTimeEvening)
    {
        $this->openingTimeEvening = $openingTimeEvening;

        return $this;
    }

    /**
     * Get the value of closingTimeEvening
     */
    public function getClosingTimeEvening()
    {
        return $this->closingTimeEvening;
    }

    /**
     * Set the value of closingTimeEvening
     *
     * @return  self
     */
    public function setclosingTimeEvening($closingTimeEvening)
    {
        $this->closingTimeEvening = $closingTimeEvening;

        return $this;
    }
    public function __toString()
    {
        return (string) $this->day;
        
    }
   
}
