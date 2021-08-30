<?php


namespace fmc\modules\order;

use fmc\components\BaseModelDb;

/**
 * Class OrderModel
 * @package fmc\modules\order
 *
 * @property int $id
 * @property int $status
 */

class OrderModel extends BaseModelDb
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $status;


    /**
     * @param  array  $order
     */
    public function __construct(array $order = [])
    {
        foreach ($this->attributes as $key => $item){
            $this->$key = $order[$key] ?: 0;
        }
    }

    /**
     * @return string
     */
    public static function getTable()
    {
        return 'order';
    }

    public function attributes()
    {
        return [
            'id',
            'status',
        ];
    }

    /**
     * @return string
     */
    public function getStatusInfo(){
        switch($this->status){
            case 1:
                return \Yii::t('app/order/main', 'Status successful!');
            default:
                return \Yii::t('app/order/main', 'Status failed!');
        }
    }

    /**
     * @return string
     */
    public function getTextByStatus(){
        switch($this->status){
            case 1:
                return \Yii::t('app/order/main', 'Congratulations! Your payment was successful!');
            default:
                return \Yii::t('app/order/main', 'Error! Payment failed!');
        }
    }


    /**
     * @return array|string|string[]
     */
    public function getNormalId(){
        $id = bindec($this->id) ?: 0;

        return substr_replace($id, "-", 5, 0) ;
    }
    /**
     * @return string
     */
    public function getClassByStatus(){
        switch($this->status){
            case 1:
                return 'success';
            default:
                return 'danger';
        }
    }

    /**
     * @return string
     */
    public function getUrlByStatus(){
        switch($this->status){
            case 1:
                return 'thank-you';
            default:
                return 'sorry';
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'],'required']
        ];
    }

}