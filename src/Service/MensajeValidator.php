<?php

namespace App\Service;

use App\Repository\ContactoRepository;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class MensajeValidator
{
    private $contactoRepository;

    public function __construct(ContactoRepository $contactoRepository)
    {
        $this->contactoRepository = $contactoRepository;
    }

    /**
     * Valida si el correo ya ha enviado un mensaje hoy.
     *
     * @param string $correo
     * @param ExecutionContextInterface $context
     */
    public function validateUnMensajePorDia(string $correo, ExecutionContextInterface $context)
    {
        // Obtener la fecha de hoy
        $hoy = new \DateTime('today');

        // Buscar si ya existe un mensaje con este correo y la fecha de hoy
        $mensaje = $this->contactoRepository->findOneBy([
            'correo' => $correo,
            'fecha_envio' => $hoy,
        ]);

        if ($mensaje) {
            // Añadir una violación de validación
            $context->buildViolation('Ya has enviado un mensaje hoy.')
                ->atPath('correo')
                ->addViolation();
        }
    }
}
