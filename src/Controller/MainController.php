<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use App\Form\DTO\ContactHandler;

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
    public function contact(Request $request, ContactHandler $handler): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $handler->handle($form->getData());

            /** @var \App\Form\DTO\ContactDTO $data */
            $data = $form->getData();

            $this->addFlash('info', 'Merci pour le message, ' . $data->name);

            return $this->redirectToRoute('contact_email_sent');
        }

        return $this->render('main/contact.html.twig', [
            'contact_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contact/merci", name="contact_email_sent")
     */
    public function contactEmailSent(string $recipient)
    {
        return $this->render('main/contact_email_sent.html.twig', [
            'recipient' => $recipient,
        ]);
    }
}
