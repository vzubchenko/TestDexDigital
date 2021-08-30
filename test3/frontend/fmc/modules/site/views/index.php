<?php

use yii\helpers\Url;



$jsonFail = '
    {
      "pay_form": {
        "token": "xxx",
        "design_name": "des1"
      },
      "transactions": {
        "12345-7891234567": {
          "id": "12345-7891234567",
          "operation": "pay",
          "status": "fail",
          "descriptor": "FAKE_PSP",
          "amount": 2345,
          "currency": "USD",
          "fee": {
            "amount": 0,
            "currency": "USD"
          },
          "card": {
            "bank": "CITIZENS STATE BANK",
          }
        }
      },
      "error": {
        "code": "6.01",
        "messages": [
          "Unknown decline code"
        ],
        "recommended_message_for_user": "Unknown decline code"
      },
      "order": {
        "order_id": "12345-7891234567",
        "status": "declined",
        "amount": 2345,
        "refunded_amount": 0,
        "currency": "USD",
        "marketing_amount": 2345,
        "marketing_currency": "USD",
        "processing_amount": 2345,
        "processing_currency": "USD",
        "descriptor": "FAKE_PSP",
        "fraudulent": false,
        "total_fee_amount": 0,
        "fee_currency": "USD"
      },
      "transaction": {
        "id": "12345-7891234567",
        "operation": "pay",
        "status": "fail"
      }
    }
';

$jsonSuccess = '
    {
      "pay_form": {
        "token": "xxx",
        "design_name": "des1"
      },
      "transactions": {
        "12345-7891234567": {
          "id": "12345-7891234567",
          "operation": "pay",
          "status": "success",
          "descriptor": "FAKE_PSP",
          "amount": 2345,
          "currency": "USD",
          "fee": {
            "amount": 0,
            "currency": "USD"
          },
          "card": {
            "bank": "CITIZENS STATE BANK",
          }
        }
      },
      "error": {
        "code": "6.01",
        "messages": [
          "Unknown decline code"
        ],
        "recommended_message_for_user": "Unknown decline code"
      },
      "order": {
        "order_id": "12345-7891234567",
        "status": "declined",
        "amount": 2345,
        "refunded_amount": 0,
        "currency": "USD",
        "marketing_amount": 2345,
        "marketing_currency": "USD",
        "processing_amount": 2345,
        "processing_currency": "USD",
        "descriptor": "FAKE_PSP",
        "fraudulent": false,
        "total_fee_amount": 0,
        "fee_currency": "USD"
      },
      "transaction": {
        "id": "12345-7891234567",
        "operation": "pay",
        "status": "fail"
      }
    }
';

$js = "
    $('.btn-danger').on('click', function(){
        $.ajax({
        url         : '".Url::to(['api/callback'])."',
        type        : 'GET',
        data        : ".$jsonFail.",
        contentType : 'application/json; charset=utf-8',
        dataType    : 'json',
        
        success: function(response){
            document.location.href = response;
        }
        
        });
    });
    
        $('.btn-success').on('click', function(){
        $.ajax({
        url         : '".Url::to(['api/callback'])."',
        type        : 'GET',
        data        : ".$jsonSuccess.",
        contentType : 'application/json; charset=utf-8',
        dataType    : 'json',
        
        success: function(response){
            document.location.href = response;
        }
        
        });
    });
";
$this->registerJs($js, $this::POS_END);
?>
<button type="button" class="btn btn-success">
    <?= \Yii::t('app/order/main', 'Success Request') ?>
</button>

<button type="button" class="btn btn-danger">
    <?= \Yii::t('app/order/main', 'Fail Request') ?>
</button>