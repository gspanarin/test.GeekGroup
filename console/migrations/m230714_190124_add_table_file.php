<?php

use yii\db\Migration;

class m230714_190124_add_table_file extends Migration{

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Ідентифікатор користувача'),
            'name' => $this->string()->defaultValue('')->comment('Назва файлу'),
            'type' => $this->string()->defaultValue('')->comment('Тип файлу'),
            'sizeOf' => $this->integer()->defaultValue(0)->comment('Розмір файлу'),
            'path' => $this->string()->defaultValue('')->comment('Шлях зберігання'),
            'comment_id' => $this->integer()->notNull()->comment('Ідентифікатор коментаря'),
            'created_at' => $this->integer()->notNull()->comment('Дата створення коментаря'),
            'updated_at' => $this->integer()->notNull()->comment('Дата оновлення коментаря'), 
        ], $tableOptions);
        
        $this->addForeignKey(
            'fk-comment_file', 
            'file', 
            'comment_id', 
            'comment', 
            'id',             
            'CASCADE');
        
       
        return true;
    }


    public function safeDown() {
        $this->dropForeignKey('fk-comment_file', 'file');
        $this->dropTable('{{%file}}');
        
        return true;
    } 
    
}
