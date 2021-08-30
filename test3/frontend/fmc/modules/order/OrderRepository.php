<?php

namespace fmc\modules\order;


use yii\db\Query;
use Yii;

class OrderRepository
{
    /**
     * @param $id
     *
     * @return OrderModel|null
     */
    public function getOrderById($id)
    {
        $order = (new Query())
            ->from(OrderModel::getTable())
            ->where(['id' => $id])
            ->one();
//        return $order ? new OrderModel($order) : null;
        if ($order){
            return new OrderModel($order);
        } else {
            return new OrderModel();
        }

    }


    /**
     * @param  OrderModel  $order
     *
     * @throws \yii\db\Exception
     */
    public function saveOrder(OrderModel $order)
    {

        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();

        try {
            $id=0;
            if($order){
                $db->createCommand()->insert(OrderModel::getTable(), $order->toArray())->execute();
                $id = $db->lastInsertID;
            }

            $transaction->commit();
            return $id;

        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
        }
    }

    /**
     * @param  OrderModel  $order
     *
     * @throws \yii\db\Exception
     */
    public function updateOrder(OrderModel $order)
    {

        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();

        try {
            $id=0;
            if($order){
                $db->createCommand()->update(OrderModel::getTable(), $order->toArray(),['id' => $order->id])->execute();
                $id = $order->id;
            }

            $transaction->commit();
            return $id;

        } catch(\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch(\Throwable $e) {
            $transaction->rollBack();
        }
    }
}