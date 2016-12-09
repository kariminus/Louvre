<?php

namespace OC\PlatformBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class ReservationLimit extends Constraint
{
    public $message = 'Le maximum de 1000 billets a été atteint';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}