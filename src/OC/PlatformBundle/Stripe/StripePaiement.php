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

    public function choicePaiement (Request $request, Reservation $reservation)
    {
        $session = $request->getSession();

        $session->set('reservation',  $reservation);
        $session->set('price',        $reservation->getPrice());
        $session->set('visitors',     $reservation->getVisitors());

    }

    public function chargePaiement (Request $request)
    {
        $session = $request->getSession();
        $reservation = $session->get('reservation');
        $token = $request->request->get('stripeToken');
        $price = $reservation->getPrice();

        \Stripe\Charge::create(array(
            "amount" => $price * 100,
            "currency" => "eur",
            "source" => $token,
            "description" => "First test charge!"
        ));
        $this->em->persist($reservation);
        $this->em->flush($reservation);

        return $reservation;
    }

}