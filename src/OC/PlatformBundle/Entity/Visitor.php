<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visitor
 *
 * @ORM\Table(name="visitor")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\VisitorRepository")
 */
class Visitor
{

    /**
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Reservation", inversedBy="visitors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reservation;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthDate", type="date")
     */
    private $birthDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="ticketPrice", type="integer")
     */
    private $ticketPrice;

    /**
     * @var \boolean
     *
     * @ORM\Column(name="reducedPrice", type="boolean")
     */
    private $reducedPrice;

    public function __construct()
    {
        $this->ticketPrice = 0;
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
     * Set firstName
     *
     * @param string $firstName
     *
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this->firstName;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this->lastName;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this->country;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this->birthDate;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set ticketPrice
     *
     * @param \integer $ticketPrice
     *
     */
    public function setTicketPrice($ticketPrice)
    {
        $this->ticketPrice = $ticketPrice;

        return $this->ticketPrice;

    }

    /**
     * Get ticketPrice
     *
     * @return int
     */
    public function getTicketPrice()
    {
        return $this->ticketPrice;
    }

    /**
     * Set reducedPrice
     *
     * @param \boolean $reducedPrice
     *
     */
    public function setReducedPrice($reducedPrice)
    {
        $this->reducedPrice = $reducedPrice;

        return $this->reducedPrice;
    }

    /**
     * Get reducedPrice
     *
     * @return \boolean
     */
    public function getReducedPrice()
    {
        return $this->reducedPrice;
    }

    /**
     * @param Reservation $reservation
     */
    public function setReservation(Reservation $reservation)
    {
        $this->reservation = $reservation;

    }

    /**
     * @return Reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }

}

