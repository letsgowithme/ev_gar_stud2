<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Equipment;
use App\Entity\Features;
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
        //  $admin->setLastname('Administrateur')
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
                ->setPassword('password');
             
                $users[] = $user;
            $manager->persist($user);
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
            ->setColor($this->faker->colorName());
            
            $cars[] = $car;
            $manager->persist($car);
        }
           // Contact
           for ($j = 0; $j < 5; $j++) {
            $contact = new Contact();
            $contact->setLastname($this->faker->name())
                ->setEmail($this->faker->email())
                ->setSubject($this->faker->word())
                ->setMessage($this->faker->text())
                ->setPhoneNumber($this->faker->phoneNumber());

            $manager->persist($contact);
        }

        //Equipment
        $equipments = [];
        for ($n = 0; $n < 5; $n++) {
            $equipment = new Equipment();
            $equipment->setName($this->faker->word());
            // $car->addCar($cars[mt_rand(0, count($cars) - 1)]);
            $equipments[] = $equipment;
            $manager->persist($equipment);
        }

        //Features
        $features = [];
        for ($n = 0; $n < 5; $n++) {
            $feature = new Features();
            $feature->setWidth($this->faker->numberBetween(100, 150))
            ->setLength($this->faker->numberBetween(200, 350))
            ->setHeight($this->faker->numberBetween(150, 250))
            ->setWeight($this->faker->numberBetween(1500, 3500))
            ->setPriceMin($this->faker->numberBetween(1000, 15000))

            ->setPriceMax($this->faker->numberBetween(10000, 50000));


             // $car->addCar($cars[mt_rand(0, count($cars) - 1)]);
            $features[] = $feature;
            $manager->persist($feature);
        }
           //Option
           $options = [];
           for ($n = 0; $n < 5; $n++) {
               $option = new Option();
               $option->setName($this->faker->word());
               // $car->addCar($cars[mt_rand(0, count($cars) - 1)]);
               $options[] = $options;
               $manager->persist($option);
           }
              //Schedule
              $schedules = [];
              for ($n = 0; $n < 5; $n++) {
                  $schedule = new Schedule();
                  $schedule->setDay($this->faker->dayOfWeek())
                  ->setOpeningTimeMidday($this->faker->time())
                  ->setClosingTimeMidday($this->faker->time())
                  ->setOpeningTimeEvening($this->faker->time())
                  ->setClosingTimeEvening($this->faker->time());

                  // $car->addCar($cars[mt_rand(0, count($cars) - 1)]);
                  $schedules[] = $schedule;
                  $manager->persist($schedule);
              }
        
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
        //Comments
        // $comments = [];
        // foreach ($recipes as $recipe) {
        // for ($n = 0; $n < 5; $n++) {
        //     $comment = new Comment();
        //     $comment->setContent($this->faker->text())
        //             ->setisApproved(mt_rand(0, 3) === 0 ? false : true)
        //             ->setAuthor($users[mt_rand(0, count($users) - 1)])
        //             ->setRecipe($recipe);

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
