<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 14.03.15
 * Time: 13:23
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * Class Appointment
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="appointment")
 */
class Appointment
{
    /**
     * @ORM\Column(type="integer", name="app_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", name="app_created_at")
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="createdAppointments")
     * @ORM\JoinColumn(name="app_created_by", referencedColumnName="use_id", nullable=false, onDelete="CASCADE")
     */
    protected $createdBy;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="appointments")
     * @ORM\JoinTable(name="user_appointment",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="use_id")},
     *      inverseJoinColumns={@JoinColumn(name="appointment_id", referencedColumnName="app_id")}
     *      )
     */
    protected $withUser;

    /**
     * @ORM\ManyToMany(targetEntity="ExternalPerson", mappedBy="appointments")
     */
    protected $withExternalPerson;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->withUser = new ArrayCollection();
        $this->withExternalPerson = new ArrayCollection();
        $this->setCreatedAt(new \DateTime('now'));
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Appointment
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $createdBy
     * @return Appointment
     */
    public function setCreatedBy(\AppBundle\Entity\User $createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \AppBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Add withUser
     *
     * @param \AppBundle\Entity\User $withUser
     * @return Appointment
     */
    public function addWithUser(\AppBundle\Entity\User $withUser)
    {
        $this->withUser[] = $withUser;


        return $this;
    }

    /**
     * Remove withUser
     *
     * @param \AppBundle\Entity\User $withUser
     */
    public function removeWithUser(\AppBundle\Entity\User $withUser)
    {
        $this->withUser->removeElement($withUser);
    }

    /**
     * Get withUser
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWithUser()
    {
        return $this->withUser;
    }

    /**
     * Add withExternalPerson
     *
     * @param \AppBundle\Entity\ExternalPerson $withExternalPerson
     * @return Appointment
     */
    public function addWithExternalPerson(\AppBundle\Entity\ExternalPerson $withExternalPerson)
    {
        $this->withExternalPerson[] = $withExternalPerson;

        return $this;
    }

    /**
     * Remove withExternalPerson
     *
     * @param \AppBundle\Entity\ExternalPerson $withExternalPerson
     */
    public function removeWithExternalPerson(\AppBundle\Entity\ExternalPerson $withExternalPerson)
    {
        $this->withExternalPerson->removeElement($withExternalPerson);
    }

    /**
     * Get withExternalPerson
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWithExternalPerson()
    {
        return $this->withExternalPerson;
    }
}
