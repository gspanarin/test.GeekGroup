<?php

use yii\db\Migration;

class m230714_184943_add_table_organization extends Migration{
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%organization}}', [
            'id' => $this->primaryKey(),
            'title' => $this->text()->defaultValue('')->comment('Повна назва організації'),
            'shot_title' => $this->text()->defaultValue('')->comment('Скорочена назва організації'),
            'description' => $this->text()->defaultValue('')->comment('Опис організації'),
            'user_id' => $this->integer()->notNull()->comment('Основна контактна особа'),
            'created_at' => $this->integer()->notNull()->comment('Дата створення організації'),
            'updated_at' => $this->integer()->notNull()->comment('Дата оновлення організації'),
            'version' => $this->bigInteger()->defaultValue(0)->comment('Версія запису'),
        ], $tableOptions);
        
        return true;
    }


    public function safeDown() {
        $this->dropTable('{{%organization}}');
        
        return true;
    } 
    
}
