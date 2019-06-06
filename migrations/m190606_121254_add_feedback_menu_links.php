<?php

use yii\db\Migration;

class m190606_121254_add_feedback_menu_links extends Migration
{

    public function up()
    {
        $this->insert('{{%menu_link}}', ['id' => 'feedback', 'menu_id' => 'admin-menu', 'link' => '/feedback/default/index', 'created_by' => 1, 'order' => 1]);        
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'feedback', 'label' => 'Feedback', 'language' => 'en-US']);
        
    }

    public function down()
    {
        $this->delete('{{%menu_link}}', ['like', 'id', 'feedback']);
    }
}