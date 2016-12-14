<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use OC\PlatformBundle\Validator\ReservationLimit;
use Symfony\Component\Validator\Constraints as Assert;


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
     *
     */
    private $mail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     *
     * @Assert\Date()
     *
     * @ReservationLimit()
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
     * @ORM\OneToMany(targetEntity="OC\PlatformBundle\Entity\Visitor", cascade={"persist", "remove"}, mappedBy="reservation")
     */
    private $visitors;


    public function __construct()
    {
        $this->visitors = new ArrayCollection();
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
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

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
     */
    public function setDate($date)
    {
        $this->date = $date;

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
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
     * Set dayTime
     *
     * @param boolean $dayTime
     *
     */
    public function setDayTime($dayTime)
    {
        $this->dayTime = $dayTime;

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
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVisitors()
    {
        return $this->visitors;
    }
}

