<?php

namespace App\EventSubscriber;

use App\Model\TimestampedInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents():array
    {
        return [
            BeforeEntityPersistedEvent::class=>['setEntityCreatedAt'],
            BeforeEntityUpdatedEvent::class=>['setEntityUpdatedAt'],
        ];
    }

    public function setEntityCreatedAt(BeforeEntityPersistedEvent $event):void
    {
        $entity = $event->getEntityInstance();
        // Condition : si $entity n'est pas une instance de TimestampedInterface, on retourne rien.
        
        if(!$entity instanceof TimestampedInterface){
            return;
        }
        // Sinon : on set createdAt pour avoir la date de création de l'article 
        $entity->setCreatedAt(new \DateTime());
    }

    public function setEntityUpdatedAt(BeforeEntityUpdatedEvent $event):void
    {
        $entity = $event->getEntityInstance();
        // Condition : si $entity n'est pas une instance de TimestampedInterface, on retourne rien.
        
        if(!$entity instanceof TimestampedInterface){
            return;
        }
        // Sinon : on set updatedAt pour avoir la date de mise à jour de l'article 
        $entity->setUpdatedAt(new \DateTime());
    }
}