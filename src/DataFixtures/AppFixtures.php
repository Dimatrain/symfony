<?php

namespace App\DataFixtures;

use App\Entity\Advert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('ru_RU');

        for ($i = 0; $i < 100; $i++) {
            $advert = new Advert();
            $advert->setName($faker->jobTitle);
            $advert->setText($faker->text);
            $manager->persist($advert);
        }

        $manager->flush();
    }
}
