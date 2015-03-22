<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * ExternalPerson
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ExternalPerson
{
    /**
     * @var integer
     *
     * @ORM\Column(name="exp_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="exp_name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="exp_email", type="string", length=100)
     */
    private $email;


    /**
     * @ORM\ManyToMany(targetEntity="Appointment", inversedBy="externalPersons")
     * @ORM\JoinTable(
     *     name="AppointmentHasExternalPerson",
     *     joinColumns={@ORM\JoinColumn(name="external_person_id", referencedColumnName="exp_id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="appointment_id", referencedColumnName="apo_id", nullable=false)}
     * )
     */
    private $appointment;

    public function __construct()
    {
        $this->appointment = new ArrayCollection();
    }

    function __toString()
    {
        return $this->name;
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
     * Add appointment
     *
     * @param \AppBundle\Entity\Appointment $appointment
     * @return ExternalPerson
     */
    public function addAppointment(\AppBundle\Entity\Appointment $appointment)
    {
        $this->appointment[] = $appointment;

        return $this;
    }

    /**
     * Remove appointment
     *
     * @param \AppBundle\Entity\Appointment $appointment
     */
    public function removeAppointment(\AppBundle\Entity\Appointment $appointment)
    {
        $this->appointment->removeElement($appointment);
    }

    /**
     * Get appointment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAppointment()
    {
        return $this->appointment;
    }
}
