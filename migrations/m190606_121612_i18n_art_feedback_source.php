<?php

use artsoft\db\SourceMessagesMigration;

class m190606_121612_i18n_art_feedback_source extends SourceMessagesMigration
{

    public function getCategory()
    {
        return 'art/feedback';
    }

    public function getMessages()
    {
        return [
            'Business' => 1,            
            'Feedback' => 1,
            'Main On' => 1,
            'On' => 1,
            'Off' => 1,
        ];
    }
}