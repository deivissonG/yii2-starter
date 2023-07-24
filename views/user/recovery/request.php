<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View               $this
 * @var yii\widgets\ActiveForm     $form
 * @var \Da\User\Form\RecoveryForm $model
 */

$this->title = Yii::t('usuario', 'Recover your password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row h-100 vh-100 ms-0 me-0 position-relative">
    <div class="position-absolute top-50 start-50 translate-middle card col-sm-12 col-md-8 col-lg-6 col-xl-4 p-4">
        <div class="card-title px-2">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body">
                <?php $form = ActiveForm::begin(
                    [
                        'id' => $model->formName(),
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => false,
                    ]
                ); ?>

            <div class="mb-3">
                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            </div>

            <?= Html::submitButton(Yii::t('usuario', 'Continue'), ['class' => 'btn btn-primary btn-block mr-1']) ?>
            <?= Html::a(Yii::t('app', 'Back'), Yii::$app->request->referrer, ['class' => 'btn btn-light btn-block']) ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
