<?php

namespace App\Form;

use App\Entity\Mecanisme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class HorlogeFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mecanismes', EntityType::class, [
                'class' => Mecanisme::class,
                'choice_label' => 'nom', // Affiche le nom du mécanisme
                'multiple' => true, // Permet de sélectionner plusieurs mécanismes
                'expanded' => true, // Affiche des checkboxes au lieu d'un select
                'required' => false,
                'label' => 'Filtrer par type de mécanisme',
            ])
            ->add('filtrer', SubmitType::class, [
                'label' => 'Appliquer les filtres',
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Le formulaire n'est lié à aucune entité
            'method' => 'GET', // Utilise GET pour que les filtres soient dans l'URL
        ]);
    }
}