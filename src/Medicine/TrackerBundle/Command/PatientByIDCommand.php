<?php

namespace Medicine\TrackerBundle\Command;

use Symfony\Bundle\Frameworkbundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Medicine\TrackerBundle\Entity\Patient;
use Doctrine\ORM\EntityRepository;

class PatientByIDCommand extends ContainerAwareCommand
{
    /**
     * Finds Patient By ID as an argument
     *
     */
    protected function configure()
    {
        $this
            ->setName('patient:return')
            ->setDescription('returns the patient information based on the id provided')
            ->addArgument('id', InputArgument::REQUIRED, 'Enter the id to retreive corresponding patient name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id'); //check if the id provided is an integer only and not a negative one

        $container = $this->getContainer();

        $em = $container->get('Doctrine')->getManager();
        $entity = $em->getRepository('MedicineTrackerBundle:Patient')->find($id);

        if(!$entity)
        {
           $output->writeln("No Such Patient in the database");
           return;
        }

        $value = $entity->getName();
        $output->writeln("Patient with id: $id is $value");  
    }
}
