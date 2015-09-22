<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(
 *  name="category",
 *  indexes={@ORM\Index(name="idx_parent_category_id",columns={"parent_category_id"})}
 * )
 * @ORM\Entity
 */
class Category
{

    const REPOSITORY = 'AppBundle:Category';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=45, nullable=true)
     */
    private $label;

    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_category_id", referencedColumnName="id")
     * })
     */
    private $parentCategory;

    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getParent()
    {
        return $this->parentCategory;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function setParent(Category $parentCategory = null)
    {
        $this->parentCategory = $parentCategory;
        return $this;
    }

}
