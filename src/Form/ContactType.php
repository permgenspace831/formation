<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\DTO\ContactDTO;

class ContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Name',
                ],
                'required' => false,
            ])
            ->add('dateOfBirth', BirthdayType::class)
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactDTO::class
        ]);
    }
}
