<?php

namespace App\DataFixtures;

use App\Entity\Cour;
use App\Repository\FormationRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class CourFixtures extends Fixture implements OrderedFixtureInterface
{
    public function __construct(FormationRepository $formationRepository)
    {
        $this->formationRepository = $formationRepository;

    }
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create("fr_FR");
        for ($i = 0; $i <= 50; $i++) {
            $promotion = new Cour();
            $promotion->setNom("site")
                ->setImage("image")
                ->setFichier('fichier')
                ->setFormation($this->formationRepository->find(1));
            $manager->persist($promotion);
        }



        $manager->flush();

    }

    public function getOrder()
    {
        return 3;
    }
}
