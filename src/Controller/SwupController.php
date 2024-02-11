<?php

namespace App\Controller;

use App\Service\UxPackageRepository;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\StimulusBundle\Ux\UxPackageMetadata;

class SwupController extends AbstractController
{
    #[Route('/swup/{page<\d+>}', name: 'app_swup')]
    public function __invoke(UxPackageMetadata $packageRepository, int $page = 1): Response
    {
        $package = $packageRepository->find('swup');

        $pagerfanta = Pagerfant::createForCurrentPageWithMaxPerPage(
            new ArrayAdapter($packageRepository->findAll()),
            $page,
            4
        );

        return $this->render('ux_packages/swup.html.twig', [
            'package' => $package,
            'pager' => $pagerfanta,
        ]);
    }
}
