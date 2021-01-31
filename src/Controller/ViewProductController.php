<?php

namespace App\Controller;

use App\Entity\OneProduct;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewProductController extends AbstractController
{
    /**
     * @Route("/view/product/{slug}_{id}", name="view_product")
     */
    public function index(OneProduct $oneProduct): Response
    {
        return $this->render('view_product/index.html.twig', [
            'OneProduct' => $oneProduct
        ]);
    }
}
