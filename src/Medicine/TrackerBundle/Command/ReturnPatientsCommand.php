<?php

namespace Medicine\TrackerBundle\Command;

use Symfony\Bundle\Frameworkbundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Medicine\TrackerBundle\Entity\Patient;
use Doctrine\ORM\EntityRepository;

class ReturnPatientsCommand extends ContainerAwareCommand
{
    /**
     * ReturnAllPatients: Returns a list of all the patients in the system.
     */
    protected function configure()
    {
        $this
            ->setName('patient:return:all')
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
            $output->writeln("Name:". $value->getName()." Id:".$value->getId());
        }        
    }
}
