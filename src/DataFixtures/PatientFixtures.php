<?php

namespace App\DataFixtures;

use App\Entity\Patient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Types\DateType;
use Doctrine\Persistence\ObjectManager;

class PatientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1;$i<=10;$i++)
{
$patient=new Patient();
$patient->setNom("Foulen")
->setPrenom("Ben Foulen")
->setDateDeNaissance(\DateTime::createFromFormat('Y-m-d', "2002-07-05"))
->setAdresse("05 rue Tunis")
->setNumTelephone(52456789);
$manager->persist($patient);
}
$manager->flush();
    }
}
