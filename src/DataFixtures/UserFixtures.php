<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;

    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");
        $user = new User();
        $password = $this->hasher->hashPassword($user, '90145781');

        for ($i = 0; $i <= 50; $i++) {
            $user = new User();
            $user->setNom($faker->firstName)
                ->setPassword($password)
                ->setPrenom($faker->lastName)
                ->setEmail($faker->email)
                ->setAdresse($faker->address)
                ->setNaissance(new \DateTime("2022-01-01"))
                ->setImage("image");
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;    }
}