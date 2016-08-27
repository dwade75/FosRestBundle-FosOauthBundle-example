<?php

    namespace Dwade75\ApiRestBundle\Form\Type;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class UserFormType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add('firstname')
                    ->add('lastname')
                    ->add('email', EmailType::class);
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => 'Dwade75\ApiRestBundle\Entity\User',
                'csrf_protection' => false
            ]);
        }

        public function getName()
        {
            return 'dwade75api_rest_bundle_user_form_type';
        }
    }
