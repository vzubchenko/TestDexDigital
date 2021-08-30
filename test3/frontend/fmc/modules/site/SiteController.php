<?php
namespace fmc\modules\site;


use fmc\modules\order\OrderService;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    private $views = [
        'index'     => '@fmc/modules/site/views/index.php',
        'returned'  => '@fmc/modules/site/views/returned.php',
    ];

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render($this->views['index']);
    }


    /**
     * @param $status
     *
     * @return string
     */
    public function actionReturned($status)
    {
        $session    = Yii::$app->session;
        $service    = new OrderService();
        $orderId    = $session['orderId'] ?: 0;
        $order      = $service->getOrderById($orderId);
//        $session->destroy();

        return $this->render($this->views['returned'], [
            'order' => $order,
        ]);
    }
}
