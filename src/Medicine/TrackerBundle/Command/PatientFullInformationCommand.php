<?php

namespace Medicine\TrackerBundle\Command;

use Symfony\Bundle\Frameworkbundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Medicine\TrackerBundle\Entity\Patient;
use Doctrine\ORM\EntityRepository;

class PatientFullInformationCommand extends ContainerAwareCommand
{
    /**
     * ReturnAllPatients: Returns a list of all the patients in the system.
     */
    protected function configure()
    {
        $this
            ->setName('patient:return:full_information')
            ->setDescription('returns the patient information based on the id provided')
            ->setHelp('This command returns a list of all the patients in the database-- active && inactive');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $em = $container->get('Doctrine')->getManager();
        $entity = $em->getRepository('MedicineTrackerBundle:Patient')->findAll();

        if(!$entity)
        {
           $output->writeln("The database is empty");
           return;
        }

        foreach ($entity as $key => $value) {

            $output->writeln("Name: ".$value->getName());

            $medicine_em = $container 
                           ->get('Doctrine')
                           ->getManager();

            $medicine_entity = $medicine_em
                               ->getRepository('MedicineTrackerBundle:MedInfo')
                               ->findBy(array('id' => $value->getId()));

            if(! $medicine_entity)
            {
                $output->writeln("No Medicine entry made yet");
            }

            foreach ($medicine_entity as $med_key => $med_value) {
                $output->writeln(
                        "Prepared On: ".$med_value->getPreparedOn()->format('Y-m-d').", Number of Blisters: ".
                        $med_value->getNumBlisters()." Next Due Date: ".
                        $med_value->getNextDueDate()->format('Y-m-d')." Delivery Pickup Date ".
                        $med_value->getDeliveryPickupDate()->format('Y-m-d')." IsActive:".
                        $med_value->getIsActive()
                        );
            }

            $output->writeln("===================================================");
        }        
    }
}
