<?php

namespace App\DataFixtures;

use App\Entity\OneProduct;
use App\Repository\OneProductRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{

    private $slugger;

    public function __construct(SluggerInterface $slugger){
        $this->slugger = $slugger;
    }


    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');


        for ($i = 1; $i <= 30; $i++) {

            $OneProduct = new OneProduct();

            $name = $faker->randomElement(['Razer', 'Logitech', 'ROCCAT', 'Asus', 'MSI']);
            $OneProduct->setName($name);

            $OneProduct->setSlug($this->slugger->slug($name)->lower());
            $OneProduct->setDescription($faker->text(2000));
            $OneProduct->setPrice($faker->numberBetween(99, 5000));


            $OneProduct->setCreationDate($faker->dateTimeBetween('-2 years', 'today'));
            $OneProduct->setFavorite($faker->boolean(10));

            $color = $faker->randomElement(['rouge', 'bleu', 'blanc', 'noir', 'vert']);
            $OneProduct->setColor($color);

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
