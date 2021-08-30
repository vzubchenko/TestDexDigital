<?php

use yii\db\Migration;

class m210830_040020_add_table_order extends Migration
{
    public function up()
    {
        $this->createTable('order',[
            'id' => $this->primaryKey( 47 ),
            'status' => $this->smallInteger(2),
        ]);
    }

    public function down()
    {
        $this->dropTable('order');
    }

}
