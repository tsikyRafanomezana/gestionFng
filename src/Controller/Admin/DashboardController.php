<?php

namespace App\Controller\Admin;

use App\Entity\Journal;
use App\Entity\Motif;
use App\Controller\Admin\JournalCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\JournalRepository;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
     private JournalRepository $journalRepository;

    // Symfony injecte le repository ici
    public function __construct(JournalRepository $journalRepository)
    {
        $this->journalRepository = $journalRepository;
    }

    public function index(): Response
    {
        // 👉 Redirection automatique vers la liste des journals
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        /*return $this->redirect(
            $adminUrlGenerator->setController(JournalCrudController::class)->generateUrl()
        );*/
        $totauxParType = $this->journalRepository->getTotalMontantParType();
        $totauxParTypeEtMois = $this->journalRepository->getSoldeParMois();
       //var_dump($totauxParTypeEtMois);die;
        return $this->render('admin/dashboard/index.html.twig',[
            'totalParType'=> $totauxParType,
            'totalParTypeEtMois'=> $totauxParTypeEtMois
        ]);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion budget Fng');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Journals', 'fas fa-list', Journal::class);
        yield MenuItem::linkToCrud('Motifs', 'fas fa-list', Motif::class);
    }
}
