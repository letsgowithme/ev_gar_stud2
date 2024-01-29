<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


#[UniqueEntity('title')]
#[ORM\Entity(repositoryClass: CarRepository::class)]
#[Vich\Uploadable]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 100)]
    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    #[Assert\Length(min: 1, max: 100, maxMessage: "Le nom est trop long")]
    private ?string $title = null;

    #[Vich\UploadableField(mapping: 'car_images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $imageName = null;

    #[ORM\Column(type: "integer", length: 4)]
    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    private ?int $year = null;

    #[ORM\Column(type: "integer")]
    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    #[Assert\Length(min: 1, max: 6)]
    private ?int $km = null;

    #[ORM\Column(type: "string", length: 50)]
    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    private ?string $fuelType = null;

    #[ORM\Column(type: "integer")]
    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    private ?int $price = null;

    #[ORM\Column(type: "string", length: 30)]
    #[Assert\NotBlank(message: "Ce champ ne doit pas être vide")]
    private ?string $color = null;
    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: Equipment::class)]
    private Collection $equipments;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\ManyToMany(targetEntity: CarOption::class, inversedBy: 'cars')]
    private Collection $carOptions;
    
    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $length = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $width = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $height = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $weight = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $priceMin = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $priceMax = null;

    #[Assert\Count(
        min: 0,
        max: 3,
        minMessage: 'Vous pouvez ajouter les images plutard',
        maxMessage: 'Vous ne pouvez pas ajouter plus que 3 images',
    )]
    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Images::class,  cascade: ['persist', 'remove'])]
    private Collection $images;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Contact::class)]
    private Collection $contacts;

    public function __construct(){
        $this->updatedAt = new \DateTimeImmutable();
        $this->equipments = new ArrayCollection();
        $this->carOptions = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->images = new ArrayCollection();
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $ImageFile = null): void
    {
        $this->imageFile = $ImageFile;

        if (null !== $ImageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): static
    {
        $this->km = $km;

        return $this;
    }

    public function getFuelType(): ?string
    {
        return $this->fuelType;
    }

    public function setFuelType(string $fuelType): static
    {
        $this->fuelType = $fuelType;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }


    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get the value of updatedAt
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @return  self
     */ 
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    
/**
     * @return Collection<int, Equipment>
     */
    public function getEquipments(): Collection
    {
        return $this->equipments;
    }

    public function addEquipment(Equipment $equipment): self
    {
        if (!$this->equipments->contains($equipment)) {
            $this->equipments->add($equipment);
        }

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, CarOption>
     */
    public function getCarOptions(): Collection
    {
        return $this->carOptions;
    }

    public function addOption(CarOption $carOption): static
    {
        if (!$this->carOptions->contains($carOption)) {
            $this->carOptions->add($carOption);
        }

        return $this;
    }

    public function removeCarOption(carOption $carOption): static
    {
        $this->carOptions->removeElement($carOption);

        return $this;
    }
   
    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(?int $length): static
    {
        $this->length = $length;

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): static
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getPriceMin(): ?int
    {
        return $this->priceMin;
    }

    public function setPriceMin(?int $priceMin): static
    {
        $this->priceMin = $priceMin;

        return $this;
    }

    public function getPriceMax(): ?int
    {
        return $this->priceMax;
    }

    public function setPriceMax(?int $priceMax): static
    {
        $this->priceMax = $priceMax;

        return $this;
    }


    /**
     * @return Collection<int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }
    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setCar($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getCar() === $this) {
                $contact->setCar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setCar($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getCar() === $this) {
                $image->setCar(null);
            }
        }

        return $this;
    }

    // /**
    //  * @return Collection<int, Contact>
    //  */
    // public function getContacts(): Collection
    // {
    //     return $this->contacts;
    // }

    // public function addContact(Contact $contact): static
    // {
    //     if (!$this->contacts->contains($contact)) {
    //         $this->contacts->add($contact);
    //         // $contact->setCar($this);
    //     }

    //     return $this;
    // }

    // public function removeContact(Contact $contact): static
    // {
    //     if ($this->contacts->removeElement($contact)) {
    //         // set the owning side to null (unless already changed)
    //         if ($contact->getCar() === $this) {
    //             $contact->setCar(null);
    //         }
    //     }

    //     return $this;
    // }

  

     

}
