<?php

use yii\helpers\Html;
use kartik\file\FileInput;
use \yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\widgets\Settings $model */
/** @var yii\widgets\ActiveForm $form */

$initialPreview = [];
$initialPreviewConfig = [];
if ($model->logo) {
    $initialPreview = [$model->logo];
    $initialPreviewConfig[] = [
            'url' => Url::to('/settings/clear-logo', 'https'),
            'downloadUrl' => Url::to($model->logo)
    ];
}
?>

<div class="pessoa-form col-12 col-xxl-8">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'class' => 'form-horizontal',
    ]); ?>

    <div class="row">

        <div class="lead">
            <?= Yii::t('settings', 'Company Details') ?>
        </div>
        <hr>
        <div class="col-12">
            <?= $form->field($model, 'companyName', [
                'template' => '<label class="col-sm-4 col-form-label" for="configuracao-duracaoimagem">' . $model->attributeLabels()['companyName'] . '</label><div class="col-sm-8">{input}</div>{error}',
            ]) ?>
            <?= $form->field($model, 'logo', [
                'template' => '<label class="col-sm-4 col-form-label" for="configuracao-duracaoimagem">' . $model->attributeLabels()['logo'] . '</label><div class="col-sm-8">{input}</div>{error}',
            ])->widget(FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                    'enctype' => 'multipart/form-data',
                ],
                'pluginOptions' => [
                    'initialPreviewAsData' => true,
                    'initialPreview' => $initialPreview,
                    'initialPreviewConfig' => $initialPreviewConfig,
                    'allowedFileExtensions' => ['jpg','jpeg', 'png', 'gif'],
                ]
            ]) ?>
        </div>
        <div class="form-group text-end my-3">
            <?= Html::button('Voltar', ['class' => 'btn btn-default', 'onclick' => 'window.history.back()']) ?>
            <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
