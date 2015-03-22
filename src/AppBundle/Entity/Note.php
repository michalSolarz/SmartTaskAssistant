<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 21.03.15
 * Time: 15:28
 */

namespace AppBundle\Entity;

namespace AppBundle\Entity;

use AppBundle\Interfaces\entityAuthorInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="note")
 */
class Note implements entityAuthorInterface{

    /**
     * @ORM\Column(type="integer", name="not_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", name="not_created")
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="createdNotifications")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="use_id", nullable=false)
     */
    protected $createdBy;

    /**
     * @ORM\Column(type="boolean", name="not_visible")
     */
    protected $visible;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $content;

    public function __construct(){
        $this->setCreatedAt(new \DateTime('now'));
    }

    /**
     * @param User $createdBy
     */
    public function setCreatedBy(User $createdBy){
        $this->createdBy = $createdBy;
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
     * @return Note
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
     * @return Note
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
     * Set visible
     *
     * @param boolean $visible
     * @return Note
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }
}
