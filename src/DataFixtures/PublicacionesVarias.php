<?php

namespace App\DataFixtures;

use App\Entity\Categoria;
use App\Entity\Comentario;
use App\Entity\Publicacion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PublicacionesVarias extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $contenidos = ['Esto es lo maximo','Esto es lo peor','Ame estos momentos','Viva la vida','De mal a peor','Mi vida cambio','Prefiero morir','Hasta junio','Hasta septiembre','Necesito dormir mas','Pizza time','Nunca nunca jamas jamas','Aguacates'];
        $comentarios = ['Lo apoyo','Que va','Correcto','Ni loco','TT_TT',':D'];
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
            $p->setTitulo($contenidos[mt_rand(0,count($contenidos)-1)]);
            $p->setFechaPublicacion(new \DateTime("now"));

            for ($i = 0 ; $i < mt_rand(0,count($comentarios)-1) ; $i++){
                $com = new Comentario();
                $com->setContenido($comentarios[mt_rand(0,count($comentarios)-1)]);
                $com->setFechaPublicacion(new \DateTime('now'));

                $com->setPublicacion($p);

                $manager->persist($com);
            }

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
