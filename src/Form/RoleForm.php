<?php

namespace App\Form;

use App\Entity\Role;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\PowerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Enum\Camp;

class RoleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('camp', ChoiceType::class, [
                'choices' => Camp::cases(), // toutes les valeurs possibles de l'enum
                'choice_label' => fn (Camp $camp) => $camp->name, // ou $camp->value selon ce que tu préfères afficher
                'choice_value' => fn (?Camp $camp) => $camp?->value, // ce que Symfony envoie en POST
            ])
            ->add('goal')
            ->add('description')
            ->add('powers', CollectionType::class, [
                'entry_type' => PowerType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->add('minPlayer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Role::class,
        ]);
    }
}
