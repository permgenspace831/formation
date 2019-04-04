<?php

namespace App\Form\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ContactDTO
{

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/^[A-Z][a-zA-Z '-]{0,}$/", message="Votre nom est trop étrange.")
     * @Assert\Length(max="5")
     */
    public $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Assert\Regex(pattern="/\.fr$/")
     */
    public $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    public $dateOfBirth;

    public $message;
}
