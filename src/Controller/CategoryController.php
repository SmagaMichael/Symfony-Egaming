<?php

namespace App\Controller;

use App\Entity\OneProduct;
use App\Repository\PcstuffRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="category")
     */
    public function index($id, Request $request, PcstuffRepository $PcstuffRepository): Response
    {
        //la on appelle la table OneProduct
        $repository = $this->getDoctrine()->getRepository(OneProduct::class);
        //je veux les produits qui on l'id que je veux
        $products = $repository->FindStuff($id);

        $category = $PcstuffRepository->findAll();


        return $this->render('category/index.html.twig', [
            'products' => $products,
            'categories' => $category,
        ]);
    }
}
