<?php

namespace Medicine\TrackerBundle\Command;

use Symfony\Bundle\Frameworkbundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Medicine\TrackerBundle\Entity\Patient;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Swiftmailer;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Annotation\Route as Route;
use Symfony\Component\HttpFoundation\Response;

class EmailPatientInfoCommand extends ContainerAwareCommand
{
    /**
     * Emails the information to a person
     */
    protected function configure()
    {
        $this
            ->setName('patient:getEmail')
            ->setDescription('returns the patient information based on the id provided');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $value = "This is some text";
        $container = $this->getContainer();

        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
        ->setUserName('ayushkaushik305@gmail.com')
        ->setpassword('Tanvirana');
        
        //----------------------------------------------------------------------------------------------------
        $mailer = \Swift_Mailer::newInstance($transport);
        $message = \Swift_Message::newInstance()
            ->setFrom('ayushkaushik305@gmail.com')
            ->setTo('ayushkaushik305@gmail.com')
            ->setBody('Test');

        $container->get('mailer')->send($message); 
    }
}
