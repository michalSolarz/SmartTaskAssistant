<?php

namespace AppBundle\Entity;

use AppBundle\Interfaces\entityAuthorInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */
class Task implements entityAuthorInterface
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

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="assignedTasks")
     * @ORM\JoinColumn(name="assignee_id", referencedColumnName="use_id", onDelete="CASCADE")
     */
    protected $assignee;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="createdTasks")
     * @ORM\JoinColumn(name="created_by_id", referencedColumnName="use_id", nullable=false, onDelete="CASCADE")
     */
    protected $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category", referencedColumnName="cat_id")
     */
    protected $category;

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

    /**
     * Set assignee
     *
     * @param \AppBundle\Entity\User $assignee
     * @return Task
     */
    public function setAssignee(\AppBundle\Entity\User $assignee = null)
    {
        $this->assignee = $assignee;

        return $this;
    }

    /**
     * Get assignee
     *
     * @return \AppBundle\Entity\User
     */
    public function getAssignee()
    {
        return $this->assignee;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $createdBy
     * @return Task
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
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     * @return Task
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function getDueDateAsString()
    {
        return date_format($this->dueDate, 'Y-m-d');
    }

    public function getDoneAsYesNo()
    {
        return $this->done ? 'yes' : 'no';
    }

    public function getPriorityAsString()
    {

        switch ($this->priority) {
            case 'low':
                $p = 'low';
                break;
            case 'medium':
                $p = 'medium';
                break;
            case 'high':
                $p = 'high';
                break;
            case 'urgent':
                $p = 'urgent';
                break;
        }
        return $p;
    }

}
