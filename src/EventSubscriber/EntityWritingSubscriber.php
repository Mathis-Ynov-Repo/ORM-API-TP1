<?php

namespace App\EventSubscriber;

use App\Entity\Article;
use DateTime;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class EntityWritingSubscriber implements EventSubscriber
{
  public function getSubscribedEvents()
  {
    return [
      Events::prePersist
    ];
  }

  public function prePersist(LifecycleEventArgs $args)
  {
    $object = $args->getObject();

    if ($object instanceof Article) {
      $object->setStatus(1);
    }
  }
}