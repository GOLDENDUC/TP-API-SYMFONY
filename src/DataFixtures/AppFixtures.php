<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Users;
use App\Entity\Posts;
use App\Entity\Reactions;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;


class AppFixtures extends Fixture
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");

        //----------------------------------------------

        
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

        //----------------------------------------------

        /* Problème avec les clés composites

        $posts = $this->getAllPosts($this->entityManager);
        $users = $this->entityManager->getRepository(Users::class)->findAll();

        print(count($posts));
        print(count($users));

        foreach($posts as $post ){

            for ($z = 0; $z < 10; $z++) {
                $randomKey = array_rand($users);
                //var_dump($users);
                $randomUser = $users[$randomKey];
                $reaction = new Reactions();
                $reaction->setPostId($post);
                $reaction->setUserId($randomUser);
                $reaction->setType("Dems");
        
                $manager->persist($reaction);
            }
        }

        */
        
        //----------------------------------------------

        $manager->flush();
    }

    private function getRandomUser(EntityManagerInterface $entityManager): Users
{
    $users = $entityManager->getRepository(Users::class)->findAll();
    $randomKey = array_rand($users);

    return $users[$randomKey];
}

private function getAllPosts(EntityManagerInterface $entityManager): Array
{
    $posts = $entityManager->getRepository(Posts::class)->findAll();

    return $posts;
}
}
