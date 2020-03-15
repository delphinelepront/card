<?php

namespace App\Form;

use App\Entity\Card;
use App\Entity\Faction;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class FormCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('Attac')
            ->add('SelfDefense')
            ->add('Faction', EntityType::class, [
                'class'=> Faction::class,
                'choice_label' =>'name'
            ])
            ->add('image', FileType::class)
            ->add('add', SubmitType::class, [
                'label'=> 'Create Card',
                'attr' => [
                    'class'=>'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Card::class,
        ]);
    }
}
