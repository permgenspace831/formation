<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="homepage", methods={"GET"})
     */
    public function homepage(): Response
    {
        return $this->render('main/homepage.html.twig');
    }

    /**
     * @Route("/contact", name="contact", methods={"GET", "POST"})
     */
    public function contact(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
        }

        return $this->render('main/contact.html.twig', [
            'contact_form' => $form->createView(),
        ]);
    }
}
