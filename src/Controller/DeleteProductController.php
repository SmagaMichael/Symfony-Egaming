<?php

namespace App\Controller;

use App\Entity\OneProduct;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteProductController extends AbstractController
{
    /**
     * @Route("/products/supprimer/{id}", name="delete_product")
     */
    public function delete(OneProduct $OneProduct): Response
    {
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($OneProduct);
      $entityManager->flush();

      $this->addFlash('danger', 'Votre produit a bien été supprimé');
      return $this->redirecttoRoute('products');
    }
}
