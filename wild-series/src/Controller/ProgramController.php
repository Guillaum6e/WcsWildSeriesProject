<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Entity\Program;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
        ]);
    }

    #[Route('/{id<\d+>}', methods: ['GET'], name: 'show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $id . ' found in program\'s table.'
            );
        };

        $seasons = $program->getSeasons();

        if (!$seasons) {
            throw $this->createNotFoundException(
                'No season for program id : ' . $id . ' found .'
            );
        };

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
        ]);
    }
    #[Route('/program/{programId<\d+>}/seasons/{seasonId<\d+>}', methods: ['GET'], name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepositiry)
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $programId . ' found in program\'s table.'
            );
        };

        $season = $seasonRepositiry->findOneBy(['id' => $seasonId]);

        if (!$season) {
            throw $this->createNotFoundException(
                'No season for season id : ' . $seasonId . ' found .'
            );
        };

        $episodes = $season->getEpisodes();

        if (!$episodes) {
            throw $this->createNotFoundException(
                'No episodes for season id : ' . $seasonId . ' found .'
            );
        };

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes,
        ]);
    }
}
