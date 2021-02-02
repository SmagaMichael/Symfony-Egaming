<?php

namespace App\Controller;


use App\Repository\OneProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index( OneProductRepository $OneProductRepository): Response
    {
        //__________________________FIND LAST 4 ID ___________________________________________________________
        $last4Product = $OneProductRepository->FindLastFourID();
        dump($last4Product);

        //_____________________________________________________________________________________

        return $this->render('home/index.html.twig', [
            'Last4ID' => $last4Product,

        ]);
    }
}
