<?php

use artsoft\widgets\ActiveForm;
use artsoft\feedback\models\Feedback;
use artsoft\helpers\Html;
use yii\jui\DatePicker;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model artsoft\feedback\models\Feedback */
/* @var $form artsoft\widgets\ActiveForm */
?>

<div class="feedback-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'feedback-form',
        'validateOnBlur' => false,
    ])
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">


                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'business')->textInput(['maxlength' => true]) ?>


                    <?= $form->field($model, 'content')->widget(trntv\aceeditor\AceEditor::class,
                        [
                            'mode' => 'html',
                            'theme' => 'sqlserver', //chrome,clouds,clouds_midnight,cobalt,crimson_editor,dawn,dracula,dreamweaver,eclipse,iplastic
                            //merbivore,merbivore_soft,sqlserver,terminal,tomorrow_night,twilight,xcode
                        ]) ?>


                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'published_at')
                        ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control']]);
                    ?>

                    <?= $form->field($model, 'status')->dropDownList(Feedback::getStatusList()) ?>

                    <?= $form->field($model, 'main_flag')->widget(SwitchInput::classname(), [
                        'pluginOptions' => [
                            'size' => 'small',
                        ],
                    ]);
                    ?>

                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="form-group">
                    <?= Html::a(Yii::t('art', 'Go to list'), ['/feedback/default/index'], ['class' => 'btn btn-default']) ?>
                    <?= Html::submitButton(Yii::t('art', 'Save'), ['class' => 'btn btn-primary']) ?>
                <?php if (!$model->isNewRecord): ?>
                    <?= Html::a(Yii::t('art', 'Delete'),
                        ['/feedback/default/delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                <?php endif; ?>
            </div>
            <?= \artsoft\widgets\InfoModel::widget(['model' => $model]); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
