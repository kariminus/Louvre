<?php

namespace tests\OC\PlatformBundle\Entity;

use OC\PlatformBundle\Entity\Visitor;

class VisitorTest extends \PHPUnit_Framework_TestCase
{
    public function testFirstName()
    {
        $visitor = new Visitor();
        $firstName = $visitor->setFirstName("karim");

        $this->assertEquals("karim", $firstName);
    }

    public function testLastName()
    {
        $visitor = new Visitor();
        $lastName = $visitor->setLastName("meciel");

        $this->assertEquals("meciel", $lastName);
    }

    public function testSetCountry()
    {
        $visitor = new Visitor();
        $country = $visitor->setCountry("france");

        $this->assertEquals("france", $country);
    }

    public function testSetBirthDate()
    {
        $visitor = new Visitor();
        $now = new \DateTime();
        $birthDate = $visitor->setBirthDate($now);

        $this->assertEquals($now, $birthDate);
    }

    public function testSetTicketPrice()
    {
        $visitor = new Visitor();
        $ticketPrice = $visitor->setTicketPrice(10);

        $this->assertEquals(10, $ticketPrice);
    }

    public function testSetReducedPrice()
    {
        $visitor = new Visitor();
        $reducedPrice = $visitor->setReducedPrice(true);

        $this->assertEquals(true, $reducedPrice);
    }
}