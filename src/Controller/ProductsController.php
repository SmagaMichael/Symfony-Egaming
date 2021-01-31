<?php

namespace App\Controller;


use App\Entity\OneProduct;
use App\Repository\OneProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     */
    public function index(Request $request, PaginatorInterface $paginator, OneProductRepository $OneProduct):Response
    {
        $Entity = $this->getDoctrine()->getRepository(OneProduct::class);



        //_____________________PAGINATION_______________________________________________________
        // $Entities = $Entity->findAll();
        $Entities = $paginator->paginate(
            $Entity->findAll(),
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );
        //__________________________FIND LAST ID ___________________________________________________________
        $lastProduct = $OneProduct->FindLastId();
        dump($lastProduct);
        //________________________
        $lastProduct = $lastProduct[0];
        dump($lastProduct);
        //_____________________________________________________________________________________



        return $this->render('products/index.html.twig', [
            'Entities' => $Entities,
            'LastProduct' => $lastProduct
        ]);
    }


}
