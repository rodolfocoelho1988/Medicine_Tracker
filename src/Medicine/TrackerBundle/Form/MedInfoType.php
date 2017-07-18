<?php

namespace Medicine\TrackerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class MedInfoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('preparedOn', 'date', ['required'=>'false', 'label' => 'Prepared On'])
            ->add('numBlisters', 'integer', ['required'=>'false', 'label' => '# Blisters'] )
            ->add('deliveryPickupDate', 'date',['required'=>'false', 'label' => 'Delivery Pickup Date'] )
            ->add('nextDueDate', 'date', ['required'=>'false', 'label' => 'Next Due Date'])
            ->add('isActive', 'checkbox', array('required' => false, 'label' => 'Active Medicine')) 
            ->add('patient')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Medicine\TrackerBundle\Entity\MedInfo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'medicine_trackerbundle_medinfo';
    }
}
