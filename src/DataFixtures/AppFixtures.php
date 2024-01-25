<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Equipment;
use App\Entity\Option;
use App\Entity\Schedule;
use App\Entity\Comment;
use App\Entity\Images;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;


    public function  __construct()
    {
        $this->faker = Factory::create('fr_FR');
        
    }
    public function load(ObjectManager $manager): void
    {
         // Users
         $users = [];

         $admin = new User();
         $admin->setLastname('Parrot')
         ->setFirstname('Vincent')
                ->setEmail('v_parrot@garage.fr')
                ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
                ->setPlainPassword('password');

                $users[] = $admin;
            $manager->persist($admin);


         for ($j = 0; $j < 10; $j++) {
            $user = new User();
            $user->setLastname($this->faker->lastName())
                 ->setFirstname($this->faker->firstName())
                 ->setEmail($this->faker->email())
                 ->setRoles(['ROLE_USER'])
                 ->setPlainPassword('password');
             
                $users[] = $user;
            $manager->persist($user);
        }

        // Equipment
        $equipments = [];
        for ($n = 0; $n < 5; $n++) {
            $equipment = new Equipment();
            $equipment->setName($this->faker->word());

            $equipments[] = $equipment;
        $manager->persist($equipment);  
        }

        //Car
        $cars = [];
        for ($i = 0; $i < 5; $i++) {
            $createdAt  = new DateTimeImmutable(); 
            $updatedAt  = new DateTimeImmutable(); 
            $car = new Car();
            $car->setTitle($this->faker->title())
            ->setYear($this->faker->numberBetween(1950, 2023))
            ->setFuelType(mt_rand(0, 1) == 1 ? "Essence" : "Diesel")
            ->setKm($this->faker->numberBetween(10000, 250000))
            ->setPrice($this->faker->numberBetween(1, 100000))
            ->setUpdatedAt($updatedAt)
            ->setColor($this->faker->colorName())
            ->setAuthor($users[mt_rand(0, count($users) - 1)]);
                
            for ($b = 0; $b < mt_rand(0, 5); $b++) {
                    $car->addEquipment($equipments[mt_rand(0, count($equipments) - 1)]);
                 }
                 for($img = 1; $img <= 20; $img++){
                    $image = new Images();
                    $car->addImage($image->setName($this->faker->image(null, 640, 480)));
                  
                }

            $cars[] = $car;
            $manager->persist($car);
        }
           // Contact
           for ($j = 0; $j < 5; $j++) {
            $contact = new Contact();
            $contact->setfullName($this->faker->name())
                ->setEmail($this->faker->email())
                ->setSubject($this->faker->word())
                ->setMessage($this->faker->text())
                ->setPhoneNumber($this->faker->phoneNumber());

            $manager->persist($contact);
        }

        
           //Option
           $options = [];
           for ($n = 0; $n < 5; $n++) {
               $option = new Option();
               $option->setName($this->faker->word());
               
               $options[] = $options;
            $manager->persist($option);
           }
             // Schedule
              $schedules = [];
              for ($n = 0; $n < 7; $n++) {
                  $schedule = new Schedule();
                  $schedule->setDay($this->faker->dayOfWeek())
                  ->setopeningTimeMorning('8:45')
                  ->setclosingTimeMorning('12:00')
                  ->setOpeningTimeEvening('14:00')
                  ->setClosingTimeEvening('18:00');

                  $schedules[] = $schedule;
                $manager->persist($schedule);
              }
        
       
        // Comments
        $comments = [];
        foreach ($comments as $comment) {
        for ($n = 0; $n < 5; $n++) {
            $comment = new Comment();
            $comment->setSubject($this->faker->title())
                     ->setContent($this->faker->text())
                    ->setAuthor($this->faker->name())
                    ->setMark(mt_rand(1, 5))
                    ->setisApproved(mt_rand(0, 1) === 0 ? false : true);

            $manager->persist($comment);
        }
        }        

        $manager->flush();
    }
}
