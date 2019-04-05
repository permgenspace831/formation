<?php

namespace App\Form\DTO;

use Psr\Log\LoggerInterface;

class ContactHandler
{

    /** @var \Swift_Mailer */
    private $mailer;

    /** @var string */
    private $recipient;

    public function __construct(\Swift_Mailer $mailer, string $recipient, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->recipient = $recipient;

        // On demande un LoggerInterface et on reçoit un Logger. *cheers*
        dump($logger);
    }

    public function handle(ContactDTO $data)
    {
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
