<?php

namespace App\Form;

use App\Entity\CategorieHorloge;
use App\Entity\Mecanisme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieHorlogeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('mecanisme', EntityType::class, [
                'class' => Mecanisme::class,
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez un mécanisme',
                'required' => false,
                'label' => 'Type de mécanisme',
            ])
            ->add('image', FileType::class, [
                'required' => false,
                'mapped' => false, // important pour l'upload
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CategorieHorloge::class,
        ]);
    }
}