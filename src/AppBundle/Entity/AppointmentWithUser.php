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
 * @ORM\Table(name="appointment_with_user")
 */
class AppointmentWithUser
{
    /**
     * @ORM\Column(type="integer", name="app_with_user_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", name="app_with_user_created_at")
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Appointment", inversedBy="withUser")
     * @ORM\JoinColumn(name="appointment_id", referencedColumnName="app_id", nullable=false, onDelete="CASCADE")
     **/
    protected $appointment;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="appointments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="use_id", nullable=false, onDelete="CASCADE")
     **/
    protected $user;

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
     * @return AppointmentWithUser
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
     * @return AppointmentWithUser
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return AppointmentWithUser
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
