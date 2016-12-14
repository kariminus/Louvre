<?php

namespace tests\OC\PlatformBundle\Entity;

use OC\PlatformBundle\Entity\Visitor;

class VisitorTest extends \PHPUnit_Framework_TestCase
{
    public function testFirstName()
    {
        $visitor = new Visitor();
        $visitor->setFirstName("karim");

        $this->assertEquals("karim", $visitor->getFirstName());
    }

    public function testLastName()
    {
        $visitor = new Visitor();
        $visitor->setLastName("meciel");

        $this->assertEquals("meciel", $visitor->getLastName());
    }

    public function testSetCountry()
    {
        $visitor = new Visitor();
        $visitor->setCountry("france");

        $this->assertEquals("france", $visitor->getCountry());
    }

    public function testSetBirthDate()
    {
        $visitor = new Visitor();
        $now = new \DateTime();
        $visitor->setBirthDate($now);

        $this->assertEquals($now, $visitor->getBirthDate());
    }

    public function testSetTicketPrice()
    {
        $visitor = new Visitor();
        $visitor->setTicketPrice(10);

        $this->assertEquals(10, $visitor->getTicketPrice());
    }

    public function testSetReducedPrice()
    {
        $visitor = new Visitor();
        $visitor->setReducedPrice(true);

        $this->assertEquals(true, $visitor->getReducedPrice());
    }
}