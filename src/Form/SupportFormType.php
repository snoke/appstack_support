<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class SupportFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => false,'attr' => array('placeholder' => 'Name'),
                'constraints' => array(
                    new NotBlank(array("message" => "Bitte Namen angeben!")),
                )
            ))
            ->add('email', EmailType::class, array('label' => false,'attr' => array('placeholder' => 'E-Mail'),
                'constraints' => array(
                    new NotBlank(array("message" => "Bitte geben E-Mail-Adresse angeben!")),
                )
            ))
            ->add('subject', TextType::class, array('label' => false,'attr' => array('placeholder' => 'Subjekt'),
                'constraints' => array(
                    new NotBlank(array("message" => "Bitte einen Titel angeben!")),
                )
            ))
            ->add('message', TextareaType::class, array('label' => false,'attr' => array('placeholder' => 'Nachricht'),
                'constraints' => array(
                    new NotBlank(array("message" => "Bitte eine Nachricht eingeben!")),
                )
            ))
            ->add('submit', SubmitType::class, array('label' => 'senden','attr' => array('class'=>"w-100 btn btn-primary")));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
