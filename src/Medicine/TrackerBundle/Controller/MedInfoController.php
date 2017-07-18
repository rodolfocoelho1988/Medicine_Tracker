<?php

namespace Medicine\TrackerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Medicine\TrackerBundle\Entity\MedInfo;
use Medicine\TrackerBundle\Entity\Patient;
use Medicine\TrackerBundle\Form\MedInfoType;

/**
 * MedInfo controller.
 *
 * @Route("/medinfo")
 */
class MedInfoController extends Controller
{

    /**
     * Lists all MedInfo entities.
     *
     * @Route("/", name="medinfo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MedicineTrackerBundle:MedInfo')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new MedInfo entity.
     *
     * @Route("/", name="medinfo_create")
     * @Method("POST")
     * @Template("MedicineTrackerBundle:MedInfo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new MedInfo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('medinfo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a MedInfo entity.
     *
     * @param MedInfo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(MedInfo $entity)
    {
        $form = $this->createForm(new MedInfoType(), $entity, array(
            'action' => $this->generateUrl('medinfo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new MedInfo entity.
     *
     * @Route("/new", name="medinfo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new MedInfo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a MedInfo entity.
     *
     * @Route("/{id}", name="medinfo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MedicineTrackerBundle:MedInfo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MedInfo entity.');
        }

        //gets the patient name
        $patientName = $entity->getPatient();

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'patient_name' => $patientName,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing MedInfo entity.
     *
     * @Route("/{id}/edit", name="medinfo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MedicineTrackerBundle:MedInfo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MedInfo entity.');
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
    * Creates a form to edit a MedInfo entity.
    *
    * @param MedInfo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(MedInfo $entity)
    {
        $form = $this->createForm(new MedInfoType(), $entity, array(
            'action' => $this->generateUrl('medinfo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing MedInfo entity.
     *
     * @Route("/{id}", name="medinfo_update")
     * @Method("PUT")
     * @Template("MedicineTrackerBundle:MedInfo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MedicineTrackerBundle:MedInfo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MedInfo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('medinfo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a MedInfo entity.
     *
     * @Route("/{id}", name="medinfo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MedicineTrackerBundle:MedInfo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MedInfo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('medinfo'));
    }

    /**
     * Creates a form to delete a MedInfo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('medinfo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
