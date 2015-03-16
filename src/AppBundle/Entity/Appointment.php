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
     * @ORM\OneToMany(targetEntity="AppointmentWithUser", mappedBy="appointment")
     * @ORM\JoinColumn(name="app_with_user", referencedColumnName="app_with_user_id", nullable=false, onDelete="CASCADE")
     */
    protected $withUser;

    /**
     * @ORM\OneToMany(targetEntity="AppointmentWithUser", mappedBy="appointment")
     * @ORM\JoinColumn(name="app_with_external_person", referencedColumnName="app_with_user_id", nullable=false, onDelete="CASCADE")
     */
    protected $withExternalPerson;

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
     * Constructor
     */
    public function __construct()
    {
        $this->withUser = new ArrayCollection();
        $this->withExternalPerson = new ArrayCollection();
        $this->setCreatedAt(new \DateTime('now'));
    }

    /**
     * Add withUser
     *
     * @param \AppBundle\Entity\AppointmentWithUser $withUser
     * @return Appointment
     */
    public function addWithUser(\AppBundle\Entity\AppointmentWithUser $withUser)
    {
        $this->withUser[] = $withUser;

        return $this;
    }

    /**
     * Remove withUser
     *
     * @param \AppBundle\Entity\AppointmentWithUser $withUser
     */
    public function removeWithUser(\AppBundle\Entity\AppointmentWithUser $withUser)
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
     * @param \AppBundle\Entity\AppointmentWithUser $withExternalPerson
     * @return Appointment
     */
    public function addWithExternalPerson(\AppBundle\Entity\AppointmentWithUser $withExternalPerson)
    {
        $this->withExternalPerson[] = $withExternalPerson;

        return $this;
    }

    /**
     * Remove withExternalPerson
     *
     * @param \AppBundle\Entity\AppointmentWithUser $withExternalPerson
     */
    public function removeWithExternalPerson(\AppBundle\Entity\AppointmentWithUser $withExternalPerson)
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
