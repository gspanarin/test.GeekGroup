<?php

use yii\db\Migration;


class m230714_183641_add_table_comment extends Migration{
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Автор коментаря'),
            'project_id' => $this->integer()->defaultValue(null)->comment('Ідентифікатор проекту'),
            'task_id' => $this->integer()->defaultValue(null)->comment('Ідентифікатор задачі'),
            'text' => $this->text()->defaultValue('')->comment('Текст коментаря'),
            'created_at' => $this->integer()->notNull()->comment('Дата створення коментаря'),
            'updated_at' => $this->integer()->notNull()->comment('Дата оновлення коментаря'),
            'version' => $this->bigInteger()->defaultValue(0)->comment('Версія запису'),
        ], $tableOptions);
        
        $this->addForeignKey(
            'fk-project_comment', 
            'comment', 
            'project_id', 
            'project', 
            'id', 
            'CASCADE');
        
        $this->addForeignKey(
            'fk-task_comment', 
            'comment', 
            'task_id', 
            'task', 
            'id', 
            'CASCADE');

        $this->addForeignKey(
            'fk-user_comment', 
            'comment', 
            'user_id', 
            'user', 
            'id', 
            'CASCADE');
        
        
        
        return true;
    }


    public function safeDown() {
        $this->dropForeignKey('fk-project_comment', 'comment');
        $this->dropForeignKey('fk-task_comment', 'comment');
        $this->dropForeignKey('fk-user_comment', 'comment');
        $this->dropTable('{{%comment}}');
        
        return true;
    }
    
}
