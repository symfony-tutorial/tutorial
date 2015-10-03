<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductStock
 *
 * @ORM\Table(name="product_stock", indexes={@ORM\Index(name="idx_product_id", columns={"product_id"}), @ORM\Index(name="idx_warehouse_id", columns={"warehouse_id"})})
 * @ORM\Entity
 */
class ProductStock
{

    const REPOSITORY = 'AppBundle:ProductStock';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false, options={"default"=0})
     */
    private $quantity;

    /**
     * @var \Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", nullable=false, referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var \Warehouse
     *
     * @ORM\ManyToOne(targetEntity="Warehouse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="warehouse_id", nullable=false, referencedColumnName="id")
     * })
     */
    private $warehouse;

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
     * Set quantity
     *
     * @param integer $quantity
     * @return ProductStock
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     * @return ProductStock
     */
    public function setProduct(\AppBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set warehouse
     *
     * @param \AppBundle\Entity\Warehouse $warehouse
     * @return ProductStock
     */
    public function setWarehouse(\AppBundle\Entity\Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    /**
     * Get warehouse
     *
     * @return \AppBundle\Entity\Warehouse 
     */
    public function getWarehouse()
    {
        return $this->warehouse;
    }

}
