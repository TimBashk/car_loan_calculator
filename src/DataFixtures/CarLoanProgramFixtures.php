<?php

namespace App\DataFixtures;

use App\Entity\PaymentProgram;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarLoanProgramFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist((new PaymentProgram())->setAlias('less_300_less_3')->setInterestRate(24)->setTitle('До300До3'));
        $manager->persist((new PaymentProgram())->setAlias('less_500_less_3')->setInterestRate(25)->setTitle('До500До3'));
        $manager->persist((new PaymentProgram())->setAlias('less_1000_less_3')->setInterestRate(26)->setTitle('До500До3'));
        $manager->persist((new PaymentProgram())->setAlias('less_300_more_3')->setInterestRate(21)->setTitle('До300От3'));
        $manager->persist((new PaymentProgram())->setAlias('less_500_more_3')->setInterestRate(22)->setTitle('До500От3'));
        $manager->persist((new PaymentProgram())->setAlias('less_1000_more_3')->setInterestRate(23)->setTitle('До1000От3'));
        $manager->persist((new PaymentProgram())->setAlias('default_program')->setInterestRate(27)->setTitle('Стандарт'));

        $manager->flush();
    }
}