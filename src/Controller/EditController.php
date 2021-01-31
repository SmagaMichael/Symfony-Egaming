<?php

namespace App\Controller;

use App\Entity\OneProduct;
use App\Form\AddProductFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditController extends AbstractController
{
    /**
     * @Route("/products/modifier/{id}", name="edit")
     */
    public function edit( OneProduct $OneProduct): Response
    {
        $form = $this->createForm(AddProductFormType::class, $OneProduct);


        return $this->render('edit/index.html.twig', [
            'AddProductFormType' => $form->createView(),
            'OneProduct' => $OneProduct,
        ]);
    }
}
