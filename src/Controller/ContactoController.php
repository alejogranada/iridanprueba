<?php
// src/Controller/ContactoController.php

namespace App\Controller;

use App\Entity\Contacto;
use App\Entity\AreaContacto;
use App\Form\ContactoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactoController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    // Inyectar el EntityManager a través del constructor
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/contacto', name: 'contacto')]
    public function nuevoContacto(Request $request): Response
    {
        $contacto = new Contacto();
        $form = $this->createForm(ContactoType::class, $contacto);

        // Obtener áreas de contacto
        $areas = $this->entityManager->getRepository(AreaContacto::class)->findAll();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Obtén las áreas seleccionadas desde el formulario
            $selectedAreas = $contacto->getAreas();
            foreach ($selectedAreas as $area) {
                $contacto->addArea($area);
            }

            $correo = $contacto->getCorreo();
            $repository = $this->entityManager->getRepository(Contacto::class);

            if ($repository->existsToday($correo)) {
                $this->addFlash('error', 'Ya has enviado un mensaje hoy.');

                return $this->render('contacto/nuevo.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

			// Si pasa la validación, guarda el contacto			
			// Actualiza la fecha de envío al momento actual
            $contacto->setFechaEnvio(new \DateTime());
            // Persistir la entidad Contacto en la base de datos
            $this->entityManager->persist($contacto);
            $this->entityManager->flush();

            // Redirige a la página de éxito
            return $this->redirectToRoute('gracias');
        }

        return $this->render('contacto/nuevo.html.twig', [
            'form' => $form->createView(),
            'areas' => $areas // Pasar áreas al twig
        ]);
    }
	
	#[Route('/gracias', name: 'gracias')]
	public function gracias(): Response
	{
		return $this->render('contacto/gracias.html.twig');
	}
}


