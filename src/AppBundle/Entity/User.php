<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;



/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer", name="use_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;


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
     * @ORM\OneToMany(targetEntity="Task", mappedBy="createdBy", cascade={"remove"})
     */
    protected $createdTasks;
    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="assignee", cascade={"remove"})
     **/
    protected $assignedTasks;

    /**
     * @ORM\OneToMany(targetEntity="Appointment", mappedBy="createdBy")
     **/
    protected $appointmentCreate;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="createdBy", cascade={"remove"})
     **/
    protected $createdCategories;

    /**
     * @ORM\OneToMany(targetEntity="Note", mappedBy="createdBy", cascade={"remove"})
     **/
    protected $createdNotes;
 
    /**
     * @ORM\ManyToMany(targetEntity="Appointment", inversedBy="users")
     * @ORM\JoinTable(
     *     name="AppointmentHasUsers",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="use_id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="appointment_id", referencedColumnName="apo_id", nullable=false)}
     * )
     */
    protected $appointment;


	public function __construct()
    {
        $now = new \DateTime('now');
        $this->setCreatedAt($now);

        $this->createdTasks = new ArrayCollection();
        $this->assignedTasks = new ArrayCollection();

        $this->createdCategories = new ArrayCollection();

        $this->createdNotes = new ArrayCollection();
        $this->appointment = new ArrayCollection();

    }

    function __toString()
    {
        return $this->username;
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
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
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


    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }


    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
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
     * Add createdCategories
     *
     * @param \AppBundle\Entity\Note $createdNotes
     * @return User
     */
    public function addCreatedNote(\AppBundle\Entity\Note $createdNotes)
    {
        $this->createdNotes[] = $createdNotes;

        return $this;
    }

    /**
     * Remove createdCategories
     *
     * @param \AppBundle\Entity\Note $createdNotes
     */
    public function removeCreatedNote(\AppBundle\Entity\Note $createdNotes)
    {
        $this->createdNotes->removeElement($createdNotes);
    }

    /**
     * Get createdCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedNotes()
    {
        return $this->createdNotes;
    }

   
    /**
     * Add appointment
     *
     * @param \AppBundle\Entity\Appointment $appointment
     * @return User
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

    /**
     * Add appointmentCreate
     *
     * @param \AppBundle\Entity\Appointment $appointmentCreate
     * @return User
     */
    public function addAppointmentCreate(\AppBundle\Entity\Appointment $appointmentCreate)
    {
        $this->appointmentCreate[] = $appointmentCreate;

        return $this;
    }

    /**
     * Remove appointmentCreate
     *
     * @param \AppBundle\Entity\Appointment $appointmentCreate
     */
    public function removeAppointmentCreate(\AppBundle\Entity\Appointment $appointmentCreate)
    {
        $this->appointmentCreate->removeElement($appointmentCreate);
    }

    /**
     * Get appointmentCreate
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAppointmentCreate()
    {
        return $this->appointmentCreate;
    }
}
