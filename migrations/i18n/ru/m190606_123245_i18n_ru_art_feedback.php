<?php

use artsoft\db\TranslatedMessagesMigration;

class m190606_123245_i18n_ru_art_feedback extends TranslatedMessagesMigration
{

    public function getLanguage()
    {
        return 'ru';
    }

    public function getCategory()
    {
        return 'art/feedback';
    }

    public function getTranslations()
    {
        return [
            'Business' => 'Деятельность',            
            'Feedback' => 'Отзывы',
            'Main On' => 'На главной',
            'On' => 'Вкл',
            'Off' => 'Выкл',
        ];
        
    }
}