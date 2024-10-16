<?php

namespace App\Controller;

use App\Entity\Contacto;
use App\Form\ContactoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactoController extends AbstractController
{
    #[Route('/contacto_index', name: 'app_contacto')]
    public function index(): Response
    {
        return $this->render('contacto/index.html.twig', [
            'controller_name' => 'ContactoController',
        ]);
    }
	
	#[Route('/contacto', name: 'contacto')]
    public function nuevoContacto(Request $request, EntityManagerInterface $em): Response
    {
        $contacto = new Contacto();
        $form = $this->createForm(ContactoType::class, $contacto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Persistir los datos en la base de datos
            $em->persist($contacto);
            $em->flush();

            // Agregar un mensaje flash de éxito
            $this->addFlash('success', '¡Mensaje enviado con éxito!');

            // Redirigir a una ruta o mostrar un mensaje
            return $this->redirectToRoute('contacto');
        }

        return $this->render('contacto/nuevo.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
