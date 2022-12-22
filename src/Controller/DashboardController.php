<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('admin/dashboard', name: 'app_dashboard_admin')]
    public function index(): Response
    {
        return $this->render('dashboard/admin.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
     #[Route('formateur/dashboard', name: 'app_dashboard_formateur')]
    public function formateur(): Response
    {
        return $this->render('dashboard/formateur.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

}
