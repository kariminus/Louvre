<?php

namespace OC\PlatformBundle\Price;

use OC\PlatformBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class SetPrice
{

    public function choicePaiement(Reservation $reservation)
    {
        $session = new Session();
        $session->set('reservation', $reservation);
        $session->set('visitors', $reservation->getVisitors());
        $visitors = $session->get('visitors');
        $date = $reservation->getDate();
        $price = 0;

        foreach ($visitors as $visitor) {
            $visitor->setReservation($reservation);
            $birth = $visitor->getBirthDate();
            $interval = date_diff($date, $birth);
            $age = $interval->y;
            $reducedPrice = $visitor->getReducedPrice();
            if ($reducedPrice === true) {
                $visitor->setTicketPrice(10);
            } elseif ($age < 4) {
                $visitor->setTicketPrice(0);
            } elseif ($age >= 4 && $age < 12) {
                $visitor->setTicketPrice(8);
            } elseif ($age >= 60) {
                $visitor->setTicketPrice(12);
            } else {
                $visitor->setTicketPrice(16);
            }
            $price += $visitor->getTicketPrice();
        }
        $reservation->setPrice($price);
        $session->set('price', $price);
    }
}

