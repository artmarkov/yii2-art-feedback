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

    <div class="row">
        <div class="col-md-8">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6"> 
                            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6"> 
                            <?= $form->field($model, 'business')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                            <?= $form->field($model, 'content')->widget(trntv\aceeditor\AceEditor::class,
                                     [
                                         'mode' => 'html',
                                         'theme' => 'sqlserver', //chrome,clouds,clouds_midnight,cobalt,crimson_editor,dawn,dracula,dreamweaver,eclipse,iplastic
                                                                 //merbivore,merbivore_soft,sqlserver,terminal,tomorrow_night,twilight,xcode
                                     ]) ?>
                    
                </div>
            </div>
        </div>

        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="record-info">
                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;"><?=  $model->attributeLabels()['id'] ?>: </label>
                            <span><?=  $model->id ?></span>
                        </div>
                        
                        <?php if (!$model->isNewRecord): ?>

                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;">
                         <?= $model->attributeLabels()['created_at'] ?> :
                            </label>
                            <span><?= $model->createdDatetime ?></span>
                        </div>

                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;">
                        <?= $model->attributeLabels()['updated_at'] ?> :
                            </label>
                            <span><?= $model->updatedDatetime ?></span>
                        </div>

                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;">
                        <?= $model->attributeLabels()['updated_by'] ?> :
                            </label>
                            <span><?= $model->updatedBy->username ?></span>
                        </div>
                        
                        <?php endif; ?>
                           
                        <div class="form-group">
                            <?php  if ($model->isNewRecord): ?>
                                <?= Html::submitButton(Yii::t('art', 'Create'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('art', 'Cancel'), ['/feedback/default/index'], ['class' => 'btn btn-default']) ?>
                            <?php  else: ?>
                                <?= Html::submitButton(Yii::t('art', 'Save'), ['class' => 'btn btn-primary']) ?>
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
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
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
    </div>

    <?php  ActiveForm::end(); ?>

</div>
