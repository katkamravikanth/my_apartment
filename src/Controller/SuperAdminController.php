<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuperAdminController extends AbstractController
{
    #[Route('/super-admin/dashboard', name: 'super_admin_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('super_admin/dashboard.html.twig');
    }
}