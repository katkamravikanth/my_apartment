<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OwnerController extends AbstractController
{
    #[Route('/owner/dashboard', name: 'owner_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('owner/dashboard.html.twig');
    }
}