<?php
/**
 * Created by PhpStorm.
 * User: tongguillaume
 * Date: 2019-04-09
 * Time: 11:16
 */

namespace App\Form;


use App\Entity\Matiere;
use App\Entity\Notes;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matiereId', EntityType::class, array(
                    'label' => 'Matiere',
                    'required' => true,
                    'class' => Matiere::class,
                    'placeholder' => 'Choisissez une matiere',
                    'choice_label' => function($type) {
                        return $type->getName();
                    }
                ))
                ->add('userId', EntityType::class, array(
                    'label' => 'Nom de l\'eleve',
                    'required' => true,
                    'class' => User::class,
                    'placeholder' => 'Choisissez un eleve',
                    'choice_label' => function($type) {
                        return $type->getUsername();
                    })
                )
                ->add('coefficient', IntegerType::class, [
                    'label' => 'Coefficient',
                    'required' => true
                ])
                ->add('note',IntegerType::class, [
                    'label'=> 'Note',
                    'required' => true
                ])

                ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Notes::class,
        ]);
    }
}