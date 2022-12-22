<?php

namespace App\Service;

use App\Entity\Formation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\TwigFunction;

class nb extends AbstractController
{
    private $em;

    /**
     * @param $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFormationOfFormateur()
    {
        $id=$this->getUser()->getId();
        $a = $this->em->getRepository(Formation::class)->createQueryBuilder('f')
            ->join('f.formateurs','e')
            ->andWhere('e.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getResult();

        return $a;
    }


}