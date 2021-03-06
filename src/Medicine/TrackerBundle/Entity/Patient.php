<?php

namespace Medicine\TrackerBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;


use Doctrine\ORM\Mapping as ORM;

/**
 * Patient
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Medicine\TrackerBundle\Entity\PatientRepository")
 */
class Patient
{

    /**
    *
    * One patient has many medicine details
    * @var ArrayCollection
    *
    * @ORM\OneToMany(targetEntity="MedInfo", mappedBy="patient")
    *
    */
    private $med_infos;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;


    /*
    * Constructor
    */
    public function __construct(){
        $this->med_infos = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Patient
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add med_infos
     *
     * @param \Medicine\TrackerBundle\Entity\MedInfo $medInfos
     * @return Patient
     */
    public function addMedInfo(\Medicine\TrackerBundle\Entity\MedInfo $medInfos)
    {
        $this->med_infos[] = $medInfos;

        return $this;
    }

    /**
     * Remove med_infos
     *
     * @param \Medicine\TrackerBundle\Entity\MedInfo $medInfos
     */
    public function removeMedInfo(\Medicine\TrackerBundle\Entity\MedInfo $medInfos)
    {
        $this->med_infos->removeElement($medInfos);
    }

    /**
     * Get med_infos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedInfos()
    {
        return $this->med_infos;
    }

    /*
    * render a patient as a string 
    *
    * @return string
    */
    public function __toString(){
        return $this->getName();
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Patient
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}
