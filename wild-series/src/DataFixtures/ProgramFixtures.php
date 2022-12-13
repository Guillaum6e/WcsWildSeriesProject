<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    // const PROGRAMS = [
    //     [
    //         'title' => 'La Rivière perdue',
    //         'slug' => 'la-rivière-perdue',
    //         'synopsis' => 'Une ancienne documentariste, Erica Shaw, est engagée pour réaliser un documentaire sur un multimillionnaire mourant,
    //              Campbell Bradford. Cependant, le passé de Campbell est entouré de mystère, ce qui amène Shaw à 
    //              faire des découvertes choquantes dans sa quête de la vérité qui la conduit, par ailleurs, dans sa ville natale.',
    //         'poster' => 'https://www.themoviedb.org/t/p/w600_and_h900_bestv2/bfySFj0ylE4SNxWE2gP666mZPpX.jpg',
    //         'category' => 'category_Horreur',
    //     ],
    //     [
    //         'title' => 'Barbie : L’aventure de princesse',
    //         'slug' => 'barbie',
    //         'synopsis' => "L'aventure commence lorsque Barbie et ses amis se rendent dans le pays de Floravie pour rencontrer la princesse Amelia, qui ressemble beaucoup à Barbie.
    //          La princesse Amelia est nerveuse à l'idée de devenir reine, alors elle élabore un plan pour échanger sa place avec Barbie. Leur secret est bien gardé jusqu'à ce qu'un prince rival découvre la vérité.",
    //         'poster' => 'https://www.themoviedb.org/t/p/w600_and_h900_bestv2/AwkmMTKJBAatbeAVhTwhcU3Pyp4.jpg',
    //         'category' => 'category_Animation',
    //     ],
    //     [
    //         'title' => 'Pokémon 2 : Le pouvoir est en toi',
    //         'slug' => 'pokemon',
    //         'synopsis' => "Sacha, Ondine et Jacky arrivent sur l'île de Shamouti. Les habitants leur parlent d'une légende où trois oiseaux mythiques, Artikodin, Électhor et Sulfura,
    //          règnent sur leur île respective. Au même moment Gelardan, un collectionneur Pokémon, capture les oiseaux pour sa collection personnelle et modifie donc le climat naturel de la Terre pour faire apparaître le Gardien des Abysses, Lugia.",
    //         'poster' => 'https://www.themoviedb.org/t/p/w600_and_h900_bestv2/r9uVYK7MNBTkREv0caUMRKB2IkY.jpg',
    //         'category' => 'category_Aventure',
    //     ],
    //     [
    //         'title' => 'After Porn Ends 3',
    //         'slug' => 'after-porn-ends-trois',
    //         'synopsis' => "Le troisième volet de cette série documentaire se penche sur la vie des plus grandes stars du cinéma pour adultes une fois leur carrière terminée.",
    //         'poster' => 'https://www.themoviedb.org/t/p/w600_and_h900_bestv2/9goN8D3NkigiUfNtyW2rh1uordZ.jpg',
    //         'category' => 'category_Documentaire',
    //     ],
    //     [
    //         'title' => '100% loup',
    //         'slug' => 'cent-pourcents-loup',
    //         'synopsis' => "Freddy Lupin et sa famille cachent depuis des siècles un grand secret. Le jour, ils sont des humains ordinaires. Mais dès la tombée de la nuit, ils deviennent des loups‐garous !",
    //         'poster' => 'https://www.themoviedb.org/t/p/w600_and_h900_bestv2/pzaQuKvFsL82kRkpHZWNaVeZqhf.jpg',
    //         'category' => 'category_Animation',
    //     ],
    // ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 1; $i < 20; $i++) {
            $program = new Program();
            $program->setTitle($faker->words($faker->numberBetween(1, 5), true));
            $program->setSynopsis($faker->paragraphs($faker->numberBetween(1, 3), true));
            $program->setPoster($faker->imageUrl(400, 600));
            $program->setCategory($this->getReference('category_' . $faker->numberBetween(0, 6)));
            $manager->persist($program);
            $this->addReference('program_' . $i, $program);
        };
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
