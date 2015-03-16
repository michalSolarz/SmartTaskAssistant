<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Column(type="integer", name="use_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string" ,length=100 ,name="use_email")
     */
    protected $email;

    /**
     * @ORM\Column(type="string" ,length=20 ,name="use_password")
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=40, name="use_name")
     */
    protected $name;

    /**
     * @ORM\Column(type="datetime", name="use_created_at")
     */
    protected $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="createdBy")
     */
    protected $createdTasks;
    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="assignee")
     **/
    protected $assignedTasks;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="createdBy")
     **/
    protected $createdCategories;

    /**
     * @ORM\OneToMany(targetEntity="Appointment", mappedBy="createdBy")
     **/
    protected $createdAppointments;

    /**
     * @ORM\OneToMany(targetEntity="AppointmentWithUser", mappedBy="user")
     * @ORM\JoinColumn(name="app_with_user", referencedColumnName="app_with_user_id", nullable=false, onDelete="CASCADE")
     */
    protected $appointments;

    public function __construct()
    {
        $now = new \DateTime('now');
        $this->setCreatedAt($now);


        $this->createdTasks = new ArrayCollection();

        $this->assignedTasks = new ArrayCollection();

        $this->createdAppointments = new ArrayCollection();
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
     * @return User
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
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        if (!isset($this->createdAt)) {
            $this->createdAt = $createdAt;
        }
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
     * Add createdTasks
     *
     * @param \AppBundle\Entity\Task $createdTasks
     * @return User
     */
    public function addCreatedTask(\AppBundle\Entity\Task $createdTasks)
    {
        $this->createdTasks[] = $createdTasks;

        return $this;
    }

    /**
     * Remove createdTasks
     *
     * @param \AppBundle\Entity\Task $createdTasks
     */
    public function removeCreatedTask(\AppBundle\Entity\Task $createdTasks)
    {
        $this->createdTasks->removeElement($createdTasks);
    }

    /**
     * Get createdTasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedTasks()
    {
        return $this->createdTasks;
    }

    /**
     * Add assignedTasks
     *
     * @param \AppBundle\Entity\Task $assignedTasks
     * @return User
     */
    public function addAssignedTask(\AppBundle\Entity\Task $assignedTasks)
    {
        $this->assignedTasks[] = $assignedTasks;

        return $this;
    }

    /**
     * Remove assignedTasks
     *
     * @param \AppBundle\Entity\Task $assignedTasks
     */
    public function removeAssignedTask(\AppBundle\Entity\Task $assignedTasks)
    {
        $this->assignedTasks->removeElement($assignedTasks);
    }

    /**
     * Get assignedTasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssignedTasks()
    {
        return $this->assignedTasks;
    }

    /**
     * Add createdCategories
     *
     * @param \AppBundle\Entity\Category $createdCategories
     * @return User
     */
    public function addCreatedCategory(\AppBundle\Entity\Category $createdCategories)
    {
        $this->createdCategories[] = $createdCategories;

        return $this;
    }

    /**
     * Remove createdCategories
     *
     * @param \AppBundle\Entity\Category $createdCategories
     */
    public function removeCreatedCategory(\AppBundle\Entity\Category $createdCategories)
    {
        $this->createdCategories->removeElement($createdCategories);
    }

    /**
     * Get createdCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedCategories()
    {
        return $this->createdCategories;
    }

    /**
     * Add createdAppointments
     *
     * @param \AppBundle\Entity\Appointment $createdAppointments
     * @return User
     */
    public function addCreatedAppointment(\AppBundle\Entity\Appointment $createdAppointments)
    {
        $this->createdAppointments[] = $createdAppointments;

        return $this;
    }

    /**
     * Remove createdAppointments
     *
     * @param \AppBundle\Entity\Appointment $createdAppointments
     */
    public function removeCreatedAppointment(\AppBundle\Entity\Appointment $createdAppointments)
    {
        $this->createdAppointments->removeElement($createdAppointments);
    }

    /**
     * Get createdAppointments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedAppointments()
    {
        return $this->createdAppointments;
    }

    /**
     * Add appointments
     *
     * @param \AppBundle\Entity\AppointmentWithUser $appointments
     * @return User
     */
    public function addAppointment(\AppBundle\Entity\AppointmentWithUser $appointments)
    {
        $this->appointments[] = $appointments;

        return $this;
    }

    /**
     * Remove appointments
     *
     * @param \AppBundle\Entity\AppointmentWithUser $appointments
     */
    public function removeAppointment(\AppBundle\Entity\AppointmentWithUser $appointments)
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
