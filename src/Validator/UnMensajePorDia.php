<?php
// src/Validator/UnMensajePorDia.php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class UnMensajePorDia extends Constraint
{
    public $message = 'Ya has enviado un mensaje hoy. Por favor, espera hasta mañana.';

    public function getTargets(): array|string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
