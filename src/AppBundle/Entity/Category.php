<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 08.03.15
 * Time: 11:24
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category
{
    /**
     * @ORM\Column(type="integer", name="cat_id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, name="cat_name")
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100, name="cat_color")
     */
    protected $color;

    /**
     * @ORM\Column(type="datetime", length=100, name="cat_created")
     */
    protected $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="name")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;



/**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="createdCategories")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="use_id")
     */
    protected $createdBy;




    public function __construct(){
        $this->createdAt = new \DateTime('now');
        $this->createdCategories = new ArrayCollection();
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
     * @return Category
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
     * Set color
     *
     * @param string $color
     * @return Category
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Category
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
