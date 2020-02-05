<?php

namespace App\DataFixtures;

use App\Entity\Categoria;
use App\Entity\Publicacion;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PriermasPublicaciones extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $repository = $manager->getRepository(Categoria::class);
        $c = $repository->findOneBy(['nombre'=>'Ajedrez']);
        $p =new Publicacion();
        $p->setCategoria($c);
        $p->setContenido('Que divertido el ajedrez :D');


        $d = new DateTime();
        $d-> format('Y-m-d H:i:s');
        $p->setFechaPublicacion($d);

        $manager->persist($p);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return array(
            PrimerasCategorias::class
        );
    }
}
