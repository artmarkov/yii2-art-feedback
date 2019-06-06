<?php

use yii\db\Migration;

class m190606_123015_i18n_ru_menu_feedback extends Migration
{

    public function up()
    {
        
        $this->insert('{{%menu_link_lang}}', ['link_id' => 'feedback', 'label' => 'Отзывы клиентов', 'language' => 'ru']);

    }

}