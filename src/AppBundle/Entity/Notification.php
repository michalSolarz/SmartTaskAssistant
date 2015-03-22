<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 22.03.15
 * Time: 12:19
 */

namespace AppBundle\Entity;

use AppBundle\Interfaces\entityAuthorInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="notification")
 */
class Notification implements entityAuthorInterface
{
    /**
     * @ORM\Column(type="integer", name="ntf_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", name="ntf_created")
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="createdNotes")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="use_id", nullable=false)
     */
    protected $createdBy;

    /**
     * @ORM\Column(type="string", length=255, name="ntf_content")
     */
    protected $content;

    /**
     * @ORM\Column(type="tinyint", name="ntf_status")
     */
    protected $status;

    public function __construct(){
        $this->createdAt = new \DateTime('now');
    }

    public function setCreatedBy(\AppBundle\Entity\User $user)
    {
        $this->createdBy = $user;
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
     * @return Notification
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
     * Set content
     *
     * @param string $content
     * @return Notification
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
     * Get createdBy
     *
     * @return \AppBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set status
     *
     * @param \tinyint $status
     * @return Notification
     */
    public function setStatus(\tinyint $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \tinyint 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
