<?php

namespace App\DataFixtures;

use App\Entity\OneProduct;
use App\Entity\Pcstuff;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{

    private $slugger;
    private $passwordEncoder;
    //On crée la variable
    //Puis on apelle et on stock le service dans la variable
    public function __construct(SluggerInterface $slugger, UserPasswordEncoderInterface  $passwordEncoder){
        $this->slugger = $slugger;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    { //On crée une instance de Faker pour générer les données aléatoires
        $faker = Factory::create('fr_FR');

        //_________________________Création des USERS____________________________________________________________

        $user = new User();
        $user->setEmail('test@test.fr');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'test'));
        $user->setRoles(['ROLE_ADMIN']);
        //permet de dire a doctrine d'insérer le User
        $manager->persist($user);

        //____________________________Création des catégories____________________________________________________
        $stuffs = ['Clavier', 'Souris', 'Casque', 'Tapis de souris'];
        foreach ($stuffs as $key => $stuff){
            $pcstuff = new Pcstuff();
            $pcstuff->setName($stuff);
            $this->addReference('stuff-'.$key, $pcstuff);
            $manager->persist($pcstuff);
        }

        //______________________________________________________________________________________________________
        for ($i = 1; $i <= 30; $i++) {

            $OneProduct = new OneProduct();
            $pcstuff = $this->getReference('stuff-'.rand(0, count($stuffs)-1));

            $name = $faker->randomElement(['Razer', 'Logitech', 'ROCCAT', 'Asus', 'MSI']);
            $OneProduct->setName($name);

            $OneProduct->setSlug($this->slugger->slug($name)->lower());
            $OneProduct->setDescription($faker->text(2000));
            $OneProduct->setPrice($faker->numberBetween(99, 5000));


            $OneProduct->setCreationDate($faker->dateTimeBetween('-2 years', 'today'));
            $OneProduct->setFavorite($faker->boolean(10));

            $color = $faker->randomElement(['rouge', 'bleu', 'blanc', 'noir', 'vert']);
            $OneProduct->setColor($color);

            $OneProduct->setPcstuff($pcstuff);

            $OneProduct->setImage($faker->randomElement([
                'default.png', 'fixtures/1.png',  'fixtures/2.png',  'fixtures/3.png',
                'fixtures/4.png', 'fixtures/5.png', 'fixtures/6.png', 'fixtures/7.png',
                'fixtures/8.png', 'fixtures/9.png',
            ]));
            $OneProduct->setPromotion($faker->boolean(10));

            $manager->persist($OneProduct);
        }
        $manager->flush();

    }


}
