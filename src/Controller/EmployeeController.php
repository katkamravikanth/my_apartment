<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    #[Route('/employee/dashboard', name: 'employee_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('employee/dashboard.html.twig');
    }
}