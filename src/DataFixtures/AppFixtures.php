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

        
        for ($i = 0; $i < 10; $i++){
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

        //Problème avec les clés composites

        $posts = $this->getAllPosts($this->entityManager);
        

        print(count($posts));
        //print(count($users));

        foreach($posts as $post ){
            $users = $this->entityManager->getRepository(Users::class)->findAll();        
            for ($z = 0; $z < 10; $z++) {

                $reaction = new Reactions();
                $reaction->setPostId($post);
                $reaction->setUserId(array_pop($users));
                $reaction->setType($this->getRandomReaction());
        
                $manager->persist($reaction);
            }
        }

        
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

private function getRandomReaction(): string
{
    $choices = ['Like', 'Dislike'];
    $randomKey = array_rand($choices);
    return $choices[$randomKey];
}
}
