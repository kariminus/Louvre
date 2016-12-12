<?php

namespace tests\OC\PlatformBundle\Entity;

use OC\PlatformBundle\Entity\Reservation;

class ReservationTest extends \PHPUnit_Framework_TestCase
{
    public function testSetMail()
    {
        $reservation = new Reservation();
        $mail = $reservation->setMail("test@mail.com");

        $this->assertEquals("test@mail.com", $mail);
    }

    public function testSetPrice()
    {
        $reservation = new Reservation();
        $price = $reservation->setPrice(10);

        $this->assertEquals(10, $price);
    }

    public function testSetDate()
    {
        $reservation = new Reservation();
        $now = new \DateTime();
        $date = $reservation->setDate($now);

        $this->assertEquals($now, $date);
    }

    public function testSetDayTime()
    {
        $reservation = new Reservation();
        $dayTime = $reservation->setDayTime(true);

        $this->assertEquals(true, $dayTime);
    }
}