<?php
namespace ApigilityOrder\V1\Rest\Order;

use ApigilityOrder\DoctrineEntity\OrderDetail;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use ApigilityUser\DoctrineEntity\User;
use ApigilityUser\V1\Rest\User\UserEntity;
use ApigilityOrder\V1\Rest\OrderDetail\OrderDetailEntity;

class OrderEntity
{
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

    private $hy;

    public function __construct(\ApigilityOrder\DoctrineEntity\Order $order)
    {
        $this->hy = new ClassMethodsHydrator();
        $this->hy->hydrate($this->hy->extract($order), $this);
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
        if ($this->create_time instanceof \DateTime) {
            return $this->create_time->getTimestamp();
        } else {
            return $this->create_time;
        }
    }

    public function setPayTime($pay_time)
    {
        $this->pay_time = $pay_time;
        return $this;
    }

    public function getPayTime()
    {
        if ($this->pay_time instanceof \DateTime) {
            return $this->pay_time->getTimestamp();
        } else {
            return $this->pay_time;
        }
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        if ($this->user instanceof User) {
            return $this->hy->extract(new UserEntity($this->user));
        } else {
            return $this->user;
        }
    }

    public function setOrderDetails($orderDetails)
    {
        return $this->orderDetails = $orderDetails;
    }

    public function addOrderDetail($orderDetail)
    {
        $this->orderDetails[] = $orderDetail;
        return $this;
    }

    public function getOrderDetails()
    {
        $data = array();
        foreach ($this->orderDetails as $orderDetail) {
            $data[] = $this->hy->extract(new OrderDetailEntity($orderDetail));
        }

        return $data;
    }
}
