<?php

namespace OC\PlatformBundle\DoctrineListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use OC\PlatformBundle\Mail\SendMail;
use OC\PlatformBundle\Entity\Reservation;

class ReservationCreationListener
{
    /**
     * @var SendMail
     */
    private $sendMail;

    public function __construct(SendMail $sendMail)
    {
        $this->sendMail = $sendMail;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Reservation) {
            return;
        }

        $this->sendMail->sendNewMail($entity);
    }
}
