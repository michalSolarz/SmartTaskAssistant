<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */
class Task
{

    /**
     * @ORM\Column(type="integer", name="tas_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, name="tas_content")
     */
    protected $content;

    /**
     * @ORM\Column(type="date", name="tas_due_date")
     */
    protected $dueDate;


    /**
     * @ORM\Column(type="boolean", name="tas_done")
     */
    protected $done;

    /**
     * @ORM\Column(type="integer", name="tas_priority")
     */
    protected $priority;

    /**
     * @ORM\Column(type="datetime", name="tas_created_at")
     */
    protected $createdAt;


    public function __construct()
    {
        $now = new \DateTime('now');
        $this->setCreatedAt($now);
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
     * Set content
     *
     * @param string $content
     * @return Task
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     * @return Task
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime 
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set done
     *
     * @param boolean $done
     * @return Task
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return boolean 
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return Task
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Task
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
}
