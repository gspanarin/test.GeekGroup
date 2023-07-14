<?php

use yii\db\Migration;

class m230714_140507_add_collumn_to_user extends Migration{

    public function safeUp(){
        $this->addColumn('{{%user}}', 'organization_id', $this->integer()->defaultValue(null)->comment('Організація'));
        $this->addColumn('{{%user}}', 'phone', $this->string()->defaultValue('')->comment(''));
        $this->addColumn('{{%user}}', 'avatar', $this->string()->defaultValue('')->comment(''));
        $this->addColumn('{{%user}}', 'comment', $this->text()->defaultValue('')->comment(''));
        $this->addColumn('{{%user}}', 'version', $this->bigInteger()->defaultValue(0)->comment('Версія запису'));
        
        return true;
    }

    public function safeDown(){
        $this->dropColumn('{{%user}}', 'organization_id');
        $this->dropColumn('{{%user}}', 'phone');
        $this->dropColumn('{{%user}}', 'avatar');
        $this->dropColumn('{{%user}}', 'comment');
        $this->dropColumn('{{%user}}', 'version');

        return true;
    }

}
