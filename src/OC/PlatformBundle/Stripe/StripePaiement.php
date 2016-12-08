<?php

namespace OC\PlatformBundle\Stripe;

use OC\PlatformBundle\Entity\Reservation;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class StripePaiement
{
    private $em;

    public function __construct($secretKey, EntityManager $em)
    {
        $this->em = $em;
        \Stripe\Stripe::setApiKey($secretKey);
    }

    public function chargePaiement (Request $request)
    {
        $session = $request->getSession();
        $reservation = $session->get('reservation');
        $email=$request->get('email');
        $reservation->setMail($email);
        $token = $request->request->get('stripeToken');
        $price = $session->get('price');

        \Stripe\Charge::create(array(
            "amount" => $price * 100,
            "currency" => "eur",
            "source" => $token,
        ));

        $this->em->persist($reservation);
        $this->em->flush();

        //$session->clear();

    }

}