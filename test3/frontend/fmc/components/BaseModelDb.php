<?php

namespace fmc\components;


use yii\base\Model;

/**
 * Class BaseModelDb
 * @package fmc\components
 *
 */
abstract class BaseModelDb extends Model
{
    /**
     * @return string
     */
    public abstract static function getTable();


    public static function getFields() {
        return [];
    }

    public function __set($name, $value)
    {
        $setter = 'set' . ucwords($name,'_');
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        }
        if (isset($this->getAttributes()[$name]) || array_key_exists($name, $this->getAttributes())) {
            $this->$name = $value;
            return;
        }
        parent::__set($name, $value);
    }

    public function __get($name)
    {
        $getter = 'get' . ucwords($name,'_');
        $getter = str_replace('_', '', $getter);

        if (method_exists($this, $getter)) {
            return $this->$getter();
        }

        if (isset($this->getAttributes()[$name]) || array_key_exists($name, $this->getAttributes())) {
            return $this->getAttributes()[$name];
        }

        return parent::__get($name);
    }
}