<?php

namespace artsoft\feedback\controllers;

use Yii;
use artsoft\controllers\admin\BaseController;

/**
 * FeedbackController implements the CRUD actions for artsoft\models\Feedback model.
 */
class DefaultController extends BaseController 
{
    public $modelClass       = 'artsoft\feedback\models\Feedback';
    public $modelSearchClass = 'artsoft\feedback\models\search\FeedbackSearch';

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id];
                break;
            case 'create':
                return ['update', 'id' => $model->id];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }
}
