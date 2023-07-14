<?php

use yii\db\Migration;

class m230714_190138_add_table_operation_log extends Migration{
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%operation_log}}', [
            'id' => $this->primaryKey(),
            'operation_type' => $this->string()->notNull()->comment($tableOptions),
            'descripton' => $this->string()->comment('Опис операції'),
            'user_id' => $this->integer()->notNull()->comment('Ідентифікатор користувача'),
            'project_id' => $this->integer()->notNull()->comment('Ідентифікатор коментаря'),
            'task_id' => $this->integer()->notNull()->comment('Ідентифікатор коментаря'),
            'comment_id' => $this->integer()->notNull()->comment('Ідентифікатор коментаря'),
            'file_id' => $this->integer()->notNull()->comment('Ідентифікатор коментаря'),
            'created_at' => $this->integer()->notNull()->comment('Дата створення коментаря'),
        ], $tableOptions);
        
        
        $this->addForeignKey(
            'fk-user_log', 
            'operation_log', 
            'user_id', 
            'user', 
            'id',             
            'CASCADE');
        
        $this->addForeignKey(
            'fk-project_log', 
            'operation_log', 
            'project_id', 
            'project', 
            'id',             
            'CASCADE');
        
        $this->addForeignKey(
            'fk-task_log', 
            'operation_log', 
            'task_id', 
            'task', 
            'id',             
            'CASCADE');
        
        $this->addForeignKey(
            'fk-comment_log', 
            'operation_log', 
            'comment_id', 
            'comment', 
            'id',             
            'CASCADE');
        
        
        $this->addForeignKey(
            'fk-file_log', 
            'operation_log', 
            'file_id', 
            'file', 
            'id',             
            'CASCADE');
        
        return true;
    }


    public function safeDown() {
        $this->dropForeignKey('fk-user_log', 'operation_log');
        $this->dropForeignKey('fk-project_log', 'operation_log');
        $this->dropForeignKey('fk-task_log', 'operation_log');
        $this->dropForeignKey('fk-comment_log', 'operation_log');
        $this->dropForeignKey('fk-file_log', 'operation_log');
        $this->dropTable('{{%operation_log}}');
        
        return true;
    } 
}
