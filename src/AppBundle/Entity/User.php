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


	public function __construct()
    {
        $now = new \DateTime('now');
        $this->setCreatedAt($now);


        $this->createdTasks = new ArrayCollection();

        $this->assignedTasks = new ArrayCollection();
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
      * @ORM\ManyToOne(targetEntity="name", inversedBy="")
      */
     protected $category;


}

