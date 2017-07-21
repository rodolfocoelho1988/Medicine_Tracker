<?php

namespace Medicine\TrackerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Medicine\TrackerBundle\Entity\Patient;
use Medicine\TrackerBundle\Entity\MedInfo;
use Medicine\TrackerBundle\Form\PatientType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;


/**
 * Patient controller.
 *
 * @Route("/patient")
 */
class PatientController extends Controller
{

    /**
     * Lists all Patient entities.
     *
     * @Route("/", name="patient")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MedicineTrackerBundle:Patient')->findAll();


        return array(
            'entities' => $entities, 
        );
    }
    
    /**
     * Creates a new Patient entity.
     *
     * @Route("/", name="patient_create")
     * @Method("POST")
     * @Template("MedicineTrackerBundle:Patient:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Patient();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('patient_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Patient entity.
     *
     * @param Patient $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Patient $entity)
    {
        $form = $this->createForm(new PatientType(), $entity, array(
            'action' => $this->generateUrl('patient_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Patient entity.
     *
     * @Route("/new", name="patient_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Patient();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Patient entity.
     *
     * @Route("/{id}", name="patient_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MedicineTrackerBundle:Patient')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Patient entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $medicines = $entity->getMedInfos(); //this gets all the medicines for that given user

    
        return array(
            'entity'      => $entity,
            'medicines' => $medicines,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Patient entity.
     *
     * @Route("/{id}/edit", name="patient_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MedicineTrackerBundle:Patient')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Patient entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Patient entity.
    *
    * @param Patient $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Patient $entity)
    {
        $form = $this->createForm(new PatientType(), $entity, array(
            'action' => $this->generateUrl('patient_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Patient entity.
     *
     * @Route("/{id}", name="patient_update")
     * @Method("PUT")
     * @Template("MedicineTrackerBundle:Patient:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MedicineTrackerBundle:Patient')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Patient entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('patient_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Patient entity.
     *
     * @Route("/{id}", name="patient_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MedicineTrackerBundle:Patient')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Patient entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('patient'));
    }

    /**
     * Creates a form to delete a Patient entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('patient_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * This page will have the search form for finding the patients by name
     *
     * @Route("/search/display", name="patient_search")
     * @Template ("MedicineTrackerBundle:Patient:search.html.twig")
     */
    public function searchAction(Request $request)
    {
        $form   = $this->createSearchForm();

         $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('MedicineTrackerBundle:Patient');
            $names = $repository->findByName($data['name']);

            if(! $names)
            {            
                return $this->render('MedicineTrackerBundle:Patient:search_results.html.twig',array('names'=> $names));
            }

                return $this->render('MedicineTrackerBundle:Patient:search_results.html.twig',array('names'=> $names));
        }

        return [ 
            'search_form'   => $form->createView()
        ];
    }

    /**
    * Creates a simple form to search patients
    */
    public function createSearchForm()
    {
        return $this->createFormBuilder()
        ->setAction($this->generateUrl('patient_search'))
        ->setMethod('POST')
        ->add('name', 'text')
        ->add('search', 'submit', array('label' => 'Search'))
        ->getForm()
        ;
    }
}
