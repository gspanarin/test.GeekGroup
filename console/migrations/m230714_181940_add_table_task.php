<?php

use yii\db\Migration;

class m230714_181940_add_table_task extends Migration{
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull()->comment('Ідентифікатор проекту'),
            'user_id' => $this->integer()->comment('Користувач, відповідальний за задачу'),
            'status' => $this->smallInteger()->notNull()->defaultValue(0)->comment('Статус задачі'),
            'title' => $this->string(255)->comment('Назва задачі'),
            'desciption' => $this->text()->defaultValue('')->comment('Опис задачі'),
            'start_date' => $this->dateTime()->defaultValue(null)->comment('Дата початку роботи над задачею'),
            'finish_date' => $this->dateTime()->defaultValue(null)->comment('Дата завершення роботи над задачею'),
            'creater_id' => $this->integer()->notNull()->comment('Ідентифікатор користувача, який створив задачу'),
            'created_at' => $this->integer()->notNull()->comment('Дата створення задачі'),
            'updated_at' => $this->integer()->notNull()->comment('Дата оновлення задачі'),
            'version' => $this->bigInteger()->defaultValue(0)->comment('Версія запису'),
        ], $tableOptions);
        
        $this->addForeignKey(
            'fk-project_task', 
            'task', 
            'project_id', 
            'project', 
            'id', 
            'CASCADE');
        
        return true;
    }


    public function safeDown() {
        $this->dropForeignKey('fk-project_task', 'task');
        $this->dropTable('{{%task}}');
        
        return true;
    }
}
