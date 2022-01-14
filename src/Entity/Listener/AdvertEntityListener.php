<?php


namespace App\Entity\Listener;


use App\Entity\Advert;
use Doctrine\ORM\Event\LifecycleEventArgs;


class AdvertEntityListener
{

    private $author =['Arnaud', 'Lucas', 'Julène', 'Julie', 'Yael', 'Goeffrey', 'Lucas P'];

    public function prePersist(Advert $entity , LifecycleEventArgs $args){
        $entity->setAuthor($this->author[random_int(0, count($this->author)-1)]);

    }
}
