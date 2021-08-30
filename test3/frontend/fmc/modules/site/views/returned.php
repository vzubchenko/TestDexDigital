<?php
/** @var OrderModel $order */

use \fmc\modules\order\OrderModel;
?>

<div class="alert alert-<?= $order->getClassByStatus() ?>" role="alert">
    <p>
        <?= $order->getTextByStatus() ?>
    </p>

    <p>
        <?= $order->getStatusInfo() ?>
    </p>

    <p>
        <?= \Yii::t('app/order/main', 'Transaction ID: ') . $order->getNormalId() ?>
    </p>
</div>