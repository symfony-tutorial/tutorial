<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address", indexes={@ORM\Index(name="idx_country_id", columns={"country_id"})})
 * @ORM\Entity
 */
class Address
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=45, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street_name", type="string", length=45, nullable=true)
     */
    private $streetName;

    /**
     * @var string
     *
     * @ORM\Column(name="street_number", type="string", length=45, nullable=true)
     */
    private $streetNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="building", type="string", length=45, nullable=true)
     */
    private $building;

    /**
     * @var string
     *
     * @ORM\Column(name="entrance", type="string", length=45, nullable=true)
     */
    private $entrance;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=45, nullable=true)
     */
    private $number;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=true)
     */
    private $deleted;

    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", nullable=false, referencedColumnName="id")
     * })
     */
    private $country;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Customer", inversedBy="address")
     * @ORM\JoinTable(name="customer_has_address",
     *   joinColumns={
     *     @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     *   }
     * )
     */
    private $customer;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->customer = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
