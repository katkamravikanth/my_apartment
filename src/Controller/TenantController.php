<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TenantController extends AbstractController
{
    #[Route('/tenant/dashboard', name: 'tenant_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('tenant/dashboard.html.twig');
    }
}