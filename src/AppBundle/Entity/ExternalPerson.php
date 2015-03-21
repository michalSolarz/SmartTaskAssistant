<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 16.03.15
 * Time: 13:38
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Class ExternalPerson
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="external_person")
 */
class ExternalPerson
{
    /**
     * @ORM\Column(type="integer", name="ext_person_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string" ,length=100 ,name="ext_person_email")
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=40, name="ext_person_name")
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="Appointment", inversedBy="withExternalPerson")
     */
    /**
     * @ORM\ManyToMany(targetEntity="Appointment", inversedBy="withUser")
     * @ORM\JoinTable(name="external_person_appointments",
     *      joinColumns={@JoinColumn(name="external_person_id", referencedColumnName="ext_person_id")},
     *      inverseJoinColumns={@JoinColumn(name="appointment_id", referencedColumnName="app_id")}
     *      )
     */
    protected $appointments;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->appointments = new ArrayCollection();
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
     * Set email
     *
     * @param string $email
     * @return ExternalPerson
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ExternalPerson
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
     * Add appointments
     *
     * @param \AppBundle\Entity\AppointmentWithExternalPerson $appointments
     * @return ExternalPerson
     */
    public function addAppointment(\AppBundle\Entity\AppointmentWithExternalPerson $appointments)
    {
        $this->appointments[] = $appointments;

        return $this;
    }

    /**
     * Remove appointments
     *
     * @param \AppBundle\Entity\AppointmentWithExternalPerson $appointments
     */
    public function removeAppointment(\AppBundle\Entity\AppointmentWithExternalPerson $appointments)
    {
        $this->appointments->removeElement($appointments);
    }

    /**
     * Get appointments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAppointments()
    {
        return $this->appointments;
    }
}
