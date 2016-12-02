<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="string", length=36)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;


    /**
     * @var boolean
     *
     * @ORM\Column(name="dayTime", type="boolean")
     */
    private $dayTime;

    /**
     * @ORM\OneToMany(targetEntity="OC\PlatformBundle\Entity\Visitor", cascade={"persist"}, mappedBy="reservation")
     */
    private $visitors;


    public function __construct()
    {
        $this->date         = new \Datetime();
        $this->visitors     = new ArrayCollection();
        $this->mail         = "mail@example.com";
        $this->number       = "ad5a1";
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Reservation
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Reservation
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }


    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set dayTime
     *
     * @param boolean $dayTime
     *
     * @return Reservation
     */
    public function setDayTime($dayTime)
    {
        $this->dayTime = $dayTime;

        return $this;
    }

    /**
     * Get dayTime
     *
     * @return boolean
     */
    public function getDayTime()
    {
        return $this->dayTime;
    }


    /**
     * @param Visitor $visitor
     *
     * @return Reservation
     */
    public function addVisitor(Visitor $visitor)
    {
        $this->visitors[] = $visitor;
        // On lie la reservation au visiteur
        $visitor->setReservation($this);
        return $this;
    }

    /**
     * @param Visitor $visitor
     */
    public function removeVisitor(Visitor $visitor)
    {
        $this->visitors->removeElement($visitor);
    }

    /**
     * Set Visitors
     *
     * @param Visitor $visitors
     *
     * @return Reservation
     */
    public function setVisitor($visitors)
    {
        $this->visitors = $visitors;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVisitors()
    {
        return $this->visitors;
    }
}

