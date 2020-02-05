<?php

namespace App\DataFixtures;

use App\Entity\Categoria;
use App\Entity\Publicacion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PublicacionesVarias extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $contenidos = ['Esto es lo maximo','Esto es lo peor','Ame estos momentos','Viva la vida','De mal a peor','Mi vida cambio','Prefiero morir','Hasta junio','Hasta septiembre','Necesito dormir mas','Pizza time','Nunca nunca jamas jamas','Aguacates'];
        $repoCat = $manager->getRepository(Categoria::class);
        $minCat = min($repoCat->findAll())->getId();
        $maxCat = max($repoCat->findAll())->getId();
        echo 'maxCat=';dump($maxCat);


        foreach ($contenidos as $contenido){
            $p = new Publicacion();

            $random = mt_rand($minCat,$maxCat);
            $c = $repoCat->find($random);
            dump($c);

            $p->setCategoria($c);
            $p->setContenido($contenido);
            $p->setFechaPublicacion(new \DateTime("now"));

            $manager->persist($p);
        }




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
