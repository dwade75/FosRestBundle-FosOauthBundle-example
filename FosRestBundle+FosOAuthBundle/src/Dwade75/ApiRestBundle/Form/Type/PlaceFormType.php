<?php

namespace Dwade75\ApiRestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('address');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => 'Dwade75\ApiRestBundle\Entity\Place',
            'csrf_protection' => false
        ]);
    }

    public function getName()
    {
        return 'dwade75api_rest_bundle_place_type';
    }
}
