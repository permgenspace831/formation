<?php


namespace App\Controller;


use App\Entity\ContactMessage;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact")
 */
class ContactMessageController extends AbstractController
{

    /**
     * @Route("/show/{id}", name="contact_message_show")
     */
    public function show(ObjectManager $objectManager, int $id): Response
    {
        $message = $objectManager
            ->getRepository(ContactMessage::class)
            ->find($id);

        if (!$message) {
            throw $this->createNotFoundException();
        }

        return $this->render('contact_message/show.html.twig', [
            'message' => $message,
        ]);
    }
}
