<?php

namespace App\Controller;

use App\Entity\OneProduct;
use App\Form\AddProductFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditController extends AbstractController
{
    /**
     * @Route("/products/modifier/{id}", name="edit")
     */
    public function edit(Request $request, OneProduct $OneProduct): Response
    {//On crée le formulaire a partir de AddProductFormType (dans le dossier form)
        //symfony rempli l'objet $OneProduct avec les données du formulaire
        // grâce à la request
        $form = $this->createForm(AddProductFormType::class, $OneProduct);

        //Permet de lié le formulaire à la requete (pour récuperer le $_POST)
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            // Upload
            $image = $form->get('image')->getData();// On récupère la valeur du champ
            if($image){// Si on upload une image dans l'annnonce
                // On doit vérifier si une ancienne image est présente pour la supprimer
                // On fera attention de ne pas supprimer default.jpg et les fixtures

                // On est donc sûr de supprimer uniquement les images des utilisateurs
                $defaultImages = ['default.png', 'fixtures/1.png',  'fixtures/2.png',  'fixtures/3.png',
                    'fixtures/4.png', 'fixtures/5.png', 'fixtures/6.png', 'fixtures/7.png',
                    'fixtures/8.png', 'fixtures/9.png'];

                if($OneProduct->getImage() && !in_array($OneProduct->getImage(), $defaultImages)) {
                    // FileSystem permet de manipuler les fichiers
                    $fs = new Filesystem();
                    // On supprime l'ancienne image
                    $fs->remove($this->getParameter('upload_directory').'/'.$OneProduct->getImage());
                }
                $filename = uniqid().'.'.$image->guessExtension();
                $image->move($this->getParameter('upload_directory'), $filename);
                $OneProduct->setImage($filename);
            }


            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Le produit a bien été modifié');
            return $this->redirecttoRoute('products');
        }


        return $this->render('edit/index.html.twig', [
            'AddProductFormType' => $form->createView(),
            'OneProduct' => $OneProduct,
        ]);
    }
}
