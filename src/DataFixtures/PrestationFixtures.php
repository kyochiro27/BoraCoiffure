<?php

namespace App\DataFixtures;

use App\Entity\Prestation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PrestationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        for($i=1; $i<=5; $i++)
        {
            $prestation = new Prestation();
            $prestation->setIntitule("Prestation $i")
                        ->setPrice(5)
                        ->setContent("Voici les details de la prestation $i")
                        ->setImage("http://placehold.it/350x150");
            $manager->persist($prestation);
        }
        $manager->flush();
    }
}
