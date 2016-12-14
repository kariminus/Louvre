<?php

namespace tests\OC\PlatformBundle\Entity;

use OC\PlatformBundle\Entity\Reservation;

class ReservationTest extends \PHPUnit_Framework_TestCase
{
    public function testSetMail()
    {
        $reservation = new Reservation();
        $reservation->setMail("test@mail.com");

        $this->assertEquals("test@mail.com", $reservation->getMail());
    }

    public function testSetPrice()
    {
        $reservation = new Reservation();
        $reservation->setPrice(10);

        $this->assertEquals(10, $reservation->getPrice());
    }

    public function testSetDate()
    {
        $reservation = new Reservation();
        $now = new \DateTime();
        $reservation->setDate($now);

        $this->assertEquals($now, $reservation->getDate());
    }

    public function testSetDayTime()
    {
        $reservation = new Reservation();
        $reservation->setDayTime(true);

        $this->assertEquals(true, $reservation->getDayTime());
    }
}