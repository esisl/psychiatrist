<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DbTestController extends AbstractController
{
    #[Route('/db/test', name: 'app_db_test')]
    public function index(): Response
    {
	return new Response('<h1>Works!</h1>');
        //return $this->render('db_test/index.html.twig', [
        //    'controller_name' => 'DbTestController',
        //]);
    }
}
