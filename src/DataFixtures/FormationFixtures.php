<?php

namespace App\DataFixtures;

use App\Entity\Formation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class FormationFixtures extends Fixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create("fr_FR");
        $promotion = new Formation();
        $promotion->setNom("site");
        $promotion->setDuree("3 moi");
        $promotion->setDuree("3 moi");
        $promotion->setDescription($faker->text);
        $manager->persist($promotion);
        $promotion = new Formation();
        $promotion->setNom("site");
        $promotion->setDuree("3 moi");
        $promotion->setDescription($faker->text);
        $manager->persist($promotion);
        $promotion = new Formation();
        $promotion->setNom("site");
        $promotion->setDuree("3 moi");
        $promotion->setDescription($faker->text);
        $manager->persist($promotion);


        $manager->flush();

    }

    public function getOrder()
    {
        return 2;
    }
}
