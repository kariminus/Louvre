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
        $session->set('visitors',     $reservation->getVisitors());
        $visitors = $session->get('visitors');
        $price = 0;

        foreach ($visitors as $visitor)
        {
            $visitor->setReservation($reservation);
            $today = new\DateTime();
            $birth = $visitor->getBirthDate();
            $interval = date_diff($today, $birth);
            $age = $interval->y;
            $reducedPrice = $visitor->getReducedPrice();
            if ($reducedPrice === true)
            {
                $visitor->setTicketPrice(10);
            }
            elseif ($age < 4)
            {
                $visitor->setTicketPrice(0);
            }
            elseif ($age > 4 && $age < 12)
            {
                $visitor->setTicketPrice(8);
            }
            elseif ($age > 60)
            {
                $visitor->setTicketPrice(12);
            }
            else
            {
                $visitor->setTicketPrice(16);
            }
            $price += $visitor->getTicketPrice();
        }
        $reservation->setPrice($price);
        $session->set('price',  $price);
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
        $this->em->flush($reservation);

        //$session->clear();

    }

}