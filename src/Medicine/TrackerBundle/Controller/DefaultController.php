<?php

namespace Medicine\TrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;



class DefaultController extends Controller
{
    /**
     * @Route("/home", name="homepage")
     * @Template()
     */
    public function indexAction($name)
    {
    	// array('name' => $name);
        
        return $this->render('default/index.html.twig', array('name'=> $name)); 
    }
}
