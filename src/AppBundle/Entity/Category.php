<?php
/**
 * Created by PhpStorm.
 * User: bezimienny
 * Date: 08.03.15
 * Time: 11:24
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

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

    public function __construct(){
        $this->createdAt = new \DateTime('now');
    }
}