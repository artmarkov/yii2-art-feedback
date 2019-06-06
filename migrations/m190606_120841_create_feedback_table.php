<?php

use yii\db\Migration;

class m190606_120841_create_feedback_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
             $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

       $this->createTable('{{%feedback}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'business' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'published_at' => $this->integer()->notNull(),
            'status' => $this->tinyInteger()->notNull(),
            'main_flag' => $this->integer()->notNull()->defaultValue('0'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('created_by', '{{%feedback}}', 'created_by');
        $this->createIndex('updated_by', '{{%feedback}}', 'updated_by');
        $this->addForeignKey('feedback_ibfk_1', '{{%feedback}}', 'created_by', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('feedback_ibfk_2', '{{%feedback}}', 'updated_by', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
    }
    
    public function down()
    {
      $this->dropTable('{{%feedback}}');
    }
}
