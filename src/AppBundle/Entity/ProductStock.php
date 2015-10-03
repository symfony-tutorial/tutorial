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


}
