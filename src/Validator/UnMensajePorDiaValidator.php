<?php
// src/Validator/UnMensajePorDiaValidator.php

namespace App\Validator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UnMensajePorDiaValidator extends ConstraintValidator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$value) {
            return; // No hacemos nada si no hay un valor
        }

        // Consultamos si ya existe un mensaje enviado hoy por este correo
        $email = $value;
        $hoy = new \DateTime('today');

        // Buscamos en la base de datos
        $contacto = $this->entityManager->getRepository(Contacto::class)->findOneBy([
            'email' => $email,
            'fechaEnvio' => $hoy->format('Y-m-d') // Formato de fecha 'YYYY-MM-DD'
        ]);

        if ($contacto) {
            // Si se encuentra un contacto con el mismo email y fecha de envío de hoy, lanzamos una violación
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}