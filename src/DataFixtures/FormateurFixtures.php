<?php

namespace App\DataFixtures;

use App\Entity\Formateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class FormateurFixtures extends Fixture implements OrderedFixtureInterface
{
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;

    }

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create("fr_FR");
        $formateur = new Formateur();
        $password = $this->hasher->hashPassword($formateur, '90145781');

        $formateur->setNom('moubkaila')
            ->setPassword($password)
            ->setPrenom('Boubacar')
            ->setEmail('Admin@gmail.com')
            ->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($formateur);

        for ($i = 0; $i <= 50; $i++) {
            $formateur = new Formateur();
            $formateur->setNom($faker->firstName)
                ->setPassword($password)
                ->setPrenom($faker->lastName)
                ->setEmail($faker->email);
            $manager->persist($formateur);
        }
        $manager->flush();

    }

    public function getOrder()
    {
        return 4;
    }
}
