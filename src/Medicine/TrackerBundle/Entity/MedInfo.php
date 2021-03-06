<?php

namespace Medicine\TrackerBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * MedInfo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Medicine\TrackerBundle\Entity\MedInfoRepository")
 */
class MedInfo
{

    /**
    * Many Medicine infos is related to one patient
    *
    * @var Patient
    * @ORM\ManyToOne(targetEntity="Patient", inversedBy="med_infos")
    * @ORM\JoinColumn(name="medicine_id", referencedColumnName="id")
    */
    private $patient;


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="preparedOn", type="date")
     */
    private $preparedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="numBlisters", type="integer")
     */
    private $numBlisters;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deliveryPickupDate", type="date")
     */
    private $deliveryPickupDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nextDueDate", type="date")
     */
    private $nextDueDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;


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
     * Set preparedOn
     *
     * @param \DateTime $preparedOn
     * @return MedInfo
     */
    public function setPreparedOn($preparedOn)
    {
        $this->preparedOn = $preparedOn;

        return $this;
    }

    /**
     * Get preparedOn
     *
     * @return \DateTime 
     */
    public function getPreparedOn()
    {
        return $this->preparedOn;
    }

    /**
     * Set numBlisters
     *
     * @param integer $numBlisters
     * @return MedInfo
     */
    public function setNumBlisters($numBlisters)
    {
        $this->numBlisters = $numBlisters;

        return $this;
    }

    /**
     * Get numBlisters
     *
     * @return integer 
     */
    public function getNumBlisters()
    {
        return $this->numBlisters;
    }

    /**
     * Set deliveryPickupDate
     *
     * @param \DateTime $deliveryPickupDate
     * @return MedInfo
     */
    public function setDeliveryPickupDate($deliveryPickupDate)
    {
        $this->deliveryPickupDate = $deliveryPickupDate;

        return $this;
    }

    /**
     * Get deliveryPickupDate
     *
     * @return \DateTime 
     */
    public function getDeliveryPickupDate()
    {
        return $this->deliveryPickupDate;
    }

    /**
     * Set nextDueDate
     *
     * @param \DateTime $nextDueDate
     * @return MedInfo
     */
    public function setNextDueDate($nextDueDate)
    {
        $this->nextDueDate = $nextDueDate;

        return $this;
    }

    /**
     * Get nextDueDate
     *
     * @return \DateTime 
     */
    public function getNextDueDate()
    {
        return $this->nextDueDate;
    }

    /**
     * Set patient
     *
     * @param \Medicine\TrackerBundle\Entity\Patient $patient
     * @return MedInfo
     */
    public function setPatient(\Medicine\TrackerBundle\Entity\Patient $patient = null)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return \Medicine\TrackerBundle\Entity\Patient 
     */
    public function getPatient()
    {
        return $this->patient;
    }

    

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return MedInfo
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
