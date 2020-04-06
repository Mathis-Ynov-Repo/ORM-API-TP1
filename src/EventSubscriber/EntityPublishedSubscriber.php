<?php

namespace App\EventSubscriber;

use App\Entity\Article;
use DateTimeImmutable;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Validator\Constraints\Date;

class EntityPublishedSubscriber implements EventSubscriber
{
  public function getSubscribedEvents()
  {
    return [
      Events::preUpdate
    ];
  }

  public function preUpdate(LifecycleEventArgs $args)
  {
    $object = $args->getObject();

    if ($object instanceof Article && $object->getStatus() == 2) {
        $object->setPublished(new DateTimeImmutable());
    }
  }
}