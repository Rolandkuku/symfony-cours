<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
* @ORM\Entity
*/

class Tag {

    public function __construct() {
        $this->updatedAt = new \DateTime();
        $this->createdAt = new \DateTime();
        $this->removed = false;
    }

    /**
    * @var integer
    *
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
     * Get the value of Id
    *
    * @return integer
    */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * Get the value of name
     * @return string name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set the value of name
     * @param string name
     * @return self
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * @var DateTime
    * 
    * @ORM\Column(name="createdAt", type="datetime")
    */
    private $createdAt;

    /**
     * Get the value of Created At
    *
    * @return string
    */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of Created At
    *
    * @param string createdAt
    *
    * @return self
    */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @var DateTime
    * 
    * @ORM\Column(type="datetime")
    * @Gedmo\Timestampable(on="update")
    */
    private $updatedAt;

    /**
     * Get the value of updaTedAtt
     * @return DateTime
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", unique=true)
     */
    private $slug;

    /**
     * Get the value of slug
     * @return string slug
     */
    public function getSlug() {
        return $this->slug;
    }

     /**
     * @var boolean
     * @ORM\Column(name="removed", type="boolean")
     */
    private $removed;

    /**
     * Get the value of removed
     * @return boolean
     */
    public function getRemoved() {
        return $this->removed;
    }

    /**
     * Set the value of removed
     * @param boolean removed
     * @return self
     */
    public function setRemoved($removed) {
        $this->removed = $removed;

        return $this;
    }

}