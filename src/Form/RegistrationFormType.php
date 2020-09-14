<?php

namespace App\Form;

use App\Entity\User;
use PhpParser\Node\Expr\BinaryOp\NotIdentical;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotIdenticalTo;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('email', EmailType::class)
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                // On Type l'Input en Password
                'type' => PasswordType::class,
                
                // Affiche un message si les Password sont différents
                'invalid_message' => 'Les Passwords doivent être les mêmes !',

                // On définit les options de l'input
                'options' => ['attr' => 
                // Dans le champ "class=" on lui met le parametre "password-field" pour pouvoir ajouter plusieurs champ de password
                ['class' => 'password-field']],

                // "required" est un parametre qui permettra d'obliger l'utilisateur a le remplir
                'required' => true,
                'mapped' => false,

                // "constraints" permet de rajouter des contraintes
                'constraints' => [
                    // Si l'input est vide on lui affiche le message suivant
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide !',
                    ]),
                    // Definit une taille minimum de la valeur inserer dans l'input
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre Password doit contenir au moins 6 characteres !',
                        // max length allowed by Symfony for security reasons
                        // max est la taille maximum allouer par symfony par sécurité
                        'max' => 4096,
                    ]),
                ],
                'first_options' => ['label' => 'password'],
                'second_options' => ['label' => 'confirm password']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
