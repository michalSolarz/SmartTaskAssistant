<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Interfaces\entityAuthorInterface;

/**
 * Appointment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Appointment implements entityAuthorInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="apo_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="apo_title", type="string",  length=150)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="apo_startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="apo_endDate", type="datetime")
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="apo_whereIs", type="string", length=150)
     */
    private $whereIs;

    /**
     * @var string
     *
     * @ORM\Column(name="apo_info", type="text")
     */
    private $info;

    /**
     * @var string
     *
     * @ORM\Column(name="apo_color", type="string", length=30)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="appointmentCreate")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="use_id", nullable=false)
     */
    protected $createdBy;

    /**
     * @ORM\ManyToMany(targetEntity="ExternalPerson", mappedBy="appointment")
     */
    private $externalPersons;
    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="appointment")
     */
    private $users;

    public function __construct()
    {
        $this->externalPersons = new ArrayCollection();
        $this->users = new ArrayCollection();
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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Appointment
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Appointment
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set whereIs
     *
     * @param string $whereIs
     * @return Appointment
     */
    public function setWhereIs($whereIs)
    {
        $this->whereIs = $whereIs;

        return $this;
    }

    /**
     * Get whereIs
     *
     * @return string 
     */
    public function getWhereIs()
    {
        return $this->whereIs;
    }

    /**
     * Set info
     *
     * @param string $info
     * @return Appointment
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Appointment
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
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
     * Add externalPersons
     *
     * @param \AppBundle\Entity\ExternalPerson $externalPersons
     * @return Appointment
     */
    public function addExternalPerson(\AppBundle\Entity\ExternalPerson $externalPersons)
    {

        if (!$this->externalPersons->contains($externalPersons)) {
            $this->externalPersons[] = $externalPersons;
            $externalPersons->addAppointment($this);
        }
        return $this;
    }

    /**
     * Remove externalPersons
     *
     * @param \AppBundle\Entity\ExternalPerson $externalPersons
     */
    public function removeExternalPerson(\AppBundle\Entity\ExternalPerson $externalPersons)
    {
        $this->externalPersons->removeElement($externalPersons);
        $externalPersons->removeAppointment($this);
    }

    /**
     * Get externalPersons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExternalPersons()
    {
        return $this->externalPersons;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Appointment
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * Add users
     *
     * @param \AppBundle\Entity\User $user
     * @return Appointment
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addAppointment($this);
        }

        return $this;
    }

    /**
     * Remove users
     *
     * @param \AppBundle\Entity\User $users
     */
    public function removeUser(\AppBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
        $users->removeAppointment($this);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
