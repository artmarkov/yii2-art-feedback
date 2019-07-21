<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use artsoft\grid\GridView;
use artsoft\grid\GridQuickLinks;
use artsoft\feedback\models\Feedback;
use artsoft\helpers\Html;
use artsoft\grid\GridPageSize;

/* @var $this yii\web\View */
/* @var $searchModel artsoft\feedback\models\search\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $this->title = Yii::t('art/feedback', 'Feedback');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title"><?=  Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('art', 'Add New'), ['/feedback/default/create'], ['class' => 'btn btn-sm btn-success']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?php 
                    /* Uncomment this to activate GridQuickLinks */
                     echo GridQuickLinks::widget([
                        'model' => Feedback::className(),
                        'searchModel' => $searchModel,
                          'labels' => [
                            'all' => Yii::t('art', 'All'),
                            'active' => Yii::t('art', 'Published'),
                            'inactive' => Yii::t('art', 'Pending'),
                        ]
                    ])
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?=  GridPageSize::widget(['pjaxId' => 'feedback-grid-pjax']) ?>
                </div>
            </div>

            <?php 
            Pjax::begin([
                'id' => 'feedback-grid-pjax',
            ])
            ?>

            <?= GridView::widget([
                'id' => 'feedback-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'feedback-grid',
                    'actions' => [
                        Url::to(['bulk-activate']) => Yii::t('art', 'Publish'),
                        Url::to(['bulk-deactivate']) => Yii::t('art', 'Unpublish'),
                        Url::to(['bulk-delete']) => Yii::t('yii', 'Delete'),
                    ]
                ],
                'columns' => [
                    ['class' => 'artsoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'artsoft\grid\columns\TitleActionColumn',
                        'options' => ['style' => 'width:350px'],
                        'attribute' => 'username',
                        'controller' => '/feedback/default',
                        'title' => function(Feedback $model) {
                            return Html::encode($model->username);
                        },
                        'buttonsTemplate' => '{update} {delete}',        
                    ],                     
                    'business',
                    [
                        'class' => 'artsoft\grid\columns\StatusColumn',
                        'attribute' => 'status',
                        'optionsArray' => Feedback::getStatusOptionsList(),
                        'options' => ['style' => 'width:150px'],
                    ],
                    [
                        'class' => 'artsoft\grid\columns\StatusColumn',
                        'attribute' => 'main_flag',
                        'optionsArray' => Feedback::getMainOptionsList(),
                        'options' => ['style' => 'width:200px'],
                    ],
                    [
                        'class' => 'artsoft\grid\columns\DateFilterColumn',
                        'attribute' => 'published_at',
                        'value' => function (Feedback $model) {
                            return '<span style="font-size:85%;" class="label label-'
                            . ((time() >= $model->published_at) ? 'primary' : 'default') . '">'
                            . $model->publishedDate . '</span>';
                        },
                        'format' => 'raw',
                        'options' => ['style' => 'width:150px'],
                    ],

                ],
            ]);
            ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>


