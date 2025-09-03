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

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        // 👉 Redirection automatique vers la liste des journals
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        /*return $this->redirect(
            $adminUrlGenerator->setController(JournalCrudController::class)->generateUrl()
        );*/
        return $this->render('admin/dashboard/index.html.twig');
        //return parent::index();
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
