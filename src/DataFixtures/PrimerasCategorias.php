<?php

namespace App\DataFixtures;

use App\Entity\Categoria;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PrimerasCategorias extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categorias = ['Programacion','Cocina','Ajedrez','Juegos'];

        foreach ($categorias as $nombre){
            $cat = new Categoria();
            $cat->setNombre($nombre);
            $manager->persist($cat);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

}
