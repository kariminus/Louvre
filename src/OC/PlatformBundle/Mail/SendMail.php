<?php

namespace OC\PlatformBundle\Mail;

use OC\PlatformBundle\Entity\Reservation;


class SendMail
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendNewMail(Reservation $reservation)
    {
        $message = new \Swift_Message(
            'Nouvelle commande'
        );

        $message
            ->addTo($reservation->getMail())
            ->addFrom('admin@votresite.com')
        ;

        $this->mailer->send($message);
    }

}
