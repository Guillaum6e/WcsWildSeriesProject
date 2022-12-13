<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    // const EPISODES = [
    //     [
    //         "number" => 1,
    //         "title" => '2010',
    //         "program" => "program_la-rivière-perdue_season_1",
    //     ],
    //     [
    //         "number" => 2,
    //         "title" => '2011',
    //         "program" => "program_la-rivière-perdue_season_1",
    //     ],
    //     [
    //         "number" => 1,
    //         "title" => '1995',
    //         "program" => "program_pokemon_season_1",
    //     ],
    //     [
    //         "number" => 1,
    //         "title" => '2008',
    //         "program" => "program_after-porn-ends-trois_season_1",
    //     ],
    //     [
    //         "number" => 1,
    //         "title" => '2005',
    //         "program" => "program_cent-pourcents-loup_season_1",
    //     ],
    //     [
    //         "number" => 1,
    //         "title" => '2005',
    //         "program" => "program_barbie_season_1",
    //     ],
    // ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 1; $i < 20; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                for ($k = 1; $k < $faker->numberBetween(1, 7); $k++) {
                    $episode = new Episode();
                    $episode->setnumber($k);
                    $episode->setTitle($faker->words($faker->numberBetween(1, 4), true));
                    $episode->setSeason($this->getReference('program_' . $i . '-season_' . $j));
                    $manager->persist($episode);
                };
            };
            $manager->flush();
        };
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont EpisodeFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}
