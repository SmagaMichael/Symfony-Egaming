<?php

namespace App\Controller;


use App\Entity\OneProduct;
use App\Repository\OneProductRepository;
use App\Repository\PcstuffRepository;
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
    public function index(Request $request,
                          PaginatorInterface $paginator,
                          OneProductRepository $OneProduct,
                          PcstuffRepository $pcstuffRepository):Response
    {
     //   On crée la variable $Entity pour y stocker l’entité que l’on a envoyé dans la BDD
     //« OneProduct » est égale au nom de l’entité que l’on a créé

        $Entity = $this->getDoctrine()->getRepository(OneProduct::class);
        $category = $pcstuffRepository->findAll();


        //_____________________PAGINATION_______________________________________________________
        // $Entities = $Entity->findAll();
        //On crée la variable $Entities pour stocker tout ce qui se trouve dans l’entité (qui se trouve la BDD) que l'on passe dans pagination  afin d'avoir
        //6 éléments par page , et que la page 1 soit celle par défaut
        $Entities = $paginator->paginate(
            $Entity->findAll(),
            $request->query->getInt('page', 1),6 );

        //__________________________FIND LAST ID _______________________________________________
        $lastProduct = $OneProduct->FindLastId();
        //dump($lastProduct);
        //________________________
        $lastProduct = $lastProduct[0];
        //dump($lastProduct);
        //_____________________________________________________________________________________



        return $this->render('products/index.html.twig', [
            'Entities' => $Entities,
            'LastProduct' => $lastProduct,
            'categories' => $category,
        ]);
    }

}
