<?php

namespace OC\PlatformBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class ReservationLimitValidator extends ConstraintValidator
{

    private $em;

    public function __construct(EntityManager $em) { // i guess it's EntityManager the type
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        $repository = $this->em->getRepository('OCPlatformBundle:Reservation');

        $listReservations = $repository->FindByDate($value);
        $number = count($listReservations);

        if ($number >= 1000)
        {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}