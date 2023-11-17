<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Equipment;
use App\Entity\Mark;
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

        //  $admin = new User();
        //  $admin->setLastname('Parrot')
        //  ->setFirstname('Vincent')
        //         ->setEmail('v_parrot@garage.fr')
        //         ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
        //         ->setPlainPassword('password');
             
        //         $users[] = $admin;
        //     $manager->persist($admin);


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
        // $equipments = [];
        // for ($n = 0; $n < 5; $n++) {
        //     $equipment = new Equipment();
        //     $equipment->setName($this->faker->word());
        //     // $car->addCar($cars[mt_rand(0, count($cars) - 1)]);
        //     $equipments[] = $equipment;
        //     $manager->persist($equipment);
        // }

        //Car
        // $cars = [];
        // for ($i = 0; $i < 5; $i++) {
        //     $createdAt  = new DateTimeImmutable(); 
        //     $updatedAt  = new DateTimeImmutable(); 
        //     $car = new Car();
        //     $car->setTitle($this->faker->title())
        //     ->setYear($this->faker->numberBetween(1950, 2023))
        //     ->setFuelType(mt_rand(0, 1) == 1 ? "Essence" : "Diesel")
        //     ->setKm($this->faker->numberBetween(10000, 250000))
        //     ->setPrice($this->faker->numberBetween(1, 100000))
        //     ->setUpdatedAt($updatedAt)
        //     ->setColor($this->faker->colorName())
        //     ->setAuthor($users[mt_rand(0, count($users) - 1)]);
                
        //     for ($b = 0; $b < mt_rand(0, 5); $b++) {
        //             $car->addEquipment($equipments[mt_rand(0, count($equipments) - 1)]);
        //          }
        //          for($img = 1; $img <= 20; $img++){
        //             $image = new Images();
        //             // $image->setName($this->faker->image(null, 640, 480));
        //             $car->addImage($image->setName($this->faker->image(null, 640, 480)));
                    
        //             // $car = $this->getReference('car-'.rand(1, 10));
        //             // $image->setCar($car);
        //             // $manager->persist($image);
        //         }

        //     $cars[] = $car;
        //     $manager->persist($car);
        // }
           // Contact
        //    for ($j = 0; $j < 5; $j++) {
        //     $contact = new Contact();
        //     $contact->setFullname($this->faker->name())
        //         ->setEmail($this->faker->email())
        //         ->setSubject($this->faker->word())
        //         ->setMessage($this->faker->text())
        //         ->setPhoneNumber($this->faker->phoneNumber());

        //     $manager->persist($contact);
        // }

        
           //Option
        //    $options = [];
        //    for ($n = 0; $n < 5; $n++) {
        //        $option = new Option();
        //        $option->setName($this->faker->word());
        //        // $car->addCar($cars[mt_rand(0, count($cars) - 1)]);
        //        $options[] = $options;
        //        $manager->persist($option);
        //    }
             // Schedule
            //   $schedules = [];
            //   for ($n = 0; $n < 7; $n++) {
            //       $schedule = new Schedule();
            //       $schedule->setDay($this->faker->dayOfWeek())
            //       ->setopeningTimeMorning('8:45')
            //       ->setclosingTimeMorning('12:00')
            //       ->setOpeningTimeEvening('14:00')
            //       ->setClosingTimeEvening('18:00');

            //       // $car->addCar($cars[mt_rand(0, count($cars) - 1)]);
            //       $schedules[] = $schedule;
            //       $manager->persist($schedule);
            //   }
        
        //Recipes
        // $recipes = [];
        // for ($j = 0; $j < 5; $j++) {
        //     $recipe = new Recipe();
        //     $recipe->setName($this->faker->word())
        //         ->setDescription($this->faker->text(100))
        //         ->setPreparationTime(mt_rand(1, 1440))
        //         ->setPauseTime(mt_rand(1, 1440))
        //         ->setCookingTime(mt_rand(1, 1440));

        //     for ($k = 0; $k < mt_rand(5, 5); $k++) {
        //         $recipe->addIngredient($ingredients[mt_rand(0, count($ingredients) - 1)]);
        //     }
        //     $recipe->setSteps($this->faker->text(100));

        //     for ($b = 0; $b < mt_rand(0, 5); $b++) {
        //         $recipe->addAllergen($allergens[mt_rand(0, count($allergens) - 1)]);
        //     }
        //     for ($g = 0; $g < mt_rand(0, 5); $g++) {
        //         $recipe->addDiet($diets[mt_rand(0, count($diets) - 1)]);
        //     }
        //     $recipe->setisPublic(mt_rand(0, 1) == 1 ? true : false);
            
        //     // $recipe->addUser($users[mt_rand(0, count($users) - 1)]);

        //     $recipes[] = $recipe;
        //     $manager->persist($recipe);
        // }
        // Comments
        // $comments = [];
        // foreach ($comments as $comment) {
        // for ($n = 0; $n < 5; $n++) {
        //     $comment = new Comment();
        //     $comment->setSubject($this->faker->title())
        //              ->setContent($this->faker->text())
        //             ->setAuthor($this->faker->name())
        //             ->setMark(mt_rand(1, 5))
        //             ->setisApproved(mt_rand(0, 1) === 0 ? false : true)
        //             ;

        //     $manager->persist($comment);
        // }
        // }

        //  // Marks
        //  foreach ($recipes as $recipe) {
        //     for ($i = 0; $i < mt_rand(0, 4); $i++) {
        //         $mark = new Mark();
        //         $mark->setMark(mt_rand(1, 5))
        //             ->setUser($users[mt_rand(0, count($users) - 1)])
        //             ->setRecipe($recipe);

        //         $manager->persist($mark);
        //     }
        // }
          

        $manager->flush();
    }
}
