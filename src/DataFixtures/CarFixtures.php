<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\BrandModel;
use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $toyota = (new Brand())->setName('Toyota');
        $manager->persist($toyota);

        $camry = (new BrandModel())
                    ->setBrand($toyota)
                    ->setName('Camry');
        $manager->persist($camry);

        $landCruiser = (new BrandModel())
                    ->setBrand($toyota)
                    ->setName('Land Cruiser 200');
        $manager->persist($landCruiser);

        $car1 = (new Car())->setBrandModel($camry)
                ->setPrice(2500000)
                ->setPhotoLink('photo_src');
        $manager->persist($car1);

        $car2 = (new Car())->setBrandModel($landCruiser)
            ->setPrice(2000000)
            ->setPhotoLink('photo_src');
        $manager->persist($car2);

        $ford = (new Brand())->setName('Ford');
        $manager->persist($ford);

        $mustang = (new BrandModel())
            ->setBrand($ford)
            ->setName('Mustang');
        $manager->persist($mustang);

        $car3 = (new Car())->setBrandModel($mustang)
            ->setPrice(2000000)
            ->setPhotoLink('photo_src');
        $manager->persist($car3);

        $manager->flush();
    }
}