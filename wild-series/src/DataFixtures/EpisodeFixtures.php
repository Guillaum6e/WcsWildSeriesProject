<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        [
            "number" => 1,
            "title" => '2010',
            "program" => "program_la-rivière-perdue_season_1",
        ],
        [
            "number" => 2,
            "title" => '2011',
            "program" => "program_la-rivière-perdue_season_1",
        ],
        [
            "number" => 1,
            "title" => '1995',
            "program" => "program_pokemon_season_1",
        ],
        [
            "number" => 1,
            "title" => '2008',
            "program" => "program_after-porn-ends-trois_season_1",
        ],
        [
            "number" => 1,
            "title" => '2005',
            "program" => "program_cent-pourcents-loup_season_1",
        ],
        [
            "number" => 1,
            "title" => '2005',
            "program" => "program_barbie_season_1",
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $key => $ep) {
            $episode = new Episode();
            $episode->setnumber($ep['number']);
            $episode->setTitle($ep['date']);
            $episode->setSeason($this->getReference($ep['program']));
            $manager->persist($episode);
        };
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont EpisodeFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}
