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
 * Class Order
 * @package ApigilityO2oServiceTrade\DoctrineEntity
 * @Entity @Table(name="apigilityorder_order")
 */
class Order
{
    const STATUS_WAIT_TO_PAY = 1;   // 等待付款
    const STATUS_CANCELED = 2;      // 已取消
    const STATUS_PAYED = 3;         // 已支付
    const STATUS_WAIT_TO_SEND = 4;  // 等待发货
    const STATUS_SENT = 5;          // 已发货
    const STATUS_SENT_BACK = 6;     // 货已回发
    const STATUS_FINISH = 7;        // 已完成

    const REFUND_STATUS_NONE = 1;   // 没有进入退款流程
    const REFUND_STATUS_REQUESTED = 2; // 已申请退款
    const REFUND_STATUS_REJECTED = 3;  // 已拒绝退款
    const REFUND_STATUS_ACCEPTED = 4;  // 已同意退款
    const REFUND_STATUS_DONE = 5;      // 已退款

    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;

    /**
     * 订单标题
     *
     * @Column(type="string", length=200, nullable=true)
     */
    protected $title;

    /**
     * 订单编号
     *
     * @Column(type="string", length=50, nullable=false)
     */
    protected $series_number;

    /**
     * 订单总额
     *
     * @Column(type="decimal", precision=7, scale=2, nullable=false)
     */
    protected $total;

    /**
     * 支付系统类型
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $payment_type;

    /**
     * 外部支付系统交易流水号
     *
     * @Column(type="string", length=50, nullable=true)
     */
    protected $payment_series_number;

    /**
     * 订单状态
     *
     * @Column(type="smallint", nullable=false)
     */
    protected $status;

    /**
     * 退款状态
     *
     * @Column(type="smallint", nullable=false)
     */
    protected $refund_status;

    /**
     * 创建时间
     *
     * @Column(type="datetime", nullable=false)
     */
    protected $create_time;

    /**
     * 支付时间
     *
     * @Column(type="datetime", nullable=true)
     */
    protected $pay_time;

    /**
     * 订单的所有者，ApigilityUser组件的User对象
     *
     * @ManyToOne(targetEntity="ApigilityUser\DoctrineEntity\User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * 订单明细
     *
     * @OneToMany(targetEntity="OrderDetail", mappedBy="order")
     */
    protected $orderDetails;

    public function __construct()
    {
        $this->orderDetails = new ArrayCollection();
    }

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

    public function setSeriesNumber($series_number)
    {
        $this->series_number = $series_number;
        return $this;
    }

    public function getSeriesNumber()
    {
        return $this->series_number;
    }

    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setPaymentType($payment_type)
    {
        $this->payment_type = $payment_type;
        return $this;
    }

    public function getPaymentType()
    {
        return $this->payment_type;
    }

    public function setPaymentSeriesNumber($payment_series_number)
    {
        $this->payment_series_number = $payment_series_number;
        return $this;
    }

    public function getPaymentSeriesNumber()
    {
        return $this->payment_series_number;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setRefundStatus($refund_status)
    {
        $this->refund_status = $refund_status;
        return $this;
    }

    public function getRefundStatus()
    {
        return $this->refund_status;
    }

    public function setCreateTime($create_time)
    {
        $this->create_time = $create_time;
        return $this;
    }

    public function getCreateTime()
    {
        return $this->create_time;
    }

    public function setPayTime($pay_time)
    {
        $this->pay_time = $pay_time;
        return $this;
    }

    public function getPayTime()
    {
        return $this->pay_time;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function addOrderDetail($orderDetail)
    {
        $this->orderDetails[] = $orderDetail;
        return $this;
    }

    public function getOrderDetails()
    {
        return $this->orderDetails;
    }
}