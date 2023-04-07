<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Users;
use App\Entity\Posts;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");

        for ($i = 0; $i < 1500; $i++){
            $user = new Users();
            $user->setUsername($faker->words(1, true));
            $user->setFirstName($faker->words(1, true));
            $user->setLastName($faker->words(1, true));
            $user->setEmail($faker->words(1, true));

            for ($y = 0; $y < 10; $y++){
                $post = new Posts();
                $post->setUserId($user);
                $post->setContent($faker->realText(60));
    
                $manager->persist($post);
    
            }

            $manager->persist($user);

        }

        $manager->flush();
    }
}
