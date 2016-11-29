<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/29
 * Time: 17:18
 */
namespace ApigilityOrder\DoctrineEntity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\Common\Collections\ArrayCollection;
use ApigilityUser\DoctrineEntity\User;

/**
 * Class OrderDetail
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityorder_order_detail")
 */
class OrderDetail
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 明细标题
     *
     * @Column(type="string", length=200, nullable=true)
     */
    protected $title;

    /**
     * 单价
     *
     * @Column(type="decimal", precision=7, scale=2, nullable=false)
     */
    protected $price;

    /**
     * 数量
     *
     * @Column(type="integer", nullable=false, options={"default":1, "unsigned":true})
     */
    protected $quantity;

    /**
     * 产品标识
     *
     * @Column(type="integer", nullable=true)
     */
    protected $product_id;

    /**
     * 规格标识
     *
     * @Column(type="integer", nullable=true)
     */
    protected $specification_id;

    /**
     * 订单对象
     *
     * @ManyToOne(targetEntity="Order", inversedBy="orderDetails")
     * @JoinColumn(name="order_id", referencedColumnName="id")
     */
    protected $order;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
        return $this;
    }

    public function getProductId()
    {
        return $this->product_id;
    }

    public function setSpecificationId($specification_id)
    {
        $this->specification_id = $specification_id;
        return $this;
    }

    public function getSpecificationId()
    {
        return $this->specification_id;
    }

    public function setOrder(Order $order)
    {
        $this->order = $order;
        return $this;
    }

    public function getOrder()
    {
        return $this->order;
    }
}