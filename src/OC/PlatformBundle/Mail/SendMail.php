<?php

namespace OC\PlatformBundle\Mail;

use OC\PlatformBundle\Entity\Reservation;


class SendMail
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    protected $twig;

    public function __construct(\Twig_Environment $twig, \Swift_Mailer $mailer )
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    public function sendNewMail(Reservation $reservation)
    {
        $number= $reservation->getId();
        $date= $reservation->getDate();
        $price= $reservation->getPrice();
        $visitors= $reservation->getVisitors();

        $body = $this->renderTemplate($reservation);

        $message = \Swift_Message::newInstance()
            ->setSubject('Confirmation de votre commande')
            ->setFrom('admin@votresite.com')
            ->setTo($reservation->getMail())
            ->setBody($body,
                'text/html'
                )
        ;


        $this->mailer->send($message);
    }

    public function renderTemplate($reservation)
    {
        return $this->twig->render(
            'Emails/email.html.twig',
            array(
                'number' => $reservation->getId(),
                'date'   => $reservation->getDate(),
                'price'   => $reservation->getPrice(),
                'visitors'   => $reservation->getVisitors()
            )
        );
    }

}
