<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderProductLine
 *
 * @ORM\Table(name="order_product_line", indexes={@ORM\Index(name="idx_order_id", columns={"order_id"}), @ORM\Index(name="idx_product_sale_id", columns={"product_sale_id"})})
 * @ORM\Entity
 */
class OrderProductLine
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
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var \Order
     *
     * @ORM\ManyToOne(targetEntity="Order")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_id", nullable=false, referencedColumnName="id")
     * })
     */
    private $order;

    /**
     * @var \ProductSale
     *
     * @ORM\ManyToOne(targetEntity="ProductSale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_sale_id", nullable=false, referencedColumnName="id")
     * })
     */
    private $productSale;


}
