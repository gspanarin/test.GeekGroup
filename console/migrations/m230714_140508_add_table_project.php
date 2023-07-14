<?php

use yii\db\Migration;

/**
 * Class m230714_140508_add_table_project
 * 
 * Створюємо таблицію для опису Проектів
 * 
 */
class m230714_140508_add_table_project extends Migration{

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->comment('Назва проекту'),
            'desciption' => $this->text()->defaultValue('')->comment('Опис проекту'),
            'status' => $this->smallInteger()->notNull()->defaultValue(0)->comment('Статус проекту'),
            'start_date' => $this->integer()->defaultValue(null)->comment('Дата початку роботи над проектом'),
            'finish_date' => $this->integer()->defaultValue(null)->comment('Дата завершення роботи над проектом'),
            'creater_id' => $this->integer()->notNull()->comment('Ідентифікатор користувача, який створив проект'),
            'created_at' => $this->integer()->notNull()->comment('Дата створення проетку'),
            'updated_at' => $this->integer()->notNull()->comment('Дата оновлення проекту'),
            'version' => $this->bigInteger()->defaultValue(0)->comment('Версія запису'),
        ], $tableOptions);
        
        $this->createTable('{{%ref_project_user}}', [
            'id' => $this->primaryKey(),
            'project_id' => $this->integer()->notNull()->comment('Проект'),
            'user_id' => $this->integer()->notNull()->comment('Користувач'),
            'role' => $this->integer()->notNull()->comment('Роль користувача у проекті'),
        ], $tableOptions);
        
        
        return true;
    }


    public function safeDown() {
        $this->dropTable('{{%project}}');
        $this->dropTable('{{%ref_project_user}}');
        
        return true;
    }
}
