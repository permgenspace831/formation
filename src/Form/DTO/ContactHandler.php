<?php

namespace App\Form\DTO;

use App\Entity\ContactMessage;
use Doctrine\Common\Persistence\ObjectManager;
use Psr\Log\LoggerInterface;

class ContactHandler
{

    /** @var \Swift_Mailer */
    private $mailer;

    /** @var string */
    private $recipient;

    /** @var ObjectManager */
    private $objectManager;

    public function __construct(
        \Swift_Mailer $mailer,
        string $recipient,
        ObjectManager $objectManager,
        LoggerInterface $logger
    ) {
        $this->mailer = $mailer;
        $this->recipient = $recipient;

        // On demande un LoggerInterface et on reçoit un Logger. *cheers*
        dump($logger);

        $this->objectManager = $objectManager;
    }

    public function handle(ContactDTO $data)
    {
        $contactMessage = new ContactMessage();
        $contactMessage
            ->setSenderName($data->name)
            ->setSenderEmail($data->email)
            ->setContent($data->message);

        $this->objectManager->persist($contactMessage);
        $this->objectManager->flush();

        /** @var \Swift_Message $emailMessage */
        $emailMessage = $this->mailer->createMessage();
        $emailMessage
            ->setFrom($data->email)
            ->setTo($this->recipient)
            ->setSubject('New message from the website')
            ->setContentType('text/html')
            ->setBody($data->message);

        $this->mailer->send($emailMessage);
    }
}
