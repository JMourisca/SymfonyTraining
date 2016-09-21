<?php
/**
 * Created by PhpStorm.
 * User: juliana
 * Date: 21/09/16
 * Time: 09:50
 */

namespace Training\HangmanBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends  AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sender', EmailType::class)
            ->add('subject', TextType::class)
            ->add('message', TextareaType::class);
    }

}