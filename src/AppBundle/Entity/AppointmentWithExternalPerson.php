<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 16.03.15
 * Time: 12:26
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class AppointmentWithUser
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="appointment_with__external_person")
 */
class AppointmentWithExternalPerson
{
    /**
     * @ORM\Column(type="integer", name="app_with_external_person_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", name="app_with_external_person_created_at")
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Appointment", inversedBy="withUser")
     * @ORM\JoinColumn(name="appointment_id", referencedColumnName="app_id", nullable=false, onDelete="CASCADE")
     **/
    protected $appointment;

    /**
     * @ORM\ManyToOne(targetEntity="ExternalPerson", inversedBy="appointments")
     * @ORM\JoinColumn(name="external_person_id", referencedColumnName="ext_person_id", nullable=false, onDelete="CASCADE")
     **/
    protected $externalPerson;

    public function __construct(){
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
     * @return AppointmentWithExternalPerson
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
     * Set appointment
     *
     * @param \AppBundle\Entity\Appointment $appointment
     * @return AppointmentWithExternalPerson
     */
    public function setAppointment(\AppBundle\Entity\Appointment $appointment)
    {
        $this->appointment = $appointment;

        return $this;
    }

    /**
     * Get appointment
     *
     * @return \AppBundle\Entity\Appointment 
     */
    public function getAppointment()
    {
        return $this->appointment;
    }

    /**
     * Set externalPerson
     *
     * @param \AppBundle\Entity\ExternalPerson $externalPerson
     * @return AppointmentWithExternalPerson
     */
    public function setExternalPerson(\AppBundle\Entity\ExternalPerson $externalPerson)
    {
        $this->externalPerson = $externalPerson;

        return $this;
    }

    /**
     * Get externalPerson
     *
     * @return \AppBundle\Entity\ExternalPerson 
     */
    public function getExternalPerson()
    {
        return $this->externalPerson;
    }
}
