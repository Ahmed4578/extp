<?php

namespace App\DataFixtures;

use App\Entity\Analyse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnalyseFixture extends Fixture
{

        public function load(ObjectManager $manager): void
    {
        for($i=1;$i<=10;$i++)
{
$analyse=new Analyse();
$analyse->setNom("A1")
->setType("blood")
->setDate(\DateTime::createFromFormat('Y-m-d', "2022-07-05"));
$manager->persist($analyse);
}
$manager->flush();
    }
    }
