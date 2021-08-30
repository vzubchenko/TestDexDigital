<?php
namespace fmc\modules\api;


use fmc\modules\order\OrderService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ApiController extends Controller
{
    const STATUS_SUCCESS    = 'success';
    const STATUS_FAIL       = 'fail';

    /**
     * @throws \Exception
     */
    public function actionCallback()
    {

        if (Yii::$app->request->get()){
            $data = Yii::$app->request->get();
            $service = new OrderService();

            $orderId = $data['order']['order_id'] ?: 0;
            $orderIdBin = $service->getDecBin($orderId);
            $status = $data['transactions'][$orderId]['status'] ?: self::STATUS_FAIL;
            $statusId = $service->getStatusId($status);
            $order = $service->getOrderById($orderIdBin);

            if ($order->id){
                $order->status = $statusId;
                $id = $service->updateOrder($order);
            } else {
                $order->id = $orderIdBin;
                $order->status = $statusId;

                $id = $service->saveOrder($order);
            }

//            Храню orderId в сесии но по хоршему хранил бы в базе и писал под юзера таблицу user_order,
//            так как тут не предусмотрена аутентификация пишу просто в сессию, я знаю что плохо так делать =)
            $session = Yii::$app->session;
            $session['orderId'] = $id;
            $session['execution'] = $status;
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $order->getUrlByStatus() ?: '/';
        } else {
            return false;
        }
    }
}
