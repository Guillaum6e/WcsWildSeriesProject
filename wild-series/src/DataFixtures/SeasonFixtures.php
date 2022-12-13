<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    // const SEASONS = [
    //     [
    //         "number" => 1,
    //         "year" => 2010,
    //         "program" => "program_la-rivière-perdue",
    //     ],
    //     [
    //         "number" => 2,
    //         "year" => 2012,
    //         "program" => "program_la-rivière-perdue",
    //     ],
    //     [
    //         "number" => 1,
    //         "year" => 1995,
    //         "program" => "program_pokemon",
    //     ],
    //     [
    //         "number" => 1,
    //         "year" => 2008,
    //         "program" => "program_after-porn-ends-trois",
    //     ],
    //     [
    //         "number" => 1,
    //         "year" => 2005,
    //         "program" => "program_cent-pourcents-loup",
    //     ],
    //     [
    //         "number" => 1,
    //         "year" => 1997,
    //         "program" => "program_barbie",
    //     ],
    // ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 1; $i < 20; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                $season = new Season();
                $season->setnumber($j);
                $season->setYear($faker->year());
                $season->setProgram($this->getReference('program_' . $i));
                $manager->persist($season);
                $this->addReference('program_' . $i . '-season_' . $j, $season);
            };
        };
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont SeasonFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}
