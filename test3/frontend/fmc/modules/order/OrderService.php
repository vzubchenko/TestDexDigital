<?php


namespace fmc\modules\order;


class OrderService
{
    private $repository;

    function __construct()
    {
        $this->repository = new OrderRepository();
    }

    /**
     * @param $id
     *
     * @return OrderModel|null
     */
    public function getOrderById($id){
        return $this->repository->getOrderById($id);
    }

    /**
     * @param $status
     *
     * @return int
     */
    public function getStatusId($status){
        switch($status){
            case 'success':
                return 1;
            default:
                return 0;
        }
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function getDecBin($id){
        return decbin(str_replace("-", "", $id));
    }

    /**
     * @param OrderModel  $order
     *
     * @throws \Exception
     */
    public function saveOrder(OrderModel $order){
        return $this->repository->saveOrder($order);
    }

    /**
     * @param OrderModel  $order
     *
     * @throws \Exception
     */
    public function updateOrder(OrderModel $order){
        return $this->repository->updateOrder($order);
    }

}