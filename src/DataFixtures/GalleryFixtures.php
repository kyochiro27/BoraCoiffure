<?php

namespace App\DataFixtures;

use App\Entity\Gallery;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GalleryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for($i=1; $i<=12; $i++){
            $image = new Gallery();
            $image->setSrc("https://placehold.it/400x300")
                  ->setAlt("Image $i");
            $manager->persist($image);
        }
        $manager->flush();
    }
}
